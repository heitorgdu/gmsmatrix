@extends('layouts.frontapp')

@section('content')
<!-- Page Content  landingPage -->
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <h3 class="page-header" style="font-size: 30px; margin-bottom:0">Guardian Managed Services</h3>
            <p class="text-right lead">
                <em>...helping people prevent problems with technology since 1984</em></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1 lead">
            <p><span style="color:#3cabda; font-weight:600">If you've been in business more than a few months</span>, 
                you probably already know that...</p>
            <p class="text-right"><span style="color:#3cabda; font-weight:600"><em><u>when your computer stops working, 
                            you are virtually out of business, right</u>?</em></span></p>
            <p><br>So you definitely want to know a good tech but...</p>
            <p class="text-right"><span style="color:#3cabda; font-weight:600">
                    <em>we think it's better to keep problems from happening!</em></span><br> <br> </p>
            <p>Like Ben Franklin said... <span style="font-weight:600">
                    <em>"An ounce of prevention is worth a pound of cure."</em></span></p>
            <h4 class="page-header" style="font-size: 24px; margin-bottom:0px; margin-top:18px">
                Learn How You Can Have <span style=" font-style:italic">
                    Business Continuity Assurance</span></h4>
            <p class="lead text-right"><span style="font-weight:600; margin-bottom:0px">
                    <em><u>...absolute certainty about the safety and future of your business</u>.</em></span></p>
            <p class="lead"><span style="margin-top:-10px">Watch the Video -</span></p>
        </div>
    </div>
    <!-- video -->
    <div class="row">
        <div class="col-xm-12 col-md-10 col-md-offset-1 img-responsive" style="padding:32px">
            <center>
                <video poster="https://evp-53245bf8beee5-40dfacc3d29f1f11f344b1139fef6601.s3.amazonaws.com/matrixpromo-1-default-splash.png?v=1496585385" controls="controls" width="640" height="360">
                    <source src="https://evp-53245bf8beee5-40dfacc3d29f1f11f344b1139fef6601.s3.amazonaws.com/matrixpromo-1.mp4"
                            type="video/mp4">
                </video>
            </center>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-10">
            <h4 class="well1 text-right">
                <a href="/directory" target="_blank">Technician Directory</a></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1 lead">
            <div class="well">
                <h4 class="well1">About Us</h4>
                <p>Guardian Partners is the division of Global Concepts that specializes in managing services for small businesses... 
                    everything from preventive computer maintenance to data security and even premium quality phones.<br>
                    Founded in 1984, Global Concepts started out as an international consulting firm and, over the next 30 years, 
                    evolved into the highly specialized, managed service provider it is today.</p>
            </div>
        </div>
    </div>
    <!-- Footer -->
</div>
<!-- /.container -->
@endsection