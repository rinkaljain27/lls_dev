<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Moba Admin</title>
    <link rel="stylesheet" href=" <?php echo URL::to('assets\css\materialdesignicons.min.css'); ?>" />
    <link rel="stylesheet" href=" <?php echo URL::to('assets\css\vendor.bundle.base.css'); ?>" />
    <link rel="stylesheet" href=" <?php echo URL::to('assets\css\style.css'); ?>" />
    <link rel="stylesheet" href=" <?php echo URL::to('assets\css\login.css'); ?>" />
    <link rel="stylesheet" href=" <?php echo URL::to('assets\css\toastr.min.css'); ?>" />
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="<?php echo URL::to('assets\images\favicon.png'); ?>" />
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
                            <form class="form mt-5" method="POST" action="{{ route('login') }}" autocomplete="off" >
                            @csrf
                                <div class="form-group">
                                    <input id="email" type="text" class="form-control p_input" placeholder="Email" name="email" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                    </span>
                                @enderror
                                <div class="form-group">
                                   <input id="password" type="password" class="form-control p_input"  name="password" placeholder="Password" >
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
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
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
   
    <script src="<?php echo URL::to('assets\js\toastr.min.js'); ?>"></script>
    {!! Toastr::message() !!}
    <!-- <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script> -->
    
</body>

</html>