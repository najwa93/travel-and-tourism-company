
@extends('Layouts/Admin_app')
@section('title')
   حـذف مديـنـة
@endsection
@section('styles')

    .p1{
    background-image: url("{{asset('images/globe.jpg')}}");
    width: 100%;
    height: 300px;
    background-size:cover;
    overflow-y: auto;
    overflow-x: auto;
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    margin-top: -1px;
    opacity: 0.9;
    }
@endsection


<form action="{{route('Cities.destroy',$city->id)}}" method="POST" >
    {{csrf_field()}}
    @method('DELETE')
    <div class="p1"><label
                style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span
                    class="glyphicon glyphicon-remove" style="color: orange;"></span>&nbsp;حذف مدينة
           </label></div>
    <br>
    <br>
    <div class="container">
        <div class="col-md-6 col-xs-12" style="float: right;">
            <label style=" font-size: 25px;
    color:#f73917; font-weight: bold;"><span class="glyphicon glyphicon-remove" style="color:#f73917"></span>&nbsp; هل تـريـد بالتأكيد القيـام بعملـية حـذف مدينة ؟</label>
            <br>
            <br>
            <br>

            <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                <div class="form-group ">
                    <label for="usr">اســم الـمـديـنـة</label>
                    <input type="text" class="form-control" name="cityname" placeholder="أدخــل اســم الـمــديــنــة"
                           value="{{$city->name}}" style="font-size: 22px; color: black;" readonly>
                </div>
                <div class="form-group ">
                    <label for="usr">عــن الـمـديـنـة</label>
                    <textarea class="form-control" name="aboutcity" placeholder="أدخــل مـعـلـومـات عـن الـمــديـنـة" style="text-align:right;font-size:22px; color: black;" rows="4" readonly>{{$city->description}}</textarea>
                </div>
                <div class="form-group ">
                    <label for="usr">مـوقــع الـمـديـنـة</label>
                    <input type="text" class="form-control" name="location" id="usr"
                           placeholder="أدخـل مـوقـع الـمــديــنــة مــن خـرائــط غـوغـل"
                           value="{{$city->city_location}}" style="font-size: 22px; color: black;" readonly>
                </div>

                <div class="form-group">
                    <label for="flag">صـور مـن الـمـديـنـة</label>
                    <div class="panel-body">
                        @foreach($cityImgs as $cityImg)
                            <img src="{{url($cityImg->img_path)}}" >
                        @endforeach
                    </div>
                </div>

                <br>
                <button type="submit" class="btn btn-info" name="btnsave"
                        style="color: white; width: 100px;height: 40px; font-size: 20px;"><span
                            class="glyphicon glyphicon-remove" style="color: #ff3928;"></span>&nbsp;حذف
                </button>
                <a href="{{route('Countries.show',$city->country_id)}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

            </div>
        </div>
    </div>
</form>
<br>
<br>

