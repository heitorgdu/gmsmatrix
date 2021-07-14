<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivationService;
use App\Models\Company;
use App\Http\Requests;
use App\Models\Email;
use App\Models\Phone;
use App\Models\Tech;
use Validator;
use App\User;
use Auth;
use App;

class UserController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['except' => array('register', 'activateUser')]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function viewProfile(Request $request) {

        return view('front.tech', [
            'record' => $request->user(),
            'isTechPreview' => true
        ]);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|regex:/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+=]).*$/|confirmed',
            'username' => 'required|max:255|unique:users',
                ], [
            'password.min' => 'For security of your account password should contain at least 8 characters. It is must to choose a password with at least 1 uppercase letter,1 lowercase letter, 1 numeric character and 1 special character.',
            'password.regex' => 'For security of your account password should contain at least 8 characters. It is must to choose a password with at least 1 uppercase letter,1 lowercase letter, 1 numeric character and 1 special character.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        $user = new User();
        $user['name'] = $data['name'];
        $user['email'] = $data['email'];
        $user['password'] = bcrypt($data['password']);
        $user['last_name'] = $data['last_name'];
        $user['username'] = $data['username'];

        $company = new Company();
        if (trim($data['business_name']) != '') {
            $company->name = $data['business_name'];
        }

        $company->number_of_computers = $data['number_of_computers'];
        $company->tpid = 102;
        $company->tcid = 102;
        $company->save();

        $user['cid'] = $company['cid'];
        $user->save();

        $techFound = false;
        $noParams = true;
        $contact = 0;

        if ($data['type'] == 't') {
            $noParams = false;
            $techFound = true;
            $company->type = 't';
            $company->tcid = $company['cid'];
            $company->contact = $user->id;
            $company->tpid = $user->id;

            $tech = new Tech();
            $tech->tcid = $company['cid'];
            $tech->save();
        }

        if ($data['tcid'] != 0) {
            $noParams = false;
            $cmpData = Company::where('cid', $data['tcid'])->first();
            if (count($cmpData) > 0) {
                $techFound = true;
                $company->type = 'c';
                $company->contact = $user->id;
                $company->tcid = $data['tcid'];
                if ($data['tpid'] == 0) {
                    $company->tpid = $cmpData->contact;
                }
            }
            else {
                $company->tpid = 102;
                $company->tcid = 102;
            }
        }

        if ($data['tpid'] != 0 && $techFound) {
            $noParams = false;
            $company->tpid = $data['tpid'];
        }


        if ($data['rcid'] != 0) {
            $noParams = false;
            $company->rcid = $data['rcid'];
            $company->contact = $user->id;
        }

        if ((!$techFound)||($noParams)) {
            $company->tpid = 102;
            $company->tcid = 102;
            $company->contact = $user->id;
        }
        $company->save();

        $emailObj = new Email();
        $emailObj->pid = $user->id;
        $emailObj->e_addr = $data['email'];
        $emailObj->type = "primary";
        $emailObj->mod_by = $user->id;
        $emailObj->save();

        $as = new ActivationService();

        $msg = $as->sendActivationMail($user);

        $request->session()->flash('alert-success', $msg);
        return redirect('registration');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function message(Request $request) {
        return view('front.message', [
            'record' => $request->user(),
        ]);
    }


    /**
     * @param Request $request
     * @param null $givenId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function person(Request $request, $givenId = null)
    {
        if ($givenId == null) {
            $userId = $request->user()->id;
            $user = User::where('id', $userId)->first();
            $cmpData = Company::where('cid', $request->user()->cid)->first();
        } else {
            $user = User::where('cid', $givenId)->first();
            $userId = $user['id'];
            $cmpData = Company::where('cid', $givenId)->first();
        }

        $phones = Phone::where('pid', $userId)->where('type','!=' ,'primary')->get();
        $phoneData[] = Phone::where('pid', $userId)->where('type', 'primary')->first();
        foreach ($phones as $phone) {
            $phoneData[] = $phone;
        }
        $emails = Email::where('pid', $userId)->where('type','!=' ,'primary')->get();
        $emailData[] = Email::where('pid', $userId)->where('type', 'primary')->first();
        foreach ($emails as $email) {
            $emailData[] = $email;
        }
        $userData = User::where('cid', $user['cid'])->get();


        return view('front.profilePerson', [
            'currentUserData' => $user,
            'emailData' => $emailData,
            'phoneData' => $phoneData,
            'companyUsers' => $userData,
            'currentPage' => 'person',
            'companyDetails' => $cmpData
        ]);
    }

    /**
     * @param Request $request
     * @param $givenId
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function personDetails(Request $request, $userId, $givenId) {

        $phones = Phone::where('pid', $userId)->where('type','!=' ,'primary')->get();
        $phoneData[] = Phone::where('pid', $userId)->where('type', 'primary')->first();
        foreach ($phones as $phone) {
            $phoneData[] = $phone;
        }
        $emails = Email::where('pid', $userId)->where('type','!=' ,'primary')->get();
        $emailData[] = Email::where('pid', $userId)->where('type', 'primary')->first();
        foreach ($emails as $email) {
            $emailData[] = $email;
        }
        $userData = User::where('cid', $givenId)->get();
        $cmpData = Company::where('cid', $givenId)->first();
        $user = User::where('id', $userId)->first();

        return view('front.profilePerson', [
            'currentUserData' => $user,
            'emailData' => $emailData,
            'phoneData' => $phoneData,
            'companyUsers' => $userData,
            'currentPage' => 'person',
            'companyDetails' => $cmpData
        ]);
    }


    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateUserProfile(Request $request, User $user) {

        $user['name'] = $request['name'];
        $user['last_name'] = $request['last_name'];


        if ($request['password'] != '') {
            $user['password'] = bcrypt($request['password']);

            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
        }


        if ($request->hasFile('pic') && $request->file('pic')->isValid()) {
            $pic_name = 'c'.$user->cid.'-'.$user->username. '.' . \File::extension($request->file('pic')->getClientOriginalName());
            if (file_exists(base_path() . "/public/uploads/" . $pic_name)) {
                unlink(base_path() . "/public/uploads/" . $pic_name);
            }
            $request->file('pic')->move(base_path() . "/public/uploads", $pic_name);
            $user->pic = $pic_name;
        }

        $user->save();


        $request->session()->flash('alert-success', 'Profile updated successfully!');
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function registerUserPopup(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|regex:/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+=]).*$/|confirmed',
            'username' => 'required|max:255|unique:users',
                ], [
            'password.min' => 'For security of your account password should contain at least 8 characters. It is must to choose a password with at least 1 uppercase letter,1 lowercase letter, 1 numeric character and 1 special character.',
            'password.regex' => 'For security of your account password should contain at least 8 characters. It is must to choose a password with at least 1 uppercase letter,1 lowercase letter, 1 numeric character and 1 special character.'
        ]);

        $data = $request;
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'last_name' => $data['last_name'],
            'cid' => $data['CoId'],
            'username' => $data['username'],
            'activated' => 1
        ]);

        $emailObj = new Email();
        $emailObj->pid = $user->id;
        $emailObj->e_addr = $data['email'];
        $emailObj->type = "primary";
        $emailObj->mod_by = $request->user()->id;
        $emailObj->save();

        $request->session()->flash('alert-success', 'Person added successfully!');

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveEmail(Request $request)
    {
        $message = '';
        $emailSaved = '';
        foreach ($request['email'] as $index => $emails) {
            if (strtolower($request['type'][$index]) == 'primary'){
                $emailSaved = $emails;
            }
            $user = User::where('email', $emailSaved)->count();
            if ($user > 1) {
                $request->session()->flash('alert-warning', $emailSaved . ' already exists.');
                return redirect('person/'. $user['cid']);
            }

        }
        Email::where("pid", $request['current_user_id'])->delete();
        foreach ($request['email'] as $index => $emails) {
            if (trim($emails) != '') {
                $data = Email::where("e_addr", $emails)->first();
                if (strtolower($request['type'][$index]) == 'primary'){
                    $emailSaved = $emails;
                }
                if (count($data) == 0) {
                    $emailObj = new Email();
                    $emailObj->pid = $request['current_user_id'];
                    $emailObj->e_addr = $emails;
                    $emailObj->type = strtolower($request['type'][$index]);
                    $emailObj->mod_by = $request->user()->id;
                    $emailObj->save();
                } else {
                    $message .= $emails . ', ';
                }
            }
        }
        if ($message != '') {
            $message = rtrim(trim($message), ",");
        }

        $user = User::where('id', $request['current_user_id'])->first();
        if ($emailSaved != '') {
            $user['email'] = $emailSaved;
            $user->save();
        }

        if ($message != '') {
            $request->session()->flash('alert-warning', $message . ' already exists.');
            return redirect()->back();
        }

        $request->session()->flash('alert-success', 'Email updated successfully!');

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function activateUser(Request $request, $token) {
        $as = new ActivationService();

        if ($user = $as->activateUser($token)) {
            auth()->login($user);
            $request->session()->flash('alert-success', 'Your account has been activated!');
            return redirect('profile');
        }
        abort(404);
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function savePhone(Request $request)
    {
        Phone::where("pid", $request['current_user_id'])->delete();

        foreach ($request['phone'] as $index => $phones) {
            if (trim($phones) != '') {
                $phoneObj = new Phone();
                $phoneObj->pid = $request['current_user_id'];
                $phoneObj->nbr = $phones;
                $phoneObj->type = strtolower($request['type'][$index]);
                $phoneObj->mod_by = $request->user()->id;
                $phoneObj->save();
            }
        }
        $request->session()->flash('alert-success', 'Phone number updated successfully!');

        return redirect()->back();
    }

    /**
     * @param $givenId
     * @return mixed
     */
    public function getUserById($givenId)
    {
        $user = User::where('id', $givenId)->first();
        $user['phone'] = Phone::where('pid', $givenId)->where('type', 'primary')->first();

        return $user;
    }

}
