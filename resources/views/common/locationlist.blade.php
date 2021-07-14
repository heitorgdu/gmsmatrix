<div class="col-xs-12 col-sm-6 col-md-6">
    <h4 style="margin-top: 20px">Service Matrix for {{$company['name']}} -</h4>
    <h5 style="margin-left: 100px;font-size: 15px;">Renewal Date:   {{$company['expires']}}</h5>
    <hr class="colorgraph">
    <div class="form-group">
        <div class="table-responsive">
            <table width="100%" class="table table-hover">
                <thead>
                <tr>
                    <th>SID</th>
                    <th>Device Name</th>
                    <th>Service</th>
                </tr>
                </thead>
                <tbody id="locUpdated">
                @if(isset($available))
                    <tr>
                        <th class="text-left" colspan="1">Available Subscriptions -</th>
                        <th class="text-left" colspan="2"></th>
                    </tr>
                    @if($available != null)
                        @foreach($available as $sub)
                        <tr class="text-center" id="availableSo{{$sub->sid}}">
                            <td>{{$sub->sid}}</td>
                            <td>{{$sub->device}}</td>
                            <td>{{$sub->service->name}}<?php echo " "; ?> {{$sub->service->type}}</td>
                        </tr>
                        @endforeach
                    @endif
                @endif
                @if($locations != null)
                    @foreach($locations as $index => $location)
                        <tr>
                            <th class="text-left" colspan="1">{{$location->name}}</th>
                            <th class="text-center" colspan="2"></th>
                        </tr>
                        @if(($location->sub) != null)
                            @foreach($location->sub as $sub)
                                <tr class="text-center" id="locationTr{{$location->lid}}">
                                    <td>{{$sub->sid}}</td>
                                    <td>{{$sub->device}}</td>
                                    <td>{{$sub->service->name}}<?php echo " "; ?> {{$sub->service->type}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center" id="locationTr{{$location->lid}}" style="display: none">
                                <td>a</td>
                                <td>b</td>
                                <td>a<?php echo " "; ?> b</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr class="text-center">
                        <td colspan="3" class="text-center">No Information Found</td>
                    </tr>
                @endif
                </tbody>
                <tfoot>

                </tfoot>

            </table>
        </div>
    </div>
</div>