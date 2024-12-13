@extends('layouts.auth3')

@section('title', __('lang_v1.reset_password'))

@section('content')
    <div class="col-lg-5">
        <div class="wrapper_right">
            <h3>@lang('lang_v1.Forget Password')</h3>

            @if(session('status') && is_string(session('status')))
                <div class="alert alert-info" role="alert">{{ session('status') }}</div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" >
                {{ csrf_field() }}

                <div class="login_item">
                    <label for="name"><img src="{{ asset('auth_pages/images/user.svg') }}" alt=""> {{ __('lang_v1.Email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="@lang('lang_v1.email_address')">
                </div>

                @if ($errors->has('email'))
                    <div class="">
                        <span class="login_error">
                            {{ $errors->first('email') }}
                        </span>
                    </div>
                @endif

                <div class="login_btn">
                    <button type="submit">@lang('lang_v1.send_password_reset_link')</button>
                </div>

                <div class="login_btn text-center">
                    <a href="{{ route('home') }}">@lang('lang_v1.Back To Login')</a>
                </div>
            </form>
        </div>
    </div>

@endsection
