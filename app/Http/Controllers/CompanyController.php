<?php
/**
 * Created by PhpStorm.
 * User: Mustabeen
 * Date: 7/18/2017
 * Time: 1:36 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Company;
use App\Helpers\Helper;
use App\Http\Requests;
use App\Models\Phone;
use App\Models\Tech;
use App\User;
use Illuminate\Support\Facades\App;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => array('preview')]);
    }


    /**
     * @param Request $request
     * @param $givenId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request, $givenId = null)
    {
        if ($givenId == null) {
            $CoId = $request->user()->cid;
        } else {
            $CoId = $givenId;
        }
        $cmpData = Company::where('cid', $CoId)->first();
        $userData = User::where('cid', $CoId)->get();
        $locationData = Location::where('cid', $CoId)->get();
        $currentUserData = User::where('id', $cmpData['contact'])->first();
        $phone = Phone::where('pid', $cmpData['contact'])->where('type', 'primary')->first();
        $cmpTechData = Tech::where('tcid', $CoId)->first();
        $primaryLoc = Location::where('cid', $CoId)->first();

        if (is_null($cmpTechData) && ($cmpData['type'] == 't')) {
            $tech = new Tech();
            $tech->tcid = $request->user()->cid;
            $tech->save();
            $cmpTechData = Tech::where('tcid', $CoId)->first();
        }

        return view('front.profile', [
            'user' => $request->user(),
            'companyDetails' => $cmpData,
            'companyUsers' => $userData,
            'locationData' => $locationData,
            'current_user_id' => $cmpData['contact'],
            'currentUserData' => $currentUserData,
            'cmpTechData' => $cmpTechData,
            'currentPage' => 'profile',
            'primaryLoc' => $primaryLoc,
            'phone' => $phone
        ]);
    }


    /**
     * @param Request $request
     * @param Company $company
     * @param $techId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveTechInfo(Request $request, Company $company, $techId)
    {
        $data = $request->all();
        if(isset($data['Previewbtn']))
        {
            $name = User::where('id', $request->contact_person)->first();
            if($name) {
                $data['fname'] = $name['name']." ".$name['last_name'];
                $data['contact_pic'] =  $name['pic'];
            }
            $phone = Phone::where('pid', $request->contact_person)->first();
            if($phone) {
                $data['phone'] = $phone['nbr'];
            }
            $location = Location::where('cid', $company->cid)->first();
            if($location) {
                $data['city'] = $location['city'];
            }

            $data['store'] = isset($request->store) ? 1 : 0;
            $data['on_site'] = isset($request->on_site) ? 1 : 0;
            $data['remote'] = isset($request->remote) ? 1 : 0;

            return view('front.tech', [
                'record' => $request->user(),
                'data' => $data,
                'isTechPreview' => true
            ]);
        } else {
            if($company->type == 't') {
                $tech = Tech::where('tcid', $techId)->first();
                $tech->url = $request->url;
                $tech->since = $request->since;
                $tech->tax_id = $request->tax_id;
                $tech->store = isset($request->store) ? 1 : 0;
                $tech->on_site = isset($request->on_site) ? 1 : 0;
                $tech->remote = isset($request->remote) ? 1 : 0;
                $tech->usp = $request->usp;
                $tech->description = $request->description;

                if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                    $pic_name = 'c'.$company->cid.'-'.$request->file('logo')->getClientOriginalName();

                    if (file_exists(base_path() . "/public/uploads/" .  $pic_name)) {
                        unlink(base_path() . "/public/uploads/" .  $pic_name);
                    }
                    $request->file('logo')->move(base_path() . "/public/uploads", $pic_name);
                    $tech->logo = $pic_name;
                }

                if ($request->hasFile('tax_id_image') && $request->file('tax_id_image')->isValid()) {
                    $pic_name = 'c'.$company->cid . '-tax_doc.' . \File::extension($request->file('tax_id_image')->getClientOriginalName());

                    if (file_exists(base_path() . "/public/uploads/" . $pic_name)) {
                        unlink(base_path() . "/public/uploads/" . $pic_name);
                    }

                    $request->file('tax_id_image')->move(base_path(). "/public/uploads", $pic_name);

                    $tech->tax_id_image = $pic_name;
                }

                $tech->save();
            }

            $company->name = $request->company_name;
            $company->contact = $request->contact_person;

            $company->save();

            $request->session()->flash('alert-success', 'Information updated successfully!');


            return redirect('profile/'.$company->cid);
        }

    }

    /**
     * @param Request $request
     * @param $givenId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeExpiry(Request $request, $givenId)
    {
        $data = $request->all();
        $company = Company::where('cid', $givenId)->first();
        $dateToday = date('d');
        if($dateToday > $data['sub_date']){
            $date = date('Y-m', strtotime('+'.$company['sub_interval'].' month'));
        } else {
            if($company['sub_interval'] > 1){
                $interval = $company['sub_interval'] - 1;
                $date = date('Y-m', strtotime('+'.$interval.' month'));
            } else {
                $date = date('Y-m');
            }
        }

        $company['sub_date'] = $data['sub_date'];
        $company['new_expiry'] = $date.'-'.$data['sub_date'];
//        dd($date, $company['new_expiry']);
        $company['renewal_diff'] = date('d', strtotime($company['new_expiry']));
        $company->save();
        Helper::cancelPreApproval($givenId);
        $request->session()->flash('alert-success', 'Renewal date has been changed!');

        return redirect('subscription/'.$givenId);
    }

    /**
     * @param Request $request
     * @param $givenId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeInterval(Request $request, $givenId)
    {
        $data = $request->all();
        $company = Company::where('cid', $givenId)->first();
        $company['sub_interval'] = $data['subinterval'];
        $dateToday = date('d');
        if($dateToday > $company['sub_date']){
            $date = date('Y-m', strtotime('+'.$company['sub_interval'].' month'));
        } else {
            if($company['sub_interval'] > 1){
                $interval = $company['sub_interval'] - 1;
                $date = date('Y-m', strtotime('+'.$interval.' month'));
            } else {
                $date = date('Y-m');
            }
        }

        $company['new_expiry'] = $date.'-'.$company['sub_date'];
        $company['renewal_diff'] = date('d', strtotime($company['new_expiry']));
        $company->save();
        Helper::cancelPreApproval($givenId);
        $request->session()->flash('alert-success', 'Renewal date has been changed!');

        return redirect('subscription/'.$givenId);
    }
    /**
     * @param Request $request
     * @param $givenId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateEmail(Request $request, $givenId)
    {
        $data = $request->all();
        $company = Company::where('cid', $givenId)->first();
        $company['paypal_email'] = $data['paypalEmail'];
        $company->save();
        $request->session()->flash('alert-success', 'PayPal Email has been changed!');

        return redirect('subscription/'.$givenId);
    }

    /**
     * @param $givenId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preview ($givenId)
    {
        $company = Company::where('cid', $givenId)->first();
        $data['company_name'] = $company['name'];
        $name = User::where('id', $company['contact'])->first();
        if($name) {
            $data['fname'] = $name['name']." ".$name['last_name'];
            $data['contact_pic'] =  $name['pic'];
            $data['email'] = $name['email'];
        }
        $phone = Phone::where('pid', $company['contact'])->first();
        if($phone) {
            $data['phone'] = $phone['nbr'];
        }

        $location = Location::where('cid', $company['cid'])->first();
        if($location) {
            $data['city'] = $location['city'];
        }
        $tech = Tech::where('tcid', $company['cid'])->first();
        if($tech) {
            $data['repair'] = $tech['store'];
            $data['service'] = $tech['on_site'];
            $data['remote'] = $tech['remote'];
            $data['logo_hidden'] =  $tech['logo'];
            $data['usp'] =  $tech['usp'];
            $data['since'] =  $tech['since'];
            $data['url'] =  $tech['url'];
            $data['description'] =  $tech['description'];
        }

        return $data;
    }

}
