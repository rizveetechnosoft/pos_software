@extends('layouts.auth3')

@section('title', __('lang_v1.reset_password'))

@section('content')
    <div class="col-lg-5">
        <div class="wrapper_right">
            <h3>@lang('lang_v1.Forget Password')</h3>
            <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="login_item">
                    <label for="name"><img src="{{ asset('auth_pages/images/user.svg') }}" alt=""> {{ __('lang_v1.Email') }}</label>
                    <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="@lang('lang_v1.email_address')">
                </div>

                @if ($errors->has('email'))
                    <div class="">
                        <span class="login_error">
                            {{ $errors->first('email') }}
                        </span>
                    </div>
                @endif

                <div class="login_item">
                    <label for="password"><img src="{{ asset('auth_pages/images/lock.svg') }}" alt=""> {{ __('lang_v1.Password') }}</label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}" required placeholder="Enter Your Password">
                </div>

                @if ($errors->has('password'))
                    <div class="">
                        <span class="login_error">
                            {{ $errors->first('password') }}
                        </span>
                    </div>
                @endif

                <div class="login_item">
                    <label for="password_confirmation"><img src="{{ asset('auth_pages/images/lock.svg') }}" alt=""> {{ __('business.confirm_password') }}</label>
                    <input type="password" id="password" name="password_confirmation" value="" required placeholder="Re-enter Your Password">
                </div>

                @if ($errors->has('password_confirmation'))
                    <div class="">
                        <span class="login_error">
                            {{ $errors->first('password_confirmation') }}
                        </span>
                    </div>
                @endif

                <br>
                <div class="login_btn">
                    <button type="submit" class="">@lang('lang_v1.reset_password')</button>
                    <!-- /.col -->
                </div>

                <div class="login_btn text-center">
                    <a href="{{ route('home') }}">@lang('lang_v1.Back To Login')</a>
                </div>
            </form>
        </div>
    </div>
@endsection
