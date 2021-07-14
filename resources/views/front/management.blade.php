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
        <div class="col-xs-12 col-sm-12 col-md-12">
            <ul class="nav nav-tabs">
                <li class="<?php if(\Request::is('subscription/*')) echo ("active");  elseif(\Request::is('subscription')) echo ("active");?>" role="presentation">
                    <a href="@if($id == null){{url('/subscription')}}@else{{url('/subscription/'.$id)}}@endif">Add/Edit</a>
                </li>
                <li class="<?php if (\Request::is('management/*')) echo ("active"); elseif(\Request::is('management')) echo ("active");?>" role="presentation">
                    <a href="@if($id == null){{url('/management')}}@else{{url('/management/'.$id)}}@endif">Manage</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @include('common.errors')
        </div>
    </div>


    <div class="row">

        <div class="col-xs-12 col-sm-6 col-md-6">
            <h4>Subscription Management</h4>
            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px">
                <div class="col-xs-6 col-sm-6 col-md-5 rightText">
                    <b>For new MTS installation -</b>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4">
                    <select id="addLocationManagement" class="marBtm10">
                        <option value="loc" disabled="disabled" selected="selected">Choose Location</option>
                        <option>New Location</option>
                        @foreach($locations as $index => $location)
                            <option value="{{$location->lid}}">{{$location->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3"></div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-5 rightText">
                    <b>To reinstall MTS -</b>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4">
                    <select class="marBtm10" id="subscriptionDropDown">
                        <option value="none">Choose Subscription</option>
                        @foreach($subsUn as $sub)
                            <option value="{{$sub->sid}}">{{$sub->sid}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3"></div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-5 rightText">
                    <b>To remove subscription -</b>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4">
                    <select class="marBtm10" id="removeSub">
                        <option value="none" disabled="disabled" selected="selected">Choose Subscription</option>
                        @foreach($subs as $sub)
                            <option value="{{$sub->sid}}">{{$sub->sid}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3"></div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-5 rightText">
                    <b>Assign MDS subscription -</b>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4">
                    <select class="marBtm10" id="mdsSubs">
                        <option value="none" disabled="disabled" selected="selected">Choose Subscription</option>
                        @foreach($mds as $md)
                            <option value="{{$md->sid}}">{{$md->sid}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3"></div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" id="activeForMDS" style="display: none">
                <div class="col-xs-6 col-sm-6 col-md-5 rightText">
                    <b>MTS Subscriptions -</b>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4">
                    <select class="marBtm10" id="unsubSubs">
                        <option value="none" disabled="disabled" selected="selected">Choose Subscription</option>
                        @foreach($mtsForMds as $sub)
                            <option value="{{$sub->sid}}" data-attr-device="{{$sub->device}}">{{$sub->sid}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3"></div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12"  id="updateMDS" style="display: none">
                <div></div>
                <a id="updateMdsBtn" class="btn btn-default" style="background-color: #FF6600;color: white;margin-left: 180px">
                   Update MDS
                </a>
                <div></div>
            </div>


            <br/>
            <br/>
            <button class="btn btn-default pull-right" id="activateMtsBtn" style="display: none">Activate MTS</button>



            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;display: none" id="actionsToFollow">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <b>Run the setup file as soon as you have the new Device ID -</b>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-2 col-sm-2 col-md-2">

                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 text-center">
                        <p>if you don't already have the current version,</p>
                        <a target="_blank" href="http://mts.files.s3.amazonaws.com/setup/GuardianMTS-Setup.exe">click to download</a>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div></div>
                    <button class="btn btn-default" id="activateMtsBtnFollow" style="background-color: #FF6600;color: white;margin-left: 180px">
                        Click to get<br>
                        a Device ID. <br>
                        Use it when you<br>
                        start installation.
                    </button>
                    <div></div>
                </div>
            </div>
            <input type="hidden" id="CoIdNeeded" value="{{$company['cid']}}">
        </div>
        @include('common.locationlist')
    </div>
    @include('common.userinfofooter')
</div>
<!-- /.container -->

<div id="addLocationModalManagement" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Location</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{ url('/saveLocation') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="current_user_id" value="{{ $user['id'] }}" class="currentUserId" />

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control input-lg" value="Home Office" placeholder="Name Home Office" tabindex="1" required />
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="addr1" id="addr1" class="form-control input-lg" placeholder="Street" tabindex="1" required />
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="addr2" id="addr2" class="form-control input-lg" placeholder="Suite/Apt" tabindex="1" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="city" id="city" class="form-control input-lg" placeholder="City" tabindex="1" required />
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="st" id="st" class="form-control input-lg" placeholder="State" tabindex="1" required />
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="postal" id="postal" class="form-control input-lg" placeholder="Zip" tabindex="1" required />
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="cntry" id="cntry" class="form-control input-lg" placeholder="Country" value="US" tabindex="1" required />
                            </div>
                        </div>

                        <input type="hidden" name="coId" value="{{$company['cid']}}">

                        <div class="col-xs-6 col-md-6 col-sm-offset-1 col-md-offset-3">
                            <button type="submit" name="management" class="btn btn-success btn-block btn-lg">Save</button>
                            <br>
                        </div>
                    </div>

                </form>
            </div>
            <input type="hidden" id="hiddenSubID" class="form-control input-lg" tabindex="1" value="" />
        </div>
        <div class="modal-footer"></div>
    </div>
</div>

<div id="removeLocPopup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="deleteTitle">Delete [service] for [device]</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{ url('/delete') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="current_user_id" value="{{ $user['id'] }}" class="currentUserId" />

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <h5>Do you want to remove this service?</h5>
                            <h5>Type "YES" to confirm</h5>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <input type="text" name="choice" id="choice" class="form-control input-lg" tabindex="1" required />
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                            </div>
                        </div>

                        <input type="hidden" id="toDeleteId" name="toDeleteId" value="">
                        <input type="hidden" name="coId" value="{{$company['cid']}}">

                        <div class="col-xs-6 col-md-6 col-sm-offset-1 col-md-offset-5">
                            <button type="submit" disabled="disabled" id="delSub" class="btn btn-success">OK</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <br>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>

<div id="newDeviceShow" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px;">
        <div>
            <a type="button" href="@if($id == null){{url('/management')}}@else{{url('/management/'.$id)}}@endif" style="float: right;">&times;</a>
            <form class="device-id">
                <input disabled="disabled" type="text" style="padding: 20px 0px;text-align: center;border-bottom: none;font-size: 45px" id="deviceID" class="form-control input-lg" tabindex="1" value="" />
            </form>
            <a style="margin-left: 25%;margin-top: -43%;" id="refreshBtn" href="@if($id == null){{url('/management')}}@else{{url('/management/'.$id)}}@endif" class="btn btn-success">OK</a>
        </div>
    </div>
</div>

<div id="notFound" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Note:</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        Subscriptions marked pending are not available for use.<br />
                        Please wait a few minutes
                        {{--<a href="@if($id == null){{url('/subscription')}}@else{{url('/subscription/'.$id)}}@endif">here</a>--}}
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer"></div>
    </div>
</div>

<div id="unassignedSelected" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Note:</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        Please install MTS on the selected computer before setting up MDS.
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
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
    #activateMtsBtn {
        border-radius: 5px;
        margin-top: 20px;
    }
    .marBtm10{
        margin-bottom: 10px;
    }
    .device-id{
        background: url('/assets/front/images/addidbox1.png') no-repeat;
        width: 295px;
        height: 443px;
        padding: 55px 43px 0 20px;
        box-sizing: border-box;
    }

    .device-id input{
        width: 100%;
        height:64px;
        border:none;
        border-radius: 10px;
        font-weight: bold;
        font-size: 18px;
        padding: 0 10px;
        box-sizing: border-box;
    }
    .rightText{
        text-align: right;
    }
</style>

<script>

    jQuery(document).ready(function ($) {
        var btnId = $('#activateMtsBtn');
        btnId.css('display', 'none');
        btnId.css('background-color', '#e6e6e6');
        btnId.css('border-color', '#adadad');

        var mds = $('#mdsSubs');
        mds.change(function() {
            var mdsVal = mds.val();
            if(mds != 'none' || mds != ""){
                $('#activeForMDS').css('display', 'block');
            } else {
                $('#activeForMDS').css('display', 'none');
            }
        });

        var activeForMDS = $('#activeForMDS');
        activeForMDS.change(function() {
            var unsubSubs = $('#unsubSubs');
            var mtsVal = unsubSubs.val();
            if(mtsVal != 'none' || mtsVal != ""){
                var option = $('option:selected', this).attr('data-attr-device');
                if(option == 'unassigned'){
                    $('#updateMDS').css('display', 'none');
                    $('#unassignedSelected').modal('show');
                    unsubSubs.val('none');
                } else {
                    $('#unassignedSelected').modal('hide');
                    $('#updateMdsBtn').attr('href','/sub/update/'+mds.val()+'/'+mtsVal);
                    $('#updateMDS').css('display', 'block');
                }
                console.log('abc',option);
            } else {
                option = $('option:selected', this).attr('data-attr-device');
                console.log('abc11',option);
            }
        });


        $('#addLocationManagement').change(function() {
            $('#removeSub').val('none');
            $('#subscriptionDropDown').val('none');
            btnId.css('background-color', '#e6e6e6');
            btnId.css('border-color', '#adadad');
            $('#actionsToFollow').css('display', 'none');
            btnId.html('Activate MTS');
            btnId.removeAttr('disabled');
            var givenVal = this.value;
            if (givenVal == 'New Location'){
                btnId.css('display', 'none');
                $('#addLocationModalManagement').modal('show');
            }
            if ((givenVal != 'New Location') && (givenVal != 'loc')) {
                btnId.attr('data-attr-id', givenVal);
                btnId.css('display', 'block');
            }

        });
        btnId.click(function (){
            var givenVal = btnId.attr('data-attr-id');
            if (givenVal != 0) {
                var coId = $('#CoIdNeeded').val();
                $.ajax({
                    type: 'POST',
                    url: "/update/subscription/" + givenVal+"/"+coId,
                    success: function (result) {
                        if (result != 1) {
                            $("#hiddenSubID").val(result.sid);
                            $("#availableSo"+result.sid).css('display', 'none');
                            var tr = ' <tr class="text-center locationTr">'+
                                '<td>'+result.sid+'</td>'+
                                '<td>'+result.device+'</td>'+
                               '<td>'+result.srv.name+' '+result.srv.type+'</td>'+
                            '</tr>';
                            $(tr).insertAfter("#locationTr"+result.lid);
                           // $("#locUpdated").empty().append(options);
                            btnId.css('background-color', '#5cb85c');
                            btnId.css('border-color', '#4cae4c');
                            btnId.html('MTS Activated');
                            btnId.attr('disabled', 'disabled');
                            $('#actionsToFollow').css('display', 'block');
                        } else {
                            $('#notFound').modal('show');
                        }
                    }
                });
            } else {
                btnId.css('background-color', '#5cb85c');
                btnId.css('border-color', '#4cae4c');
                btnId.html('MTS Activated');
                btnId.attr('disabled', 'disabled');
                $('#actionsToFollow').css('display', 'block');
            }

        });
        $('#removeSub').change(function() {
            var givenVal = this.value;
            if (givenVal != 'none') {
                $('#toDeleteId').val(givenVal);
                $.ajax({
                    type: 'GET',
                    url: "/sub/by/" + givenVal,
                    success: function (result) {
                        $('#deleteTitle').text('Delete '+result.srv.name+" "+result.srv.type+' for subscription ID: '+givenVal);
                    }
                });
                $('#choice').val('');
                $('#delSub').attr('disabled', 'disabled');
                $('#removeLocPopup').modal('show');
            }
        });
        $('#subscriptionDropDown').change(function() {
            var givenVal = this.value;
            if (givenVal != 'none') {
                btnId.attr('data-attr-id', 0);
                btnId.css('display', 'block');
                btnId.css('background-color', '#e6e6e6');
                btnId.css('border-color', '#adadad');
                btnId.html('Activate MTS');
                btnId.removeAttr('disabled');
                $('#actionsToFollow').css('display', 'none');
            }
        });


        $('#choice').change(function() {
            var givenVal = $('#choice').val();
            if (givenVal.toLowerCase() == 'yes') {
                $('#delSub').removeAttr('disabled');
            } else {
                $('#removeLocPopup').modal('hide');
                $('#choice').val('');
                $('#removeSub').val('none');
            }

        });

        $('#activateMtsBtnFollow').click(function(){
            var idNeeded = $("#subscriptionDropDown").val();
            if (idNeeded != 'none') {
                $('#deviceID').val(idNeeded);
                $('#newDeviceShow').modal('show');
            } else {
                var extra = $("#hiddenSubID").val();
                if (extra != null){
                    idNeeded = extra;
                }
                $('#deviceID').val(idNeeded);
                $('#newDeviceShow').modal('show');
            }
        });
    });
</script>
@endsection