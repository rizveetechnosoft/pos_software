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
    <div class="container">
        <div class="welcome_box">
            <h4> {{ __('lang_v1.welcome_to_technosoft_informatics') }} </h4>
            <p>{{ __('lang_v1.Techno POS Software') }}</p>
        </div>

        <div class="wrapper_mainBox">
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
        </div>
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
