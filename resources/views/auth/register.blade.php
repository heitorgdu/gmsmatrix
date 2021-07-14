@extends('layouts.frontapp')

@section('content')
         
                   <!-- === BEGIN CONTENT === -->
        <div id="content">
            <div class="container background-white">
                <div class="row margin-vert-30">
                    <!-- Register Box -->
                    <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
        <form id="registerForm" class="signup-page margin-top-20" role="form" method="POST" action="{{ url('/registerUser') }}" onsubmit="return validateCaptcha()">
                        {!! csrf_field() !!}
					<input type="hidden" name="type" value="<?php echo(isset($_GET['type']) ? $_GET['type'] : 0); ?>" />
					<input type="hidden" name="tpid" value="<?php echo(isset($_GET['tpid']) ? $_GET['tpid'] : 0); ?>" />
					<input type="hidden" name="tcid" value="<?php echo(isset($_GET['tcid']) ? $_GET['tcid'] : 0); ?>" />
					<input type="hidden" name="rcid" value="<?php echo(isset($_GET['rcid']) ? $_GET['rcid'] : 0); ?>" />

					<div class="signup-header">
                                <h2 class="margin-bottom-20" style="margin: 40px auto; text-align: center; color: #197aa4; font-weight: normal;">Create Account</h2>
                                <!-- <p>Already a member? Click
                                    <a href="#">HERE </a> to login to your account.</p> -->
                            </div>
														<div class="row">
                                <div class="col-sm-12">
								<div class="flash-message">
								@foreach (['danger', 'warning', 'success', 'info'] as $msg)
								  @if(Session::has('alert-' . $msg))

								  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
								  @endif
								@endforeach
								</div>							  </div>
							  </div>
                             <div class="row">
                                <div class="col-sm-6 form-group md-form">
                                   
									 
                                    <input class="form-control margin-bottom-20" type="text" id="name" name="name" required value="{{ old('name') }}">
									 <label class="wrap_form_control <?php if(old('name')!='') echo('active'); ?>" for="name">First Name*                               
                                    </label>
									 @if ($errors->has('name'))
                                   
									<label for="name" style="font-size: 12px !important;" class="error">{{ $errors->first('name') }}</label>
                                       
									 @endif
                                </div>
                                <div class="col-sm-6 form-group md-form">
                                   
                                    <input class="form-control margin-bottom-20" id="last_name" name="last_name" type="text" required value="{{ old('last_name') }}">
									 <label class="wrap_form_control <?php if(old('last_name')!='') echo('active'); ?>" for="last_name">Last Name*
                                       
                                    </label>
									@if ($errors->has('last_name'))
                                   
									<label for="name" style="font-size: 12px !important;" class="error">{{ $errors->first('last_name') }}</label>
                                       
									 @endif
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-sm-6 form-group md-form">
                                    
                                    <input class="form-control margin-bottom-20" type="text" value="{{ old('business_name') }}" id="business_name" name="business_name">
									<label class="wrap_form_control <?php if(old('business_name')!='') echo('active'); ?>" for="business_name">Business Name
                                        
                                    </label>
                                </div>
                                <div class="col-sm-6 form-group md-form">
                                    
                                    <input class="form-control margin-bottom-20" type="text" value="{{ old('number_of_computers') }}" id="number_of_computers" name="number_of_computers">
									<label class="wrap_form_control <?php if(old('number_of_computers')!='') echo('active'); ?>" for="number_of_computers"># of Computers
                                        
                                    </label>
                                </div>
                            </div>
                            
                           
                            <div class="row">
                                <div class="col-sm-6 form-group md-form">
                            
                            <input class="form-control margin-bottom-20" id="email" type="email" name="email" required value="{{ old('email') }}">
						<label class="wrap_form_control <?php if(old('email')!='') echo('active'); ?>" for="email"> Email Address*
                                
                            </label>
									@if ($errors->has('email'))
                                   
									<label for="email" style="font-size: 12px !important;" class="error">{{ $errors->first('email') }}</label>
                                       
									 @endif
                                        </div>                
                                <div class="col-sm-6 form-group md-form">
                                    
                                    <input class="form-control margin-bottom-20" type="text" value="{{ old('username') }}" name="username" id="username" required />
									<label class="wrap_form_control <?php if(old('username')!='') echo('active'); ?>" for="username">User Name*
                                        
                                    </label>
									@if ($errors->has('username'))
                                   
									<label for="username" style="font-size: 12px !important;" class="error">{{ $errors->first('username') }}</label>
                                       
									 @endif
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group md-form">
                                    
                                    <input class="form-control margin-bottom-20" id="password" type="password" name="password" required>
									<label class="wrap_form_control" for="password"> Password*
                                       <a data-tooltip-content="#tooltip_content" href="javascript:void(0)" class="tooltipster"><img width="20" src='<?php echo url('assets/front'); ?>/images/image.png' /> </a>
                                    </label>
									@if ($errors->has('password'))
                                   
									<label for="password" style="font-size: 12px !important;" class="error">{{ $errors->first('password') }}</label>
                                       
									 @endif
									<div class="tooltip_templates">
									 <span id="tooltip_content">
        <strong>Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br />  - At least one number and one <br /> - Special character such as @#$%</strong>
				</span>  </div>
                                </div>
                                <div class="col-sm-6 form-group md-form">
                                    
                                    <input class="form-control margin-bottom-20" id="password_confirmation" type="password" name="password_confirmation" required>
									<label class="wrap_form_control" for="password_confirmation"> Confirm Password*
                                        
                                    </label>
									@if ($errors->has('password_confirmation'))
                                   
									<label for="password_confirmation" style="font-size: 12px !important;" class="error">{{ $errors->first('password_confirmation') }}</label>
                                       
									 @endif
                              
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-8">
                                   <div class="g-recaptcha" data-type="image" data-sitekey="6LeNwiEUAAAAANciRiVEEjXO6CTOH8wEnRYy67j6"></div>
								 <span class="help-block" style="color:red;display:none;font-size: 12px !important;" id="cp_bx">
                                        <strong>Please click the checkbox to verify you are human.</strong>
                                    </span>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <!-- <button class="btn btn-primary" type="submit">Register</button> -->
                                     <button type="submit" class="btn btn-success btn-block btn-lg">Create Account</button> 
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Register Box -->
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
if (!response.length)
{
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



	$("#registerForm").validate({
        rules: {
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
            password: {
                passwordCheck:  'Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br /> - At least one number and one <br /> - Special character such as @#$%',
                minlength: 'Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br /> - At least one number and one <br /> - Special character such as @#$%',
            },
            password_confirmation: {
                passwordCheck:  'Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br /> - At least one number and one <br /> - Special character such as @#$%',
                minlength: 'Use a minimum of 8 characters with:<br /> - Both upper case and lower case letters<br /> - At least one number and one <br /> - Special character such as @#$%',
                equalTo: "Password doesn't match."
            }
        }
    });

});
</script>
@endsection
