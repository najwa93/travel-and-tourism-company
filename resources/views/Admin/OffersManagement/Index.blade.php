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
                    class="glyphicon glyphicon-gift" style="color: orange;"></span>&nbsp;إدارة العروض السـياحية</label>
    </div>
    <br>
    <div class="container">
        <br>
        <a href="{{route('Offers.create')}}" style="text-decoration:none ;">
            <button type="button" class="btn btn-block"
                    style="background-color:#64AEF7; color: white; height: 40px; font-size: 22px; font-weight: bold;">
                <span class="glyphicon glyphicon-plus" style="color: orange;"></span>&nbsp;&nbsp;إنشـاء عـرض سياحي
                جــديــد
            </button>
        </a>
        <br>
        <hr>
        <br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="text-align: center" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span style="font-size: 25px;text-align: center;font-weight: bold">{{ $message }}</span>
            </div>
        @endif
        <div style="text-align: center; color:#64AEF7; font-size: 28px;"><label>&nbsp;&nbsp;قــائـــمـــة العروض
                السياحية</label></div>
        <!-- Table -->
        <table class="table table-striped table-bordered" id="myTable">
            <tr class="header">
                <th class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">من المدينة
                </th>
                <th class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">إلى المدينة
                </th>
                <th class="text-center col-xs-8" style="font-size: 18px; color: white;background-color: #64AEF7">
                    خــيــارات
                </th>

            </tr>
            <tbody style="text-align: center;">
            @foreach($allData as $value)
                <tr>
                    <td>{{$value['source_city']}}</td>
                    <td>{{$value['destination_city']}}</td>
                    <td>
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <a href="{{route('Offers.delete',$value['offer_id'])}}">
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </a>
                            </div>
                            <div class="btn-group" role="group">
                                <a href="{{route('Offers.edit',$value['offer_id'])}}">
                                    <button type="submit" class="btn btn-warning">تعديل</button>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div style="text-align: center" class="btnstyle"> <a href="{{route('Main.index')}}"> <button type="button" class="btn " style="color: white; width:215px;height: 41px; background-color:#74828F;font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;عودة إلى إدارة الموقع </button></a></div><br>

@endsection