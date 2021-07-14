@extends('layouts.frontapp')

@section('content')
        <!-- Page Content  landingPage -->

<div class="container">

    @if($IfAdmin == 1)
        <div style=" margin-top:20px;">
            <div class="col-xs-1 col-sm-1 col-md-1"></div>
            <div class="col-xs-10 col-sm-10 col-md-10">
                <ul class="nav nav-tabs">
                    <li class="@if (\Request::is('report/tech')) active @elseif(\Request::is('report/tech/*')) active @endif" role="presentation"><a href="{{url('/report/tech')}}">Tech Report</a></li>
                </ul>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1"></div>
        </div>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h2 style="margin-top: 20px">Tech Report for {{$company['name']}}</h2>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <form role="form" method="POST" action="{{ url('/save/techrpt') }}">
                <input name="techs" value="{{$total_Co}}" type="hidden">
                <input name="client" value="{{$total_client}}" type="hidden">
                <input name="device" value="{{$total_device}}" type="hidden">
                <button type="submit" class="btn btn-success pull-left">Save Report</button>
            </form>
            <button id="showTechReportSummary" class="btn btn-success pull-right">View Summary</button>
        </div>

        <div class="col-xs-1 col-sm-1 col-md-1"></div>
        <div class="col-xs-12 col-sm-12 col-md-10">
            <hr class="colorgraph">
            @if($IfAdmin == 1)
                <div class="form-group">
                    <div class="table-responsive">
                        <table width="100%" class="table table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <a href="@if($type != 'asc'){{url('/tech/name/asc')}}@else {{url('/report/tech')}} @endif">
                                        Name
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="@if($type != 'asc'){{url('/tech/users/asc')}}@else {{url('/tech/users')}} @endif">
                                        Person
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="@if($type != 'asc'){{url('/tech/email/asc')}}@else {{url('/tech/email')}} @endif">
                                        Email
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="@if($type != 'asc'){{url('/tech/phone/asc')}}@else {{url('/tech/phone')}} @endif">
                                        Phone
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="@if($type != 'asc'){{url('/tech/client/asc')}}@else {{url('/tech/client')}} @endif">
                                        Clients / Devices
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
                                            <td><a href="{{url('/report/client')."/".$tech['cid']}}">{{$tech['name']}}</a></td>
                                        @else
                                            <td><a href="{{url('/report/client')."/".$tech['cid']}}">Business Name</a></td>
                                        @endif
                                        <td>{{$tech->personDet['name']}}<?php echo " "; ?>{{$tech->personDet['last_name']}}</td>
                                        <td>{{$tech->emailDet['e_addr']}}</td>
                                        <td>{{$tech->phoneDet['nbr']}}</td>
                                        <td class="text-center">{{$tech->clientCount}} / {{$tech->deviceDet}}</td>
                                    </tr>
                                @endforeach
                                {{ $techs->links() }}

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

<div id="techReportSummary" class="modal fade" role="dialog" style="margin-top: 50px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Summary</h4>
            </div>
            <div class="modal-body">
                <p>Tech Partners: <span style="font-weight:normal;">{{$total_Co}}</span></p>
                <p>MTS Clients: <span style="font-weight:normal;">{{$total_client}}</span> </p>
                <p>MTS Devices: <span style="font-weight:normal;">{{$total_device}}</span> </p>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<style>
    th{
        font-weight:bold;
        color: black;
    }
    th a{
        color: black;
    }
    td {
        padding-bottom: 10px;
    }
    p{
        font-weight:bold;
    }
</style>
<script>
    jQuery(document).ready(function ($) {
        $('#showTechReportSummary').click(function (){
            $('#techReportSummary').modal('show');
        });
    });

</script>
@endsection