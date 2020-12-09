@extends('Layouts/Admin_app')
@section('title')
    إضـافة عـرض سـياحـي
@endsection
@section('styles')

    .p1{
    background-image: url("{{asset('images/offer-travel.jpg')}}");
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
                    class="glyphicon glyphicon-gift" style="color: orange;"></span>&nbsp;إضـافة عرض سـياحـي</label>
    </div>
    <br>
    @if ($message = Session::get('warning'))
        <div class="alert alert-danger" style="text-align: center" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <span style="font-size: 25px;text-align: center;font-weight: bold">{{ $message }}</span>
        </div>
    @endif
    <div class="well" style="font-size: 30px;font-weight: bold; color: #64AEF7; text-align: center;"><span
                class="glyphicon glyphicon-plane" style="color: orange;"></span>&nbsp;الرحـلـة
    </div><br>
    @if(($allData != null | []) and ($allReturnedData != null | []))
<form action="{{route('Offers.store')}}" method="post">
    {{csrf_field()}}
    <div class="container" style="font-size: 18px;">
        <div style="text-align: center; color:#64AEF7; font-size: 28px;"><label>رحـلـة الذهـاب</label></div>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td></td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">من المدينة
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">إلى المدينة
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">التاريخ
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">الوقت
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">شركة الطيران
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">عدد المقاعد اقتصادية
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">عدد المقاعد السياحية
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">سعرالتذكرة الاقتصادية
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">سعرالتذكرة السياحية
                </td>

            </tr>
            </thead>
            <tbody style="text-align: center;" dir="ltr">

            @foreach($allData as $value)
                <tr>
                    <td><input type="radio" name="flight" value="{{$value['flight_id']}}" {{old('flight') == $value['flight_id'] ? 'checked':''}}></td>

                    <td>{{$value['source_city']}}</td>
                    <td>{{$value['destination_city']}}</td>
                    <td>{{$value['date']}}</td>
                    <td>{{$value['updated_time']}}</td>
                    <td>{{$value['flight_company']}}</td>
                    <td>{{$value['economy_seats_count']}}</td>
                    <td>{{$value['first_class_seats_count']}}</td>
                    <td>{{$value['economy_ticket_price']}}</td>
                    <td>{{$value['first_class_ticket_price']}}</td>
                </tr>
            @endforeach
            </tbody>
            @error('flight')
            <div class="alert alert-danger">يرجى اختيار رحلة الذهاب </div>
            @enderror
        </table>
        <br>
        <hr>
        <br>
        <div style="text-align: center" class="btnstyle"> <a href="{{route('Offers.create')}}"> <button type="button" class="btn " style="color: white; width:215px;height: 41px; background-color:#74828F;font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;عودة إلى إنشاء عرض سياحي </button></a></div><br>

        <div style="text-align: center; color:#64AEF7; font-size: 28px;"><label>رحـلـة العـودة</label></div>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td></td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">من المدينة
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">إلى المدينة
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">التاريخ
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">الوقت
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">شركة الطيران
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">عدد المقاعد اقتصادية
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">عدد المقاعد السياحية
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">سعرالتذكرة الاقتصادية
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">سعرالتذكرة السياحية
                </td>

            </tr>
            </thead>
            <tbody style="text-align: center;" dir="ltr">
            @foreach($allReturnedData as $value)
                <tr>
                    <td><input type="radio" name="returned_flight" value="{{$value['flight_id']}}" {{old('returned_flight') == $value['flight_id'] ? 'checked':''}}></td>

                    <td>{{$value['source_city']}}</td>
                    <td>{{$value['destination_city']}}</td>
                    <td>{{$value['date']}}</td>
                    <td>{{$value['updated_time']}}</td>
                    <td>{{$value['flight_company']}}</td>
                    <td>{{$value['economy_seats_count']}}</td>
                    <td>{{$value['first_class_seats_count']}}</td>
                    <td>{{$value['economy_ticket_price']}}</td>
                    <td>{{$value['first_class_ticket_price']}}</td>
                </tr>
            @endforeach

            </tbody>
            @error('returned_flight')
            <div class="alert alert-danger">يرجى اختيار رحلة العودة </div>
            @enderror
        </table>
        <br>
        <hr>
        <br>
        <div class="row" style="font-size: 25px;">
            <div class="col-md-6 col-xs-12" style="float: right;">
                <label style="color:#64AEF7;"><span class="glyphicon glyphicon-user" style="color: orange;"></span>&nbsp;عـدد
                    المقاعـد</label><br>
                <input type="number" name="seats_count" min="1" max="500" class="form-control" id="usrname" value="{{old('seats_count')}}"
                       placeholder="ادخل  عدد المقاعـد">
                @error('seats_count')
                <div class="alert alert-danger col-xs-6">يرجى تحديد عدد مقاعد الرحلة </div>
                @enderror
            </div>

            <div class="col-md-6 col-xs-12" style="float: right;">
                <label style="color:#64AEF7;"><span class="glyphicon glyphicon-briefcase" style="color: orange;"></span>&nbsp;درجة
                    الرحلـة </label><br>
                <select id="country" name="flight_degree" class="form-control">
                    <option value="">اختر درجة الرحلة</option>
                    @foreach($flightDegrees as $value)
                        <option value="{{$value->id}}" {{ (\Illuminate\Support\Facades\Input::old("flight_degree") == $value->id ? "selected":"") }}>{{$value->name}}</option>
                    @endforeach
                </select>
                @error('flight_degree')
                <div class="alert alert-danger">يرجى اختياردرجة الرحلة </div>
                @enderror
            </div>

            <div class="col-md-6 col-xs-12" style="margin-top: 10px;">
                <label style="color:#64AEF7;"><span class="glyphicon glyphicon-gift" style="color: orange;"></span>&nbsp;مدة
                    الرحلة </label><br>
                <input type="text" name="offer_duration" class="form-control" value="{{old('offer_duration')}}"
                       placeholder="ادخل  مدة الرحلة ">
            </div>

            <div class="col-md-6 col-xs-12" style="margin-top: 10px;">
                <label style="color:#64AEF7;"><span class="glyphicon glyphicon-gift" style="color: orange;"></span>&nbsp;سعر
                    العرض </label><br>
                <input type="text" name="price" id="price" class="col-xs-8 form-control" value="{{old('price')}}"
                       placeholder="ادخل سعرالعرض ">
                <label for="price"
                       class=" col-form-label text-md-right" style="border:2px solid #FFA500;margin: 1px 5px;padding: 1px 6px;border-radius: 5px;font-size: 20px"><span style="color: black">$</span></label>
                @error('price')
                <div class="alert alert-danger col-xs-6">يرجى تحديد سعر العرض</div>
                @enderror

            </div>

        </div>
        <br><br><br></div>
    <div class="well" style="font-size: 30px;font-weight: bold; color: #64AEF7; text-align: center;"><span
                class="glyphicon glyphicon-lamp" style="color: orange;"></span>&nbsp;الفنـدق
    </div><br>
    <div class="container" style="font-size: 18px;">

        <div style="text-align: center; color:#64AEF7; font-size: 28px;"><label>قـائـمـة الفـنـادق</label></div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td></td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">الفندق
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">البلد
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">المدينة
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">اسم الغرفة
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">النوع
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">عدد الاشخاص
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 20px;width: 200px; color: white; background-color: #64AEF7;">تكلفة الليلة
                </td>
            </tr>
            </thead>
            <tbody style="text-align: center;" dir="ltr">
            @foreach($allHotelData as $value)
                <tr>
                    {{--<td><input type="radio" name="room" value="{{$value['hotel_room_id']}}"  {{old('room') == $value['hotel_room_id'] ? 'checked':''}}></td>--}}
                    <td><input type="checkbox" name="rooms[]" value="{{$value['hotel_room_id']}}"/></td>
                    <td>{{$value['hotel']}}</td>
                    <td>{{$value['country']}}</td>
                    <td>{{$value['city']}}</td>
                    <td>{{$value['hotel_room']}}</td>
                    <td>{{$value['hotel_room_type']}}</td>
                    <td>{{$value['customers_count']}}</td>
                    <td>${{$value['night_price']}}</td>
                </tr>
            @endforeach
            </tbody>
            @error('rooms')
            <div class="alert alert-danger">يرجى اختيار رحلة الفندق </div>
            @enderror
        </table>
        <br>
        <hr>
        <br>
    </div>
    <div class="well" style="font-size: 30px;font-weight: bold; color: #64AEF7; text-align: center;"><span
                class="glyphicon glyphicon-gift" style="color: orange;"></span>&nbsp;الـعـرض
    </div><br>
    <div class="container" style="font-size: 18px;">
        <div class="col-md-6 col-xs-12" style="float: right;">
            <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                <div class="form-group ">
                    <label for="usr">عدد المسافرين</label>
                    <input type="number" name="customers_count" min="1" max="500" class="form-control" id="usr" placeholder="أدخــل  عدد المسافرين"
                        value="{{old('customers_count')}}"   style="font-size: 20px; color: black;">
                </div>
                @error('customers_count')
                <div class="alert alert-danger">يرجى تحديدعدد المسافرين </div>
                @enderror
                <div class="form-group ">
                    <label for="usr">التفاصيل</label>
                    <textarea class="form-control" name="details" placeholder="تفاصيل العرض"
                               style="text-align: right; font-size:20px; color: black;" rows="4"> {{old('details')}}</textarea>
                </div>
                <button type="submit" class="btn btn-info"
                        style="color: white; width: 100px;height: 40px; font-size: 20px;"><span
                            class="glyphicon glyphicon-floppy-save" style="color: orange;"></span>&nbsp;حــفــظ
                </button>
                <a href="{{route('Offers.index')}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

            </div>
        </div>
    </div>
</form>
    @else
        <div class="alert alert-warning" style="text-align: center "  role="alert">
            <span style="font-size: 25px;text-align: center;font-weight: bold"> لاتوجد نتائج </span>

        </div>
        <div style="text-align: center" class="btnstyle"> <a href="{{route('Offers.create')}}"> <button type="button" class="btn " style="color: white; width:215px;height: 41px; background-color:#74828F;font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;عودة </button></a></div><br>

    @endif
    <br>
@endsection