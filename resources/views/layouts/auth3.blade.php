<!DOCTYPE html>
<html lang="en-US">
<head>
    <!-- Meta setup -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="decription" content="">
    <meta name="designer" content="">
    <!-- Font Awesome CDN link for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('title') - {{ config('app.name', 'POS') }}</title>

    <!-- Fav Icon -->
    <link rel="icon" href="/auth_pages/images/favicon.png?v=2" />

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- All css here -->
    <link rel="stylesheet" href="/auth_pages/css/login-bootstrap.css" />
    <link rel="stylesheet" href="/auth_pages/css/login-style.css?v=1" />

</head>
<body>

<!-- main_wrapper start -->
<main class="main_wrapper">
    <h3 class="login_header_text">Welcome To CodeloomBd Pos <h3>
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper">
                        <div class="title"><span>@lang('lang_v1.login')</span></div>
                        <form action="{{ route('login') }}" method="POST" >
                            {{ csrf_field() }}
                            @php
                                $username = old('username');
                                $password = null;
                                if(config('app.env') == 'demo'){
                                    $username = 'admin';
                                    $password = '123456';
            
                                    $demo_types = array(
                                        'all_in_one' => 'admin',
                                        'super_market' => 'admin',
                                        'pharmacy' => 'admin-pharmacy',
                                        'electronics' => 'admin-electronics',
                                        'services' => 'admin-services',
                                        'restaurant' => 'admin-restaurant',
                                        'superadmin' => 'superadmin',
                                        'woocommerce' => 'woocommerce_user',
                                        'essentials' => 'admin-essentials',
                                        'manufacturing' => 'manufacturer-demo',
                                    );
            
                                    if( !empty($_GET['demo_type']) && array_key_exists($_GET['demo_type'], $demo_types) ){
                                        $username = $demo_types[$_GET['demo_type']];
                                    }
                                }
                            @endphp
                            <div class="row">
                                <i class="fas fa-user"></i>
                                <input type="text" id="username" name="username" value="{{ $username }}" placeholder="Enter Your Username" required>
                            </div>
                            @if ($errors->has('username'))
                                <div class="">
                                    <span class="login_error">
                                        {{ $errors->first('username') }}
                                    </span>
                                </div>
                            @endif
                            <div class="row">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="password" name="password" value="{{ $password }}" placeholder="Enter Your Password" required>
                            </div>
                            @if ($errors->has('password'))
                                <div class="">
                                    <span class="login_error">
                                        {{ $errors->first('password') }}
                                    </span>
                                </div>
                            @endif
                            <div class="row mb-30">
                                <button class="button" type="submit">{{ __('lang_v1.login') }}</button>
                            </div>
                        </form>
                      
                      </div>
                  
                    {{-- <div class="wrapper_left">
                        <div class="wrapper_leftoverlay">
                            <div class="wrapleft_content">
                                <div class="main_logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('auth_pages/images/logo.svg') }}" alt="logo">
                                    </a>
                                </div>
                                <div class="wraper_cnt">
                                    <h4> {{ __('lang_v1.POS') }} </h4>
                                </div>
                                <div class="powered_item">
                                    <p>{{ __('lang_v1.Powered By') }} :</p>
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('auth_pages/images/logo-2.svg') }}?v=2" alt="powered logo" width="226px" height="auto">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                     {{-- @yield('content') --}}
                </div>
            </div>
        </div>
        {{-- <div class="welcome_box">
            <h4> {{ __('lang_v1.welcome_to_technosoft_informatics') }} </h4>
            <p>{{ __('lang_v1.Techno POS Software') }}</p>
        </div> --}}

        {{-- <div class="wrapper_mainBox">
            <div class="row">
                <div class="col-lg-7">
                    <div class="wrapper_left">
                        <div class="wrapper_leftoverlay">
                            <div class="wrapleft_content">
                                <div class="main_logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('auth_pages/images/logo.svg') }}" alt="logo">
                                    </a>
                                </div>
                                <div class="wraper_cnt">
                                    <h4> {{ __('lang_v1.POS') }} </h4>
                                </div>
                                <div class="powered_item">
                                    <p>{{ __('lang_v1.Powered By') }} :</p>
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('auth_pages/images/logo-2.svg') }}?v=2" alt="powered logo" width="226px" height="auto">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')
            </div>
        </div> --}}
    </div>
</main>
<!-- main_wrapper end -->

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggleButton = document.querySelector(".toggle-password img");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleButton.src = "/auth_pages/images/eye-slash.png"; // Change to eye-slash icon
        } else {
            passwordInput.type = "password";
            toggleButton.src = "/auth_pages/images/eye.png"; // Change back to eye icon
        }
    }
</script>

</body>
</html>
