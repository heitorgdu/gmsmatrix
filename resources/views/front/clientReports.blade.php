@extends('layouts.frontapp')

@section('content')
        <!-- Page Content  landingPage -->

<div class="container">

    @if($IfAdmin == 1)
        <div style=" margin-top:20px;">
            <div class="col-xs-1 col-sm-1 col-md-1"></div>
            <div class="col-xs-10 col-sm-10 col-md-10">
                <ul class="nav nav-tabs">
                    <li class="<?php if (\Request::is('report/tech')) echo ("active"); ?>" role="presentation"><a href="{{url('/report/tech')}}">Tech Report</a></li>
                </ul>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1"></div>
        </div>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2 style="margin-top: 20px">Client Report for <a href="{{url('/profile')."/".$company['cid']}}">{{$company['name']}}</a></h2>
    </div>
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
        <div class="col-xs-12 col-sm-12 col-md-10">
            <hr class="colorgraph">
            @if($IfTech == 1)
                <div class="form-group">
                    <div class="table-responsive">
                        <table width="100%" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-left">
                                        <a href="@if($type != 'asc'){{url('/client/name/asc').'/'.$company['cid']}}@else {{url('/report/client').'/'.$company['cid']}} @endif">
                                            Name
                                            <i class="fa fa-sort" aria-hidden="true"></i>
                                        </a>
                                    </th>
                                    <th class="text-left">
                                        <a href="@if($type != 'asc'){{url('/client/users/asc').'/'.$company['cid']}}@else {{url('/client/users/desc').'/'.$company['cid']}} @endif">
                                            Person
                                            <i class="fa fa-sort" aria-hidden="true"></i>
                                        </a>
                                    </th>
                                    <th class="text-left">
                                        <a href="@if($type != 'asc'){{url('/client/email/asc').'/'.$company['cid']}}@else {{url('/client/email/desc').'/'.$company['cid']}} @endif">
                                            Email
                                            <i class="fa fa-sort" aria-hidden="true"></i>
                                        </a>
                                    </th>
                                    <th class="text-left">
                                        <a href="@if($type != 'asc'){{url('/client/phone/asc').'/'.$company['cid']}}@else {{url('/client/phone/desc').'/'.$company['cid']}} @endif">
                                            Phone
                                            <i class="fa fa-sort" aria-hidden="true"></i>
                                        </a>
                                    </th>
                                    <th class="text-center">
                                        <a href="@if($type != 'asc'){{url('/client/device/asc').'/'.$company['cid']}}@else {{url('/client/device/desc').'/'.$company['cid']}} @endif">
                                            Devices
                                            <i class="fa fa-sort" aria-hidden="true"></i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($techs) != 0)
                                    @foreach($techs as $index => $tech)
                                        <tr class="text-left">
                                            @if($tech['name'] != null)
                                                <td><a href="{{url('/dashboard')."/".$tech['cid']}}">{{$tech['name']}}</a></td>
                                            @else
                                                <td><a href="{{url('/dashboard')."/".$tech['cid']}}">Business Name</a></td>
                                            @endif
                                            <td>{{$tech->personDet['name']}}<?php echo " "; ?>{{$tech->personDet['last_name']}}</td>
                                            <td>{{$tech->emailDet['e_addr']}}</td>
                                            <td>{{$tech->phoneDet['nbr']}}</td>
                                            <td class="text-center">{{$tech->deviceDet}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="5" class="text-center">No Information Found</td>
                                    </tr>
                                @endif
                            </tbody>

                            <tfoot class="pull-right">

                            </tfoot>

                        </table>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <h4>Sorry you are not authorized to view this page.</h4>
                </div>
            @endif
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
    </div>

    @include('common.userinfofooter')
</div>
<!-- /.container -->

<style>
    th{
        font-weight:bold;
        text-align: center;
    }
    th a{
        color: black;
    }
    td {
        padding-bottom: 10px;
    }
</style>
@endsection