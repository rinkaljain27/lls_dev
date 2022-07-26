<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href=" <?php echo URL::to('assets\css\style.css'); ?>" />
    <link rel="stylesheet" href=" <?php echo URL::to('assets\css\login.css'); ?>" />
    <link rel="stylesheet" href=" <?php echo URL::to('assets\css\toastr.min.css'); ?>" />
    <script src="<?php echo URL::to('assets\js\jquery.min.js'); ?>"></script>
    <link rel="shortcut icon" href="<?php echo URL::to('assets\images\favicon.png'); ?>" />
    <script src="<?php echo URL::to('assets\js\jquery.validate.js'); ?>"></script>  
    
</head>
<body class="login-page">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper m-0">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth p-0">
                    <div class="card col-12 col-lg-8 mx-auto h-sm-50 h-100  login-bg w-70 m-0">
                         <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                         </div>
                    </div>
                    <div class="card col-12 col-lg-4 mx-auto h-sm-50 h-100 w-30 l-r-card">
                        <div class="card-body px-5 py-5 mt-5">
                            <h3 class="card-title text-left mb-3 d-flex align-items-center justify-content-center mt-5"><img src="<?php echo URL::to('assets\images\logo_black.png'); ?>" width="200" class="logo_login"></h3>
                            <form class="form mt-5" method="POST" id="login-form"action="{{ route('login') }}" autocomplete="off" >
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <input id="email" type="text" class="form-control p_input error" placeholder="Email" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                   <input id="password" type="password" class="form-control p_input error"  name="password" placeholder="Password" >
                                </div>
                            </div>
                                <div class="form-group d-flex align-items-center justify-content-end link">
                                    <!-- <a href="{{ route('password.request') }}" class="forgot-pass text-right" >Forgot password ?</a> -->
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn login-btn">Login</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var container = $('#errors');
        function updateErrorContainer(errorId, errorMsg) {
            if (typeof errorMsg != 'undefined' && errorMsg != '') {
                $("#" + errorId).removeClass("hidden").find("label").html(errorMsg);
                container.removeClass("hidden");
            }
        }
        $(document).ready(function($) {
            $("#login-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 25,
                    },
                },
                messages: {
                    email: {
                        required: "Please Enter Your Email",
                        email: "Please Enter A Valid Email Address"
                    },
                    password: {
                        required: "Please Enter Your Password",
                        minlength: "Your Password must be at least 6 characters long",
                        maxlength: "Please enter Password no more than 25 characters"
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.is(":radio")) {
                        error.appendTo(element.parents('.form-group'));
                    } else { // This is the default behavior 
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }

            });
        });
    </script>
    <script src="<?php echo URL::to('assets\js\toastr.min.js'); ?>"></script>
    {!! Toastr::message() !!}
</body>
</html>