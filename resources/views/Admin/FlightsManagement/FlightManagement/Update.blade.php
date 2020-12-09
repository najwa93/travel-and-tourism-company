@extends('Layouts.Admin_app')
@section('title')
    تـعديـل رحلـة طـيـران
@endsection
@section('styles')

    .p1{
    background-image: url("{{asset('images/latravel1.jpg')}}");
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
@endsection

@section('content')
    <div class="p1"><label
                style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span
                    class="glyphicon glyphicon-pencil" style="color: orange;"></span>&nbsp;تـعديـل رحلة طيـران
            جـديـدة</label></div>
    <br>
    <br>
    <div class="container">

        <label style=" font-size: 25px;
    color:#64AEF7; font-weight: bold;"><span class="glyphicon glyphicon-pencil" style="color: orange;"></span>&nbsp;تـعديـل
            رحـلة طـيران </label>
        <hr>
        <br>
        <br>
        <form action="{{route('Flights.update',$flight->id)}}" method="post">
            {{csrf_field()}}
            @method('PUT')
            <div class="col-md-6 col-xs-12" style="float: right;">
                <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                    <div class="form-group ">
                        <label for="usr">مـن المـديـنة </label>
                        <select name="source_city" id="city1" class="form-control">
                            @foreach($cities as $key => $value)
                                <option {{$key == $flight->source_city_id?'selected="selected"':''}} value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('source_city')
                    <div class="alert alert-danger">يرجى اختيار اسم المدينة </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">إلـى المـديـنة </label>
                        <select name="dist_city" id="city2" class="form-control">
                            @foreach($cities as $key => $value)
                                <option {{$key == $flight->destination_city_id?'selected="selected"':''}} value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('dist_city')
                    <div class="alert alert-danger">يرجى اختيار اسم المدينة </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">شـركـة الطـيران</label>
                        <select name="flight_company" id="filghtcompany" class="form-control">
                            @foreach($flightCompanies as $key => $value)
                                <option {{$key == $flight->flight_company_id?'selected="selected"':''}} value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('flight_company')
                    <div class="alert alert-danger">يرجى اختيار شركة الطيران </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">عـدد مقاعـد الدرجة الاقتصادية</label>
                        <input type="text" class="form-control" id="usr" name="economy_seats_count"
                               value="{{$flight->economy_seats_count}}" placeholder="عـدد مقاعـد الدرجة الاقتصادية"
                               style="font-size: 20px; color: black;">
                    </div>
                    @error('economy_seats_count')
                    <div class="alert alert-danger">يرجى ادخال عدد مقاعد الدرجة الاقتصادية </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">عـدد مقاعـد الدرجة السياحية</label>
                        <input type="text" class="form-control" id="usr" name="first_class_seats_count"
                               value="{{$flight->first_class_seats_count}}" placeholder="عـدد مقاعـد الدرجة السياحية"
                               style="font-size: 20px; color: black;">
                    </div>
                    @error('first_class_seats_count')
                    <div class="alert alert-danger">يرجى ادخال عدد مقاعد الدرجةالسياحية </div>
                    @enderror
                    <div class="form-group ">
                        <label for="datepicker">التاريـخ</label>
                        {{--<input type="date" class="form-control" id="usr" name="date" placeholder="تاريـخ الرحـلـة"
                               style="font-size: 20px; color: black;">--}}
                        <input type="text" class="form-control" id="datepicker" name="datepicker" value="{{$flight->date}}">

                    </div>
                    @error('datepicker')
                    <div class="alert alert-danger">يرجى اختيار التاريخ </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">الـوقـت</label>
                        <input type="time" class="form-control" id="usr" name="time" value="{{$flight->time}}"
                               placeholder="وقـت الرحـلـة" style="font-size: 20px; color: black;">
                    </div>
                    @error('time')
                    <div class="alert alert-danger">يرجى اختيار الوقت </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">مـدة الرحـلة</label>
                        <input type="text" class="form-control" id="usr" name="duration"
                               value="{{$flight->flight_duration}}" placeholder="مـدة الرحـلة"
                               style="font-size: 20px; color: black;">
                    </div>
                    @error('duration')
                    <div class="alert alert-danger">يرجى ادخال مدة الرحلة </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">سعر التذكرة الدرجة الاقتصادية</label>
                        <input type="text" class="form-control" id="usr" name="economy_ticket_price"
                               value="{{$flight->economy_ticket_price}}" placeholder="سعر التذكرة الدرجة الاقتصادية"
                               style="font-size: 20px; color: black;">
                    </div>
                    @error('economy_ticket_price')
                    <div class="alert alert-danger">يرجى ادخال سعر التذكرة </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">سعر التذكرة الدرجة السياحية</label>
                        <input type="text" class="form-control" id="usr" name="first_class_ticket_price"
                               value="{{$flight->first_class_ticket_price}}" placeholder="سعر التذكرة الدرجة السياحية"
                               style="font-size: 20px; color: black;">
                    </div>
                    @error('first_class_ticket_price')
                    <div class="alert alert-danger">يرجى ادخال سعر التذكرة </div>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-info"
                            style="color: white; width: 100px;height: 40px; font-size: 20px;"><span
                                class="glyphicon glyphicon-floppy-save" style="color: orange;"></span>&nbsp;تـعديـل
                    </button>
                    <a href="{{route('Flights.index')}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

                </div>
            </div>
        </form>
    </div>
    <br>
    <br>
@endsection