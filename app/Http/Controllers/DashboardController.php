<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        return view('front.index', [
            'record' => $request->user(),
            'currentPage' => 'home'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function techDirectory(Request $request) {
        return view('front.techdir', [
            'record' => $request->user(),
            'currentPage' => 'home'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function techs(Request $request) {
        return view('front.techs', [
            'record' => $request->user(),
            'currentPage' => 'home'
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function home(Request $request) {

        if (!Auth::guest()) {
            return (redirect('profile'));
        }
        return view('front.index', [
            'record' => $request->user(),
            'currentPage' => 'home'
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registerPage(Request $request) {

        return view('front.registerPage', [
            'record' => $request->user(),
            'currentPage' => 'registration'
        ]);
    }

    public function support()
    {
        return view('front.support', [
        ]);
    }
}
