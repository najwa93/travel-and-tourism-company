@extends('Layouts.Admin_app')
@section('title')
    تعديـل شـركة طيـران
@endsection
@section('styles')

    .p1{
    background-image:  url("{{asset('images/latravel1.jpg')}}");
    width: 100%;
    height: 300px;
    background-size:cover;
    overflow-y: auto;
    overflow-x: auto;
    background-position: center;
    background-repeat: no-repeat;
    margin-top: -1px;
    opacity: 0.9;
    }

    </head>
@endsection

@section('content')
    <div class="p1"><label
                style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span
                    class="glyphicon glyphicon-globe" style="color: orange;"></span>&nbsp;إضـافـة شـركة طيـران
            جـديـدة</label></div>
    <br>
    <div class="container">
        <div class="col-md-6 col-xs-12" style="float: right;">
            <label style=" font-size: 25px;
    color:#64AEF7; font-weight: bold;"><span class="glyphicon glyphicon-download" style="color: orange;"></span>&nbsp;تـعديل
                شـركة طيران </label>
            <hr>
            <br>
            <br>
            <form action="{{route('FlightCompany.update',$flightCompany->id)}}" method="POST">
                {{csrf_field()}}
                @method('PUT')
                <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                    <div class="form-group ">
                        <label for="usr">اسـم شـركة الطيـران</label>
                        <input type="text" class="form-control" id="usr" name="name" value="{{$flightCompany->name}}"
                               placeholder="أدخــل اســم  شـركة الطيران" style="font-size: 22px; scolor: black;">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">يرجى إدخال اسم شركة الطيران </div>
                    @enderror
                    <br>
                    <div class="form-group ">
                        <label for="usr">البريد الالكتروني</label>
                        <input type="email" class="form-control" id="usr" name="email" value="{{$flightCompany->email}}"
                               placeholder="أدخــل  البريد الالكتروني" style="font-size: 22px; color: black;">
                    </div>
                    <br>
                    <div class="form-group ">
                        <label for="usr">رقـم الهاتـف</label>
                        <input type="text" class="form-control" id="usr" name="phone_number"
                               value="{{$flightCompany->phone_number}}" placeholder="أدخــل  رقم الهاتـف"
                               style="font-size: 22px; color: black;">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-info"
                            style="color: white; width: 100px;height: 40px; font-size: 20px;"><span
                                class="glyphicon glyphicon-floppy-save" style="color: orange;"></span>&nbsp;تـعديـل
                    </button>
                    <a href="{{route('Flights.index')}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

                </div>
            </form>
        </div>
    </div>
    <br>
    <br>
@endsection