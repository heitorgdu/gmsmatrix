@extends('layouts.frontapp')

@section('content')
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

    <link rel="stylesheet" type="text/css" href="<?php echo url('assets/front'); ?>/stylesheets/compiled.min.css">
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <div class="container">

        <div style=" margin-top:20px;">
            <div class="col-xs-1 col-sm-1 col-md-1"></div>
            <div class="col-xs-10 col-sm-10 col-md-10">
                <ul class="nav nav-tabs">
                    <li class="<?php if(\Request::is('profile/*')) echo ("active");  elseif(\Request::is('profile')) echo ("active");?>" role="presentation">
                        <a href="@if($id == null){{url('/profile')}}@else{{url('/profile/'.$id)}}@endif">Company</a>
                    </li>
                    <li class="<?php if (\Request::is('person/*')) echo ("active"); elseif(\Request::is('person')) echo ("active");?>" role="presentation">
                        <a href="@if($id == null){{url('/person')}}@else{{url('/person/'.$id)}}@endif">Personal</a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1"></div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-10 col-sm-offset-1 col-md-offset-1">
                <input type="hidden" name="current_user_id" value="{{ $current_user_id }}" class="currentUserId"/>
                <hr class="colorgraph">
                <div class="row">
                    <div class="col-sm-12">
                        @include('common.errors')
                    </div>
                </div>
                @if(isset($cmpTechData))
                    <form id="forNewWind" name="form1" role="form" method="POST" action="{{ url('/saveTechInfo') }}/{{ $companyDetails['cid'] }}/{{ $cmpTechData->tcid }}" enctype="multipart/form-data">
                @else
                    <form id="forNewWind"  name="form1" role="form" method="POST" action="{{ url('/saveTechInfo') }}/{{ $companyDetails['cid'] }}/{{ $companyDetails['cid'] }}" enctype="multipart/form-data">
                @endif
                    {!! csrf_field() !!}
                    <input type="hidden" name="current_user_id" value="{{ $current_user_id }}" class="currentUserId" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="form-group md-form">
                                                <input class="form-control input-lg" type="text" name="company_name" id="company_name"  tabindex="1" value="{{ $companyDetails['name'] }}" required=false>
                                                <label for="company_name" class="wrap_form_control @if($companyDetails['name']!='') active @endif">Company Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label for="contact_person"> Contact Person </label>
                                                <input type="hidden" id="contact_email" name="contact_email" value="{{ $currentUserData['email'] }}"/>
                                                <input type="hidden" id="contact_phone" name="contact_phone" value="{{$phone['nbr']}}"/>
                                                <input type="hidden" id="company_loc_first" name="company_loc_first" value="{{$primaryLoc['city']}}"/>
                                                <input type="hidden" id="contact_pic" name="contact_pic" value="{{ $currentUserData['pic'] }}"/>
                                                <select class="input-sm" id="contact_person" name="contact_person">
                                                    @foreach ($companyUsers as $users)
                                                        <option value="{{ $users->id }}" @if($users->id == $companyDetails['contact']) selected='selected' @endif>
                                                            {{ $users->name }} {{ $users->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($companyDetails['type']=='t')
                         <div class="row">
                            <div class="col-xs-12 col-sm-3 col-md-3 ">
                                <div class="form-group md-form">
                                    <input type="text" name="url" id="url"  tabindex="1" value="{{  $cmpTechData->url }}">
                                    <label for="url" class="wrap_form_control @if($cmpTechData->url!='') active @endif">Website url</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-2 col-md-2">
                                <div class="form-group md-form">
                                    <input type="text" name="since" id="since" tabindex="1" value="{{  $cmpTechData->since }}">
                                    <label for="since" class="wrap_form_control @if($cmpTechData->since!='') active @endif">Years in business</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-3 col-md-3">
                                <div class="form-group md-form">
                                    <input type="password" name="tax_id" id="tax_id" tabindex="2" value="{{  $cmpTechData->tax_id }}">
                                    <label for="tax_id" class="wrap_form_control @if($cmpTechData->tax_id!='') active @endif">Tax ID #</label>
                                    @if ($cmpTechData->tax_id!='')
                                        <a class="btn btn-xsm" href="javascript:void(0)" id="tax_mask_show">Show</a>
                                    @else
                                        <a class="btn btn-xsm" href="javascript:void(0)" id="tax_mask_show" style="display:none;">Show</a>
                                    @endif
                                    <a class="btn btn-xsm" href="javascript:void(0)" style="display:none;" id="tax_mask_hide">Hide</a>
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-4 col-md-4 ">
                                 @if (!is_null($cmpTechData['tax_id_image']))
                                    <label for="" class="wrap_form_control_tax">Tax Certificate</label>
                                    <a class="btn btn-xsm" target="_blank" href="<?php echo(asset('uploads/'.$cmpTechData['tax_id_image'])); ?>" style="float:left">View</a>
                                 @endif
                                 <div class="input-group">
                                    <input type="file" id="tax_id_image" name="tax_id_image" style="display:none" />
                                    @if (!is_null($cmpTechData['logo']))
                                        &nbsp;&nbsp;<a href="javascript:void(0)" class="btn btn-xsm" onclick="$('#tax_id_image').show('slow');$(this).hide()" style="float:right">Upload/Change Tax Certificate</a>
                                    @else
                                         &nbsp;&nbsp;<a href="javascript:void(0)" class="btn btn-xsm" onclick="$('#tax_id_image').show('slow');$(this).hide()" style="float:right">Upload/Change Tax Certificate</a>
                                    @endif
                                 </div>
                              </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                @if (!is_null($cmpTechData['logo']))
                                    <img src="<?php echo (asset('uploads/'.$cmpTechData['logo'])); ?>" style="height: 35px;border:none">
                                @endif
                                <div class="input-group">
                                 <input type="hidden" id="logo_hidden" name="logo_hidden" value="{{ $cmpTechData['logo'] }}"/>
                                    <input type="file" id="logoComp" name="logo" style="display:none" />
                                    @if (!is_null($cmpTechData['logo']))
                                        &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="btn btn-xsm" onclick="$('#logoComp').show('slow');$(this).hide()">Update Logo</a>
                                    @else
                                        &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="btn btn-xsm" onclick="$('#logoComp').show('slow');$(this).hide()">Add Logo</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input id="repair" type="checkbox" name="store" value="1" <?php if($cmpTechData->store==1){ ?>checked='checked'<?php } ?> ><label for="repair"> Repair Center</label>
                                    <input id="service" type="checkbox" name="on_site" value="1" <?php if($cmpTechData->on_site==1){ ?>checked='checked'<?php } ?> > <label for="service"> On-Site Service</label>
                                    <input id="remote" type="checkbox" name="remote" value="1" <?php if($cmpTechData->remote==1){ ?>checked='checked'<?php } ?> ><label for="remote"> Remote Assistance</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <br>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 ">
                                <div class="form-group md-form">
                                Unique Selling Position / Slogan
                                <br />
                                    <textarea style="resize: none;" id="usp" name="usp" rows="2" cols="60" class="form-control input-lg md-textarea">{{  $cmpTechData->usp }}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 ">
                                <div class="form-group md-form">
                                Promote your company here:<br />
                                    <textarea id="description" name="description" rows="2" cols="60"  class="form-control input-lg md-textarea">{{  $cmpTechData->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <script>

                            CKEDITOR.config.toolbar = [
                               ['Styles','Format','Font','FontSize'],
                               '/',
                               ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
                               '/',
                               ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                               ['Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
                            ] ;
                            CKEDITOR.replace( 'usp');
                            CKEDITOR.replace( 'description');
                        </script>
                    @endif
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <button type="submit" name="submitForm" class="btn btn-success btn-block btn-lg" style="width: 150px; height: 40px; line-height: 19px; margin: 0px auto; float: right; margin: 10px 0px;">Update</button>
                            <br>
                        </div>
                        @if($companyDetails['type']=='t')
                            <div class="col-xs-6 col-md-6">
                                <button {{--onclick="gmsPreview()" type="button" --}} onclick="gmsPreview(event)" type="button" name="Previewbtn" class="btn btn-success btn-block btn-lg" style="width: 150px; height: 40px; line-height: 19px; margin: 0px auto; float: left; margin: 10px 0px;">Preview</button>
                                <br>
                            </div>
                        @endif
                    </div>
                </form>
                <hr class="colorgraph">
                <div class="row margin-bottom-20">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group" id="gsmLocation">
                            @if (count($locationData)>0)
                                @foreach ($locationData as $location)
                                    <div class="mainDiv col-sm-12 col-md-12" style="margin-bottom: 5px;">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            {{ $location->name }}, {{ $location->addr1 }}, {{ $location->addr2 }}, {{ $location->city }}, {{ $location->st }}, {{ $location->postal }}, {{ $location->cntry }}
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <a href="#addLocationModal{{ $location->lid }}" data-toggle="modal" data-target="#addLocationModal{{ $location->lid }}"  class="btn btn-xsm">
                                                Edit
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-xsm" onclick="removeLocation({{ $location->lid }})">Delete</a>
                                            <div id="addLocationModal{{ $location->lid }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Edit Location</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form role="form" method="POST" action="{{ url('/editLocation') }}/{{ $location->lid }}">
                                                                {!! csrf_field() !!}
                                                                <input type="hidden" name="current_user_id" value="{{ $current_user_id }}" class="currentUserId" />

                                                                <div class="row">
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <div class="form-group">
                                                                            <input type="text" name="name" id="name" class="form-control input-lg" placeholder="Name Home Office" tabindex="1" required value="{{ $location->name }}" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <div class="form-group">
                                                                            <input type="text" name="addr1" id="addr1" class="form-control input-lg" placeholder="Street" tabindex="1" required value="{{ $location->addr1 }}" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <div class="form-group">
                                                                            <input type="text" name="addr2" id="addr2" class="form-control input-lg" placeholder="Suite/Apt" tabindex="1" value="{{ $location->addr2 }}" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <div class="form-group">
                                                                            <input type="text" name="city" id="city" class="form-control input-lg" placeholder="City" tabindex="1" required value="{{ $location->city }}" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <div class="form-group">
                                                                            <input type="text" name="st" id="st" class="form-control input-lg" placeholder="State" tabindex="1" required value="{{ $location->st }}" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <div class="form-group">
                                                                            <input type="text" name="postal" id="postal" class="form-control input-lg" placeholder="Zip" tabindex="1" required value="{{ $location->postal }}" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <div class="form-group">
                                                                            <input type="text" name="cntry" id="cntry" class="form-control input-lg" placeholder="Country" tabindex="1" required value="{{ $location->cntry }}" />
                                                                        </div>
                                                                        </div>

                                                                    <div class="col-xs-6 col-md-6 col-sm-offset-1 col-md-offset-3">
                                                                        <button type="submit" class="btn btn-success btn-block btn-lg">Update</button>
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer"></div>
                                                 </div>

                                            </div>
                                         </div>
                                    </div>
                                @endforeach
                             @endif
                        </div>
                        @if (count($locationData)>1)
                            <a href="javascript:void(0)" id="location_show_all">Show All</a><a href="javascript:void(0)" style="display:none;" id="location_show_less">Show Less</a>
                        @endif
                    </div>
                </div>

                <div class="row margin-bottom-20">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="#addLocationModal" data-toggle="modal" data-target="#addLocationModal" style="margin: 10px 0px; float: left;">
                            <button class="button_popup">Add New Location</button></a>
                    </div>
                </div>
                <hr class="colorgraph">
            </div>

        </div>
    </div>

        <!-- START Location MODAL  -->
    <div id="addLocationModal" class="modal fade" role="dialog">
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
                        <input type="hidden" name="current_user_id" value="{{ $current_user_id }}" class="currentUserId" />

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
                                    <input type="text" name="cntry" id="cntry" class="form-control input-lg" value="US" placeholder="Country" tabindex="1" required />
                                </div>
                            </div>

                            <input type="hidden" name="coId" value="{{$companyDetails['cid']}}">

                            <div class="col-xs-6 col-md-6 col-sm-offset-1 col-md-offset-3">
                                <button type="submit" class="btn btn-success btn-block btn-lg">Save</button>
                                <br>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
    <!-- END Add Location Modal   -->
    <!-- START Add Phone Number MODAL  -->

    <style>
        th{
            font-weight:bold;
            text-align: center;
        }
        td {
            padding-bottom: 10px;
        }
        /*[type="checkbox"]:checked, [type="checkbox"]:not(:checked) {
            position: unset;
            left: -9999px;
            visibility: visible;
        }*/
        [type="checkbox"] + label, [type="radio"]:checked + label, [type="radio"]:not(:checked) + label{
            padding-left: 22px;
            line-height: 21px;
            padding-right: 12px;
            font-size: 12px;
        }
        select, textarea, input[type=text], input[type=password], input[type=datetime], input[type=datetime-local], input[type=date], input[type=month], input[type=time], input[type=week], input[type=number], input[type=email], input[type=url], input[type=search], input[type=tel], input[type=color]
        {
            margin-bottom: 10px;
        }
    </style>

    <script>
        jQuery(document).ready(function ($) {
            $('#contact_person').change(function() {
                var idNeeded = $("#contact_person").val();
                $.ajax({
                    type: 'GET',
                    url: "/user/" + idNeeded,
                    success: function (data) {
                        $('#contact_pic').val(data.pic);
                        $('#contact_email').val(data.email);
                        $('#contact_phone').val(data.phone.nbr);
                    }
                });
            });

        });

        function newWindCall() {
            var width = window.innerWidth * .8 ;
            // define the height in
            var height = width * window.innerHeight / window.innerWidth ;

            var left = (screen.width/2)-(width/2);
            var top = (screen.height/2)-(height/2);
            document.form1.target = "myActionWin";
            window.open("","myActionWin",'width='+width+', height='+height+', top='+top+',left='+left);
            document.form1.submit();

        }
        function removeLocation(locationId){
            if (confirm("Are you sure you want to delete this location?") )
            {
                window.location = "{{ url('removeLocation') }}/"+locationId;
            }
        }
        function gmsPreview(e)
        {
            var width = window.innerWidth * .8 ;
            // define the height in
            var height = width * window.innerHeight / window.innerWidth ;

            var repair=0,service=0,remote=0;
            if ($('#repair').is(':checked'))
            {
                repair=1;
            }

            if ($('#service').is(':checked'))
            {
                service=1;
            }

            if ($('#remote').is(':checked'))
            {
                remote=1;
            }
            var left = (screen.width/2)-(width/2);
            var top = (screen.height/2)-(height/2);

            var params= 'company_name='+$('#company_name').val()+"&";
            params += 'usp='+$('#usp').val()+"&";
            if ($('#contact_email').val() != '' )
            {
                params += 'email='+$('#contact_email').val()+"&";
            }
            if ($('#contact_phone').val() != '' )
            {
                params += 'phone='+$('#contact_phone').val()+"&";
            }
            if ($('#company_loc_first').val() != '' )
            {
                params += 'city='+$('#company_loc_first').val()+"&";
            }

            if ($('#logo_hidden').val() != '' )
            {
                params += 'logo_hidden='+$('#logo_hidden').val()+"&";
            }

            params += 'repair='+repair+"&";
            params += 'remote='+remote+"&";
            params += 'service='+service+"&";
            params += 'since='+$('#since').val()+"&";
            params += 'url='+encodeURIComponent($('#url').val())+"&";
            params += 'description='+$('#description').val()+"&";


            if( $('#contact_pic').val() != '')
            {
                params += 'contact_pic='+$('#contact_pic').val()+"&";
            }
            params += 'fname='+$("#contact_person :selected").text();
            params = encodeURI(params);
            window.open('{{ url("techPreview") }}?'+params,'GMS','width='+width+', height='+height+', top='+top+',left='+left);
        }

    </script>

@endsection
