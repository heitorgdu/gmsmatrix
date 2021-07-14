@extends('layouts.frontapp')

@section('content')
 <!-- Page Content -->

    <div class="container">




        <div class="row" style="margin-bottom: 10px;">
            <!-- Blog Search Well -->
            <div class="col-md-12">
                <div class="col-md-6">
                </div>
                <div class="col-md-6" id="liListing">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6" style="margin-top: 10px;">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg)}}  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-12" style="margin-top: 30px;">
            <div class="col-md-10">
            </div>
            <div class="input-group col-md-2">
                <a class="btn btn-success" id="createBtnT" type="button" style="margin-top: 40px;display: none">
                    Choose this Tech<br />
                    Create Free Account
                </a>
            </div>

        </div>

        <!-- Middle row -->
        <div id="letseeAppend" style="display: none;margin-top: 20px;">
            @include('common.techpreview')
        </div>

    </div>
    <!-- /.row -->
    <input id="pathTillAssets" type="hidden" value="{{(asset('uploads/'))}}">
    <input id="pathTillUrl" type="hidden" value="{{(url('/'))}}">
    <input id="front" type="hidden" value="{{(url('assets/front'))}}">

    <!-- /.container -->

<style>
    li {
        padding: 5px;
    }

</style>
<script>
    function windCall(param) {
        var html = '';
        var width = window.innerWidth * .8 ;
        // define the height in
        var height = width * window.innerHeight / window.innerWidth ;
        var left = (screen.width/2)-(width/2);
        var top = (screen.height/2)-(height/2);
        var path = $('#pathTillUrl').val();
        var uploads = $('#pathTillAssets').val();
        var front = $('#front').val();

        $.ajax({
            type: 'GET',
            url: "/company/"+param,
            success: function (data) {
                $('#letseeAppend').attr('style', 'display:none');
                if (data.logo_hidden != '') {
                    $('#techLogoPreview').attr('src', uploads+'/'+data.logo_hidden);
                    $('#techLogoPreview').css('max-width', '35%');
                }else {
                    $('#techLogoPreview').css('display', 'none');
                }

                var cname = $('#compNamePreview');
                cname.text(data.company_name);
                cname.css('height', '35px');
                cname.css('font-weight', 'normal');
                $('#uspPreview').empty().append(data.usp);
                $('#dontShow').css('display', 'none');
                $('#dontShowR').css('display', 'none');
                $('#dontShowS').css('display', 'none');

                if (data.contact_pic != '') {
                    $('#contactPicPreview').attr('src', uploads+'/'+data.contact_pic);
                }else {
                    $('#contactPicPreview').attr('src', uploads+'/no-image.gif');
                }
                if(data.repair == '0') {
                    $('#repairPreview').attr('src', front+'/images/redCheckbox18px.png');
                } else {
                    $('#repairPreview').attr('src', front+'/images/greenCheckmark20px.png');
                }
                if(data.remote == '0') {
                    $('#remotePreview').attr('src', front+'/images/redCheckbox18px.png');
                } else {
                    $('#remotePreview').attr('src', front+'/images/greenCheckmark20px.png');
                }
                if(data.service == '0') {
                    $('#servicePreview').attr('src', front+'/images/redCheckbox18px.png');
                } else {
                    $('#servicePreview').attr('src', front+'/images/greenCheckmark20px.png');
                }
                if(data.since != ""){
                    $('#sincePreview').text(data.since + '  years in business');
                }
                $('#techUserName').text(data.fname);
                $('#locationPreview').text(data.city);
                $('#phonePreview').text(data.phone);
                $('#emailPreview').attr('href', 'mailto:'+data.email);
                $('#webPreview').attr('href', 'http://'+data.url);
                $('#descPreview').empty().append(data.description);
                $('#letseeAppend').attr('style', 'display:block');
                var givenId = $('#createBtnT');
                givenId.attr('href', path+'/registration?tcid='+param);
                givenId.attr('style', 'display:block');

            }
        });
        $("#liListing").attr('style', 'display:none');
//        window.open(path+'/company/'+param,'width='+width+', height='+height+', top='+top+',left='+left);
    }

    function pressSmallWind()
    {
        callEveryTime('small');
        $('.overlay').fadeOut(250);
        $('#menu_collapse').removeClass('in');
        $('#menu_collapse').addClass('out');

    }

    function keyUpSmall(e)
    {
        if(e.keyCode  == 13) {
            callEveryTime('small');
            $('.overlay').fadeOut(250);
            $('#menu_collapse').removeClass('in');
            $('#menu_collapse').addClass('out');
        }

    }


    function callEveryTime(size){
        var ids = '';
        var liId =  $('#liListing');
        $('#letseeAppend').attr('style', 'display:none');
        $('#createBtnT').attr('style', 'display:none');
        if (size == 'small') {
            var givenId = $('#postalCodeSearch1').val();
            var countryId = $('#countryCode1').val();
        } else {
            var givenId = $('#postalCodeSearch').val();
            var countryId = $('#countryCode').val();
        }


        if ((givenId != '') || (givenId != ' ')) {
            $.ajax({
                type: 'POST',
                url: "/search/postal",
                data: {
                    'postalCode': givenId,
                    'countryCode': countryId
                },
                success: function (result) {
                    var path = $('#pathTillAssets').val();
                    var ul = '<ul style="margin-left: 0px">';
                    console.log(result);
                    if (result == 1) {
                        ul = ul + '<li style="list-style: none !important;">';
                        ul = ul + 'Invalid Postal Code or Country Code';
                        ul = ul + '</li>';
                        liId.attr('style', 'border: 1px solid red;');
                    } else if(result == 2){
                        ul = ul + '<li style="list-style: none !important;">';
                        ul = ul + 'No nearest location found in system';
                        ul = ul + '</li>';
                        liId.attr('style', 'border: 1px solid #ebebeb;');
                    } else {
                        $.each(result, function( index, value ) {
                            if(value.company != null) {
                                ids = value.company.cid;
                                ul = ul + '<a id="'+ids+'" onclick="windCall(this.id)">';
                                ul = ul + '<li style="list-style: none !important;">';
                                if(value.user != null) {
                                    console.log(value.user.pic);
                                    if (value.user.pic != "") {
                                        ul = ul + '<img src="'+path+'/'+value.user.pic+'" data-attr-data="sff" style="width: 35px;height: 35px;border-radius: 50%;background-color: #ccc;border:none">';
                                    } else {
                                        ul = ul + '<img src="'+path+'/no-image.gif" style="width: 35px;height: 35px;border-radius: 50%;background-color: #ccc;border:none">';
                                    }
                                    ul = ul + '<span style="margin-left: 5px">'+ value.user.name +'</span>';
                                } else {
                                    ul = ul + '<img src="<?php echo(asset('uploads')); ?>/no-image.gif" style="width: 35px;height: 35px;border-radius: 50%;background-color: #ccc;border:none">';
                                    ul = ul + '<span style="margin-left: 5px">No name</span>';
                                }


                                if((value.tech != null)) {
                                    if((value.tech.logo != "")) {
                                        ul = ul + '<img src="'+path+'/'+value.tech.logo+'" style="height: 35px;border:none;margin-left: 5px">';
                                    }
                                }
                                ul = ul + '<span style="margin-left: 5px">'+ value.company.name +'</span>';
                                ul = ul + '<span style="margin-left: 5px">'+ value.locs.city +'</span>';
                                ul = ul + '<span style="margin-left: 5px">'+ value.locs.st +'</span>';
                                ul = ul + '</li>';
                                ul = ul + '</a>';
                            }

                        });
                        ul = ul + '</ul>';
                        liId.attr('style', 'border: 1px solid #ebebeb;');
                    }

                    liId.empty().append(ul);
                }
            });
        }
    }
    jQuery(document).ready(function ($) {

        var postalId =  $('#postalCodeBtn');
        postalId.click(function () {
            callEveryTime('normal');
        });
        $('#postalCodeSearch').keyup(function (e) {
            if(e.keyCode  == 13) {
                callEveryTime('normal');
            }
        });
    });

</script>
@endsection