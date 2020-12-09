@extends('layouts.Web_app')
@section('title','تسجيل الدخول')
@section('login-s')
    <a href="{{route('login')}}" class="h"><span class="glyphicon glyphicon-log-in" style="color:orange;"></span> تسجيل الدخول </a>
@endsection
<style>
    body {
        /* background-image: url("
    {{asset('public/images/test1.png')}} ");*/
    }

    .card {
        border: 1px solid #ffffff;
        margin-top: 30px;
        padding: 10px;
    }

    .login-page {
        width: 360px;
        padding: 4% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form button:hover, .form button:active, .form button:focus {
        background: grey;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }

    .form .message a {
        color: #64AEF7;
        text-decoration: none;
    }

    .form .register-form {
        display: none;
    }
    .user-icon{
        color: orange;
    }
</style>
@section('content')

    <div class="login-page">
        <div class="form">
            <form method="POST" action="{{ route('login') }}" class="login-form">
                {{ csrf_field() }}
               <span style="font-weight: bold;color: grey;margin-bottom: 10px;font-size: 23px">تسجيل الدخول<i class="fas fa-user-alt user-icon"></i></span><br/><hr>
                <label style="font-weight: bold;color: grey;margin-bottom: 10px;margin-left: 185px">البريد الإلكتروني:</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <div class="alert alert-danger" role="alert" style="padding:7px;">
                    <span class="invalid-feedback" role="alert">
                        <span style="font-size: 12px;color: darkred;font-weight: bold"><strong>{{ $message }}</strong></span>
                    </span>
                </div>
                @enderror
                <label style="font-weight: bold;color: grey;;margin-bottom: 10px;margin-left: 185px">كلمة المرور:</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">
                @error('password')
                <div class="alert alert-danger" role="alert" style="padding:7px;">
                    <span class="invalid-feedback" role="alert">
                        <span style="font-size: 12px;color: darkred;font-weight: bold"><strong>{{ $message }}</strong></span>
                    </span>
                </div>
                @enderror
                <button type="submit" class="btn btn-primary" style="font-weight: bold;font-size: 18px"><span style="font-size: 16px">تسجيل الدخول</span>
                </button>
                @if (Route::has('password.request'))
                    <p class="message"><span style="font-weight: bold">ليس لديك حساب</span>
                        <a class="btn btn-link" href="{{ route('register') }}">
                            <span style="font-weight: bold">اضغط هنا </span>
                        </a><br/>
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('هل نسيت كلمة المرور؟') }}
                        </a></p>
                @endif
            </form>
        </div>
    </div>
    {{--
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('تسجيل الدخول') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
@endsection