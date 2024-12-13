@extends('layouts.auth3')
@section('title', __('lang_v1.login'))

@section('content')
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
                    <input type="text" id="username" name="username" value="{{ $username }}" placeholder="Enter Your Username" required>
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
                    {{-- <input type="password" id="password" name="password" value="{{ $password }}" placeholder="Enter Your Password" required> --}}
                    <div class="password-input-wrapper">
                        <input type="password" id="password" name="password" value="{{ $password }}" placeholder="Enter Your Password" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                            <img src="auth_pages/images/eye.png" alt="Toggle Password Visibility">
                        </span>
                    </div>
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
                    <a href="{{ route('password.request') }}"> {{ __('lang_v1.forgot_your_password') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
