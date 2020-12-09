@extends('layouts.Web_app')

@section('styles')
 .content{

  }
 .content-style{
 background-image: url('{{asset("images/test.png")}}');
 }

    label{
   font-size:20px;
   color:64AEF7
     }
@endsection

@section('content')
    <div class="container content-style">
        <div class="row justify-content-center ">
            <div class="col-md-8 content">
                <div class="card ">
                    <div class="card-header" style=""><h1 style="color: #FFA500;font-weight: bold;margin-bottom: 20px">{{ __('إتمام عملية الحجز ') }}</h1></div>
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span style="font-size: 15px;text-align: center;font-weight: bold">{{ $message }}</span>
                        </div>

                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('completeHotelReservation',['hotel' => $hotel->id,'room' => $room->id])}}">
                            @csrf
                            <div class="form-group row">
                                <label for="first_name"
                                       class=" col-form-label text-md-right ">{{ __('الاسم الأول') }}</label>

                                <div >
                                    <input id="first_name" type="text"
                                           class="col-xs-8 form-control @error('first_name') is-invalid @enderror"
                                           name="first_name" value="{{$user->first_name}}"
                                           autocomplete="first_name" autofocus readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name"
                                       class="col-form-label text-md-right">{{ __('الاسم الأخير') }}</label>

                                <div >
                                    <input id="last_name" type="text"
                                           class="col-xs-8 form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" value="{{$user->last_name}}"
                                           autocomplete="last_name" autofocus readonly placeholder="أدخل الاسم  الأخير">

                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email"
                                       class="col-form-label text-md-right">{{ __('البريد الإلكتروني') }}</label>

                                <div >
                                    <input id="email" type="email"
                                           class="col-xs-8 form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{$user->email}}"  autocomplete="email" readonly
                                           placeholder="أدخل  البريد الالكتروني">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number"
                                       class="col-form-label text-md-right">{{ __('رقم الهاتف') }}</label>

                                <div >
                                    <input id="phone_number" type="text"
                                           class="col-xs-8 form-control @error('phone_number') is-invalid @enderror"
                                           name="phone_number" value="{{ $user->phone_number }}" required
                                           autocomplete="phone_number" autofocus readonly
                                           placeholder="أدخل  رقم الهاتف">


                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="country"
                                       class="col-form-label text-md-right">{{ __(' البلد') }}</label>

                                <div >
                                    <input id="country" type="text"
                                           class="col-xs-8 form-control @error('country') is-invalid @enderror"
                                           name="phone_number" value="{{$user->country_id != null?$user->country->name:''}}"
                                           autofocus readonly>
                                </div>
                            </div>


                            <label for="credit" class="col-form-label text-md-right" style="font-size: 23px;color: #FFA500;">{{ __('*لإتمام الحجز أدخل اسم البطاقة ورصيد البطاقة:') }}</label>
                            <div class="form-group row">
                                <label for="credit"
                                       class="col-form-label text-md-right">{{ __('اسم البطاقة') }}</label>

                                <div >
                                    <input id="credit" type="text"
                                           class="col-xs-8  form-control @error('credit') is-invalid @enderror"
                                           name="credit" value="{{ $user->credit }}" required
                                           autocomplete="credit" autofocus placeholder="أدخل اسم البطاقة">

                                    @error('credit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="credit_number"
                                       class="col-form-label text-md-right">{{ __('رصيد البطاقة') }}</label>

                                <div >
                                    <input id="credit_number" type="text"
                                           class="col-xs-8 form-control @error('credit_number') is-invalid @enderror"
                                           name="credit_number"
                                           value="{{ $user->credit_balance }}" required autocomplete="credit"
                                           placeholder="أدخل  رصيد البطاقة">
                                    <label for="credit"
                                           class=" col-form-label text-md-right" style="border:2px solid #FFA500;margin: 1px 5px;padding: 1px 6px;border-radius: 5px;font-size: 20px"><span style="color: black">$</span></label>
                                    @error('credit_number')
                                    <div class="alert alert-danger col-xs-8">
                                    <span class="invalid-feedback" role="alert">
                                         <strong>يرجى إدخال رصيد صالح للبطاقة</strong>
                                     </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('إتمام الحجز') }}
                                    </button>
                                    <a href="{{route('editUserProfile')}}">
                                    <button type="button" class="btn btn-success">
                                        {{ __('تعديل الملف الشخصي') }}
                                    </button>
                                    </a>
                                    <a href="{{route('home_page.index')}}">
                                        <button type="button" class="btn btn-warning">
                                            <i ></i>
                                            {{ __('إلغاء') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('Partials.Web._javascript')

