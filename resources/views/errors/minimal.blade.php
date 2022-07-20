<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> @yield('title') | {{ config('app.name')}}</title>
        <link rel="stylesheet" href="<?php echo URL::to('assets\css\style.css'); ?>" />
        <link rel="shortcut icon" href="<?php echo URL::to('assets\images\favicon.png'); ?>" />
    
        <style>
            .erroe_404 {
                color: #ffcc00;
                font-size: 10rem;
                margin-top: 8rem;
            }
            
            .btn-color-set {
                color: #fff !important;
            }
            
            #container {
                text-align: center;
            }
            
            .message {
                color: #fff;
            }
            
            .message a {
                color: #ffcc00;
                text-transform: uppercase;
            }
            
            #container {
                text-align: center;
                height: 79.2vh;
            }
        </style>
    </head>
    <body>
    <div id="container">

        <h1 class="erroe_404">@yield('code')</h1>


        <div class="message">
            <h2>@yield('message')</h2><br>
            <h3>@yield('ext_message')</h3><br>

        </div>
        <div class="message">
            <a href="{{url('/home')}}" class="btn btn-primary btn-color-set p-3"> Dashboard </a>
        </div>
    </div>
        
    </body>
</html>
