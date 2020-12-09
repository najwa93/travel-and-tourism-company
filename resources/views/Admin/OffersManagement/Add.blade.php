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
    <div class="well" style="font-size: 25px;font-weight: bold; color: #64AEF7; text-align: center;"><span
                class="glyphicon glyphicon-gift" style="color: orange;"></span>&nbsp; العرض الســيـاحـي
    </div><br>

    <div class="container" style="font-size: 20px;">
        <div class="row">
            <form action="{{route('completeOffer')}}" method="get">
                {{csrf_field()}}
                <div class="card col-md-5 col-xs-12" style="background-color: #64AEF7; color: white;float: right; ">
                    <div class="panel-heading" style="text-align: center;">
                        <h3><span class="glyphicon glyphicon-globe" style="color: orange;"></span>&nbsp;مـن المـدينة
                        </h3>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <label>البـلـد</label>
                        <select name="country" id="country" class="form-control">
                            <option value="">اختـرالبلـد</option>
                            @foreach($countries as $key => $value)
                                <option value="{{$key}}" {{ (\Illuminate\Support\Facades\Input::old("country") == $key ? "selected":"") }}>{{$value}}</option>
                            @endforeach
                        </select>
                        @error('country')
                        <div class="alert alert-danger">يرجى اختيار اسم البلد</div>
                        @enderror
                        <label>المـدينة</label>
                        <select name="city" id="city" class="form-control">
                            <option value="" >City</option>
                        </select>
                        @error('city')
                        <div class="alert alert-danger">يرجى اختيار اسم المدينة</div>
                        @enderror
                    </div>
                </div>


                <div class="panel col-md-5 col-xs-12" style="background-color: #64AEF7; color: white; float: left;">
                    <div class="panel-heading" style="text-align: center;">
                        <h3><span class="glyphicon glyphicon-globe" style="color: orange;"></span>&nbsp;إلـى المـدينة
                        </h3>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <label>البـلـد</label>
                        <select name="destcountry" id="country" class="form-control">
                            <option value="">اختـرالبلـد</option>
                            @foreach($countries as $key => $value)
                                <option value="{{$key}}" {{ (\Illuminate\Support\Facades\Input::old("destcountry") == $key ? "selected":"") }}>{{$value}}</option>
                            @endforeach
                        </select>
                        @error('destcountry')
                        <div class="alert alert-danger">يرجى اختيار اسم البلد</div>
                        @enderror
                        <label>المـدينة</label>
                        <select name="destcity" id="city" class="form-control">
                            <option value="">City</option>
                        </select>
                        @error('destcity')
                        <div class="alert alert-danger">يرجى اختيار اسم المدينة</div>
                        @enderror
                    </div>

                </div>
        </div>
        <br>
        <center>
            <button type="submit" class="btn btn-lg"
                    style="background-color:#64AEF7; color: white; height: 45px; font-size: 22px; font-weight: bold;">
                <span class="glyphicon glyphicon-arrow-right" style="color: orange;"></span>&nbsp;&nbsp;مـتـابعـة ..
            </button>
            <div style="text-align: center" class="btnstyle"> <a href="{{route('Offers.index')}}"> <button type="button" class="btn " style="color: white;height: 41px; background-color:#74828F;font-size: 20px;padding: 4px ;font-weight: bold;margin-top: 20px;width: 100px">&nbsp;عودة </button></a></div><br>

        </center>
        </form>

    </div>
    <br>
@endsection