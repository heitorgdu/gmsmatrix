<?php
/**
 * Created by PhpStorm.
 * User: Mustabeen
 * Date: 7/19/2017
 * Time: 11:53 AM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SiteVars;
use App\Models\Discount;
use App\Models\Location;
use App\Helpers\Helper;
use App\Models\Company;
use App\Models\Service;
use App\Http\Requests;
use App\Models\Sub;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @param Request $request
     * @param null $givenId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $givenId = null)
    {
        if ($givenId == null) {
            $CoId = $request->user()->cid;
        } else {
            $CoId = $givenId;
        }
        $company = Company::where('cid', $CoId)->first();
        $user = Helper::getMTS($request, $CoId);
        $subs = DB::table('sub')->where('cid', $CoId)->groupBy('srv_id')->get();
        $data['current'] = 0;
        $data['days'] = 0;
        $data['credit'] = 0;
        $credit = 0;
        $data['tot_discount'] = 0;
        $data['new_cost'] = 0;
        $data['prorate'] = 0;
        $prorate = 0;
        $data['setup'] = 0;
        $data['setup_tax'] = 0;
        $data['tax'] = 0;
        $data['total'] = 0;
        $data['expiry'] = '+1d';
        $data['endExpiry'] = '+1m';
        $dot_discount = 0;
        $location = Location::where('cid', $CoId)->first();
        $rate = SiteVars::where('recnum', 1)->first();
        $oneSet = 0;
        $oneTax = 0;
        $for_new_cost = 0;
        $sub_interval = $company['sub_interval'];

        foreach($subs as $sub) {
            $sub->service = Service::where('srv_id', $sub->srv_id)->first();
            if(count($location) > 0) {
                if(($location['st'] == "Texas")||($location['st'] == "TX")||($location['st'] == "texas")||($location['st'] == "tx")||($location['st'] == "TEXAS")||($location['st'] == "Tx")){
                    if($sub->service['tax'] == 'y'){
                        $count = Sub::where('srv_id', $sub->srv_id)->where('device', 'pending')->where('cid', $CoId)->count();
                        $tot = $sub->service['setup'] * $count;
                        $setupTax = $tot * $rate['TX_Tax'];
                        $data['setup_tax'] = $data['setup_tax'] + $setupTax;
                        if($sub->service['name'] != 'mts') {
                            $count = Sub::where('srv_id', $sub->srv_id)->where('cid', $CoId)->count();
                            $tots= $sub->service['price'] * $count;
                            $srvTax = $tots * $rate['TX_Tax'];
                            $data['tax'] = $data['tax'] + $srvTax;
                        }
                    }
                }
            }
            $oneSet = $data['setup_tax'] / 30;
            $oneTax = $data['tax'] / 30;
            $for_new_cost = $data['setup_tax'] + $data['tax'];
            $sub->count = Sub::where('srv_id', $sub->srv_id)->where('device', 'pending')->where('cid', $CoId)->count();
            $data['setup'] = $data['setup'] + ($sub->service['setup'] * $sub->count);
            $sub->count = Sub::where('srv_id', $sub->srv_id)->where('cid', $CoId)->count();
            $data['new_cost'] = $data['new_cost'] + ($sub->service['price'] * $sub->count);
            $data['current'] = $sub->count;
            $data['current'] =  number_format(abs($data['current']), 2);

        }

        $subNot = Sub::where('cid',$request->user()->cid)->groupBy('srv_id')->pluck('srv_id');
        $services = Service::whereNotIn('srv_id', $subNot)->orderBy('srv_id', 'asc')->get();

        if(count($subs) < 1) {
            $company['expires'] = null;
            $company->save();
        } else {
            if (isset($company['expires'])) {
                if($company['new_expiry'] >= $company['expires']){
                    $data['expiry'] = date('M d', strtotime($company['expires']));
                    $data['endExpiry'] = date('M d', strtotime('+30 days', strtotime($company['expires'])));
                }
            }
        }

        if (isset($company['expires'])) {
            if (!isset($company['new_expiry'])){
                $company['new_expiry'] = $company['expires'];
            }
        }

        $test = Sub::where('cid', $CoId)->where('device', 'pending')->get();

        $today = Carbon::parse('now');
        if (isset($company['new_expiry'])) {
            $exp = Carbon::parse($company['new_expiry']);
            $explode = explode("-", $exp);
            $d = cal_days_in_month(CAL_GREGORIAN,$explode[1],$explode[1]);
        } else {
            $d = date('t');
        }

        $d = 30;


        if ((count($test) > 0) || (date('M d, Y', strtotime($company['expires'])) != date('M d, Y', strtotime($company['new_expiry']))))  {
            if (isset($company['new_expiry'])) {
                $exp = Carbon::parse($company['new_expiry']);
                $proDiff = date_diff($exp, $today);
                $proDays = abs($proDiff->days)+1;
                $prorate = abs(($data['new_cost'] / $d) * $proDays);
//                dd($proDays);
//                dd($exp, $proDiff, $proDays, $data['new_cost'] , ($data['new_cost'] / $d), $prorate);
                $data['prorate'] = number_format(abs($prorate), 2);
                $data['setup_tax'] = $oneSet*($proDays);
                $data['tax'] = $oneTax*($proDays);
            }
            if (isset($company['expires'])) {
                $d = date('t');
                $exp = Carbon::parse($company['expires']);
                $expDiff = date_diff($exp, $today);
                $expDays = abs($expDiff->days)+1;
                if ($company['cost'] > 0) {
                    $amt = $company['cost'] - $company['removal_amt'];
                    $credit = (($amt / $d) * $expDays);
                    $data['credit'] = number_format(abs($credit), 2);
                }

            }
            $discounts = Discount::where('expires','>=', $today)->get();
            foreach($discounts as $dis) {
                $srv = Service::where('name', $dis['service'])->first();
                $subDis = Sub::where('cid',$CoId)->where('device', 'pending')->where('srv_id', $srv['srv_id'])->where('token', $dis['code'])->count();
                $dot_dis = $dis['amount'] * $subDis;
                $dot_discount = $dot_discount + $dot_dis;

            }
        }

        if (isset($company['expires'])) {
            if (!isset($company['new_expiry'])){
                $company['new_expiry'] = date('M d', strtotime($company['expires']));
                $company['renewal_diff'] = date('d', strtotime($company['expires']));
            }
            $company['expires'] = date('M d, Y', strtotime($company['expires']));
        }
        if ((!isset($company['new_expiry'])) || ($company['new_expiry'] == NULL)){
            $company['new_expiry'] = date('M d', strtotime('+1 month'));
            $company['renewal_diff'] = date('d', strtotime($company['new_expiry']));
        } else {
            $company['new_expiry'] = date('M d', strtotime($company['new_expiry'] ));
            $company['renewal_diff'] = date('d', strtotime($company['new_expiry']));
        }

        $data['tot_discount'] = $dot_discount;
        $data['total'] = $prorate + $data['setup'] + $data['setup_tax'] + $data['tax'] - $credit - $dot_discount;
        if($data['total'] == $data['tax']) {
            $data['tax'] = 0;
            $data['total'] = 0;
        }
        $data['t'] = $data['total'];
        $data['total'] = number_format($data['total'], 2);
        $data['new_cost'] = $data['new_cost'] + $for_new_cost;
        $data['new_cost'] = $data['new_cost'] * $sub_interval;
        $data['nc'] = $data['new_cost'];
        $data['setup'] = number_format($data['setup'], 2);
        if($company['cost'] < 1) {
            $company['cost'] = $data['new_cost'];
        }
        $company['cost'] = number_format($company['cost'], 2);
        $data['tot_discount'] = number_format($dot_discount, 2);
        $data['new_cost'] = number_format($data['new_cost'], 2);
        $data['tax'] = $data['tax'] + $data['setup_tax'];
        $data['tax'] = number_format($data['tax'], 2);
        $location = Location::where('cid', $CoId)->count();


        return view('front.subscription', [
            'company' => $company,
            'user' => $user,
            'subs' => $subs,
            'services' => $services,
            'data' => $data,
            'location' => $location
        ]);
    }

    /**
     * @param Request $request
     * @param $givenId
     * @return array
     */
    public function show(Request $request, $givenId)
    {
        $data = $request->all();
        $idArray = explode(',', $data['ids']);
        $service = Service::where('srv_id', $givenId)->first();
        $subNot = Sub::where('cid', $data['CoId'])->groupBy('srv_id')->pluck('srv_id');
        $services = Service::whereNotIn('srv_id', $subNot)->whereNotIn('srv_id', $idArray)->orderBy('srv_id', 'asc')->get();

        return ([
            'subs' => $service,
            'services' => $services
        ]);
    }


    /**
     * @param Request $request
     * @param $givenId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveSubscription(Request $request, $givenId)
    {
        $check = 0;
        $checkBit = 0;
        $data = $request->all();
        if(isset($data['saveToken'])){
            $subsPrev = Sub::where('cid', $givenId)->where('device',  'pending')->where('token', null)->get();
            foreach($subsPrev as $item) {
                $item['token'] = $data['token'];
                $item->save();
            }
            if (count($subsPrev) > 0)  {
                $request->session()->flash('alert-success', 'Setup code has been saved');
            } else {
                $request->session()->flash('alert-danger', 'No new Subscription found to save setup code');
            }

            return redirect('subscription/'.$givenId);
        }
        $prevSub = Sub::where('cid', $givenId)->count();
        if ($prevSub == 0) {
            $company = Company::where('cid', $givenId)->first();
            $company['new_expiry'] = date('Y-m-d', strtotime('+1 month'));
            $company['renewal_diff'] = date('d', strtotime($company['new_expiry']));
            $company->save();
        }
        $counts = array();
        foreach ($data['srv_id'] as $index => $sub) {
            $count = Sub::where('srv_id', $sub)->where('cid', $givenId)->count();
            $counts[$index] = $count;

            if ($data['quantity'][$index] < $count) {
                $request->session()->flash('alert-danger',
                    'You must first remove the subscription(s) you no longer want.');
                return redirect('subscription');
            }
            if($data['quantity'][$index] != $counts[$index]){
                $checkBit = 1;
            }
        }


        if ($checkBit == 0) {
            $request->session()->flash('alert-danger',
                'Please First add the service you need or edit the quantity');
            return redirect('subscription');
        }
        $location = Location::where('cid', $givenId)->first();
        if($location) {
            $data['location'] = $location['lid'];
        }

        foreach ($data['srv_id'] as $index => $sub) {
            $loop = $data['quantity'][$index] - $counts[$index];
            if ((trim($sub) != '') && $loop != 0) {
                for($i=1; $i<=$loop; $i++) {
                    $subObj = new Sub();
                    $subObj->srv_id = $sub;
                    $subObj->lid = NULL;
                    $subObj->cid = $givenId;
                    $subObj->device = 'pending';
                    $subObj->mod_by = $request->user()->id;
                    if(isset($data['token'])) {
                        $subObj->token = $data['token'];
                    }
                    $subObj->save();
                }
            }
        }
        $start = Carbon::parse('now');
        foreach ($data['srv_id'] as $index => $sub) {
            $srv = Service::where('srv_id', $sub)->first();
            if (isset($data['token'])) {
                $discounts = Discount::where('code', $data['token'])->where('service', $srv['name'])->where('expires','>=', $start)->count();
                if ($discounts > 0) {
                    $check = 1;
                    break;
                }
            }
        }
        Helper::cancelPreApproval($givenId);
        if (($check == 0)&&($data['token']) != null)  {
            $request->session()->flash('alert-success', 'Subscriptions has been updated successfully! But Setup Code was Invalid');
        } else {
            $request->session()->flash('alert-success', 'Subscriptions has been updated successfully!');
        }

        return redirect('subscription/'.$givenId);
    }

    /**
     * @param Request $request
     * @param null $givenId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function management(Request $request, $givenId = null)
    {
        if ($givenId == null) {
            $CoId = $request->user()->cid;
        } else {
            $CoId = $givenId;
        }
        $company = Company::where('cid', $CoId)->first();
        if ($company == null) {
            return redirect()->back();
        }
        $locations = DB::table('location')->where('cid', $CoId)->orderBy('lid', 'asc')->get();
        foreach($locations as $location) {
            $subs = DB::table('sub')->where('lid', $location->lid)->get();
            foreach($subs as $sub) {
                $service = DB::table('srv')->where('srv_id', $sub->srv_id)->first();
                $sub->service = $service;
            }
            $location->sub = $subs;
        }
        $user = Helper::getMTS($request, $CoId);
        $subs = Sub::where('cid', $CoId)->get();
        $subsUn = Sub::where('cid', $CoId)->where('device','!=', 'pending')->where('srv_id', '<', 200)->where('device','!=', 'unassigned')->get();
        $available = Sub::where('cid', $CoId)->where('lid', NULL)->get();
        foreach($available as $item) {
            $service = DB::table('srv')->where('srv_id', $item->srv_id)->first();
            $item->service = $service;
        }
        $mds = Sub::where('cid', $CoId)->where('device', 'unassigned')->whereBetween('srv_id', [200, 399])->get();
        $mtsForMds = Sub::where('cid', $CoId)->where('device','!=', 'pending')->where('srv_id', '<', 200)->get();

        return view('front.management', [
            'locations' => $locations,
            'company' => $company,
            'user' => $user,
            'subs' => $subs,
            'available' => $available,
            'subsUn' => $subsUn,
            'mds' => $mds,
            'mtsForMds' => $mtsForMds
        ]);
    }

    public function updateMds($mdsId, $mtsId, $givenId = null)
    {
        if ($givenId == null) {
            $CoId = Auth::user()->cid;
        } else {
            $CoId = $givenId;
        }
        $mds = Sub::where('sid', $mdsId)->where('cid', $CoId)->first();
        $mts = Sub::where('sid', $mtsId)->where('cid', $CoId)->first();

        $mds['device'] = $mts['device'];
        $mds['lid'] = $mts['lid'];

        if(!$mds->save()){
            return redirect('management/'.$CoId)->with('alert-danger', 'MDS Subscription has not been updated');
        }else {
            return redirect('management/'.$CoId)->with('alert-success', 'MDS Subscription has been updated');

        }

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $data = $request->all();
        $sub  = Sub::where('sid', $data['toDeleteId'])->where('cid', $data['coId'])->first();
        $company = Company::where('cid', $data['coId'])->first();
        if ($sub['device'] != 'pending') {
            $service = Service::where('srv_id', $sub['srv_id'])->first();
            $company = Company::where('cid', $sub['cid'])->first();
            $company['removal_amt'] = $company['removal_amt'] + $service['price'];
            $company->save();
        }
        $sub->delete();
        if ($company['cost'] > 0) {
            $amt = $company['cost'] - $company['removal_amt'];
            $company['cost'] = number_format(abs($amt), 2);
            $company['removal_amt'] = 0;
            $company->save();
        }
        return redirect()->back();
    }

    /**
     * @param $givenId
     * @return mixed
     */
    public function subById($givenId)
    {
        $sub = Sub::where('sid', $givenId)->first();
        $sub['srv'] = Service::where('srv_id', $sub['srv_id'])->first();

        return $sub;
    }


    /**
     * @param Request $request
     * @param $givenId
     * @param $coId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSubscription(Request $request, $givenId, $coId)
    {
        $available = Sub::where('cid', $coId)->where('lid', NULL)->where('device', '!=', 'pending')->where('srv_id', '<', 200)->first();
        if ($available == null) {
            return 1;
        }
        $available['lid'] = $givenId;
        $available['device'] = 'assigned';
        $available->save();
        $available['srv'] = Service::where('srv_id', $available['srv_id'])->first();

        return $available;
    }

    /**
     * @param $code
     * @return mixed
     */
    public function checkSetupCode($code)
    {
        $start = Carbon::parse('now');
        $discount = Discount::where('code', $code)->where('expires','>=', $start)->first();
        if ($code == $discount['code']) {
            return 1;
        }

        return 0;
    }



}