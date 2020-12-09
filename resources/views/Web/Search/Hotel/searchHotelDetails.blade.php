@extends('Layouts.Web_app')

@section('styles')
    .panel-body h4 {
        font-weight: bold;
    }

    .panel-s{
      padding: 15px 30px;
    }

    .slick-prev:before, .slick-next:before{
        color: #64AEF7;!important;
    }

    .modal-style{
        margin-top: 100px;
    }

    .panel-group{
     margin-top:20px;
    }
@endsection
@section('content')
    <div class="container">
            {{csrf_field()}}
            <div class="details col-md-12">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading"> <h2 style="font-weight: bold;color: #64AEF7;">تفاصيل الفندق</h2></div>
                        <div class="panel-body panel-s">
                            <h1 style="color: #FFA500;font-weight: bold;margin-bottom: 20px"> {{$hotel->name}}</h1>
                            <h3 style="font-weight: bold"><span style="color: #FFA500;font-weight: bold;margin-bottom: 20px">   عدد النجوم :</span> {{$hotel->stars}} نجوم</h3>
                            <h3><span style="color: #FFA500;font-weight: bold;margin-bottom: 20px">   صور من الفندق :</span></h3>
                            @if($hotel->hotelImage != null)
                            <div class="autoplay">
                                @foreach($hotel->hotelImage as $img)
                                    <img src="{{url($img->img_path)}}"
                                         style="width: 250px;height: 200px; margin: 10px" alt="hotel Image">
                                @endforeach
                            </div>
                            @endif
                            <h3 style="color: #FFA500;font-weight: bold;margin-bottom: 20px">  معلومات عن الفندق :</h3><h4 style="font-weight: bold"> {{$hotel->details}}</h4>
                            <h3 style="color: #FFA500;font-weight: bold;margin-bottom: 20px">  تفاصيل الغرفة :</h3><h4 style="font-weight: bold"> {{$room->details}}</h4><br/>
                            <a href="{{$hotel->location}}" class="btn btn-success" target="_blank" style="font-size: 17px;font-weight: bold">استعراض موقع الفندق</a>
                        </div>
                        <div class="buttons" style="margin: 20px;">
                        <a href="{{ route('hotelReservation',['hotel' => $hotel->id,'room' => $room->id])}}"><button type="button" class="btn btn-info"  name="btnsave" style="color: white; height: 40px; font-size: 20px;"><span class="glyphicon glyphicon-floppy-save" style="color: orange;"></span>&nbsp;احجز الاّن</button></a>
                            <a href="{{ route('home_page.index')}}"><button type="submit" class="btn btn-info" name="btnsave" style="color: white; height: 40px; font-size: 20px;"><span class="glyphicon glyphicon-remove" style="color: orange;"></span>&nbsp;الغاء</button></a>
                        </div>
                    </div>

                </div>
            </div>
    </div>

@endsection

@include('Partials.Web._jquery')
<script>

    $(document).ready(function () {
        $('.autoplay').slick({
            rtl: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: true,
            autoplaySpeed: 2000,
            arrows: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]
        });
    });


</script>
