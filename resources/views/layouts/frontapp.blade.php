<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
    <!--<![endif]-->
    <head>
        <!-- Basic Page Needs -->
        <meta charset="utf-8"/>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="author" content="Xoho Tech Inc."/>
        @if ((\Request::is('techLanding')) || (\Request::is('/')))
        <title>GMS Matrix - Business Continutiy Assurance</title>
        @else
        <title>GMS Portal</title>
        @endif
        <link rel="apple-touch-icon" sizes="180x180" href="http://gp.web.s3.amazonaws.com/favicons/apple-touch-icon.png"/>
        <link rel="icon" type="image/png" href="http://gp.web.s3.amazonaws.com/favicons/favicon-32x32.png" sizes="32x32"/>
        <link rel="icon" type="image/png" href="http://gp.web.s3.amazonaws.com/favicons/favicon-16x16.png" sizes="16x16"/>
        <link rel="manifest" href="http://gp.web.s3.amazonaws.com/favicons/manifest.json"/>
        <link rel="shortcut icon" href="http://gp.web.s3.amazonaws.com/favicons/favicon.ico"/>
        <link rel="mask-icon" href="http://gp.web.s3.amazonaws.com/favicons/safari-pinned-tab.svg" color="#5bbad5"/>
        <meta name="msapplication-config" content="http://gp.web.s3.amazonaws.com/favicons/browserconfig.xml"/>
        <meta name="theme-color" content="#000000"/>
        <!-- Bootstrap  -->
        <link rel="stylesheet" type="text/css" href="<?php use Illuminate\Support\Facades\URL;echo url('assets/front'); ?>/stylesheets/bootstrap.css"/>
        <!-- Theme Style -->
        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/style.css"/>
        <!-- Responsive -->
        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/responsive.css"/>
        <!-- Animation Style -->
        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/animate.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/custom.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/header.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/guardian.css"/>


        <!--[if lt IE 9]>
            <script src="<?php echo url('assets/front'); ?>/javascript/html5shiv.js"></script>
            <script src="<?php echo url('assets/front'); ?>/javascript/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript" src="<?php echo url('assets/front'); ?>/javascript/jquery.min.js"></script>

        <!-- Facebook Pixel Code -->
        <script>
            !function (f, b, e, v, n, t, s) {
                if (f.fbq)
                    return;
                n = f.fbq = function () {
                    n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq)
                    f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window,
                    document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

            fbq('init', '792725250776833');
            fbq('track', "PageView");</script>
            <noscript><img height="1" width="1" style="display:none"
                       src="https://www.facebook.com/tr?id=792725250776833&ev=PageView&noscript=1"/>
            </noscript>
        <!-- End Facebook Pixel Code -->
    </head>

    <body class="header_sticky">
        <section class="loading-overlay">
            <div class="Loading-Page">
                <h2 class="loader">Loading</h2>
            </div>
        </section>

        <!--BOX -->
        <div class="box">
            <!--/.header -->
            <div class="header2">
                <div id="sns_header" class="wrap">
                    <div class="container">
                        <div class="row-fluid">
                            <!-- BEGIN: Logo -->
                            <div id="logo" class="span4">
                                <a title="Guardian Partners Logo" href="https://gmsmatrix.com/">
                                    <img src="<?php echo url('assets/front'); ?>/images/gpLogo174x35.png" alt="Guardian Partners Logo" style="height:35px">
                                        <span>Managed support services for small business - Since 1984</span>
                                </a>
                            </div>
                            <!-- END: Logo -->
                            <div class="header-right span8">
                                <div class="header-right-inner">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sns_topheader" class="wrap">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="topheader-left span5">
                                <div><em><span style="color: #002c51;"><span style="font-size: medium;">Support for small businesses since 1984<br></span></span></em></div>
                            </div>
                            <div class="topheader-right span7">
                                <div class="inner">
                                    <div class="sns-quickaccess">
                                        <div class="quickaccess-inner">
                                            <span class="welcome">Managed support services for small business - Since 1984</span>

                                        </div>
                                    </div>

                                    <script type="text/javascript">
                                        jQuery(document).ready(function ($) {
                                            $('.topheader-right ul.links li').each(function () {
                                                href = String($(this).find('a').attr('href'));
                                                if (href.search('customer/account/login') != -1) {
                                                    $(this).addClass('login');
                                                    $(this).removeClass('last');
                                                    $(this).find('a').attr('data-toggle', 'modal');
                                                    $(this).find('a').attr('href', '#modal_login');
                                                }
                                            });
                                        });
                                    </script>
                                    <div class="sns-switch">
                                        <div class="switch-inner">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="sns_menu" class="wrap">
                    <div class="inner">
                        <div class="container">
                            <div class="row-fluid">
                                @if(!isset($isTechPreview))
                                <?php $checkForReports =  \App\Helpers\Helper::checkForReports();?>

                                <!-- BEGIN: Main Navigation -->
                                <div id="sns_mainnav" class="span9">
                                    <div id="sns_custommenu" class="">
                                        <ul class="mainnav">
                                            <?php
                                                $url = URL::current();
                                                $ids = explode("/",$url);
                                                $count = count($ids)-1;
                                                if (isset($ids[$count])){
                                                    if (is_numeric($ids[$count])) {
                                                        $id = $ids[$count];
                                                    } else {
                                                        $id = null;
                                                    }

                                                } else {
                                                    $id = null;
                                                }
                                            ?>
                                            @if($id != null)
                                                <li class="level0 nav-1 no-group first parent <?php if (isset($currentPage) && ($currentPage == 'home' || $currentPage == 'dashboard/*')) echo ("active"); ?>">
                                                    <a href="@if(Auth::guest()){{ url('') }}@else {{ url('/dashboard')."/".$id }} @endif" class=" menu-title-lv0">
                                                        <span>Home</span>
                                                    </a>
                                                </li>
                                                @if(Auth::guest())
                                                    @if(\Request::is('registration'))
                                                        <li class="level0 nav-2 no-group drop-blocks parent <?php if (isset($currentPage) && $currentPage == 'registration') echo ("active"); ?>">
                                                            <a href="{{ url('registration') }}" class=" menu-title-lv0">
                                                                <span>Create Account</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="pull-right level0 nav-2 no-group drop-blocks parent <?php if (\Request::is('login')) echo ("active"); ?>">
                                                        <a href="{{ url('login') }}" class=" menu-title-lv0">
                                                            <span>Login</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="level0 nav-3 no-group drop-blocks parent <?php if (isset($currentPage) && $currentPage == 'profile/*') echo ("active"); ?>">
                                                        <a href="{{ url('profile')."/".$id }}" class=" menu-title-lv0">
                                                            <span>Profile</span>
                                                        </a>
                                                    </li>
                                                    <li class="level0 nav-3 no-group drop-blocks parent <?php if (\Request::is('subscription/*')) echo ("active"); ?>">
                                                        <a href="{{ url('subscription')."/".$id }}" class=" menu-title-lv0">
                                                            <span>Services</span>
                                                        </a>
                                                    </li>
                                                    @if(($checkForReports == 'a')||($checkForReports == 't'))
                                                        <li class="level0 nav-3 no-group drop-blocks parent <?php if (\Request::is('report/*')) echo ("active"); ?>">
                                                            <a href="@if($checkForReports == 'a'){{ url('report/tech') }}@elseif($checkForReports == 't'){{ url('report/client')."/".$id }}@endif" class=" menu-title-lv0">
                                                                <span>Report</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="pull-right level0 nav-2 no-group drop-blocks parent">
                                                        <a href="{{ url('logout') }}" class=" menu-title-lv0">
                                                            <span>Logout</span>
                                                        </a>
                                                    </li>
                                                    <li class="pull-right level0 nav-2 no-group drop-blocks parent">
                                                        <a href="{{ url('support') }}" class=" menu-title-lv0">
                                                            <span>Support</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            @else
                                                <li class="level0 nav-1 no-group first parent <?php if ((isset($currentPage) && ($currentPage == 'home')) || (\Request::is('dashboard'))) echo ("active"); ?>">
                                                    <a href="@if(Auth::guest()){{ url('') }}@else {{ url('/dashboard') }} @endif" class=" menu-title-lv0">
                                                        <span>Home</span>
                                                    </a>
                                                </li>
                                                @if (\Request::is('techLanding'))
                                                    <li style="float:right;width:300px;" class="level0 nav-1 no-group parent <?php if ((isset($currentPage) && ($currentPage == 'home')) || (\Request::is('dashboard'))) echo ("active"); ?>">
                                                        <form method="post">
                                                            {!! csrf_field() !!}

                                                            <div class="input-group">
                                                                <input type="text" class="form-control" style="border: 1px solid #ccc; box-shadow:0px 0px 4px 1px #ccc;background: #fff;">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="submit">
                                                                            <span class="fa fa-search"></span>
                                                                        </button>
                                                                    </span>
                                                            </div>
                                                        </form>
                                                    </li>
                                                @elseif(\Request::is('/') || (\Request::is('techs')))
                                                    @if(Auth::guest())
                                                        <li class="pull-right level0 nav-2 no-group drop-blocks parent <?php if (\Request::is('login')) echo ("active"); ?>">
                                                            <a href="{{ url('login') }}" class=" menu-title-lv0">
                                                                <span>Login</span>
                                                            </a>
                                                        </li>
                                                        <li class="pull-right level0 nav-2 no-group drop-blocks parent">
                                                            <a href="{{ url('support') }}" class=" menu-title-lv0">
                                                                <span>Support</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @elseif(\Request::is('directory'))
                                                    @if(Auth::guest())
                                                        <li class="pull-right level0 nav-2 no-group drop-blocks parent <?php if (\Request::is('login')) echo ("active"); ?>">
                                                            <a href="{{ url('login') }}" class=" menu-title-lv0">
                                                                <span>Login</span>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li class="pull-right level0 nav-2 no-group drop-blocks parent">
                                                            <a href="{{ url('logout') }}" class=" menu-title-lv0">
                                                                <span>Logout</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="pull-right level0 nav-2 no-group drop-blocks parent">
                                                        <a href="{{ url('support') }}" class=" menu-title-lv0">
                                                            <span>Support</span>
                                                        </a>
                                                    </li>
                                                    <li style="float:right;width:300px;margin-right: 100px;" class="level0 nav-1 no-group parent <?php if(isset($currentPage) && $currentPage=='home') echo ("active"); ?>">
                                                        <form onSubmit="return tonothing();" style="display: inline-flex;">
                                                            <div class="input-group">
                                                                <input type="text" value="US" placeholder="Country Code" name="countryCode" id="countryCode" class="form-control" required style="border: 1px solid #ccc; height:15px; box-shadow:0px 0px 4px 1px #ccc;background: #fff;    width: 100px;margin-right: 10px;">
                                                            </div>
                                                            <div class="input-group">
                                                                <input type="text" placeholder="Find a Tech Near You" name="postalCode" id="postalCodeSearch" class="form-control" required style="border: 1px solid #ccc; height:15px; box-shadow:0px 0px 4px 1px #ccc;background: #fff;">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-default" id="postalCodeBtn" style="margin-top: 2px;">
                                                                        <span class="fa fa-search"></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                            <!-- /.input-group -->
                                                        </form>
                                                    </li>
                                                @else
                                                    @if(Auth::guest())
                                                        @if(\Request::is('registration'))
                                                            <li class="level0 nav-2 no-group drop-blocks parent <?php if (isset($currentPage) && $currentPage == 'registration') echo ("active"); ?>">
                                                                <a href="{{ url('registration') }}" class=" menu-title-lv0">
                                                                    <span>Create Account</span>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li class="pull-right level0 nav-2 no-group drop-blocks parent <?php if (\Request::is('login')) echo ("active"); ?>">
                                                            <a href="{{ url('login') }}" class=" menu-title-lv0">
                                                                <span>Login</span>
                                                            </a>
                                                        </li>
                                                        <li class="pull-right level0 nav-2 no-group drop-blocks parent">
                                                            <a href="{{ url('support') }}" class=" menu-title-lv0">
                                                                <span>Support</span>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li class="level0 nav-3 no-group drop-blocks parent <?php if (isset($currentPage) && $currentPage == 'profile') echo ("active"); ?>">
                                                            <a href="{{ url('profile') }}" class=" menu-title-lv0">
                                                                <span>Profile</span>
                                                            </a>
                                                        </li>
                                                        <li class="level0 nav-3 no-group drop-blocks parent <?php if (\Request::is('subscription')) echo ("active"); ?>">
                                                            <a href="{{ url('subscription') }}" class=" menu-title-lv0">
                                                                <span>Services</span>
                                                            </a>
                                                        </li>
                                                        @if(($checkForReports == 'a')||($checkForReports == 't'))
                                                            <li class="level0 nav-3 no-group drop-blocks parent <?php if (\Request::is('report/*')) echo ("active"); ?>">
                                                                <a href="@if($checkForReports == 'a'){{ url('report/tech') }}@elseif($checkForReports == 't'){{ url('report/client') }}@endif" class=" menu-title-lv0">
                                                                    <span>Report</span>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li class="pull-right level0 nav-2 no-group drop-blocks parent">
                                                            <a href="{{ url('logout') }}" class=" menu-title-lv0">
                                                                <span>Logout</span>
                                                            </a>
                                                        </li>
                                                        <li class="pull-right level0 nav-2 no-group drop-blocks parent">
                                                            <a href="{{ url('support') }}" class=" menu-title-lv0">
                                                                <span>Support</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                    <div id="sns_mommenu" class="menu-collapse">
                                        <span class="btn btn-navbar menusidebar collapsed" data-toggle="collapse" data-target="#menu_collapse"><i class="fa fa-bars"></i>
                                            <span class="overlay" style="display: none;"></span>
                                        </span>
                                        <div class="menu_collapse_wrap">
                                            <div id="menu_collapse" class="mainnav collapse" style="height: 0px;">
                                                <ul>
                                                    <?php
                                                        $url = URL::current();
                                                        $ids = explode("/",$url);
                                                        $count = count($ids)-1;
                                                        if (isset($ids[$count])){
                                                            if (is_numeric($ids[$count])) {
                                                                $id = $ids[$count];
                                                            } else {
                                                                $id = null;
                                                            }

                                                        } else {
                                                            $id = null;
                                                        }
                                                    ?>
                                                    @if($id != null)
                                                        <li class="level0 nav-1 no-group first parent <?php if (isset($currentPage) && ($currentPage == 'home' || $currentPage == 'dashboard/*')) echo ("active"); ?>">
                                                            <a href="@if(Auth::guest()){{ url('') }}@else {{ url('/dashboard')."/".$id }} @endif" class=" menu-title-lv0">
                                                                <span>Home</span>
                                                            </a>
                                                        </li>
                                                        @if(Auth::guest())
                                                            @if(\Request::is('registration'))
                                                                <li class="level0 nav-2 no-group drop-blocks parent <?php if (\Request::is('login')) echo ("active"); ?>">
                                                                    <a href="{{ url('registration') }}" class=" menu-title-lv0">
                                                                        <span>Create Account</span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li class="level0 nav-2 no-group drop-blocks parent">
                                                                <a href="{{ url('support') }}" class=" menu-title-lv0">
                                                                    <span>Support</span>
                                                                </a>
                                                            </li>
                                                            <li class="level0 nav-2 no-group drop-blocks parent <?php if (isset($currentPage) && $currentPage == 'login') echo ("active"); ?>">
                                                                <a href="{{ url('login') }}" class=" menu-title-lv0">
                                                                    <span>Login</span>
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="level0 nav-3 no-group drop-blocks parent <?php if (isset($currentPage) && $currentPage == 'profile/*') echo ("active"); ?>">
                                                                <a href="{{ url('profile')."/".$id }}" class=" menu-title-lv0">
                                                                    <span>Profile</span>
                                                                </a>
                                                            </li>
                                                            <li class="level0 nav-3 no-group drop-blocks parent <?php if (\Request::is('subscription/*')) echo ("active"); ?>">
                                                                <a href="{{ url('subscription')."/".$id }}" class=" menu-title-lv0">
                                                                    <span>Services</span>
                                                                </a>
                                                            </li>
                                                            @if(($checkForReports == 'a')||($checkForReports == 't'))
                                                                <li class="level0 nav-3 no-group drop-blocks parent <?php if (\Request::is('report/*')) echo ("active"); ?>">
                                                                    <a href="@if($checkForReports == 'a'){{ url('report/tech') }}@elseif($checkForReports == 't'){{ url('report/client')."/".$id }}@endif" class=" menu-title-lv0">
                                                                        <span>Report</span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li class="level0 nav-2 no-group drop-blocks parent">
                                                                <a href="{{ url('support') }}" class=" menu-title-lv0">
                                                                    <span>Support</span>
                                                                </a>
                                                            </li>
                                                            <li class="level0 nav-2 no-group drop-blocks parent">
                                                                <a href="{{ url('logout') }}" class=" menu-title-lv0">
                                                                    <span>Logout</span>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @else
                                                        <li class="level0 nav-1 no-group first parent <?php if (isset($currentPage) && ($currentPage == 'home' || $currentPage == 'dashboard')) echo ("active"); ?>">
                                                            <a href="@if(Auth::guest()){{ url('') }}@else {{ url('/dashboard') }} @endif" class=" menu-title-lv0">
                                                                <span>Home</span>
                                                            </a>
                                                        </li>
                                                        @if(\Request::is('directory'))
                                                            <li class="level0 nav-2 no-group drop-blocks parent">
                                                                <a href="{{ url('support') }}" class=" menu-title-lv0">
                                                                    <span>Support</span>
                                                                </a>
                                                            </li>
                                                            <li class="level0 nav-1 no-group parent <?php if(isset($currentPage) && $currentPage=='home') echo ("active"); ?>">
                                                                <form onSubmit="return tonothing();" style="display: inline-flex;">
                                                                    <div class="input-group">
                                                                        <input type="text" value="US" placeholder="Country Code" name="countryCode" id="countryCode1" class="form-control" required style="border: 1px solid #ccc; height:15px; box-shadow:0px 0px 4px 1px #ccc;background: #fff;width: 50px;">
                                                                    </div>
                                                                    <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                                                        <div class="col-md-8 col-xs-8 col-sm-8">
                                                                            <input type="text" placeholder="Find a Tech Near You" name="postalCode" id="postalCodeSearch1" onkeyup="keyUpSmall(event)" class="form-control" required style="border: 1px solid #ccc; height:15px; box-shadow:0px 0px 4px 1px #ccc;background: #fff;">
                                                                        </div>
                                                                        <div class="col-md-4 col-xs-4 col-sm-4">
                                                                             <span class="input-group-btn">
                                                                                <button class="btn btn-default" id="postalCodeBtn" onclick="pressSmallWind()" style="margin-top: 2px;">
                                                                                    <span class="fa fa-search"></span>
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.input-group -->
                                                                </form>
                                                            </li>
                                                            @if(Auth::guest())
                                                                <li class="level0 nav-2 no-group drop-blocks parent <?php if (\Request::is('login')) echo ("active"); ?>">
                                                                    <a href="{{ url('login') }}" class=" menu-title-lv0">
                                                                        <span>Login</span>
                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li class="level0 nav-2 no-group drop-blocks parent">
                                                                    <a href="{{ url('logout') }}" class=" menu-title-lv0">
                                                                        <span>Logout</span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @else
                                                            @if(Auth::guest())
                                                                @if(\Request::is('registration'))
                                                                    <li class="level0 nav-2 no-group drop-blocks parent <?php if (isset($currentPage) && $currentPage == 'registration') echo ("active"); ?>">
                                                                        <a href="{{ url('registration') }}" class=" menu-title-lv0">
                                                                            <span>Create Account</span>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                <li class="level0 nav-2 no-group drop-blocks parent">
                                                                    <a href="{{ url('support') }}" class=" menu-title-lv0">
                                                                        <span>Support</span>
                                                                    </a>
                                                                </li>
                                                                <li class="level0 nav-2 no-group drop-blocks parent gin') <?php if (\Request::is('login')) echo ("active"); ?>">
                                                                    <a href="{{ url('login') }}" class=" menu-title-lv0">
                                                                        <span>Login</span>
                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li class="level0 nav-3 no-group drop-blocks parent <?php if (isset($currentPage) && $currentPage == 'profile') echo ("active"); ?>">
                                                                    <a href="{{ url('profile') }}" class=" menu-title-lv0">
                                                                        <span>Profile</span>
                                                                    </a>
                                                                </li>
                                                                <li class="level0 nav-3 no-group drop-blocks parent <?php if (\Request::is('subscription')) echo ("active"); ?>">
                                                                    <a href="{{ url('subscription') }}" class=" menu-title-lv0">
                                                                        <span>Services</span>
                                                                    </a>
                                                                </li>
                                                                @if(($checkForReports == 'a')||($checkForReports == 't'))
                                                                    <li class="level0 nav-3 no-group drop-blocks parent <?php if (\Request::is('report/*')) echo ("active"); ?>">
                                                                        <a href="@if($checkForReports == 'a'){{ url('report/tech') }}@elseif($checkForReports == 't'){{ url('report/client')}}@endif" class=" menu-title-lv0">
                                                                            <span>Report</span>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                <li class="level0 nav-2 no-group drop-blocks parent">
                                                                    <a href="{{ url('support') }}" class=" menu-title-lv0">
                                                                        <span>Support</span>
                                                                    </a>
                                                                </li>
                                                                <li class="level0 nav-2 no-group drop-blocks parent">
                                                                    <a href="{{ url('logout') }}" class=" menu-title-lv0">
                                                                        <span>Logout</span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END: Main Navigation -->
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

            <!-- ****************START FOOTER******************** -->
            <div id="sns_footer" class="wrap">
                <div class="container">
                    <div class="row-fluid">


                        <div class="col-xs-12">
                            <div style="padding-top:10em" id="footer"><center>
                                    <p>(214) 702-4152 - support@GuardianPartners.net</p>
                                    <p>&copy; 2017 Global Concepts, Inc. dba Guardian Partners - All Rights Reserved<br />
                                        <a href="https://guardianpartners.net/terms" target="_blank">Terms</a> |
                                        <a href="https://guardianpartners.net/privacy" target="_blank">Privacy</a> |
                                        <a href="https://guardianpartners.net/disclaimer" target="_blank">Disclaimer</a> |
                                        <a href="https://guardianpartners.net/contacts" target="_blank">Contact Us</a></p>
                                </center></div>
                        </div>
                        @if ((\Request::is('techLanding')) || (\Request::is('/')))
                        <script type="text/javascript">
                            //<![CDATA[
                            jQuery(function ($) {
                                function snsTooltip() {
                                    $("body#bd *[data-toggle='tooltip']").tooltip();
                                }
                                snsTooltip();
                                setInterval(function () {
                                    snsTooltip()
                                }, 1000);
                            });
                            //]]>
                        </script>
                        @endif
                    </div>
                </div>
            </div>

            <!-- ****************END FOOTER********************** -->
        </div>
        <!--/.box -->

        <!-- Javascript -->
        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css" />

        @if (!isset($isTechPreview))
            <link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/compiled.min.css">
        @else
            <style>
                ol, ul {
                    list-style: unset !important;
                }
            </style>
        @endif
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!--<script type="text/javascript" src="<?php echo url('assets/front'); ?>/javascript/jquery-ui.js"></script>-->
        <script type="text/javascript" src="<?php echo url('assets/front'); ?>/javascript/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo url('assets/front'); ?>/javascript/jquery.easing.js"></script>
        <script type="text/javascript" src="<?php echo url('assets/front'); ?>/javascript/mdb.min.js"></script>
        <script type="text/javascript" src="<?php echo url('assets/front'); ?>/javascript/jquery-validate.js"></script>
        <script type="text/javascript" src="<?php echo url('assets/front'); ?>/javascript/jquery-waypoints.js"></script>
        <script type="text/javascript" src="<?php echo url('assets/front'); ?>/javascript/main.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>


        <script type="text/javascript" src="<?php echo url('assets/front'); ?>/javascript/tooltipster.bundle.min.js"></script>

        <script type="text/javascript">
            function  tonothing(){
                return false;
            }
            jQuery(document).ready(function ($) {

                $("#tax_mask_show").click(function () {
                    $("#tax_id").attr('type', 'text');
                    $("#tax_mask_show").hide();
                    $("#tax_mask_hide").show();
                });

                $("#tax_mask_hide").click(function () {
                    $("#tax_id").attr('type', 'password');
                    $("#tax_mask_hide").hide();
                    $("#tax_mask_show").show();
                });

                $(".gmsSort").find('tr:gt(1)').hide();
                $("#phone_show_all").click(function () {
                    $("#gsmPhone").find('tr:gt(1)').toggle();
                    $("#phone_show_all").hide();
                    $("#phone_show_less").show();
                });
                $("#phone_show_less").click(function () {
                    $("#gsmPhone").find('tr:gt(1)').toggle();
                    $("#phone_show_less").hide();
                    $("#phone_show_all").show();
                });

                $("#email_show_all").click(function () {
                    $("#gsmEmail").find('tr:gt(1)').toggle();
                    $("#email_show_all").hide();
                    $("#email_show_less").show();
                });
                $("#email_show_less").click(function () {
                    $("#gsmEmail").find('tr:gt(1)').toggle();
                    $("#email_show_less").hide();
                    $("#email_show_all").show();
                });

                $("#location_show_all").click(function () {
                    $(".mainDiv:gt(0)").show();
                    $("#location_show_all").hide();
                    $("#location_show_less").show();
                });
                $("#location_show_less").click(function () {
                    $(".mainDiv:gt(0)").hide();
                    $("#location_show_less").hide();
                    $("#location_show_all").show();
                });

                $(".mainDiv:gt(0)").hide();
                $('#sns_mommenu .btn.menusidebar').on('click', function () {
                    if ($(this).hasClass('active')) {
                        $(this).find('.overlay').fadeOut(250);
                        $(this).removeClass('active');
                    } else {
                        $(this).addClass('active');
                        $(this).find('.overlay').fadeIn(250);
                    }
                });
                $('.tooltipster').tooltipster({
                    contentCloning: true,
                    theme: 'tooltipster-shadow'
                });
            });
        </script>
    </body>

</html>
