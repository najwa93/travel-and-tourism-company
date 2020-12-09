@extends('Layouts/Admin_app')

@section('title')
    إدارةغـرف الفنـادق
@endsection

@section('styles')
    .p1{
    background-image: url("{{asset('images/hotel.jpg')}}");
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
                    class="glyphicon glyphicon-cutlery" style="color: orange;"></span>&nbsp;إدارة غـرف الـفـنادق</label>
    </div>
    <br> <br>
    <div class="well" style="font-size: 25px; color: #64AEF7; text-align: center;"><span class="glyphicon glyphicon-bed" style="color: orange;"></span>&nbsp;{{$hotel->name}}</div>

    <div class="container">
        <a href="{{route('GetRoom.create',$hotel->id)}}" style="text-decoration:none ;">
            <button type="button" class="btn btn-block"
                    style="background-color:#64AEF7; color: white; height: 40px; font-size: 22px; font-weight: bold;">
                <span class="glyphicon glyphicon-plus" style="color: orange;"></span>&nbsp;&nbsp;إضــافــة غـرفــة
                جــديــدة
            </button>
        </a>
        <br><br>

        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="text-align: center" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span style="font-size: 25px;text-align: center;font-weight: bold">{{ $message }}</span>
            </div>
        @endif
        <div style="text-align: center; color:#64AEF7; font-size: 28px;"><label><span class="glyphicon glyphicon-lamp"
                                                                                      style="color: orange;"></span>&nbsp;&nbsp;الـغـرف
                الـمـتـوفــرة</label></div>
        <!-- Table -->
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td class="text-center" style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">
                    الاســم
                </td>
                <td class="text-center" style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">
                    النـوع
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">عـدد الأشـخاص
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">التـفـاصـيل
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">الـتـكـلـفة
                </td>
                <td class="text-center col-xs-4"
                    style="font-size: 18px;width: 300px; color: white;background-color: #64AEF7">خــيــارات
                </td>

            </tr>
            </thead>
            <tbody style="text-align: center;" dir="ltr">
            @foreach($allData as $value)
                <tr>
                    <td>{{$value['hotel_room']}}</td>
                    <td>{{$value['hotel_room_type']}}</td>
                    <td>{{$value['customers_count']}}</td>
                    <td style="direction: rtl">{{$value['details']}}</td>
                    <td>${{$value['night_price']}}</td>
                    <td>
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <a href="{{route('Rooms.edit',$value['hotel_room_id'])}}">
                                    <button type="button" class="btn btn-warning">تعديل</button>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div style="text-align: center" class="btnstyle"> <a href="{{route('Hotels.index')}}"> <button type="button" class="btn " style="color: white; width:200px;height: 41px; background-color:#74828F;font-size: 18px;padding: 4px ;font-weight: bold">&nbsp;عودة إلى قائمة الفندق </button></a></div><br>

@endsection