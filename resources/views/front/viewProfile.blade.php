@extends('layouts.frontapp')

@section('content')
 <style type="text/css">
  /***
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT

/* Profile container */
.profile {
  margin: 20px 0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 50%;
  height: 50%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: 460px;
}
</style>        
<div class="container">
    <div class="row profile">
    <div class="col-md-1"></div>
    <div class="col-md-10 border">
    <div class="col-md-2"></div>
    <div class="col-md-4 border-right">
      <div class="profile-usermenu">
          <ul class="nav">
          <h3>Services include</h3>
          <br>
            <li class="active">
              <input type="checkbox" value="" <?php if($cmpTechData->store==1){ ?>checked='checked'<?php } ?>>
              Repair Center
            </li>
            <li class="active">
              <input type="checkbox" value="" <?php if($cmpTechData->remote==1){ ?>checked='checked'<?php } ?> >
              Remote Assistance
            </li>
            <li class="active">
              <input type="checkbox" value="" <?php if($cmpTechData->on_site==1){ ?>checked='checked'<?php } ?>>
              On-site Service
            </li>
            <br>
           <!--  <li>
              <a href="#">
              <i class="glyphicon glyphicon-flag"></i>
              Help </a>
            </li> -->
          </ul>
          <span><h3>About Us</h3></span>
          <br>
          <span><?php echo(nl2br($cmpTechData->description)); ?></span>
        </div>
    </div>
    <div class="col-md-5">
      <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic text-center">
									<?php
										if (!is_null($cmpTechData['logo'])) {
									?>
									
									<img src="<?php echo Helper::displayImage(asset('uploads/'.$cmpTechData['logo']),100,100); ?>" style="width: 100px;height: 100px;border-radius: 50%;background-color: #ccc;border:none;">

									<?php
										}
									?>
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
          <div class="profile-usertitle-name">
          Contact : {{ $currentUserData['name'] }} {{ $currentUserData['last_name'] }}<br>
          
         
          E-mail : {{ $currentUserData['email'] }} <br>
          Website : {{ $cmpTechData['url'] }}


          </div>
          <!-- <div class="profile-usertitle-job">
            Developer
          </div> -->
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS 
        <div class="profile-userbuttons">
          <button type="button" class="btn btn-success btn-sm">Follow</button>
          <button type="button" class="btn btn-danger btn-sm">Message</button>
        </div>-->
        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        
        
        <!-- END MENU -->
      </div>
    </div>
    <!-- <div class="col-md-9">
            <div class="profile-content">
         Some user related content goes here...
            </div>
    </div> -->
  </div>
  </div>
</div>


    

    

@endsection
