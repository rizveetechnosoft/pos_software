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

        <!-- Title -->
        <title> {{ __('lang_v1.login') }} - {{ config('app.name', 'POS') }}</title>

        <!-- Fav Icon -->
        <link rel="icon" href="/auth_pages/images/favicon.png" />

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- All css here -->
        <link rel="stylesheet" href="/auth_pages/css/login-bootstrap.css" />
        <link rel="stylesheet" href="/auth_pages/css/login-style.css" />

    </head>
    <body>

        <!-- main_wrapper start -->
        <main class="main_wrapper">
            <div class="container">
                <div class="welcome_box">
                    <h4> {{ __('lang_v1.Welcome to Technosoft Integration') }} </h4>
                    <p>{{ __('lang_v1.Techno RMS Software') }}</p>
                </div>
                <div class="wrapper_mainBox">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="wrapper_left">
                                <div class="wrapper_leftoverlay">
                                    <div class="wrapleft_content">
                                        <div class="main_logo">
                                            <a href="#">
                                                <img src="auth_pages/images/logo.svg" alt="logo">
                                            </a>
                                        </div>
                                        <div class="wraper_cnt">
                                            <h4> {{ __('lang_v1.RMS') }} </h4>
                                        </div>
                                        <div class="powered_item">
                                            <p>{{ __('lang_v1.Powered By') }} :</p>
                                            <a href="#">
                                                <img src="auth_pages/images/logo-2.svg" alt="powered logo">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="wrapper_right">
                                <h3>@lang('lang_v1.login')</h3>
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

                                    <div class="login_item">
                                        <label for="name"><img src="auth_pages/images/user.svg" alt=""> {{ __('lang_v1.User Name') }}</label>
                                        <input type="text" id="username" name="username" value="{{ $username }}" placeholder="demo" required>
                                    </div>

                                    @if ($errors->has('username'))
                                        <div class="">
                                            <span class="login_error">
                                                {{ $errors->first('username') }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="login_item">
                                        <label for="password"><img src="auth_pages/images/lock.svg" alt=""> {{ __('lang_v1.Password') }}</label>
                                        <input type="password" id="password" name="password" value="{{ $password }}" placeholder="*****" required>
                                    </div>

                                    @if ($errors->has('password'))
                                        <div class="">
                                            <span class="login_error">
                                                {{ $errors->first('password') }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="check_box">
                                        <input type="checkbox" id="checkbox" class="form-check-input">
                                        <label for="checkbox"> {{ __('lang_v1.Remember Me') }} </label>
                                    </div>
                                    <div class="login_btn">
                                        <button type="submit">{{ __('lang_v1.login') }}</button>
                                    </div>
                                    <div class="login_links text-center">
                                        <a href="#"> {{ __('lang_v1.forgot_your_password') }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- main_wrapper end -->

    </body>
</html>
