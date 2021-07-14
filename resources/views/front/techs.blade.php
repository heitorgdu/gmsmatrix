@extends('layouts.frontapp')

@section('content')
 <!-- Page Content -->
    <div class="container landingPage">
		<div class="row">
			<div class="col-xs-12 col-md-9" style="float: right;">
				<h3 class="page-header" style="font-size: 30px; margin-bottom:0">IT Professionals Needed for Referrals</h3>
				<p class="text-right techtxt">
					<span style=" font-style:italic">...local tech support for our clients in your area</span></p>
				<p class="techtxt"><span style="color:#3cabda; font-weight:600">Register as a candidate for a free, full-page listing </span>
					in our new online directory of computer technicians that will be available for our clients in your area.</p>
				<p class="techtxt">	<span style=" font-style:italic">Note: This is a private directory so <span style="font-weight:600">
					listings are free</span> and there will be<span style="font-weight:600"> <u>no paid advertising available</u></span>.</span></p>
				<h3 class="page-header" style="font-size: 24px; margin-bottom:0">It only takes a few minutes -</h3>
				<ul class="techtxt gm_ul">
					<li class="gm_li">Enter your name and email on the left side of the screen;</li>
					<li class="gm_li">Respond to the confirmation email that will contain a customized registration link; <em>and</em></li>
					<li class="gm_li">Use that link to register, activate your account and login to the portal and complete your profile.</li>
				</ul>
				<p class="techtxt">We'll review your profile and get in touch.</p>
				<p class="techtxt"><span style="color:#3cabda; font-weight:600">
					Your full-page listing </span> will allow our clients that you are the right choice for tech support.
					The page will include your name, phone number, email address and even a live link to your website along with a picture 
					and your company logo if you have one. Format the description however you wish with the html editor and you'll have 
					plenty of room to make your case.
				</p>
				<p class="techtxt"><span style="color:#3cabda; font-weight:600">
					When the directory goes live, </span>clients will be able to search for a local tech near their zip code. 
					When they click your link, the entire page will be about you and they'll be able to contact you directly whenever they 
					need help. <em>You and the client decide your own terms for local support.</em>
				</p>
				<p class="techtxt"><span style="color:#3cabda; font-weight:600">
					Register now. </span>Don't let one of your competitors take your spot.</p>
					
				<h3 class="page-header" style="font-size: 24px; margin-bottom:0">About Us -</h3>
				<p class="techtxt"><span style="color:#3cabda; font-weight:600">
					Incorporated in the fall of 1984</span>, Global Concepts started out as a small, international consulting firm and, 
					over the next 30 years, evolved into the highly specialized, managed service provider for small businesses that we 
					are today.</p>
				<p class="techtxt">Expanding geographically would require managing offices all over the county so we've chosen to work 
					with existing service providers that are located near our clients.<br>
					That has worked out so well that we now do business as Guardian Partners.</p>
				<p class="techtxt">We're in the process of creating a robust infrastructure designed to support what we expect to be 
					massive growth and, in order to prepare for that, we are looking for highly qualified tech professionals in 
					virtually every community in North America.</p>
			</div>
			<div class="col-xs-12 col-md-3">
				<h3 class="page-header" style="font-size: 24px; margin-bottom:0">Register Now -</h3>
				<form action="https://app.getresponse.com/add_subscriber.html" accept-charset="utf-8" method="post">
					<div class="form-group md-form">
						<input type="text" placeholder="First Name" name="first_name"/><br/>
					</div>
					<div class="form-group md-form">
						<input type="text" placeholder="E-mail address" name="email"/><br/>
					</div>
					<input type="hidden" name="campaign_token" value="T0GMZ" />
					<div class="form-group md-form">
						<button class="btn btn-success btn-block btn-lg">Get Started</button>
					</div>
				</form>
			</div>
		</div>

        <hr>

        <!-- Footer -->
       

    </div>
    <!-- /.container -->
@endsection