<?php

	// Code within app\Helpers\Helper.php
namespace App\Helpers;

use App\Models\Approval;
use App\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\CancelPreapprovalRequest;
use PayPal\Types\Common\RequestEnvelope;

class Helper
{
	public static function displayImage($src='',$width=250,$height=250)
	{
		return asset("assets/timthumb.php?zc=2&w=$width&h=$height&src=$src");
	}

	public static function getActiveClass(Request $request, $path)
	{
		$current_path =  $request->segment(1);

		if($current_path!=$path)
		{
			return "";
		}

		return "active";
	}

	public static function mailToAdmin($subject, $msg)
	{
		Mail::send('layouts.email', ['msg' => $msg], function ($m) use ($subject) {
			$m->from( config('constant.SITE_EMAIL'), config('constant.SITE_NAME') );

			$m->to( config('constant.ADMIN_MAIL'), config('constant.SITE_NAME') )->subject($subject);
		});
	}

	public static function nl2p($string,$class='',$tag='p')
	{
		$paragraphs = '';

		foreach (explode("\n", $string) as $line) {
			if (trim($line)) {
				$paragraphs .= '<'.$tag.' class="'.$class.'">' . $line . '</'.$tag.'>';
			}
		}

		return $paragraphs;
	}



	public static function prep_url($str = '')
	{
		if ($str=='') {
			return ("javascript:void(0)");
		}
		if ($str === 'http://' OR $str === '')
		{
			return '';
		}
		$url = parse_url($str);
		if ( ! $url OR ! isset($url['scheme']))
		{
			return 'http://'.$str;
		}
		return $str;
	}


	public static function words($value, $words = 100, $end = '...')
	{
		return \Illuminate\Support\Str::words($value, $words, $end);
	}

	public static function checkForReports()
	{
		$check = 0;
		$company = Company::where('cid', Auth::user()['cid'])->first();
		if (($company['type'] == 'a')) {
			$check = 'a';
		} elseif (($company['type'] == 't')){
			$check = 't';
		}

		return $company['type'];
	}


	/**
	 * @param Request $request
	 * @param $givenId
	 */
	public static function getMTS($request, $givenId)
	{
		if ($givenId == null) {
			$CoId = $request->user()->cid;
		} else {
			$CoId = $givenId;
		}
		$company = Company::where('cid', $CoId)->first();
		$user = User::where('id', $company['tpid'])->first();
		if (isset($user)) {
			$user['emailPrimary'] = DB::table('email')->where('pid', $user['id'])->where('type', 'primary')->first();
			$user['phone'] = DB::table('phone')->where('pid', $user['id'])->where('type', 'primary')->first();
		}

		return $user;
	}


	/**
	 * @param $cid
     */
	public static function cancelPreApproval($cid)
	{
		$approval = Approval::where('cid', $cid)->where('preapprovalKey', 'like', 'PA-'.'%')->orderBy('created_at', 'desc')->first();
		if (count($approval)>0) {
			$requestEnvelope = new RequestEnvelope("en_US");
			$cancelPreapprovalReq = new CancelPreapprovalRequest($requestEnvelope, $approval['preapprovalKey']);
			$config = array(
				'mode' => 'sandbox',
				'acct1.UserName' => 'business_api1.xoho.tech',
				'acct1.Password' => 'QNDB5535VJG4DPV5',
				'acct1.Signature' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAEs1kwIPjNwpI9gCogTBtj0JkKoJ',
				'acct1.AppId' => 'APP-80W284485P519543T'
			);
			$service = new AdaptivePaymentsService($config);
			$service->CancelPreapproval($cancelPreapprovalReq);
		}

		return;

	}

}