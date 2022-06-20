<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.1
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description"
        content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords"
        content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Reset Password</title>

    <!-- Favicons-->
    @if( $app_info )
    <link rel="shortcut icon" href="{{ asset('images/info/'.$app_info->fav) }}">
    @endif
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <!-- Font Awesome -->


    <!-- CORE CSS-->

    <link href="{{ asset('auth/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('auth/css/materialize.icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('auth/css/style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->
    <link href="{{ asset('auth/css/custom.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

    <link href="{{ asset('auth/css/page-center.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="{{ asset('auth/css/prism.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('auth/css/perfect-scrollbar.css') }}" type="text/css" rel="stylesheet"
        media="screen,projection">

    <style>
        .password-box{
            position: relative;
        }
        .password-box .hide-password{
            display: none;
        }
        .password-box .fas{
            position: absolute;
            top: 28%;
            right: 15px;
            z-index : 10;
            cursor : pointer;
            color: white;
        }
    </style>

</head>

<body class="cyan">
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->



    <div id="login-page" class="row">
        <div class="col s12 z-depth-4 card-panel">
            @if ($errors->any())
            <div class="new badge red">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if( session()->has('success') )
            <div class="new badge green">
                {{ session()->get('success') }}
            </div>
            @endif
            @if( session()->has('failed') )
            <div class="new badge red">
                {{ session()->get('failed') }}
            </div>
            @endif
            <form class="login-form" action="{{ route('password.reset',$email) }}" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s12 center">
                        @if( $app_info )
                        <img src="{{ asset('images/info/'.$app_info->logo) }}" alt=""
                            class="responsive-img valign profile-image-login">
                        @endif
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input id="email" type="text" readonly name="email" class="validate @error('email') is-valid @enderror" value="{{ $email }}">
                        <label for="email">Email Address</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12 password-box">
                        <i class="fas fa-eye show-password"></i>
                        <i class="fas fa-eye-slash hide-password"></i>
                        <i class="material-icons prefix">lock</i>
                        <input type="password" name="password" id="password-field" class="validate" placeholder="Password">
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12 password-box">
                        <i class="fas fa-eye show-password"></i>
                        <i class="fas fa-eye-slash hide-password"></i>
                        <i class="material-icons prefix">lock</i>
                        <input type="password" name="password_confirmation" id="password-field" class="validate" placeholder="Password Confirmation">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light col s12">Reset</button>
                    </div>
                </div>
                <div class="progress">
                    <div class="indeterminate"></div>
                </div>
            </form>
        </div>
    </div>



    <!-- ================================================
    Scripts
    ================================================ -->

    <!-- jQuery Library -->
    <script type="text/javascript" src="{{ asset('auth/js/jquery-1.11.2.min.js') }}"></script>
    <!--materialize js-->
    <script type="text/javascript" src="{{ asset('auth/js/materialize.min.js') }}"></script>
    <!--prism-->
    <script type="text/javascript" src="{{ asset('auth/js/prism.js') }}"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="{{ asset('auth/js/perfect-scrollbar.min.js') }}"></script>

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="{{ asset('auth/js/plugins.min.js') }}"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="{{ asset('auth/js/custom-script.js') }}"></script>

    <script>
        $(".show-password").click(function () {
            let $this = $(this)
            $this.closest(".password-box").find("#password-field").attr("type", "text")
            $this.closest(".password-box").find(".show-password").hide()
            $this.closest(".password-box").find(".hide-password").show()
        })
    
        $(".hide-password").click(function () {
            let $this = $(this)
            $this.closest(".password-box").find("#password-field").attr("type", "password")
            $this.closest(".password-box").find(".show-password").show()
            $this.closest(".password-box").find(".hide-password").hide()
        })
    </script>

</body>

</html>
