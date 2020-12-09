
@extends('Layouts/Admin_app')
@section('title')
    إضـافـة مـديـنـة جـديـدة
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


<form action="{{route('StoreCity.store',$country->id)}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="p1"><label style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span class="glyphicon glyphicon-globe" style="color: orange;"></span>&nbsp;إضـافـة مـديـنـة جـديـدة</label></div>
    <br>
    <br>
    <div class="container">
        <div class="col-md-6 col-xs-12" style="float: right;">
            <label style=" font-size: 25px;
    color:#64AEF7; font-weight: bold;"><span class="glyphicon glyphicon-download" style="color: orange;"></span>&nbsp;أضــف  مـديــنــة  إلــى قــائـمـة الــمــدن  الـمـتـاحـة</label>
            <br>
            <br>
            <br>
            @if ($message = Session::get('error'))
                <div class="alert alert-danger" style="text-align: center" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span style="font-size: 25px;text-align: center;font-weight: bold">{{ $message }}</span>
                </div>
            @endif
                <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                    <div class="form-group ">
                        <label for="usr">اســم الـمـديـنـة</label>
                        <input type="text" class="form-control" name="cityname" placeholder="أدخــل اســم الـمــديــنــة" value="{{old('cityname')}}" style="font-size: 22px; color: black;">
                    </div>
                    @error('cityname')
                    <div class="alert alert-danger">يرجى إدخال اسم المدينة</div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">عــن الـمـديـنـة</label>
                        <textarea class="form-control" name="aboutcity" placeholder="أدخــل مـعـلـومـات عـن الـمــديـنـة"  style="text-align:right;font-size:22px; color: black;"rows="4">{{old('aboutcity')}}</textarea>
                    </div>
                    <div class="form-group ">
                        <label for="usr">مـوقــع الـمـديـنـة</label>
                        <input type="text" class="form-control" name="location" id="usr" placeholder="أدخـل مـوقـع الـمــديــنــة مــن خـرائــط غـوغـل" {{old('location')}} style="font-size: 22px; color: black;">
                    </div>
                    @error('location')
                    <div class="alert alert-danger">يرجى إدخال موقع المدينة</div>
                    @enderror
                    <div class="form-group">
                        <label for="flag">صـور  مـن الـمـديـنـة</label>
                        <input id="file-input" type="file" name="images[]" multiple>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-info" name="btnsave" style="color: white; width: 100px;height: 40px; font-size: 20px;"><span class="glyphicon glyphicon-floppy-save" style="color: orange;"></span>&nbsp;إضـافــة</button>
                    <a href="{{route('Countries.show',$country->id)}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

                </div>
        </div>
    </div>
</form>
<br>
<br>

