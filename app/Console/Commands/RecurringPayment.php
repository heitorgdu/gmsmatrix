<?php
/**
 * Created by PhpStorm.
 * User: Mustabeen
 * Date: 08/05/2017
 * Time: 11:53 AM
 */

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\Allocate;
use App\Models\Approval;
use PayPal\Types\AP\Receiver;
use Illuminate\Console\Command;
use PayPal\Types\AP\PayRequest;
use PayPal\Types\AP\ReceiverList;
use PayPal\Types\AP\SenderIdentifier;
use PayPal\Types\Common\RequestEnvelope;
use PayPal\Service\AdaptivePaymentsService;

class RecurringPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recurring Payment on Renewal Date';


    /**
     * ImportOrderDetails constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        @set_time_limit(0);
        @ini_set("max_execution_time", 999999999999);
        $companies = Company::all();
        $config = array(
            'mode' => 'sandbox',
            'acct1.UserName' => 'business_api1.xoho.tech',
            'acct1.Password' => 'QNDB5535VJG4DPV5',
            'acct1.Signature' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAEs1kwIPjNwpI9gCogTBtj0JkKoJ',
            'acct1.AppId' => 'APP-80W284485P519543T'
        );
        $requestEnvelope = new RequestEnvelope("en_US");
        $allocate = Allocate::where('recnum', 1)->first();
        $primary = Company::where('cid', 101)->first();
        $gp = Company::where('cid', 102)->first();
        if ((!$primary) || ($primary['paypal_email'] == null)) {
            return;
        }
        if ((!$gp) || ($gp['paypal_email'] == null)) {
            return;
        }


        foreach ($companies as $company) {

            $amt = $company['cost'];
            $tech = Company::where('tcid', $company['tcid'])->where('type', 't')->first();
            $referral = Company::where('cid', $company['rcid'])->first();

            $_gloTot = $amt * $allocate['portal'];
            $_gpTot = $amt * $allocate['gp'];
            $_techTot = $amt * $allocate['tech'];
            $_referralTot = $amt * $allocate['referral'];

            if ((!$referral) || ($referral['paypal_email'] == null)) {
                $referral['paypal_email'] = $primary['paypal_email'];
            }
            if ((!$tech) || ($tech['paypal_email'] == null)) {
                $tech['paypal_email'] = $primary['paypal_email'];
            }

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

                foreach($dataNeed['receivers'] as $k1 => $arrays) {
                    if ($arrays['email'] == null) {
                    }else {
                        $receivers[$k1] = new Receiver();
                        $receivers[$k1]->email = $arrays['email'];
                        $receivers[$k1]->amount = $arrays['amount'];
                        $receivers[$k1]->primary = $arrays['primary'];
                    }
                }
            }
            $receiverList = new ReceiverList($receivers);

            $exp = Carbon::parse($company['expires']);
            $today = Carbon::parse('now');
            $diff = date_diff($exp, $today);
            $days = abs($diff->days);
            if (($company['expires'] != NULL) && ($days < 1)) {
                $approval = Approval::where('cid', $company['cid'])->where('preapprovalKey', 'like', 'PA-'.'%')->orderBy('created_at', 'desc')->first();

                $service = new AdaptivePaymentsService($config);
                $payRequest = new PayRequest($requestEnvelope,'PAY_PRIMARY',url('/'), 'USD', $receiverList, url('/'));
                $payRequest->feesPayer = 'PRIMARYRECEIVER';
                $payRequest->preapprovalKey  = $approval['preapprovalKey'];
                $payRequest->sender = new SenderIdentifier();
                $payRequest->sender->email  = $company['paypal_email'];
                $response = $service->Pay($payRequest);
                if($response->responseEnvelope->ack == 'Success'){
                    $company['expires'] = date('Y-m-d', strtotime('+1 month'));;
                    $company['new_expiry'] = date('Y-m-d', strtotime('+1 month'));;
                    $company['renewal_diff'] = date('d', strtotime($company['new_expiry']));
                    $company->save();
                }
                $this->info($response->responseEnvelope->ack);
            } else {
                $this->info('failed');
            }
        }
    }
}
