@extends('Layouts.Web_app')
@section('title','تعديل الملف الشخصي')
<style>
    body {
        /* background-image: url("
    {{asset('images/test1.png')}} ");*/
    }

    .card {
        border: 1px solid #ffffff;
        margin-top: 30px;
        padding: 10px;
    }

    .login-page {
      /*  width: 360px;*/
        padding: 4% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        /*max-width: 360px;*/
        margin: 0 auto 100px;
        padding: 45px;
      /*  text-align: center;*/
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
        font-family: "Roboto", sans-serif;
       // outline: 0;
        background: #f2f2f2;
        //width: 100%;
        /*border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;*/
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        width: 18%;
        border: 0;
       /* padding: 15px;*/
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
        margin: 16px 0;
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
    label{
        color: grey;
    }
</style>

{{--
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1>تعديل الملف الشخصي </h1>
                    <div class="card-body">
                        <form method="POST" action="{{route('updateUserProfile')}}">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name"
                                       class="col-md-12 col-form-label text-md-right">{{ __('الاسم الأول') }}</label>

                                <div class="col-md-8">
                                    <input id="first_name" type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name" value="{{ $user->first_name }}" required
                                           autocomplete="first_name" autofocus placeholder="أدخل الاسم  الأول">

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name"
                                       class="col-md-12 col-form-label text-md-right">{{ __('الاسم الأخير') }}</label>

                                <div class="col-md-8">
                                    <input id="last_name" type="text"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" value="{{ $user->last_name }}" required
                                           autocomplete="last_name" autofocus placeholder="أدخل الاسم  الأخير">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="user_name"
                                       class="col-md-12 col-form-label text-md-right">{{ __('اسم المستحدم') }}</label>

                                <div class="col-md-8">
                                    <input id="user_name" type="text"
                                           class="form-control @error('user_name') is-invalid @enderror"
                                           name="user_name" value="{{ $user->user_name }}" required
                                           autocomplete="user_name" autofocus placeholder="أدخل اسم المستخدم">

                                    @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number"
                                       class="col-md-12 col-form-label text-md-right">{{ __('رقم الهاتف') }}</label>

                                <div class="col-md-8">
                                    <input id="phone_number" type="text"
                                           class="form-control @error('phone_number') is-invalid @enderror"
                                           name="phone_number" value="{{ $user->phone_number }}" required
                                           autocomplete="phone_number" autofocus placeholder="أدخل  رقم الهاتف">

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-12 col-form-label text-md-right">{{ __('البريد الإلكتروني') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $user->email }}" required autocomplete="email" readonly>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-12 col-form-label text-md-right">{{ __('الجنس') }}</label>

                                <div class="col-md-8">
                                    <div class="form-check">
                                        <input type="radio" name="gender" value="male"  {{$user->gender == 'male'?'checked':''}} > Male<br>
                                        <input type="radio" name="gender" value="female"  {{$user->gender == 'female'?'checked':''}}> Female<br>

                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="country"
                                       class="col-md-12 col-form-label text-md-right">{{ __('اختر البلد') }}</label>

                                <div class="col-md-8">
                                    <select name="country" id="country" class="form-control">
                                        <option value="">اختر البلد</option>
                                        @foreach($countries as $key => $value)
                                            <option  {{$key == $user->country_id?'selected':''}} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-12 col-form-label text-md-right">{{ __('كلمة المرورالحالية') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="c_password"
                                           required autocomplete="new-password" placeholder="أدخل كلمة المرورالحالية">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-12 col-form-label text-md-right">{{ __('كلمة المرور الجديدة') }}</label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password"  autocomplete="new-password"
                                           placeholder="أدخل كلمة المرور الجديدة">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-12 col-form-label text-md-right">{{ __('أعد إدخال كلمة المرور') }}</label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation"  autocomplete="new-password"
                                           placeholder="أعد إدخال كلمة المرور">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('حفظ') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                        <a href="{{route('home_page.index')}}" ><button type="submit" class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i>{{ __('إلغاء') }}</button></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@include('Partials.Web._javascript')
--}}


@section('content')

    <div class="container">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger" style="text-align: center" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span style="font-size: 25px;text-align: center;font-weight: bold">{{ $message }}</span>
            </div>
        @endif
        <div class="login-page">
            <div class="form">
                <form method="POST" action="{{route('updateUserProfile')}}" class="login-form">
                    {{ csrf_field() }}
                    <div style="text-align: center"><span style="font-weight: bold;color: grey;margin-bottom: 10px;font-size: 25px;">تعديل الملف الشخصي<i class="fas fa-user-cog icon-style"></i></span><br/><hr></div>
                    <label style="margin: 20px 0;font-size: 23px ;margin-left: 416px">الاسم الأول:</label>
                    <input id="first_name" type="text"
                           class="form-control @error('first_name') is-invalid @enderror"
                           name="first_name" value="{{ $user->first_name }}" required
                           autocomplete="first_name" autofocus placeholder="أدخل الاسم  الأول">
                    @error('first_name')
                    <div class="alert alert-danger" role="alert" style="padding:7px;">
                    <span class="invalid-feedback" role="alert">
                        <span style="font-size: 12px;color: darkred;font-weight: bold"><strong>يرجى إدخال الاسم الأول بشكل صحيح</strong></span>
                    </span>
                    </div>
                    @enderror

                    <label style="margin: 17px 0;font-size: 23px">الاسم الأخير:</label>
                    <input id="last_name" type="text"
                           class="form-control @error('last_name') is-invalid @enderror"
                           name="last_name" value="{{ $user->last_name }}"
                           autocomplete="last_name" autofocus placeholder="أدخل الاسم  الأخير">

                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                    <label style="margin: 17px 0;font-size: 23px;">اسم المستخدم:</label>

                        <input id="user_name" type="text"
                               class="form-control @error('user_name') is-invalid @enderror"
                               name="user_name" value="{{ $user->user_name }}" required
                               autocomplete="user_name" autofocus placeholder="أدخل اسم المستخدم">

                        @error('user_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label style="margin: 17px 0;font-size: 23px">رقم الهاتف:</label>
                        <input id="phone_number" type="text"
                               class="form-control @error('phone_number') is-invalid @enderror"
                               name="phone_number" value="{{ $user->phone_number }}"
                               autocomplete="phone_number" autofocus placeholder="أدخل  رقم الهاتف">

                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label style="margin: 17px 0;font-size: 23px">البريد الإلكتروني:</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ $user->email }}" required autocomplete="email" readonly>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    <div class="form-group row">
                        <label for="gender" style="margin: 17px 0;font-size: 23px;margin-right: 20px">الجنس</label>

                            <div class="form-check" style=" margin-right: 20px">
                                <input type="radio" name="gender" value="male"  {{$user->gender == 'male'?'checked':''}} > <label style="font-size: 15px">Male</label>
                                <input type="radio" name="gender" value="female"  {{$user->gender == 'female'?'checked':''}} style="margin-right: 60px"><label style="font-size: 15px;margin-right: 2px">Female</label>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                    </div>

                            <label style="margin: 17px 0;font-size: 23px">البلد:</label>
                            <select name="country" id="country" class="form-control">
                                <option value="">اختر البلد</option>
                                @foreach($countries as $key => $value)
                                    <option {{$key == $user->country_id?'selected':''}} value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select><br>

                            <label style="margin: 17px 0;font-size: 23px">كلمة المرور الحالية:</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="c_password"
                                   required autocomplete="new-password" placeholder="أدخل كلمة المرورالحالية">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        <h4 style="color: red;font-weight: bold" >*إذا رغبت بإعادة تعيين كلمة المرور أدخل كلمة المرور الجديدة :</h4>
                            <label style="margin: 17px 0;font-size: 23px">كلمة المرور الجديدة:</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password" autocomplete="new-password"
                                   placeholder="أدخل كلمة المرور الجديدة">

                            <label style="margin: 17px 0;font-size: 23px">أعد إدخال كلمة المرور:</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" autocomplete="new-password"
                                   placeholder="أعد إدخال كلمة المرور">

                    <button type="submit" class="btn btn-primary">
                        {{ __('حفظ') }}
                    </button>
                    <a href="{{route('home_page.index')}}" ><button type="button" class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i>{{ __('إلغاء') }}</button></a>

                </form>
            </div>
        </div>
    </div>
@endsection

@include('Partials.Web._javascript')