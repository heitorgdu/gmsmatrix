@extends('layouts.frontapp')

@section('content')

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
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
        <div class="col-xs-10 col-sm-10 col-md-10">
            <ul class="nav nav-tabs">
                <li class="<?php if(\Request::is('profile/*')) echo ("active");  elseif(\Request::is('profile')) echo ("active");?>" role="presentation">
                    <a href="@if($id == null){{url('/profile')}}@else{{url('/profile/'.$id)}}@endif">Company</a>
                </li>
                <li class="<?php if (\Request::is('person/*')) echo ("active"); elseif(\Request::is('person')) echo ("active"); elseif(\Request::is('personBy/*')) echo ("active");?>" role="presentation">
                    <a href="@if($id == null){{url('/person')}}@else{{url('/person/'.$id)}}@endif">Personal</a>
                </li>
            </ul>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1"></div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-10 col-sm-offset-1 col-md-offset-1">
            <hr class="colorgraph">
            <div class="row">
                <div class="col-sm-12">
                    @include('common.errors')
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 ">
                    <div class="form-group md-form">
                        <input class="form-control input-lg" type="text" readonly="readonly" tabindex="1" value="{{ $companyDetails->name }}">
                    </div>
                </div>	
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label for="selected_person"> Select person to edit </label>
                        <select class="input-sm" id="type" name="selected_person" onchange="window.location ='{{ url('personBy') }}/'+this.value">
                            @foreach ($companyUsers as $users) {
                                <option value="{{ $users->id."/".$companyDetails->cid}}"   @if($users['id'] == $currentUserData->id) selected='selected' @endif>
                                    {{ $users->name }} {{ $users->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <form id="updateUserFormProfile" role="form" method="POST" action="{{ url('/updateUserProfile') }}/{{ $currentUserData['id'] }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        @if($currentUserData->pic != "")
                            <img src="<?php echo (asset('uploads/' . $currentUserData->pic)); ?>" style="width: 100px;height: 100px;border-radius: 50%;background-color: #ccc;border:none">
                        @else
                            <img src="<?php echo(asset('uploads')); ?>/no-image.gif" style="width: 100px;height: 100px;border-radius: 50%;background-color: #ccc;border:none"/>
                        @endif
                        <input type="file" name="pic" id="pic" style="display:none" /><br />
                        <a href="javascript:void(0)" class="btn btn-xsm" onclick="$('#pic').show('slow'); $(this).hide()">Upload</a>
                        <p style="width: 230px;">Square: 500 x 500 recommended</p>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 ">
                        <div class="form-group md-form">
                            <input type="text" name="name" id="name" tabindex="1" value="{{ $currentUserData['name'] }}" required>
                            <label for="name" class="wrap_form_control <?php if ($currentUserData['name'] != '') echo('active'); ?>">First Name</label>
                        </div>
                        @if ($errors->has('name'))
                            <span style="font-size: 12px !important;" class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 ">
                        <div class="form-group md-form">
                            <input type="text" name="last_name" id="last_name" tabindex="2" value="{{ $currentUserData['last_name'] }}" required>
                            <label for="last_name" class="wrap_form_control <?php if ($currentUserData['last_name'] != '') echo('active'); ?>">Last Name</label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 ">
                        <div class="form-group md-form">
                            <input type="password" name="password" id="usr_password" tabindex="3">
                            <label for="usr_password" class="wrap_form_control">Change Password</label>
                        </div>
                        @if ($errors->has('password'))
                            <span style="font-size: 12px !important;" class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 ">
                        <div class="form-group md-form">
                            <input type="password" name="password_confirmation" id="usr_password_confirmation" tabindex="3">
                            <label for="usr_password_confirmation" class="wrap_form_control">Confirm Password</label>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span style="font-size: 12px !important;" class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <button type="submit" class="btn btn-success btn-sm" style="float: right;">Update Person</button>
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <a class="btn btn-success btn-sm" href="#personPidModal" data-toggle="modal" data-target="#personPidModal">Add Person</a>
                    </div>
                </div>
            </form>

            <hr class="colorgraph">
            <div class="row row-thin">
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="form-group">
                        <a href="#addPhoneModal" data-toggle="modal" data-target="#addPhoneModal" style="margin: 10px 0px; float: left;" class="btn btn-success btn-sm">Update Phone Numbers</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="form-group">

                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="form-group">
                        <a href="#addEmailTypeModal" data-toggle="modal" data-target="#addEmailTypeModal" style="margin: 10px 0px;" class="btn btn-success btn-sm">Update E-mail</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="form-group">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <table width="98%" class="gmsSort" id="gsmPhone">
                            <tr>
                                <th>Phone Number</th>
                            </tr>
                            @if(count($phoneData) > 0)
                                @foreach ($phoneData as $phone)
                                    <tr>
                                        <td> {{ $phone['nbr'] }} (<?php echo(ucfirst($phone['type'])); ?>)</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                            @if (count($phoneData) > 1)
                                <a href="javascript:void(0)" id="phone_show_all">Show All</a><a href="javascript:void(0)" style="display:none;" id="phone_show_less">Show Less</a>
                            @endif
                    </div>
                </div>


                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <table width="98%" class="gmsSort" id="gsmEmail">
                            <tr>
                                <th>Email</th>
                            </tr>
                            @if(count($emailData) > 0)
                                @foreach ($emailData as $email)
                                    <tr>
                                        <td> {{ $email['e_addr'] }} ({{ucfirst($email['type'])}})</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                           @if (count($emailData) > 1)
                            <a href="javascript:void(0)" id="email_show_all">Show All</a>
                            <a href="javascript:void(0)" style="display:none;" id="email_show_less">Show Less</a>
                           @endif
                    </div>
                </div>

            </div>

            <hr class="colorgraph1">


        </div>
    </div>

</div>
<!-- START Add Phone Number MODAL  -->
<div id="personPidModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Another Person</h4>
            </div>
            <div class="modal-body" style="padding: 28px;">
                <form id="registerForm" role="form" method="POST" action="{{ url('/registerUserPopup') }}">
                    {!! csrf_field() !!}  
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group md-form">

                            <input class="form-control margin-bottom-20" type="text" name="name" required value="{{ old('name') }}">
                            <label class="wrap_form_control <?php if (old('name') != '') echo('active'); ?>" for="name">First Name*                               
                            </label>
                            @if ($errors->has('name'))
                            <span style="font-size: 12px !important;" class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group md-form">
                            <input class="form-control margin-bottom-20" name="last_name" type="text" required value="{{ old('last_name') }}">
                            <label class="wrap_form_control <?php if (old('last_name') != '') echo('active'); ?>" for="last_name">Last Name*
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group md-form">

                            <input class="form-control margin-bottom-20" type="email" name="email" required value="{{ old('email') }}">
                            <label class="wrap_form_control <?php if (old('email') != '') echo('active'); ?>" for="email"> Email Address*

                            </label>
                            @if ($errors->has('email'))
                            <span style="font-size: 12px !important;" class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>                              
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group md-form">

                            <input id="username" class="form-control margin-bottom-20" type="text" required value="{{ old('username') }}" name="username">
                            <label class="wrap_form_control <?php if (old('username') != '') echo('active'); ?>" for="username">User Name*

                            </label>
                            @if ($errors->has('username'))
                                <span style="font-size: 12px !important;" class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group md-form">

                            <input class="form-control margin-bottom-20" type="password" name="password" id="password" required>
                            <label class="wrap_form_control" for="password"> Password*
                                <a data-tooltip-content="#tooltip_content" href="javascript:void(0)" class="tooltipster">
                                    <img width="20" src='<?php echo url('assets/front'); ?>/images/image.png' />
                                </a>
                            </label>
                            @if ($errors->has('password'))
                                <span style="font-size: 12px !important;" class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <div class="tooltip_templates">
                                <span id="tooltip_content">
                                    <strong>Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br />  - At least one number and one <br /> - Special character such as @#$%</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group md-form">

                            <input class="form-control margin-bottom-20" type="password" id="password_confirmation" name="password_confirmation" required>
                            <label class="wrap_form_control" for="password_confirmation"> Confirm Password*

                            </label>

                            @if ($errors->has('password_confirmation'))
                            <span style="font-size: 12px !important;" class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <input name="CoId" value="{{$currentUserData['cid']}}" type="hidden">
                    <div class="row">

                        <div class="col-xs-6 col-md-6 col-sm-offset-1 col-md-offset-3"><button type="submit" class="btn btn-success btn-block btn-lg">Save</button> 
                            <br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- END Person PID Modal   -->
<!-- START PERSON PID MODAL  -->
<div id="addPhoneModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Phones</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{ url('/savePhone') }}">
                    {!! csrf_field() !!}  
                    <input type="hidden" name="current_user_id" value="{{ $currentUserData['id'] }}" class="currentUserId" />
                    @if (count($phoneData) > 0)
                        <?php $count = 0; ?>
                        @foreach ($phoneData as $phone)
                            <div class="row" id="rowPhone{{ $count }}">
                                <div class="col-xs-12 col-sm-5 col-md-5">
                                    <div class="form-group">
                                        <input type="text" id="phone" name="phone[]" class="form-control input-lg phoneInput" placeholder="Phone Number" tabindex="1" required value="{{ $phone['nbr'] }}"/>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-5 col-md-5">
                                    <div class="form-group">
                                        <select class="input-sm" id="type" name="type[]">
                                            @if ($count == 0) {
                                                <option>Primary</option>
                                            @endif
                                            @if ($count) {
                                                <option  <?php if ($phone->type == 'home') echo ("selected='selected'"); ?>>Home</option>
                                                <option  <?php if ($phone->type == 'work') echo ("selected='selected'"); ?>>Work</option>
                                                <option  <?php if ($phone->type == 'mobile') echo ("selected='selected'"); ?>>Mobile</option>
                                                <option  <?php if ($phone->type == 'other') echo ("selected='selected'"); ?>>Other</option>
                                           @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-2 col-md-2">
                                    <div class="form-group">
                                        @if ($count)
                                            <a href="javascript:void(0)" onclick="$('#rowPhone{{ $count }}').remove()">X</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <?php $count++; ?>
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-xs-12 col-sm-5 col-md-5">
                                <div class="form-group">
                                    <input type="text" id="phone" name="phone[]" class="form-control input-lg phoneInput" placeholder="Phone Number" tabindex="1" required/>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-5 col-md-5">
                                <div class="form-group">
                                    <select class="input-sm" id="type" name="type[]">
                                        <option>Primary</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-2">
                                <div class="form-group">
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row appendLastPhone" id="referencePhoneRow" style="display:none;">
                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                <input type="text" name="phone[]" id="phone" class="form-control input-lg phoneInput" placeholder="Phone Number" tabindex="1" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                <select class="input-sm" id="type" name="type[]">
                                    <option>Home</option>
                                    <option>Work</option>
                                    <option>Mobile</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                            </div>
                        </div>
                    </div>

                    <div class="row">	
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a id="addnewphone" style="float:right;" href="javascript:void(0)" class="btn btn-success btn-sm">
                                Add
                            </a>
                            <br>
                        </div>
                    </div>
                    <div class="row">	
                        <div class="col-xs-4 col-md-4 col-sm-offset-1 col-md-offset-3"><button type="submit" class="btn btn-success btn-block btn-lg">Save</button> 
                            <br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- END Add Phone Number Modal   -->

<!-- START ADD EMAIL TYPE -->
<div id="addEmailTypeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Emails</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{ url('/saveEmail') }}">
                    {!! csrf_field() !!}  
                    <input type="hidden" name="current_user_id" value="{{ $currentUserData['id'] }}" class="currentUserId" />
                    @if(count($emailData) > 0)
                        <?php $count = 0; ?>
                        @foreach ($emailData as $email)
                            <div class="row" id="rowEmail{{ $count }}">
                                <div class="col-xs-12 col-sm-5 col-md-5">
                                    <div class="form-group">
                                        <input type="email" name="email[]" id="email" class="form-control input-lg" placeholder="Add Email" tabindex="1" required value="{{ $email['e_addr'] }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-5 col-md-5">
                                    <div class="form-group">
                                        <select class="input-sm" id="type" name="type[]">
                                            @if ($count == 0)
                                                <option>Primary</option>
                                            @endif
                                            @if ($count)
                                                <!-- <option @if ($email->type == 'paypal') "selected='selected'" @endif; ?>>PayPal</option>-->
                                                <option <?php if ($email->type == 'home') echo ("selected='selected'"); ?>>Home</option>
                                                <option <?php if ($email->type == 'alert') echo ("selected='selected'"); ?>>Alert</option>
                                                <option <?php if ($email->type == 'work') echo ("selected='selected'"); ?>>Work</option>
                                                <option <?php if ($email->type == 'other') echo ("selected='selected'"); ?>>Other</option>
                                           @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-2 col-md-2">
                                    <div class="form-group">
                                        @if($count)
                                            <a href="javascript:void(0)" onclick="$('#rowEmail{{ $count }}').remove()">X</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                <?php $count++;?>
                        @endforeach
                    @endif
                    <div class="row appendLast" id="referenceEmailRow" style="display:none;">
                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                <input type="email" name="email[]" id="email" class="form-control input-lg" placeholder="Add Email" tabindex="1">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                <select class="input-sm" id="type" name="type[]">
                                    <option>Home</option>
                                    <option>Alert</option>
                                    <option>Work</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12"><a style="float:right;" href="javascript:void(0)" class="btn btn-success btn-sm" onclick="$('#referenceEmailRow').clone().insertAfter('.appendLast:last').show();">Add</a>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-md-4 col-sm-offset-1 col-md-offset-3"><button type="submit" class="btn btn-success btn-block btn-lg">Save</button>
                            <br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- END ADD EMAIL TYPE -->

<style type="text/css">
    .md-form label
    {
        font-size: .9rem !important;
    }
    th{
        font-weight:bold;
    }
    .error, .help-block {
        font-size: 12px !important;
    }
    label.error {
        font-size: 12px !important;
        font-weight: 300 !important
    }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>

<script>

    jQuery(window).load(function()
    {
        var phones = [{ "mask": "(###) ###-####"}, { "mask": "(###) ###-####"}];
        $('.phoneInput').inputmask({
            mask: phones,
            greedy: false,
            definitions: { '#': { validator: "[0-9]", cardinality: 1}}
        });
    });
    $(document).ready(function(){
        $('#addnewphone').click(function() {
            $('#referencePhoneRow').clone().insertAfter('.appendLastPhone:last').show();
            var phones = [{ "mask": "(###) ###-####"}, { "mask": "(###) ###-####"}];
            $('.phoneInput').inputmask({
                mask: phones,
                greedy: false,
                definitions: { '#': { validator: "[0-9]", cardinality: 1}}
            });
        });
        $.validator.addMethod(
            "passwordCheck",
            function(value, element, regexp) {
            var check = false;
            return this.optional(element) || regexp.test(value);
            },
            'Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br /> - At least one number and one <br /> - Special character such as @#$%'
        );
        $("#updateUserFormProfile").validate({
            rules: {
                name:{
                    required: true,
                    minlength: 3
                },
                password: {
                    minlength: 8,
                    passwordCheck: /^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+=.!"'()*,-/:;<+>?\_|~]).*$/
                },
                password_confirmation: {
                    minlength: 8,
                    equalTo: "#usr_password",
                    passwordCheck: /^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+=.!"'()*,-/:;<+>?\_|~]).*$/
                }
            },
            messages: {
                name: {
                    passwordCheck:  'Username should be at least 3 characters',
                    minlength: 'Username should be at least 3 characters'
                },
                password: {
                    passwordCheck:  'Use a minimum of 8 characters with:- Both upper case and lower case letters- At least one number and one- Special character such as @#$%',
                    minlength: 'Use a minimum of 8 characters with:- Both upper case and lower case letters- At least one number and one- Special character such as @#$%',
                },
                password_confirmation: {
                    passwordCheck:  'Use a minimum of 8 characters with:- Both upper case and lower case letters- At least one number and one- Special character such as @#$%',
                    minlength: 'Use a minimum of 8 characters with:- Both upper case and lower case letters- At least one number and one- Special character such as @#$%',
                    equalTo: "Password doesn't match."
                }
            }
        });

        $("#registerForm").validate({
            rules: {
                username:{
                    required: true,
                    minlength: 3
                },
                password: {
                    required: true,
                    minlength: 8,
                    passwordCheck: /^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+=]).*$/
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password",
                    passwordCheck: /^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+=]).*$/
                }
            },
            messages: {
                username: {
                    passwordCheck:  'Username should be at least 3 characters',
                    minlength: 'Username should be at least 3 characters',
                },
                password: {
                    passwordCheck:  'Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br /> - At least one number and one <br /> - Special character such as @#$%',
                    minlength: 'Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br /> - At least one number and one <br /> - Special character such as @#$%',
                },
                password_confirmation: {
                    passwordCheck:  'Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br /> - At least one number and one <br /> - Special character such as @#$%',
                    minlength: 'Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br /> - At least one number and one <br /> - Special character such as @#$%',
                    equalTo: "Password doesn't match."
                },
            }
        });
    });
</script>
@endsection
