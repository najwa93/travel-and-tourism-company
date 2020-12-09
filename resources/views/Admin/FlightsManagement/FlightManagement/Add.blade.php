@extends('Layouts.Admin_app')
@section('title')
    إضافة رحلـة طيـران جـديـدة
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
                    class="glyphicon glyphicon-globe" style="color: orange;"></span>&nbsp;إضـافـة رحلة طيـران
            جـديـدة</label></div>
    <br>
    <br>
    <div class="container">

        <label style=" font-size: 25px;
    color:#64AEF7; font-weight: bold;"><span class="glyphicon glyphicon-list" style="color: orange;"></span>&nbsp;امـلأ
            الـنـمـوذج الـتـالــي لإضــافـة رحـلـة إلـى قـائـمـة رحـلات الـطيـران المـتوفرة </label>
        <hr>
        <br>
        <br>
        <form action="{{route('Flights.store')}}" method="POST">
            {{csrf_field()}}
            <div class="col-md-6 col-xs-12" style="float: right;">
                <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                    <div class="form-group ">
                        <label for="usr">مـن المـديـنة </label>
                        <select name="source_city" id="city1" class="form-control">
                            <option value="">اختر مدينة</option>
                            @foreach($cities as $key => $value)
                                <option value="{{$key}}" {{ (\Illuminate\Support\Facades\Input::old("source_city") == $key ? "selected":"") }}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('source_city')
                    <div class="alert alert-danger">يرجى اختيار اسم المدينة </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">إلـى المـديـنة </label>
                        <select name="dist_city" id="city2" class="form-control">
                            <option value="">اختر مدينة</option>
                            @foreach($cities as $key => $value)
                                <option value="{{$key}}" {{ (\Illuminate\Support\Facades\Input::old("dist_city") == $key ? "selected":"") }}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('dist_city')
                    <div class="alert alert-danger">يرجى اختيار اسم المدينة </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">شـركـة الطـيران</label>
                        <select name="flight_company" id="filghtcompany" class="form-control">
                            <option value="">اختر شركة طيران</option>
                            @foreach($flightCompanies as $key => $value)
                                <option value="{{$key}}" {{ (\Illuminate\Support\Facades\Input::old("flight_company") == $key ? "selected":"") }}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('flight_company')
                    <div class="alert alert-danger">يرجى اختيار شركة الطيران </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">عـدد مقاعـد الدرجة الاقتصادية</label>
                        <input type="text" class="form-control" id="usr" name="economy_seats_count"
                               placeholder="عـدد مقاعـد الدرجة الاقتصادية"  value="{{old('economy_seats_count')}}" style="font-size: 20px; color: black;">
                    </div>
                    @error('economy_seats_count')
                    <div class="alert alert-danger">يرجى ادخال عدد مقاعد الدرجة الاقتصادية </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">عـدد مقاعـد الدرجة السياحية</label>
                        <input type="text" class="form-control" id="usr" name="first_class_seats_count"
                               placeholder="عـدد مقاعـد الدرجة السياحية" value="{{old('first_class_seats_count')}}" style="font-size: 20px; color: black;">
                    </div>
                    @error('first_class_seats_count')
                    <div class="alert alert-danger">يرجى ادخال عدد مقاعد الدرجةالسياحية </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">التاريـخ</label>
                        {{--<input type="date" class="form-control" id="usr" name="date" placeholder="تاريـخ الرحـلـة"
                               style="font-size: 20px; color: black;">--}}
                        <input type="text" class="form-control" id="datepicker" name="datepicker" value="{{old('datepicker')}}">

                    </div>
                    @error('datepicker')
                    <div class="alert alert-danger">يرجى اختيار التاريخ </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">الـوقـت</label>
                        <input type="time" class="form-control" id="usr" name="time" value="{{old('time')}}" placeholder="وقـت الرحـلـة"
                               style="font-size: 20px; color: black;">
                    </div>
                    @error('time')
                    <div class="alert alert-danger">يرجى اختيار الوقت </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">مـدة الرحـلة</label>
                        <input type="text" class="form-control" id="usr" name="duration" value="{{old('duration')}}" placeholder="مـدة الرحـلة"
                               style="font-size: 20px; color: black;">
                    </div>
                    @error('duration')
                    <div class="alert alert-danger">يرجى ادخال مدة الرحلة </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">سعر التذكرة الدرجة الاقتصادية</label><br/>
                        <input type="text" class="col-xs-8 col-md-10 form-control" id="usr" name="economy_ticket_price"
                               placeholder="سعر التذكرة الدرجة الاقتصادية" value="{{old('economy_ticket_price')}}" style="font-size: 20px; color: black;"><label for="credit" class=" col-form-label text-md-right" style="border:2px solid #FFA500;margin: 1px 5px;padding: 1px 6px;border-radius: 5px;font-size: 20px"><span style="color: black">$</span></label>

                    </div>
                    @error('economy_ticket_price')
                    <div class="alert alert-danger">يرجى ادخال سعر التذكرة </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">سعر التذكرة الدرجة السياحية</label><br/>
                        <input type="text" class="col-xs-8 col-md-10 form-control" id="usr" name="first_class_ticket_price"
                               placeholder="سعر التذكرة الدرجة السياحية" value="{{old('first_class_ticket_price')}}" style="font-size: 20px; color: black;"><label for="credit" class=" col-form-label text-md-right" style="border:2px solid #FFA500;margin: 1px 5px;padding: 1px 6px;border-radius: 5px;font-size: 20px"><span style="color: black">$</span></label>
                    </div>
                    @error('first_class_ticket_price')
                    <div class="alert alert-danger">يرجى ادخال سعر التذكرة </div>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-info"
                            style="color: white; width: 100px;height: 40px; font-size: 20px;"><span
                                class="glyphicon glyphicon-floppy-save" style="color: orange;"></span>&nbsp;إضـافــة
                    </button>
                    <a href="{{route('Flights.index')}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

                </div>
            </div>
        </form>
    </div>
    <br>
    <br>
@endsection