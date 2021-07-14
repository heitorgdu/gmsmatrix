<?php
/**
 * Created by PhpStorm.
 * User: Mustabeen
 * Date: 7/28/2017
 * Time: 3:35 PM
 */
namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Distance;
use App\Models\Location;
use App\Helpers\Helper;
use App\Models\Company;
use App\Models\techrpt;
use App\Http\Requests;
use App\Models\Email;
use App\Models\Phone;
use App\Models\Tech;
use App\Models\Sub;
use Carbon\Carbon;
use stdClass;
use App\User;
use App;


class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => array('searchByZip')]);
    }

    /**
     * @param Request $request
     * @param null $givenId
     * @param null $name
     * @param null $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function clientReportSort(Request $request, $name = null, $type = null, $givenId = null)
    {
        if ($givenId == null) {
            $coId = $request->user()->cid;
        } else {
            $coId = $givenId;
        }
        $IfAdmin = 0;
        $IfTech = 0;
        $comp = Company::where('cid', $request->user()->cid)->first();
        if (($comp['type'] == 'a')) {
            $IfAdmin = 1;
            $IfTech = 1;
        } elseif (($comp['type'] == 't')){
            $IfTech = 1;
            if ($coId != $request->user()->cid) {
                return redirect('report/client');
            }
        }
        $company = Company::where('cid', $coId)->where('type', 't')->first();
        $Cos = array();
        if (($comp['type'] == 't') || ($comp['type'] == 'a')){
            $tech = Tech::where('tcid', $company['cid'])->first();
            $Cos = Company::where('tcid', $tech['tcid'])->where('type', 't')->get();
            foreach($Cos as $Co){
                $Co['personDet'] = User::where('id', $Co['contact']) ->first();
                $Co['emailDet'] = Email::where('pid', $Co['contact'])->first();
                $Co['phoneDet'] = Phone::where('pid', $Co['contact'])->first();
                $Co['deviceDet'] = Sub::where('cid', $Co['cid'])->where('srv_id', 101)->count();
            }
        } else {
            return redirect()->back();
        }

        $user = Helper::getMTS($request, $coId);

        if ($name == null){
            if ($type != 'asc'){
                $Cos = $Cos->sortBy('name');
            } else {
                $Cos = $Cos->sortBy('name')->reverse();
            }

        } else {
            if ($type != 'asc'){
                if ($name == 'users') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['personDet']['name']);
                    });
                }
                elseif ($name == 'email') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['emailDet']['e_addr']);
                    });
                }
                elseif ($name == 'phone') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['phoneDet']['nbr']);
                    });
                }
                elseif ($name == 'device') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return ($product['deviceDet']);
                    });
                }
                else {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['name']);
                    });
                }
            } else {
                if ($name == 'users') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['personDet']['name']);
                    })->reverse();
                }
                elseif ($name == 'email') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['emailDet']['e_addr']);
                    })->reverse();
                }
                elseif ($name == 'phone') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['phoneDet']['nbr']);
                    })->reverse();
                }
                elseif ($name == 'device') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return ($product['deviceDet']);
                    })->reverse();
                }
                else {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['name']);
                    })->reverse();
                }
            }
        }

        $Cos =  $this->paginate($Cos, $perPage = 50, $page = null , $options = []);
        return view('front.clientReports', [
            'techs' => $Cos,
            'user' => $user,
            'company' => $company,
            'IfAdmin' => $IfAdmin,
            'IfTech' => $IfTech,
            'type' => $type,
        ]);
    }

    /**
     * @param Request $request
     * @param null $givenId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function clientReport(Request $request, $givenId = null)
    {
        if ($givenId == null) {
            $coId = $request->user()->cid;
        } else {
            $coId = $givenId;
        }
        $IfAdmin = 0;
        $IfTech = 0;
        $comp = Company::where('cid', $request->user()->cid)->first();
        if (($comp['type'] == 'a')) {
            $IfAdmin = 1;
            $IfTech = 1;
        } elseif (($comp['type'] == 't')){
            $IfTech = 1;
            if ($coId != $request->user()->cid) {
                return redirect('report/client');
            }
        }
        $company = Company::where('cid', $coId)->where('type', 't')->first();
        $Cos = array();
        if (($comp['type'] == 't') || ($comp['type'] == 'a')){
            $tech = Tech::where('tcid', $company['cid'])->first();
            $Cos = Company::where('tcid', $tech['tcid'])->where('type', 't')->get();
            foreach($Cos as $Co){
                $Co['personDet'] = User::where('id', $Co['contact']) ->first();
                $Co['emailDet'] = Email::where('pid', $Co['contact'])->first();
                $Co['phoneDet'] = Phone::where('pid', $Co['contact'])->first();
                $Co['deviceDet'] = Sub::where('cid', $Co['cid'])->where('srv_id', 101)->count();
            }
        } else {
            return redirect()->back();
        }

        $user = Helper::getMTS($request, $coId);
        $Cos = $Cos->sortBy(function ($product, $key) {
            return strtoupper($product['name']);
        });

        $Cos =  $this->paginate($Cos, $perPage = 50, $page = null , $options = []);
        return view('front.clientReports', [
            'techs' => $Cos,
            'user' => $user,
            'company' => $company,
            'IfAdmin' => $IfAdmin,
            'IfTech' => $IfTech,
            'type' => null,
        ]);
    }

    /**
     * @param Request $request
     * @param null $name
     * @param null $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function techReport(Request $request, $name = null, $type = null)
    {
        $total_device = 0;
        $total_client = 0;
        $IfAdmin = 0;
        $IfTech = 0;
        $company = Company::where('cid', $request->user()->cid)->first();
        if (($company['type'] == 'a')) {
            $IfAdmin = 1;
            $IfTech = 1;
        } elseif (($company['type'] == 't')){
            $IfTech = 1;
        }
        $Cos = array();
        if (($company['type'] == 'a')){
            $Cos = Company::where('type', 't')->get();
            $total_Co = Company::where('type', 't')->count();
            foreach($Cos as $Co){
                $Co['personDet'] = User::where('id', $Co['contact']) ->first();
                $Co['emailDet'] = Email::where('pid', $Co['contact'])->first();
                $Co['phoneDet'] = Phone::where('pid', $Co['contact'])->first();
                $Co['clientCount'] = Company::where('tcid', $Co['cid'])->count();
                $total_client = $total_client + $Co['clientCount'];
                $clients = Company::where('tcid', $Co['cid'])->get();
                $devices = 0;
                foreach ($clients as $client) {
                    $device = Sub::where('cid', $client['cid'])->where('srv_id', 101)->count();
                    $devices = $devices + $device;
                }
                $Co['deviceDet'] = $devices;
                $total_device = $total_device + $devices;
            }
        } else {
            return redirect()->back();
        }

        $user = Helper::getMTS($request, $request->user()->cid);

        if ($name == null){
            if ($type != 'asc'){
                $Cos = $Cos->sortBy(function ($product, $key) {
                    return strtoupper($product['name']);
                });
            } else {
                $Cos = $Cos->sortBy(function ($product, $key) {
                    return strtoupper($product['name']);
                })->reverse();
            }

        } else {
            if ($type != 'asc'){
                if ($name == 'users') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['personDet']['name']);
                    });
                }
                elseif ($name == 'email') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['emailDet']['e_addr']);
                    });
                }
                elseif ($name == 'phone') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['phoneDet']['nbr']);
                    });
                }
                elseif ($name == 'client') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return ($product['clientCount']);
                    });
                }
                else {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['name']);
                    });
                }
            } else {
                if ($name == 'users') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['personDet']['name']);
                    })->reverse();
                }
                elseif ($name == 'email') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['emailDet']['e_addr']);
                    })->reverse();
                }
                elseif ($name == 'phone') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['phoneDet']['nbr']);
                    })->reverse();
                }
                elseif ($name == 'client') {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return ($product['clientCount']);
                    })->reverse();
                }
                else {
                    $Cos = $Cos->sortBy(function ($product, $key) {
                        return strtoupper($product['name']);
                    })->reverse();
                }
            }
        }

        $Cos =  $this->paginate($Cos, $perPage = 50, $page = null , $options = []);

        return view('front.techReports', [
            'techs' => $Cos,
            'user' => $user,
            'company' => $company,
            'IfAdmin' => $IfAdmin,
            'IfTech' => $IfTech,
            'total_device' => $total_device,
            'total_client' => $total_client,
            'total_Co' => $total_Co,
            'type' => $type,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveTechRpt(Request $request)
    {
        $data = $request->all();
        $rpts = new techrpt();
        $rpts['rpt_date'] = Carbon::now();
        $rpts->timestamps = false;
        $rpts['techs'] = $data['techs'];
        $rpts['clients'] = $data['client'];
        $rpts['devices'] = $data['device'];
        $rpts->save();

        $request->session()->flash('alert-success', 'Tech Report has been saved');

        return redirect('report/tech');
    }

    /**
     * @param Request $request
     * @return int
     */
    public function searchByZip(Request $request)
    {
        $data = $request->all();
        $distance = Distance::where('id', 1)->first();
        if ($distance == null) {
            $dis = 2500;
        } else {
            $dis = $distance['miles'];
        }
        $postal = $data['postalCode'];
        if (isset($data['countryCode'])){
            $country = $data['countryCode'];
        } else {
            $country = 'US';
        }

//        $res = json_decode(file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$country.'&components=postal_code:'.$postal.'&sensor=true'), true);
//dd($res);
//        if(!isset($res['results'][0])){
//            $testFailed = 1;
//            return $testFailed;
//        }
//        $res = $res['results'][0];
//        $addCount  = count($res['address_components']) - 1;
//        $short= $res['address_components'][$addCount]['short_name'];
//        $long = $res['address_components'][$addCount]['long_name'];
//        if (($short != $country) && ($long != $country)) {
//            $testFailed = 1;
//            return $testFailed;
//        }
//
//        $res = $res['geometry'];
//        $res = $res['location'];
//        $longitude = $res['lng'];
//        $latitude = $res['lat'];
//        $query = "SELECT lid,cid, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) *
//            cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) *
//            sin( radians( latitude ) ) ) ) AS distance FROM location WHERE cid != 102 HAVING
//            distance < $dis ORDER BY distance LIMIT 0 , 4";
//        $locations = DB::select( DB::raw( $query ));
        $check = 0;
        $locations = Location::where('cid','!=', 102)->where('postal', $postal)->get();
        $count = count($locations);
        for($i=0;$i<$count;$i++){
            $co = Company::where('cid', $locations[$i]->cid)->where('type', 't')->first();
            if ($co != null){
                $locations[$i]->company = $co;
                $locations[$i]->user = User::where('id', $co['contact'])->first();
                $locations[$i]->locs = Location::where('cid', $locations[$i]->cid)->where('lid', $locations[$i]->lid)->first();
                $locations[$i]->tech = Tech::where('tcid', $co['cid'])->first();
            }
        }
        $i = $count;
        if ($check == 0) {
            $co = Company::where('cid', 102)->first();
            $locations[$i] = new StdClass;
            $locations[$i]->company = $co;
            $locations[$i]->user = User::where('id', $co['contact'])->first();
            $locations[$i]->locs = Location::where('cid', $co['cid'])->first();
            $locations[$i]->tech = Tech::where('tcid', $co['cid'])->first();
        }


        return ($locations);
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
//        dd(Paginator::resolveCurrentPage(), $page);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page,  [
            'path' => Paginator::resolveCurrentPath(),
        ]);
    }
}
