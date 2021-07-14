@extends('layouts.frontapp')

@section('content')
        <!-- Page Content  landingPage -->

<div class="container">
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

    <div style=" margin-top:20px;">

        <div class="col-xs-10 col-sm-10 col-md-10">
            <ul class="nav nav-tabs">
                <li class="<?php if(\Request::is('subscription/*')) echo ("active");  elseif(\Request::is('subscription')) echo ("active");?>" role="presentation">
                    <a href="@if($id == null){{url('/subscription')}}@else{{url('/subscription/'.$id)}}@endif">Add/Edit</a>
                </li>
                <li class="<?php if (\Request::is('management/*')) echo ("active"); elseif(\Request::is('management')) echo ("active");?>" role="presentation">
                    <a href="@if($id == null){{url('/management')}}@else{{url('/management/'.$id)}}@endif">Manage</a>
                </li>
            </ul>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
    </div>


    <div class="row">
        <div class="col-sm-6" style="margin-top: 10px;">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg)}}  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
                @if($location < 1)
                    <p class="alert alert-danger">
                        NOTICE: Location is missing. Please update your profile.
                    </p>
                @endif
                    <p id="upperMsg" style="display: none" class="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </p>
            </div>
        </div>
    </div>


    <div class="row" style="margin-top: 20px">
        <h3>Subscription Setup for {{$company['name']}} -</h3>

        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
            <div class="col-xs-12 col-sm-12 col-md-7 text-left">
                <span class="text-left" style="margin-left: 20px">Add the services you need and edit the quantity</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 text-right">

            @if(isset($company['expires']))
                <h6>Current Renewal Date: {{$company['expires']}}</h6>
            @endif
            <input id="startFromEx" style="display: none" value="{{$data['expiry']}}">
            <input id="endFromEx" style="display: none" value="{{$data['endExpiry']}}">
            <hr class="colorgraph">
            <input type="hidden" id="hiddenNewServices" value="">
            <input type="hidden" id="locationCount" value="{{$location}}">
            <div class="form-group">
                <form role="form" method="POST" action="{{ url('/save/subscription/'.$company['cid']) }}">
                    <div class="table-responsive" style="border: none;">
                        <table width="100%" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Quantity</th>
                                <th>Service</th>
                                <th>Price</th>
                                <th>Setup</th>
                                <th>Totals</th>
                            </tr>
                            </thead>
                            <tbody>
                                {!! csrf_field() !!}
                                @if (isset($subs))
                                    @foreach($subs as $sub)
                                        <tr class="text-center servicesRecord">
                                            <td class="col-md-2 col-lg-2 col-xs-2">
                                                <input @if($location < 1)disabled="disabled" @endif data-value-prev="{{$sub->count}}" type="number" min="0" name="quantity[]" class="text-center checkValue" value="{{$sub->count}}">
                                            </td>
                                            <td>
                                                <input type="hidden" name="srv_id[]" value="{{$sub->service['srv_id']}}">
                                                {{$sub->service['name']}} {{$sub->service['type']}}
                                            </td>
                                            <?php $setup = number_format($sub->service['setup'], 2); ?>
                                            <td>{{$sub->service['price']}}</td>
                                            <td>{{$setup}}</td>
                                            <td>{{$sub->count * $sub->service['price']}}</td>
                                        </tr>
                                @endforeach
                                @endif
                                <tr class="text-center" id="selectNewSub">

                                    <td class="col-md-2 col-lg-2 col-xs-2">
                                        <input disabled="disabled" type="hidden" class="text-center">
                                    </td>
                                    <td colspan="2">
                                        <select id="addServiceSelect" style="width: 120px;max-width: 120px;" @if($location < 1)disabled="disabled" @endif>
                                            <option value="none">Add Service</option>
                                            @foreach($services as $service)
                                                <option value="{{$service['srv_id']}}" onclick="AddService()">
                                                    {{$service['name']}} {{$service['type']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>

                            </tfoot>

                        </table>
                    </div>

                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <div class="col-md-6 col-lg-6 col-xs-6">
                            <span>Enter if you have one:</span>
                        </div>

                        <div class="col-md-4 col-lg-4 col-xs-4">
                            <input type="text" id="setupcodecheckHidden" style="display:none" value="2">
                            <input type="text" id="setupcodecheck" @if($location < 1)disabled="disabled" @endif name="token" placeholder="Setup Code">
                        </div>
                        <div class="col-md-2 col-lg-2 col-xs-2">
                            <button type="button" disabled="disabled" style="background-color: rgb(230, 230, 230);border-color: rgb(173, 173, 173);color: black;" id="setupCodeBtn"  class="btn btn-default">
                               Verify
                            </button>
                        </div>

                    </div>

                    <div>
                        <button disabled="disabled" name="saveSub" id="updateSubSub" type="submit" class="btn btn-success btn-sm">Update Subscription</button>
                        <button style="display:none;" name="saveToken" id="updateSubToken" type="submit" class="btn btn-success btn-sm">Update Subscription</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 text-right" style="margin-top: -50px">
            <div  class="table-responsive" style="border: none;overflow-x: hidden;">
                <table width="100%" class="table">
                    <tbody>
                        <tr class="text-right">
                            <td class="bt" style="font-weight:bold;" colspan="3">
                                <p>Current renewal amount: </p>
                            </td>
                            <td class="bt">
                                {{$company['cost']}}
                            </td>
                            <td class="bt"></td>
                        </tr>
                        <tr class="text-right">
                            <td class="bt" style="font-weight:bold;" colspan="3">
                                <p>Subscription Period: </p>
                            </td>
                            <td class="bt" id="hideSubPeriod">
                                {{$company['sub_interval']}} @if($company['sub_interval'] && $company['sub_interval'] != 0) - month @endif
                            </td>
                            <td class="bt"> <a id="showSubPeriod">Update</a></td>
                        </tr>

                        <tr class="text-right">
                            <td class="bt" style="font-weight:bold;" colspan="4">
                                <div class="col-md-12 col-lg-12 col-xs-12">
                                    <div class="col-md-9 col-lg-9 col-xs-9"></div>
                                    <div class="col-md-3 col-lg-3 col-xs-3" id="showWhenSubPeriodChanged"  style="display: none">
                                        <form role="form" method="POST" action="{{ url('/change/interval').'/'.$company['cid'] }}" style="width: 140px;">
                                        <div class='input-group'>
                                            <select name="subinterval">
                                                <option value="1" @if($company['sub_interval'] == 1) selected="selected" @endif>One Month</option>
                                                {{--<option value="3" @if($company['sub_interval'] == 3) selected="selected" @endif>Three Months</option>--}}
                                                <option value="6" @if($company['sub_interval'] == 6) selected="selected" @endif>Six Months</option>
                                                <option value="12" @if($company['sub_interval'] == 12) selected="selected" @endif>One Year</option>
                                            </select>
                                        </div>
                                        <div style="margin-top: 10px;">
                                        <button type="submit" id="allDoneSubInterval" class="btn btn-success btn-sm">Save</button>
                                        <button type="button" id="cancelSubInterval" class="btn btn-default btn-sm">Cancel</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-right">
                            <td class="bt" style="font-weight:bold;" colspan="3">
                                <p>Day of month for renewal: </p>
                            </td>
                            <td class="bt" id="hideRenewalDate">
                                {{$company['sub_date']}}
                            </td>
                            <td class="bt"> <a id="showRenewalDate">Update</a></td>
                        </tr>
                        <tr class="text-right">
                            <td class="bt" style="font-weight:bold;" colspan="4">
                                <div class="col-md-12 col-lg-12 col-xs-12">
                                    <div class="col-md-9 col-lg-9 col-xs-9"></div>
                                    <div class="col-md-3 col-lg-3 col-xs-3" id="showWhenRenewalDateChanged"  style="display: none">
                                        <form role="form" method="POST" action="{{ url('/change/expiry').'/'.$company['cid'] }}" style="width: 140px;">
                                            <div class='input-group'>
                                                <input type="number" min="1" max="28" name="sub_date" value="{{$company['sub_date']}}"/>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <button type="submit" id="allDoneRenewalDate" class="btn btn-success btn-sm">Save</button>
                                                <button type="button" id="cancelRenewalDate" class="btn btn-default btn-sm">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{--<tr class="text-right">--}}
                            {{--<td class="bt" style="font-weight:bold;" colspan="3">Day of  month for renewal:</td>--}}
                            {{--<td  class="bt" id="hideWhenChecked">{{$company['renewal_diff']}}</td>--}}
                            {{--<td class="bt"> <a id="showChangeRenewal">Update</a></td>--}}
                        {{--</tr>--}}
                        {{--<tr class="text-right">--}}
                            {{--<td class="bt" style="font-weight:bold;" colspan="4">--}}
                                {{--<div class="col-md-12 col-lg-12 col-xs-12">--}}
                                    {{--<div class="col-md-3 col-lg-3 col-xs-3"></div>--}}
                                    {{--<div class="col-md-6 col-lg-6 col-xs-6" id="showWhenChanged"  style="display: none">--}}
                                        {{--<form role="form" method="POST" action="{{ url('/change/expiry').'/'.$company['cid'] }}" style="width: 140px;">--}}
                                            {{--<div class='input-group date' id='form_datetime'>--}}
                                                {{--<input id="toShow" readonly="readonly" value="{{$company['new_expiry']}}" type='text' class="form-control" style="font-size: 14px"/>--}}
                                                {{--<span class="input-group-addon" id="setStyle">--}}
                                                    {{--<span class="glyphicon glyphicon-calendar">--}}
                                                    {{--</span>--}}
                                                {{--</span>--}}
                                            {{--</div>--}}
                                            {{--<input id="actualRenewal" name="changeRenewal" style="display: none;"/>--}}

                                            {{--<div style="margin-top: 10px;">--}}
                                                {{--<button type="submit" id="allDoneRenewal" class="btn btn-success btn-sm">Save</button>--}}
                                                {{--<button type="button" id="cancelRenewal" class="btn btn-default btn-sm">Cancel</button>--}}
                                            {{--</div>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-3 col-lg-3 col-xs-3"></div>--}}
                                {{--</div>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        <tr class="text-right">
                            <td class="bt" style="font-weight:bold;" colspan="3">Next renewal date:</td>
                            <td class="bt">
                                @if (isset($company['new_expiry']))
                                    {{$company['new_expiry']}}
                                @endif
                            </td>
                            <td class="bt"></td>
                        </tr>
                        @if ($data['total'] != 0)
                            @if ($data['new_cost'] != 0)
                                <tr class="text-right">
                                    <td class="bt" colspan="3" style="font-weight:bold;">Next renewal amount:</td>
                                    <td class="bt">{{$data['new_cost']}}</td>
                                    <td class="bt"></td>
                                </tr>
                            @endif
                        @endif

                        @if ($data['total'] != 0)
                            <tr class="text-left">
                                <td class="bt" style="font-weight:bold;" colspan="3">Today's Payment Includes:</td>
                                <td class="bt"></td>
                                <td class="bt"></td>
                            </tr>
                        @endif
                        <br/>
                        @if ($data['prorate'] != 0)
                            <tr class="text-right">
                                <td class="bt" style="font-weight:bold;" colspan="3">Prorated charge to renewal date:</td>
                                <td class="bt">{{$data['prorate']}}</td>
                                <td class="bt"></td>
                            </tr>
                        @endif
                        @if ($data['credit'] != 0)
                            <tr class="text-right">
                                <td class="bt" style="font-weight:bold;" colspan="3">Prorated credit:</td>
                                <td class="bt" style="color:red">- {{$data['credit']}}</td>
                                <td class="bt"></td>
                            </tr>
                        @endif
                        @if ($data['setup'] != 0)
                            <tr class="text-right">
                                <td class="bt" style="font-weight:bold;" colspan="3">Setup charge for added service:</td>
                                <td class="bt">{{$data['setup']}}</td>
                                <td class="bt"></td>
                            </tr>
                        @endif
                        @if ($data['tot_discount'] != 0)
                            <tr class="text-right">
                                <td class="bt" colspan="3" style="font-weight:bold;">Promotional Discount:</td>
                                <td class="bt" style="color:red">- {{$data['tot_discount']}}</td>
                                <td class="bt"></td>
                            </tr>
                        @endif
                        @if ($data['tax'] != 0)
                            <tr class="text-right">
                                <td class="bt" style="font-weight:bold;" colspan="3">Texas Sales Tax:</td>
                                <td class="bt">{{$data['tax']}}</td>
                                <td class="bt"></td>
                            </tr>
                        @endif
                        @if ($data['total'] != 0)
                            <tr class="text-right">
                                <td class="bt" style="font-weight:bold;" colspan="3">Total due today:</td>
                                <td class="bt">{{$data['total']}}</td>
                                <td class="bt"></td>
                            </tr>
                        @endif
                        <br/>
                        <br/>
                        <form role="form" method="POST" action="{{ url('/email/update/'.$company['cid']) }}">
                            <tr class="text-right">
                                <td class="bt" style="font-weight:bold;" colspan="3">Paypal Email:
                                    <span style="font-weight:normal;">{{$company['paypal_email']}}</span>
                                </td>
                                <td class="bt"></td>
                                <td class="bt"> <a style="margin-left: 10px" id="editPaypalId">Update</a></td>
                            </tr>
                            <tr class="text-right" style="font-weight:bold;">
                                <td class="bt" colspan="3">
                                    <input name="paypalEmail" required="required" type="email" value="{{$company['paypal_email']}}" style="display: none" class="addEmail" />
                                </td>
                                <td class="bt">
                                    <button type="submit" class="addEmail btn btn-success" style="display: none">Save</button>
                                </td>
                                <td class="bt">
                                </td>

                            </tr>
                        </form>
                        <form role="form" method="POST" action="{{ url('/email/paypal/'.$company['cid']) }}">
                            <tr class="text-right" style="font-weight:bold;">
                                <td class="bt">
                                    <input type="number" style="display: none" name="amountToPay" value="{{$data['nc']}}">
                                    <input type="number" style="display: none" name="amount_due" value="{{$data['t']}}">
                                </td>
                                <td class="bt"></td>
                                <td class="bt">
                                    <input name="paypalEmail" required="required" type="email" value="{{$company['paypal_email']}}" style="display: none" />
                                </td>

                            </tr>
                            <tr class="text-right" style="font-weight:bold;">
                                <td class="bt">
                                </td>
                                <td class="bt" colspan="2">
                                    <label style="font-size: 12px;font-weight:normal;width: 185px" for="paypalAuth">
                                        Check to confirm PayPal address
                                    </label>
                                </td>
                                <td class="bt">
                                    <input id="paypalAuth" @if($company['paypal_email'] == "" || $company['paypal_email'] == NULL) disabled="disabled" @endif type="checkbox" name="emailChecked" value="1">
                                    <label for="paypalAuth" style="font-size: 12px;font-weight:normal;" for=""></label>
                                </td>
                            </tr>
                            <tr class="text-right">
                                <td class="bt"></td>
                                <td class="bt"></td>
                                <td class="bt" colspan="3">
                                    <button type="submit" @if($data['total'] < 1) disabled="disabled"@endif style="display: none;margin-left: 25px;" id="paypalAuthbtn" name="paypalAuth" class="btn btn-success btn-sm">PayPal Authorization</button>
                                </td>

                            </tr>
                            <tr class="text-left" id="paypalAuthText" style="display: none;">
                                <td class="bt"></td>
                                <td class="bt" colspan="4">
                                    <ol type="1" style="list-style: decimal;margin-left: 180px;color: black;" >
                                        <p style="color:red"><b>Authorization requires 2 steps -</b></p>
                                        <li class="mt25">Approve the monthly payment plan; and</li>
                                        <li class="mt25">Then pay the Amount due today.</li>
                                    </ol>
                                </td>
                            </tr>

                        </form>

                    </tbody>
                </table>
            </div>
        </div>
        {{--<div class="col-xs-12 col-sm-12 col-md-12 text-right" style="margin-top: 10px">--}}
            {{--<div class="col-xs-12 col-sm-12 col-md-8 text-right">--}}
                {{--<h5 class="text-left">Subscription Tutorial: </h5>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-xm-12 col-md-10 col-md-offset-1 img-responsive" style="padding:32px">--}}
                        {{--<center>--}}
                            {{--<div id="evp-76f63baee4fa8e40bdb931eff1830488-wrap" class="evp-video-wrap"></div>--}}
                            {{--<script type="text/javascript" src="https://guardianpartners.net/evp/framework.php?div_id=evp-76f63baee4fa8e40bdb931eff1830488&id=bWF0cml4cHJvbW8tMS5tcDQ%3D&v=1496589893&profile=default"></script>--}}
                            {{--<script type="text/javascript">--}}
                                {{--_evpInit('bWF0cml4cHJvbW8tMS5tcDQ=[evp-76f63baee4fa8e40bdb931eff1830488]');//-->--}}
                            {{--</script>--}}
                        {{--</center>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}


    <div class="col-xs-12 col-sm-12 col-md-12">
        @include('common.userinfofooter')
    </div>

</div>
<!-- /.container -->

<input type="hidden" id="CoIdForAll" value="{{$company['cid']}}">
<div id="alertMessage" class="modal fade" role="dialog" style="margin-top: 50px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>You must first remove the subscription(s) you no longer want.</p>
                <a href="{{url('/management/'.$company['cid'])}}">Subscription Management page</a>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<style>
    th{
        font-weight:bold;
        text-align: center;
    }
    td {
        padding-bottom: 10px;
    }
    p{
        font-weight:bold;
    }
    span{
        margin-left: 10px
    }
    .bt{
        border-top: none !important;
    }
    .dropdown-menu {
        background-color: #fff ;
        color: #333 ;
    }
    .disabled{
        font-weight:300 !important;
        opacity: 0.5;
    }
    .day {
        font-weight: 900;
    }
    .mt25{
        margin-left: 25px;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/bootstrap-datepicker3.css"/>
<script src="<?php echo url('assets/front'); ?>/javascript//bootstrap-datepicker.js"></script>


<script>

    $('#form_datetime').datepicker({
        //..
        format: 'M dd ',
        startDate: $('#startFromEx').val(),
        endDate: $('#endFromEx').val(),
        minView: 2,
        autoclose: 1,
        datesDisabled: ['Jan 29', 'Jan 30','Jan 31','Feb 29','Mar 29', 'Mar 30','Mar 31','Apr 29', 'Apr 30',
            'May 29', 'May 30','May 31','Jun 29', 'Jun 30','Jul 29', 'Jul 30','Jul 31',
            'Aug 29', 'Aug 30','Aug 31','Sep 29', 'Sep 30', 'Oct 29', 'Oct 30','Oct 31',
            'Nov 29', 'Nov 30','Dec 29', 'Dec 30','Dec 31']
    });

    $('#toShow').change(function() {
        var month = '';
        var showValue = $('#toShow').val();
        showValue = showValue.split(" ");
        if (showValue[0] == 'Jan'){
            month = 01;
        }
        if(showValue[0] == 'Feb'){
            month = 02;
        }
        if(showValue[0] == 'Mar'){
            month = 03;
        }
        if(showValue[0] == 'Apr'){
            month = 04;
        }
        if(showValue[0] == 'May'){
            month = 05;
        }
        if(showValue[0] == 'Jun'){
            month = 06;
        }
        if(showValue[0] == 'Jul'){
            month = 07;
        }
        if(showValue[0] == 'Aug'){
            month = 08;
        }
        if(showValue[0] == 'Sep'){
            month = 09;
        }
        if(showValue[0] == 'Oct'){
            month = 10;
        }
        if(showValue[0] == 'Nov'){
            month = 11;
        }
        if(showValue[0] == 'Dec'){
            month = 12;
        }
        var CurrentDate = new Date();
        console.log(showValue[0], CurrentDate.getFullYear() );
        if(showValue[0] != 'Dec'){
            CurrentDate.setMonth(CurrentDate.getMonth() + 1);
        }
        console.log(CurrentDate.getFullYear() , 'abc');
        var year = CurrentDate.getFullYear();
        var actualDate = (year +"-"+month+'-'+showValue[1]);
        $('#actualRenewal').val(actualDate);
    });
//    <input id="toShow"
//            <input id="ActuallRenewal"

    jQuery(document).ready(function ($) {
        var locationCheck = $('#locationCount').val();
        console.log(locationCheck);
        var check =  $('#paypalAuth');
        check.click(function(){
            if (check.is(':checked')) {
                if(locationCheck != 0) {
                    $('#paypalAuthbtn').removeAttr('disabled');
                    $('#paypalAuthbtn').css('display', 'inline');
                    $('#paypalAuthText').css('display', '');
                    $('#hideWhenChecked').css('display', '');
                    $('#showWhenChanged').css('display', 'none');
                } else {
                    $('#paypalAuthbtn').css('display', 'inline');
                    $('#paypalAuthbtn').attr('disabled', 'disabled');
                    $('#paypalAuthText').css('display', 'none');
                }
            } else {
                $('#paypalAuthbtn').css('display', 'none');
                $('#paypalAuthText').css('display', 'none');
            }

        });

        var msg =   $('#setupcodecheck');
        msg.focus(function(){
            var btn = $('#setupCodeBtn');
            btn.removeAttr('disabled');
            btn.css('background-color', 'rgb(230, 230, 230)');
            btn.text('Verify');
            btn.css('color', 'black');
        });

        msg.focusout(function(){
            var code = $('#setupcodecheck').val();
            if (code == "") {
                $('#setupCodeBtn').attr('disabled', 'disabled');
            }
            if (code == " ") {
                $('#setupCodeBtn').attr('disabled', 'disabled');
            }

        });
        $('#setupCodeBtn').click(function(){
            var code = $('#setupcodecheck').val();
            if (code != "") {
                $.ajax({
                    type: 'GET',
                    url: "/check/code/" + code,
                    success: function (result) {
                        var msg =  $('#setupCodeBtn');
                        msg.css('color', 'white');
                        if (result > 0) {
                            msg.css('background-color', 'green');
                            msg.text('Valid');
                            var newValue = $('.checkValue').val();
                            var prevValue = $('.checkValue').attr('data-value-prev');
                            if(newValue == prevValue) {
                                $('#updateSubSub').css('display', 'none');
                                $('#updateSubToken').css('display', '');
                            }
                        } else {
                            msg.css('background-color', 'red');
                            msg.text('Invalid');
                        }
                    }
                });
            }
        });


        if ($('#setupcodecheck').val() == "") {
            $('#setupcodecheckHidden').val(2);
            var msg =  $('#upperMsg');
            msg.css('display', 'none');
        }
        $('#editPaypalId').click(function (){
            $('#editPaypalId').css('display', 'none');
            $('.addEmail').css('display', 'block');
            $('#hideWhenChecked').css('display', '');
            $('#showWhenChanged').css('display', 'none');
        });

        var ids = $('#showWhenChanged');
        $('#showChangeRenewal').click(function() {
            $('#hideWhenChecked').css('display', 'none');
            $('#showWhenChanged').css('display', '');
            $('#editPaypalId').css('display', '');
            $('.addEmail').css('display', 'none');
        });

        $('#showRenewalDate').click(function() {
            $('#hideWhenChecked').css('display', 'none');
            $('#showWhenSubPeriodChanged').css('display', 'none');
            $('#hideRenewalDate').css('display', 'none');
            $('#showWhenRenewalDateChanged').css('display', '');
            $('#editPaypalId').css('display', '');
            $('.addEmail').css('display', 'none');
        });

        $('#showSubPeriod').click(function() {
            $('#hideWhenChecked').css('display', 'none');
            $('#hideSubPeriod').css('display', 'none');
            $('#showWhenRenewalDateChanged').css('display', 'none');
            $('#showWhenSubPeriodChanged').css('display', '');
            $('#editPaypalId').css('display', '');
            $('.addEmail').css('display', 'none');
        });

        $('#cancelRenewal').click(function(){
            $('#hideWhenChecked').css('display', '');
            $('#showWhenChanged').css('display', 'none');
        });

        $('#cancelRenewalDate').click(function(){
            $('#hideRenewalDate').css('display', '');
            $('#showWhenRenewalDateChanged').css('display', 'none');
        });
        $('#cancelSubInterval').click(function(){
            $('#hideSubPeriod').css('display', '');
            $('#showWhenSubPeriodChanged').css('display', 'none');
        });


        $('#iflessthante').blur(function() {
            var checkVal = $('#iflessthante').val();
            if (checkVal > 28) {
                $('#msgToShow').css('display', 'block');
            } else {
                $('#msgToShow').css('display', 'none');
            }
        });


        $('.checkValue').blur(function() {
            var newValue = $(this).val();
            var prevValue = $(this).attr('data-value-prev');
            prevValue = 0+prevValue;
            if(newValue == prevValue) {
                $('#updateSubSub').attr('disabled', 'disabled');
            }
            if(newValue < prevValue) {
                $('#alertMessage').modal('show');
                $('#updateSubSub').attr('disabled', 'disabled');
                    var newValue = $(this).val();
                    var prevValue = $(this).attr('data-value-prev');
                    prevValue = 0 + prevValue;
                    if (newValue == prevValue) {
                        $('#updateSubSub').attr('disabled', 'disabled');
                    }
                    if (newValue < prevValue) {
                        $('#alertMessage').modal('show');
                        $('#updateSubSub').attr('disabled', 'disabled');
                    }
                } else {
                var hiddenID = $('#setupcodecheckHidden').val();
                if (hiddenID == 0) {
                    var msg =  $('#upperMsg');
                    msg.css('display', 'block');
                    msg.removeClass('alert-success');
                    msg.addClass('alert-danger');
                    msg.text('You can not update or add subscription with invalid or expired code');
                } else {
                    $('#updateSubSub').removeAttr('disabled');
                }

            }
        });

        $( "#addServiceSelect" ).change(function() {
            var _token = $('input[name="_token"]').val();
            var givenId = this.value;
            var idNeeded = $('#hiddenNewServices');
            var getValue = $(idNeeded).val();
            if (getValue != ""){
                $(idNeeded).val(getValue+','+givenId);
            } else {
                $(idNeeded).val(givenId);
            }

            getValue = $(idNeeded).val();
            var coIdNeeded = $('#CoIdForAll').val();
            if (givenId != 'none') {
                $.ajax({
                    type: 'POST',
                    url: "/subscriptions/"+givenId,
                    data: {
                        _token : _token,
                        'ids':getValue,
                        'CoId':coIdNeeded
                    },
                    success: function(result){
                        var html = ' <tr class="text-center servicesRecord">'+
                                '<td class="col-md-2 col-lg-2 col-xs-2">'+
                                    '<input min="0" data-value-prev="0" name="quantity[]" class="text-center checkValue" type="number" placeholder="1" value="1">'+
                                '</td>'+
                                '<td>'+
                                    '<input type="hidden" name="srv_id[]" value="'+result.subs.srv_id+'">'+
                                     result.subs.name +"  "+result.subs.type+
                                '</td>'+
                                '<td>'+result.subs.price+'</td>'+
                                '<td>'+result.subs.setup+'</td>'+
                                '<td>'+result.subs.price+'</td>'+
                                '</tr>';

                        var options = ' <option value="none">Add Service</option>';
                        $.each(result.services, function( index, value ) {
                            options = options + '<option value="'+value.srv_id+'">'+value.name+"  "+value.type+'</option>'
                        });
                        $(html).insertBefore("#selectNewSub");
                        $("#addServiceSelect").empty().append(options);
                        $('#updateSubSub').removeAttr('disabled');
                    }
                });
            }

        });
    });

</script>
@endsection