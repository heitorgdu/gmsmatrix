
<div style="margin-top: 20px">
    <h6 style="display: inline;">MTS Tech:       </h6>
    <span>{{$user['name']}}  {{$user['last_name']}} @if(isset($user['emailPrimary'])) . <a href="mailto:{!! $user['emailPrimary']->e_addr !!}">{{$user['emailPrimary']->e_addr}}</a>@endif  @if(isset($user['phone'])) . {{$user['phone']->nbr}}@endif</span>
</div>
