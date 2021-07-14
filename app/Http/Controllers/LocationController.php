<?php
/**
 * Created by PhpStorm.
 * User: Mustabeen
 * Date: 7/18/2017
 * Time: 2:13 PM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Helpers\Helper;
use App\Models\Company;
use App\Http\Requests;
use App\Models\Sub;
use App;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * @param Request $request
     * @param Location $location
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeLocation(Request $request, Location $location)
    {
        $coId = $location['cid'];
        $location->delete();

        $request->session()->flash('alert-success', 'Location deleted successfully!');
        return redirect('profile/'.$coId);
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editLocation(Request $request, Location $location)
    {
        $locations = Location::where('cid', $location->cid)->get();
        foreach($locations as $loc) {
            if($loc['lid'] != $location->lid) {
                if($loc['name'] == $location->name) {
                    $request->session()->flash('alert-danger', 'Name must be unique');

                    return redirect('profile/'.$location['cid']);
                }
            }
        }

        $location->name = $request['name'];
        $location->addr1 = $request['addr1'];
        $location->addr2 = $request['addr2'];
        $location->city = $request['city'];
        $location->st = $request['st'];
        $location->postal = $request['postal'];
        $location->cntry = $request['cntry'];
        if($request['cntry'] == ""){
            $location->cntry = 'US';
        }
        $location->mod_by = $request['current_user_id'];
        if ($location->postal != null) {
            $res = json_decode(file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$location->cntry.'&components=postal_code:'.$location->postal.'&sensor=true'), true);
            if (isset($res['results'][0])) {
                $res = $res['results'][0];
                $res = $res['geometry'];
                $res = $res['location'];
                $location->longitude = $res['lng'];
                $location->latitude = $res['lat'];
            }
        }
        $location->save();
        $request->session()->flash('alert-success', 'Location edited successfully!');

        return redirect('profile/'.$location['cid']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveLocation(Request $request)
    {
        $locations = Location::where('cid', $request['coId'])->where('name', $request['name'])->first();
        if (count($locations) > 0) {
            $request->session()->flash('alert-danger', 'Name must be unique');
            if (isset($request['management'])){
                return redirect('management/'.$request['coId']);
            }
            return redirect('profile/'.$request['coId']);
        }

        $locationObj = new Location();
        $locationObj->name = $request['name'];
        $locationObj->addr1 = $request['addr1'];
        $locationObj->addr2 = $request['addr2'];
        $locationObj->city = $request['city'];
        $locationObj->st = $request['st'];
        $locationObj->postal = $request['postal'];
        $locationObj->cntry = $request['cntry'];
        if($request['cntry'] == ""){
            $locationObj->cntry = 'US';
        }
        $locationObj->cid = $request['coId'];
        $locationObj->mod_by = $request['current_user_id'];
        if ($locationObj->postal != null) {
            $res = json_decode(file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$locationObj->cntry.'&components=postal_code:'.$locationObj->postal.'&sensor=true'), true);
            if (isset($res['results'][0])) {
                $res = $res['results'][0];
                $res = $res['geometry'];
                $res = $res['location'];
                $locationObj->longitude = $res['lng'];
                $locationObj->latitude = $res['lat'];
            }
        }
        $locationObj->save();
        $request->session()->flash('alert-success', 'Location added successfully!');

        if (isset($request['management'])){
            return redirect('management/'.$locationObj->cid);
        }
        return redirect('profile/'.$locationObj->cid);
    }

    /**
     * @param Request $request
     * @param null $givenId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLocationsForDashboard(Request $request, $givenId = null)
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
        $locations = DB::table('location')->where('cid', $CoId)->orderBy('lid', 'ASC')->get();
        foreach($locations as $location) {
            $subs = DB::table('sub')->where('lid', $location->lid)->get();
            foreach($subs as $sub) {
                $service = DB::table('srv')->where('srv_id', $sub->srv_id)->first();
                $sub->service = $service;
            }
            $location->sub = $subs;
        }
        $user = Helper::getMTS($request, $CoId);
        $available = Sub::where('cid', $CoId)->where('lid', NULL)->get();
        foreach($available as $item) {
            $service = DB::table('srv')->where('srv_id', $item->srv_id)->first();
            $item->service = $service;
        }


        return view('front.home', [
            'locations' => $locations,
            'company' => $company,
            'available' => $available,
            'user' => $user
        ]);

    }

    /**
     *
     */
    public function updateLocationForSearch()
    {
        $locations = Location::all();
        foreach ($locations as $location) {
            if ($location->postal != null) {
                $res = json_decode(file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$location->cntry.'&components=postal_code:'.$location->postal.'&sensor=true'), true);
                if(isset($res['results'][0])){
                    $res = $res['results'][0];
                    $res = $res['geometry'];
                    $res = $res['location'];
                    $location->longitude = $res['lng'];
                    $location->latitude = $res['lat'];
                    $location->save();
                }
            }
        }
        dd('all done');
    }

    /**
     * @param $givenId
     * @return mixed
     */
    public function subByLocationId($givenId)
    {
        $location = Location::where('lid', $givenId)->first();
        $subs = Sub::where('lid', $givenId)->where('cid', $location['cid'])->where('device' , '!=', 'pending')->get();
        if (count($subs) < 1) {
            return 1;
        }
        foreach($subs as $sub) {
            $service = DB::table('srv')->where('srv_id', $sub->srv_id)->first();
            $sub->service = $service;
        }
        $location['subs'] = $subs;

        return $location;
    }

}
