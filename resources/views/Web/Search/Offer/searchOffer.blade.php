@extends('Layouts.Web_app')

@section('styles')

    .p1 {
    margin-top: 0;
    background-image: url('{{asset("images/reservation.png")}}');
    background-size: cover;
    height: 600px;
    overflow-y: auto;
    overflow-x: auto;
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    }

    .p2 {
    padding-top: 5px;
    font-family: Arial;
    font-style: italic;
    font-size: 38px;
    color: #64AEF7;
    font-weight: bold;
    }

    #myTable {
    width: 100%; /* Full-width */
    font-size: 20px; /* Increase font-size */
    color: white;
    }

    .table tr th{
    font-size:25px;
    color: #FFA500;
    text-align:center;
    }

    .table tr td{
    text-align:center;
    font-size:19px;
    color: #263859;
    font-weight:bold;
    }
@endsection

@section('content')
    <div class="p1">
        <div class="well" style="font-size: 25px;font-weight: bold; color: #64AEF7; text-align: center;"><span class="glyphicon glyphicon-user" style="color: orange;"></span>&nbsp;قائمة رحلات الطيران
        </div>
        <div class="container" style="color: #64AEF7; font-size: 20px;">
            @if($searched_data != null | [])
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">البلد</th>
                    <th scope="col">المدينة</th>
                    <th scope="col">التاريخ</th>
                    <th scope="col">سعر العرض</th>
                    <th scope="col">الفندق</th>
                    <th scope="col">نوع الغرفة</th>
                    <th>التفاصيل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($searched_data as $offer)
                    <tr>
                        <td>{{$offer['country']}}</td>
                        <td>{{$offer['destination_city']}}</td>
                        <td>{{$offer['date']}}</td>
                        <td>${{$offer['price']}}</td>
                        <td>{{$offer['room']->hotel->name}}</td>
                        <td>{{$offer['room']->room_type->name}}</td>
                        <th scope="col"><a href="{{route('offerDetails',['offer' => $offer['offer_id'],'flight' => $offer['flight_id']])}}"><button type="button" class="btn btn-warning" style="color: white; width: 120px;height: 35px; font-size: 20px;padding: 4px ">&nbsp;التفاصيل</button></a><br>
                    </tr>

                @endforeach
                </tbody>
            </table>
                @else
                    <div class="alert alert-warning" style="text-align: center "  role="alert">
                        <span style="font-size: 25px;text-align: center;font-weight: bold"> لاتوجد نتائج </span>
                    </div>
                @endif
                <div class="col-sm" style="margin-top: 100px;text-align: center"><a href="{{route('home_page.index')}}"> <button type="submit" class="btn btn-success" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;العودة</button></a><br>

                    <br>
            <br>
        </div>
    </div>
    <br>

@endsection

@include('Partials.Web._javascript')