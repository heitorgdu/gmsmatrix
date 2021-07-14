@extends('layouts.frontapp')

@section('content')

<div id="content">
    <div class="container background-white">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @include('common.errors')
                </div>
            </div>
            <div class="row margin-vert-30">
                <!-- Login Box -->
                <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                    <form class="login-page" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                        <div class="login-header margin-bottom-30">
                            <h2 style="margin: 40px auto; text-align: center; color: #197aa4; font-weight: normal;">Login</h2>
                        </div>
                        <div class="form-group md-form">


                            <input id="email" name="username" type="text" required>
                            <label for="email" class="wrap_form_control"> User Name* </label>
                            @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group md-form">


                            <input type="password" id="password" name="password" required>
                            <label for="password" class="wrap_form_control"> Password* </label>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-sm-offset-2 col-md-4">
                                <button class="btn btn-success btn-block btn-lg">Login</button> 
                            </div>
                        </div>
                        <hr>
                        <h4>Forgot Your Password ?</h4>
                        <p>
                            <a href="{{ url('/password/reset') }}">Click here </a> to reset your password.</p>
                    </form>
                </div>
                <!-- End Login Box -->
            </div>
        </div>
    </div>
</div>

<style>
    .error, .help-block {
        font-size: 12px !important;
    }
    label.error {
        font-size: 12px !important;
        font-weight: 300 !important
    }
</style>

@endsection
