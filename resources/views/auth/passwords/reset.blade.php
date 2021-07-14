@extends('layouts.frontapp')

@section('content')
<style>
    .error{
        margin-top: 45px;
    }
</style>
<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form id="restPasswordForm" class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}" onsubmit="return validateCaptcha()">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="md-form form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-10 col-md-offset-1">
                                <input type="email" readonly class="form-control" name="email" value="{{ $email or old('email') }}">
	                            <!-- <label class="wrap_form_control">E-Mail Address</label>
 -->                                @if ($errors->has('email'))
                                    <span style="font-size: 12px !important;" class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="md-form form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                           

                            <div class="col-md-10 col-md-offset-1">
                                <input type="password" class="form-control" id="password" name="password">
								 <label class="wrap_form_control">Password</label>
                                @if ($errors->has('password'))
                                    <span style="font-size: 12px !important;" class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="md-form form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" style="margin-top: 90px;">
                            <div class="col-md-10 col-md-offset-1">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            <label class="wrap_form_control">Confirm Password</label>

                                @if ($errors->has('password_confirmation'))
                                    <span style="font-size: 12px !important;" class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-8">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i>Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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

<script>
    function validateCaptcha(){
        var response = grecaptcha.getResponse();
        if (!response.length) {
            $('#cp_bx').show("slow");
            return false;
        }
        return true;
    }
    $(document).ready(function(){
        $.validator.addMethod(
            "passwordCheck",
            function(value, element, regexp) {
                var check = false;
                return this.optional(element) || regexp.test(value);
            },
            'Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br /> - At least one number and one <br /> - Special character such as @#$%'
        );

    $("#restPasswordForm").validate({
        rules: {
            username:{
                required: true,
                minlength: 3
            },
            password: {
                required: true,
                minlength: 8,
                passwordCheck: /^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+=.!"'()*,-/:;<+>?\_|~]).*$/
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#password",
                passwordCheck: /^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+=.!"'()*,-/:;<+>?\_|~]).*$/
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


