<header class="header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"
                        style="border-color:orange;   color: white !important;">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="font-family:Georgia; font-style: italic; font-size: 32px; color:white; ">Travel<span
                            style="font-family:Georgia;font-style: italic; color:orange;">Ro</span> </a>
            </div>


            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">


                    <li><a href="{{route('home_page.index')}}" class="h"><span class="glyphicon glyphicon-home"
                                                                               style="color: orange;"></span>&nbsp;الـرئيسـيـة</a>
                    @auth
                        @if(Auth::user()->role_id != 8)
                            <li><a href="{{route('Main.index')}}" class="h"><span class="glyphicon glyphicon-wrench"
                                                                                  style="color: orange;"></span>&nbsp;إدارة
                                    الموقع</a></li>
                        @endif

                        @if(Auth::user()->role_id == 8)
                                <li> @yield('contact')</li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="glyphicon glyphicon-user"
                                      style="color: orange;"></span>{{ Auth::user()->user_name }} <span
                                        class="caret"></span></a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->role_id != 1)
                                    <i class="far fa-calendar-check icon-style"></i><a class="dropdown-item signout" href="{{ route('showUserReservations') }}">الحجوزات</a>
                                    <br/>
                                    <i class="far fa-bell icon-style"></i><a class="dropdown-item signout" href="{{ route('show_message_replies') }}"> البريد الوارد </a><br/>
                                @endif
                                <i class="fas fa-user-cog icon-style"></i><a class="dropdown-item signout" href="{{ route('editUserProfile') }}">تعديل الملف الشخصي</a><br/>
                                <i class="fas fa-sign-out-alt icon-style"></i><a class="dropdown-item signout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">تسجيل الخروج</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <br>

                            </div>

                        </li>
                    @else
                        <li> @yield('contact')</li>
                        <li><a href="{{route('register')}}" class=""><span class="glyphicon glyphicon-user" style="color: orange;"></span>&nbsp; إنشاء حسـاب</a></li>

                        <li><a href="{{route('login')}}" class="h"><span class="glyphicon glyphicon-log-in" style="color:orange;"></span> تسجيل الدخول </a></li>

                      {{--  <li><a  data-toggle="modal" data-target="#myModal" data-backdrop="static" class="h"> @yield('login') </a></li>

                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="modal fade" id="myModal" role="dialog" style="margin-top: 40px;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header"
                                             style="background-color: #64AEF7; color: white; height: 60px;">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    style="float: left;text-align: left;">X
                                            </button>
                                            <center><label style="font-size: 26px; margin-top: -5px;">تسـجيل
                                                    الدخـول</label></center>
                                        </div>

                                        <div class="row">
                                            <div class="modal-body col-md-6 col-xs-12"
                                                 style=" float: right;padding-right: 22px; padding-left: 22px;">
                                                <div >
                                                    <label for="email"
                                                           class="col-form-label text-md-right">{{ __('البريد الإلكتروني') }}</label> <br/>


                                                        <input id="email" type="email"
                                                               class="form-control @error('email') is-invalid @enderror"
                                                               name="email" value="{{ old('email') }}" required
                                                               autocomplete="email" autofocus>

                                                        @error('email')
                                                    <div class="alert alert-danger" role="alert" style="padding:7px;">
                                                         <span class="invalid-feedback" role="alert">
                                                                <span style="font-size: 12px;color: darkred;font-weight: bold"><strong>{{ $message }}</strong></span>
                                                             </span>
                                                    </div>
                                                        @enderror
                                                     <br/>
                                                </div>

                                                <div>
                                                    <label for="password"
                                                           class="col-form-label text-md-right">{{ __('Password') }}</label><br/>


                                                        <input id="password" type="password"
                                                               class="form-control @error('password') is-invalid @enderror"
                                                               name="password" required autocomplete="current-password">

                                                        @error('password')
                                                    <div class="alert alert-danger" role="alert" style="padding:7px;">
                                                         <span class="invalid-feedback" role="alert">
                                                                <span style="font-size: 12px;color: darkred;font-weight: bold"><strong>{{ $message }}</strong></span>
                                                             </span>
                                                    </div>
                                                        @enderror

                                                </div>
                                                @if($errors->has('email') || $errors->has('password'))
                                                    <script>
                                                        $(function() {
                                                            $('#myModal').modal({
                                                                show: true
                                                            });
                                                        });
                                                    </script>
                                                @endif
                                            </div>

                                            <div class="col-md-6 col-xs-12" style="float: right; padding-right: 30px;">
                                                <img src="{{asset('images/login1.png')}}" alt="human" style="width:200px;height: 200px;"></div>
                                            </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4" style="margin-right: 10px;">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('تسجيل الدخول') }}
                                                </button>

                                                <a href="{{route('home_page.index')}}" style="text-decoration: none">
                                                    <button type="button" class="btn btn-warning">
                                                        {{ __('إلغاء') }}
                                                    </button>
                                                </a>

                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ __('هل نسيت كلمة المرور؟') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                            </form>
                        <hr>

                        <div style="font-size: 15px; padding-bottom: 10px;padding-right: 10px;padding-top: -5px;"><i
                                    class="glyphicon glyphicon-warning-sign" style="color: red;"></i>اذا لم تنشئ حساب
                            لدينا <a href="{{route('register')}}"> اضغط هنا</a></div>--}}

                    @endauth

                </ul>
            </div>
        </div>
    </nav>
</header>
