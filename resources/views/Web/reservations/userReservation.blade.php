@extends('layouts.Web_app')
@section('title','قائمة الحجوزات')
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

    .table{
    margin-bottom:60px;
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
        <div class="well" style="font-size: 25px;font-weight: bold; color: #64AEF7; text-align: center;"><span
                    class="glyphicon glyphicon-user" style="color: orange;"></span>&nbsp;قائمة الحجوزات
    </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="text-align: center" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span style="font-size: 25px;text-align: center;font-weight: bold"> {{ $message  }}</span>
            </div>
        @endif
        <div class="container" style="color: #64AEF7; font-size: 20px;">
            <h2 style="font-weight: bold;color:black;text-align: center;margin-bottom: 30px">الحجز الفندقي</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">اسم الفندق</th>
                    <th scope="col">المدينة</th>
                    <th scope="col">نوع الغرفة</th>
                    <th scope="col">عدد الأشخاص</th>
                    <th scope="col">التفاصيل</th>
                    <th scope="col">تكلفة الليلة</th>
                    <th scope="col">يشمل العرض</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allData['hotelReservation'] as $reservation)
                    <tr>
                        <td>{{$reservation['hotel']}}</td>
                        <td>{{$reservation['city']}}</td>
                        <td>{{$reservation['room_type']}}</td>
                        <td>{{$reservation['customers_count']}}</td>
                        <td>{{$reservation['room_details']}}</td>
                        <td>${{$reservation['night_price']}}</td>
                        @if($reservation['offer_id'] != null)
                            <td><i class="fas fa-user-check"></i></td>
                        @else
                            <td></td>
                        @endif
                        {{--
                                                <th scope="col"><a href="{{route('deleteHotelReservation',$reservation['hotel_reservation_id'])}}" class="btn btn-danger" onclick="return confirm('هل تريد بالتأكيد القيام بعملة الحذف؟')"> إلغاء الحجز</a><br>
                        --}}
                        <td scope="col">
                            <form method="POST"
                                  action="{{route('deleteHotelReservation',$reservation['hotel_reservation_id'])}}">
                                {{ csrf_field() }}

                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('هل تريد بالتأكيد القيام بعملة الحذف؟')">إلغاء الحجز
                                </button>

                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            <h2 style="font-weight: bold;color:black;text-align: center;margin-bottom: 30px">حجز رحلات الطيران</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">من المدينة</th>
                    <th scope="col">إلى المدينة</th>
                    <th scope="col">التاريخ</th>
                    <th scope="col">الوقت</th>
                    <th scope="col">نوع التذكرة</th>
                    <th scope="col">سعرالتذكرة</th>
                    <th scope="col">يشمل العرض</th>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($allData['flightReservation'] as $reservation)
                    <tr>
                        <td>{{$reservation['source_city']}}</td>
                        <td>{{$reservation['destination_city']}}</td>
                        <td>{{$reservation['date']}}</td>
                        <td>{{$reservation['time']}}</td>
                        <td>{{$reservation['flight_degree']}}</td>
                        <td>${{$reservation['reservation_price']}}</td>
                        @if($reservation['offer_id'] != null)
                            <td><i class="fas fa-user-check"></i></td>
                        @else
                            <td></td>
                        @endif
                        {{--
                                                <th scope="col"><a href="{{route('deleteFlightReservation',$reservation['flight_reservation_id'])}}" class="btn btn-danger" onclick="return confirm('هل تريد بالتأكيد القيام بعملة الحذف؟')"> إلغاء الحجز</a><br>
                        --}}
                        <td scope="col">
                            <form method="POST"
                                  action="{{route('deleteFlightReservation',$reservation['flight_reservation_id'])}}">
                                {{ csrf_field() }}

                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('هل تريد بالتأكيد القيام بعملة الحذف؟')">إلغاء الحجز
                                </button>

                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <br>

            <br>
            <br>
        </div>
    </div>
    <br>
@endsection

@include('Partials.Web._javascript')
{{--
<script>
    function myFunction() {
        alert("هل تريد بالتأكيد القيام بعملية الحذف؟")
    }
</script>
--}}


