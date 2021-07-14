<?php
/**
 * Created by PhpStorm.
 * User: Mustabeen
 * Date: 7/26/2017
 * Time: 12:20 AM
 */

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Discount;
use App\Models\Location;
use App\Models\Service;
use App\Models\SiteVars;
use App\User;
use Carbon\Carbon;
use App\Models\Sub;
use App\Http\Requests;
use App\Models\Company;
use App\Models\Approval;
use App\Models\Allocate;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PayPal\Types\AP\Receiver;
use PayPal\Types\AP\PayRequest;
use PayPal\Types\AP\ReceiverList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PayPal\Types\AP\SenderIdentifier;
use PayPal\Types\AP\PreapprovalRequest;
use PayPal\Types\Common\RequestEnvelope;
use PayPal\Service\AdaptivePaymentsService;
use Srmklive\PayPal\Services\AdaptivePayments;


class PayPalController extends Controller
{
    protected $provider;

    public function __construct(AdaptivePayments $provider)
    {
        $this->provider = $provider;
    }


    /**
     * @param Request $request
     * @param $givenId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function preApproval(Request $request, $givenId)
    {

        $dataGiven = $request->all();

        if ($givenId == null) {
            $givenId = $request->user()->cid;
        }
        $company = Company::where('cid', $givenId)->first();

        if ((!$dataGiven['paypalEmail']) || ($dataGiven['paypalEmail'] == null)) {
            $company['new_cost'] = NULL;
            $company->save();
            $errorMsg = "Please set a PayPal Email address for this company";
            $this->sendErrorEmail($request, $errorMsg, $company, $givenId);
        }
        if (($company['new_cost'] != NULL) || ($company['new_cost'] != 0)) {
            $company['new_cost'] = NULL;
            $company->save();
            $errorMsg = 'Do not make further changes until PayPal processes recent changes';
            $this->sendErrorEmail($request, $errorMsg, $company, $givenId);
        }
        $company['new_cost'] = $dataGiven['amountToPay'];

        $company['paypal_email'] = $dataGiven['paypalEmail'];
        $company->save();

        $config = array(
            'mode' => env('PAYPAL_API_MODE', ''),
            'acct1.UserName' => env('PAYPAL_API_USERNAME', 'paypal_api1.ProTek2.com'),
            'acct1.Password' => env('PAYPAL_API_PASSWORD', 'CZHUHWN2E4FCAHBZ'),
            'acct1.Signature' => env('PAYPAL_API_SECRET', 'AFcWxV21C7fd0v3bYYYRCpSSRl31A5ZKA3Z7gId98fqTjyBTJBGRqNYV'),
            'acct1.AppId' => env('PAYPAL_API_APP_ID', 'APP-2R596630LE555572N')
        );
        Helper::cancelPreApproval($givenId);
        $service = new AdaptivePaymentsService($config);
        $requestEnvelope = new RequestEnvelope("en_US");
        $preapprovalRequest = new PreapprovalRequest(
            $requestEnvelope,
            url('subscription/'.$givenId),
            'USD',
            url('/preapproval/payment/'.$givenId.'?amount_due='.$dataGiven['amount_due']),
            date('Y-m-d', strtotime($company['new_expiry']))
        );

        if($company['sub_interval'] == 1){
            $paymentPeriod = 'MONTHLY';
        } elseif($company['sub_interval'] == 6){
            $paymentPeriod = 'MONTHLY';
        } elseif($company['sub_interval'] == 12){
            $paymentPeriod = 'MONTHLY';
        } else {
            $paymentPeriod = 'MONTHLY';
        }
        $end = date('Y-m-d', strtotime($company['new_expiry']. '+2 years'));
        $preapprovalRequest->endingDate = $end;
        $preapprovalRequest->paymentPeriod = $paymentPeriod;
        $preapprovalRequest->maxAmountPerPayment = round($dataGiven['amountToPay'], 2);
        $preapprovalRequest->maxTotalAmountOfAllPayments = 5000;
        $preapprovalRequest->pinType = 'NOT_REQUIRED';
        $preapprovalRequest->senderEmail =  $company['paypal_email'];
//        $preapprovalRequest->displayMaxTotalAmount = TRUE;
        $preapprovalRequest->feesPayer = 'PRIMARYRECEIVER';
        $preapprovalRequest->ipnNotificationUrl = url('/ipn/notification');

        $response = $service->Preapproval($preapprovalRequest);
//dd($response);
        $token = $response->preapprovalKey;
        $this->saveApprovalI($givenId, $response, $rand = rand());
        $payPalURL = 'https://www.sandbox.paypal.com/webscr&cmd=_ap-preapproval&preapprovalkey='. $token;
        return redirect($payPalURL);
    }

    /**
     * @param Request $request
     * @param null $givenId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function preApprovedPayment(Request $request, $givenId = null)
    {
        $dataGiven = $request->all();
        $requestEnvelope = new RequestEnvelope("en_US");
        $config = array(
            'mode' => env('PAYPAL_API_MODE', ''),
            'acct1.UserName' => env('PAYPAL_API_USERNAME', 'paypal_api1.ProTek2.com'),
            'acct1.Password' => env('PAYPAL_API_PASSWORD', 'CZHUHWN2E4FCAHBZ'),
            'acct1.Signature' => env('PAYPAL_API_SECRET', 'AFcWxV21C7fd0v3bYYYRCpSSRl31A5ZKA3Z7gId98fqTjyBTJBGRqNYV'),
            'acct1.AppId' => env('PAYPAL_API_APP_ID', 'APP-2R596630LE555572N')
        );

        if ($givenId == null) {
            $givenId = $request->user()->cid;
        }
        $company = Company::where('cid', $givenId)->first();
        $amt = $company['new_cost'];
        $needValues = $this->getDataNeededArray($company, $amt, $request, $givenId, 'preapproval');
        $receivers = $this->makeDataRList($needValues, $receivers=array(), 'preapproval');
        $receiverList = new ReceiverList($receivers);

        $approval = Approval::where('cid', $company['cid'])->where('preapprovalKey', 'like', 'PA-' . '%')->orderBy('created_at', 'desc')->first();
        \PayPal\Core\PPHttpConfig::$DEFAULT_CURL_OPTS[CURLOPT_SSLVERSION] = 6;
        $service = new AdaptivePaymentsService($config);
        $payRequest = new PayRequest(
            $requestEnvelope,
            'PAY_PRIMARY',
            url('subscription/'.$givenId),
            'USD',
            $receiverList,
            url('/adaptive/payment/'.$givenId.'?amount_due='.$dataGiven['amount_due'])
        );
        $payRequest->feesPayer = 'PRIMARYRECEIVER';
        $payRequest->preapprovalKey = $approval['preapprovalKey'];
        $payRequest->ipnNotificationUrl = url('/ipn/notification');
        $payRequest->sender = new SenderIdentifier();
        $payRequest->sender->email = $company['paypal_email'];
        $service->Pay($payRequest);
        return redirect('/adaptive/payment/'.$givenId.'?amount_due='.$dataGiven['amount_due']);
    }

    /**
     * @param Request $request
     * @param null $givenId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function adaptiveCheck(Request $request, $givenId = null)
    {
        $dataGiven = $request->all();
        if ($givenId == null) {
            $givenId = $request->user()->cid;
        }
        $company = Company::where('cid', $givenId)->first();
        $rand = rand();
        $needValues = $this->getDataNeededArray($company, $dataGiven['amount_due'], $request, $givenId, 'adaptive');
        $data['receivers'] = $this->makeDataRList($needValues['array'], $data=array(), 'adaptive');
        $data['total'] = $needValues['sum'];
        $data['payer'] = 'PRIMARYRECEIVER';
        $dataGiven['amountToPay'] = $company['new_cost'];
        $data['return_url'] = url('/paypal/checkout/' . $givenId . '/'.$rand.'?value=' . $dataGiven['amountToPay']);
        $data['cancel_url'] = url('/paypal/checkout/' . $givenId . '/'.$rand.'?value=' . $dataGiven['amountToPay']);
        $response = $this->provider->createPayRequest($data);

        $this->saveTrans($givenId, $response, $dataGiven['amount_due']);
        $approval = $this->saveApproval($givenId, $response, $rand);
        if ($approval['error'] == 'error') {
            $company['new_cost'] = NULL;
            $company->save();
            $errorMsg = $response['error'][0]['message'];
            $this->sendErrorEmail($request, $errorMsg, $company, $givenId);
            $request->session()->flash('alert-danger', $errorMsg);
            return redirect('subscription/'.$givenId);
        } else {
            $approval['preapprovalKey'] = $response['payKey'];
            $redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);
            return redirect($redirect_url);
        }

    }


    /**
     * @param Request $request
     * @param $givenId
     * @param $key
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function returnFunction(Request $request, $givenId, $key)
    {
        $company = Company::where('cid', $givenId)->first();

        $alertEmail = '';
        $approval = Approval::where('rand', $key)->first();
        $pro = $this->provider->getPaymentDetails($approval['preapprovalKey']);
        $tpid = Company::where('cid', $company['tpid'])->first();
        $user = User::where('id', $tpid['contact'])->first();
        if (isset($user)) {
            $alertEmail = DB::table('email')->where('pid', $user['id'])->where('type', 'alert')->first();
        }
        if ($pro['status'] == 'COMPLETED') {
            $company['cost'] = $request->get('value');
            $company['new_cost'] = NULL;
            $company['removal_amt'] = 0;
            $company['expires'] = Carbon::parse($company['new_expiry']);
            $company['new_expiry'] = Carbon::parse($company['new_expiry']);
            $company['renewal_diff'] = date('d', strtotime($company['expires']));
            $company->save();

            $subs = Sub::where('cid', $givenId)->get();
            foreach ($subs as $sub) {
                $sub['device'] = 'unassigned';
                $sub->save();
            }
            $company->save();
            $request->session()->flash('alert-success', 'Action Completed');
        } else {
            $company['new_cost'] = NULL;
            $company->save();
            $errorMsg = 'Action Failed';
            $currentUser = User::where('id', $request->user()->id)->first();
            $currentCo = Company::where('cid', $request->user()->cid)->first();
            $adminCo = Company::where('cid', 102)->first();
            $admin = User::where('id', $adminCo['contact'])->first();
            if ($alertEmail != ''){
                Mail::send('errors.email', ['errorMsg' => $errorMsg, 'user' => $user, 'currentUser' => $currentUser, 'co' => $currentCo, 'cmp' => $company],
                    function ($message) use ($admin,$alertEmail) {
                        $message->to($alertEmail->e_addr)->subject(' GMS Matrix Alert from System');
                    });
            }
            $request->session()->flash('alert-danger', $errorMsg);
        }

        return redirect('management/'.$givenId);
    }

    public function saveApproval($givenId, $response, $rand)
    {
        $approval = new Approval();
        if (isset($response['payKey'])) {
            $approval['preapprovalKey'] = $response['payKey'];
            $approval['error'] = ' no error';
        } else {
            $approval['error'] = 'error';
            $approval['category'] = $response['error'][0]['category'];
            $approval['domain'] = $response['error'][0]['domain'];
            $approval['errorId'] = $response['error'][0]['errorId'];
            $approval['message'] = $response['error'][0]['message'];
            $approval['parameter'] = 'param';
            $approval['severity'] = $response['error'][0]['severity'];
        }
        $approval['cid'] = $givenId;
        $approval['rand'] = $rand;
        $approval['ack'] = $response['responseEnvelope']['ack'];
        $approval['build'] = $response['responseEnvelope']['build'];
        $approval['correlationId'] = $response['responseEnvelope']['correlationId'];
        $approval['timestamp'] = $response['responseEnvelope']['timestamp'];
        $approval->save();

        return $approval;
    }

    public function saveTrans($givenId, $response, $amount)
    {
        $trans = new Transaction();
        $trans['cid'] = $givenId;
        $trans['date'] = Carbon::now();
        $trans['txn_type'] = 'adaptive';
        $trans['paypal_data'] = json_encode($response);
        $trans['amount'] = $amount;
        $trans->save();
    }

    public function sendErrorEmail($request, $errorMsg, $company, $givenId)
    {
        $alertEmail = '';
        $user = User::where('id', $company['tpid'])->first();
        if (isset($user)) {
            $alertEmail = DB::table('email')->where('pid', $user['id'])->where('type', 'alert')->first();
        }
        $currentUser = User::where('id', $request->user()->id)->first();
        $currentCo = Company::where('cid', $request->user()->cid)->first();
        $adminCo = Company::where('cid', 102)->first();
        $admin = User::where('id', $adminCo['tpid'])->first();

        if ($alertEmail != ''){
            Mail::send('errors.email', ['errorMsg' => $errorMsg, 'user' => $user, 'currentUser' => $currentUser, 'co' => $currentCo, 'cmp' => $company],
                function ($message) use ($admin,$alertEmail,$company) {
                    $message->to($alertEmail->e_addr)->subject(' GMS Matrix Alert from System about'.$company['name']);
                });
        }

        $request->session()->flash('alert-danger', $errorMsg);
        return redirect('subscription/'.$givenId);
    }

    public function makeDataRList($dataNeed, $data, $type)
    {
        if (isset($dataNeed['receivers'])) {
            foreach($dataNeed['receivers'] as $k1 => $arrays) {
                foreach($dataNeed['receivers'] as $k2 => $val) {
                    if ($k1 != $k2) {
                        if($arrays['email'] == $val['email']) {

                            if ($arrays['primary'] == true){
                                $ifPrimary = true;
                                $amount = $arrays['amount'];
                            } elseif ($val['primary'] == true) {
                                $ifPrimary = true;
                                $amount = $val['amount'];
                            } else {
                                $ifPrimary = false;
                                $amount = $val['amount'] + $arrays['amount'];
                            }

                            $dataNeed['receivers'][$k1] = null;
                            $dataNeed['receivers'][$k2] =
                                [
                                    'email' => $val['email'],
                                    'amount' => $amount,
                                    'primary' => $ifPrimary,
                                ];
                        }
                    }
                }
            }

            if ($type == 'preapproval') {
                foreach ($dataNeed['receivers'] as $k1 => $arrays) {
                    if ($arrays['email'] == null) {
                    } else {
                        $data[$k1] = new Receiver();
                        $data[$k1]->email = $arrays['email'];
                        $data[$k1]->amount = $arrays['amount'];
                        $data[$k1]->primary = $arrays['primary'];
                    }
                }
            } else {
                foreach($dataNeed['receivers'] as $k1 => $arrays) {
                    if ($arrays['email'] == null) {
                    }else {
                        $data[] = $arrays;
                    }
                }
            }

        }

        return $data;
    }

    public function getDataNeededArray($company, $amount, $request, $givenId, $type)
    {
        $allocate = Allocate::where('recnum', 1)->first();
        $primary = Company::where('cid', 101)->first();
        $gp = Company::where('cid', 102)->first();
        $tech = Company::where('tcid', $company['tcid'])->where('type', 't')->first();
        $referral = Company::where('cid', $company['rcid'])->first();
        $tax = 0;
        $subs = DB::table('sub')->where('cid', $company['cid'])->groupBy('srv_id')->get();
        $location = Location::where('cid', $company['cid'])->first();
        $rate = SiteVars::where('recnum', 1)->first();
        foreach($subs as $sub) {
            $sub->service = Service::where('srv_id', $sub->srv_id)->first();
            if(count($location) > 0) {
                if(($location['st'] == "Texas")||($location['st'] == "TX")||($location['st'] == "texas")||($location['st'] == "tx")||($location['st'] == "TEXAS")||($location['st'] == "Tx")){
                    if($sub->service['tax'] == 'y'){
                        if ($type == 'adaptive') {
                            $setup_tax = $sub->service['setup'] * $rate['TX_Tax'];
                            $count = Sub::where('srv_id', $sub->srv_id)->where('device', 'pending')->where('cid', $company['cid'])->count();
                            $setup_tax = $setup_tax * $count;
                            $tax = $tax + $setup_tax;
                        } else {
                            if($sub->service['name'] != 'mts') {
                                $srvTax = $sub->service['price'] * $rate['TX_Tax'];
                                $count = Sub::where('srv_id', $sub->srv_id)->where('cid', $company['cid'])->count();
                                $srvTax = $srvTax * $count;
                                $tax = $tax + $srvTax;
                            }
                        }
                    }
                }
            }
        }
        $amt = $amount;
        $amt = $amt - $tax;
        $changes = 0;
        $new_referralTot = 0;
        $new_gloTot = 0;
        $today = Carbon::parse('now');
        $dot_discount = 0;

        $discounts = Discount::where('expires','>=', $today)->get();
        foreach($discounts as $dis) {
            $srv = Service::where('name', $dis['service'])->first();
            $subDis = Sub::where('cid',$company['cid'])->where('device', 'pending')->where('srv_id', $srv['srv_id'])->where('token', $dis['code'])->count();
            $dot_dis = $dis['amount'] * $subDis;
            $dot_discount = $dot_discount + $dot_dis;

        }

        if ($type == 'adaptive') {
            $count = 0;
            $subs_count = 0;
            $services = Service::all();
            foreach ($services as $service) {
                $subs = Sub::where('srv_id', $service['srv_id'])->where('device', 'pending')->where('cid', $company['cid'])->count();
                $total = $service['setup'] * $subs;
                $count = $count + $total;
            }
            $services = Service::where('name', 'mts')->get();
            foreach ($services as $service) {
                $subs = Sub::where('srv_id', $service['srv_id'])->where('device', 'pending')->where('cid', $company['cid'])->count();
                $subs_count = $subs_count + $subs;
            }
            $count = $count - $dot_discount;
            $new_gloTot = 47 * $subs_count;
            $new_referralTot = $count - $new_gloTot;
            $new_referralTot = $new_referralTot * 0.97;
            $new_gloTot = $count - $new_referralTot;
            $changes = 1;
            $amt = $amt - $count;
        }

        $_gloTot = $amt * $allocate['portal'];
        $_gpTot = $amt * $allocate['gp'];
        $_techTot = $amt * $allocate['tech'];
        $_referralTot = $amt * $allocate['referral'];

        if ((!$primary) || ($primary['paypal_email'] == null)) {
            $company['new_cost'] = NULL;
            $company->save();
            $errorMsg = "Please set a PayPal Email address for company = 101";
            $this->sendErrorEmail($request, $errorMsg, $company, $givenId);
        }
        if ((!$gp) || ($gp['paypal_email'] == null)) {
            $company['new_cost'] = NULL;
            $company->save();
            $errorMsg = "Please set a PayPal Email address for company = 102";
            $this->sendErrorEmail($request, $errorMsg, $company, $givenId);
        }
        if ((!$referral) || ($referral['paypal_email'] == null)) {
            $referral['paypal_email'] = $primary['paypal_email'];
        }
        if ((!$tech) || ($tech['paypal_email'] == null)) {
            $tech['paypal_email'] = $primary['paypal_email'];
        }
        if ($changes == 1) {
            $_referralTot = $_referralTot + $new_referralTot;
            $_gloTot = $_gloTot + $new_gloTot;
        }
        $_gloTot = $_gloTot + $tax;
        $sum = $_gloTot + $_gpTot + $_techTot + $_referralTot ;


        $dataNeed = [
            'receivers' => [
                [
                    'email' => $primary['paypal_email'],
                    'amount' => round($sum,2),
                    'primary' => true,
                ],
                [
                    'email' => $tech['paypal_email'],
                    'amount' => round($_techTot,2),
                    'primary' => false
                ],
                [
                    'email' => $gp['paypal_email'],
                    'amount' => round($_gpTot,2),
                    'primary' => false
                ],
                [
                    'email' => $referral['paypal_email'],
                    'amount' => round($_referralTot,2),
                    'primary' => false
                ]
            ]
        ];

        if ($type == 'preapproval') {
            return $dataNeed;
        }
        $data['sum'] = $sum;
        $data['array'] = $dataNeed;

        return $data;
    }

    public function saveApprovalI($givenId, $response, $rand)
    {
        $token = $response->preapprovalKey;
        $approval = new Approval();
        if (isset($token)) {
            $approval['preapprovalKey'] = $token;
            $approval['error'] = ' no error';
        } else {
            $approval['error'] = 'error';
            $approval['category'] = $response->error[0]->category;
            $approval['domain'] = $response->error[0]->domain;
            $approval['errorId'] = $response->error[0]->errorId;
            $approval['message'] = $response->error[0]->message;
            $approval['parameter'] = 'param';
            $approval['severity'] = $response->error[0]->severity;
        }
        $approval['cid'] = $givenId;
        $approval['rand'] = $rand;
        $approval['ack'] = $response->responseEnvelope->ack;
        $approval['build'] = $response->responseEnvelope->build;
        $approval['correlationId'] = $response->responseEnvelope->correlationId;
        $approval['timestamp'] = $response->responseEnvelope->timestamp;
        $approval->save();

        return $approval;
    }

    public function ipnUrl()
    {
//        $emails = ['mustabeen@xoho.tech', 'gms-api@guardiantm.com'];
//        Mail::send('errors.ipnNotification', ['responseApi' => $_REQUEST],
//            function ($message) use ($emails) {
//                $message->to($emails)->subject('Pre Approval details');
//        });
    }
}