@extends('layouts.frontapp')

@section('content')
    <!-- Page Content  landingPage -->

    <div class="container">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <h2>Managed Services -</h2>
            <h4 class="text-center">...your business continuity assurance</h4>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
        </div>

        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6"></div>
            @include('common.locationlist')
        </div>
        @include('common.userinfofooter')
    </div>
    <!-- /.container -->

    <style>
        th{
            font-weight:bold;
            text-align: center;
        }
        td {
            padding-bottom: 10px;
        }
    </style>
@endsection