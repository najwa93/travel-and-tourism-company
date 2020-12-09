@extends('Layouts.Admin_app')

@section('title')
    إضافة فـنـدق جـديـد
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
                    class="glyphicon glyphicon-globe" style="color: orange;"></span>&nbsp;إضـافـة فـنـدق جـديـد</label>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="col-md-6 col-xs-12" style="float: right;">
            <label style=" font-size: 25px;
    color:#64AEF7; font-weight: bold;"><span class="glyphicon glyphicon-list" style="color: orange;"></span>&nbsp;امـلأ
                الـنـمـوذج الـتـالــي لإضــافـة فـنـدق إلـى قـائـمـة الـفـنـادق </label>
            <hr>
            <br>
            <br>
            <form action="{{route('Hotels.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                    <div class="form-group ">
                        <label for="usr">اســم الـفـنـدق</label>
                        <input type="text" class="form-control" name="name" id="usr"
                               placeholder="أدخــل اســم الـفـنـدق" value="{{old('name')}}" style="font-size: 20px; color: black;">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">يرجى إدخال اسم الفندق</div>
                    @enderror
                    <div class="form-group">
                        <label for="usr">اســم الـبـلــد</label>
                        <select name="country" id="country" class="form-control">
                            <option value="">Select Country</option>
                            @foreach($countries as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('country')
                    <div class="alert alert-danger">يرجى اختيار اسم البلد</div>
                    @enderror
                    <div class="form-group">
                        <label for="usr">اســم الـمـديـنـة</label>
                        <select name="city" id="city" class="form-control">
                            <option value="">City</option>

                        </select>
                    </div>
                    @error('city')
                    <div class="alert alert-danger">يرجى اختيار اسم المدينة</div>
                    @enderror
                    {{--   <div class="form-group ">
                           <label for="usr">اســم الـبـلــد</label>
                           <input type="text" class="form-control" name="countryname" id="usr" placeholder="أدخــل اســم الـبـلـد" style="font-size: 20px; color: black;">
                       </div>
                       <div class="form-group ">
                           <label for="usr">اســم  الـمـديـنـة</label>
                           <input type="text" class="form-control" name="cityname" id="usr" placeholder="أدخــل اســم الـمـديـنـة" style="font-size: 20px; color: black;">
                       </div>--}}
                    <div class="form-group ">
                        <label for="usr">عـدد الـنـجـوم</label>
                        <input type="number" class="form-control" name="stars" id="usr" min="1" max="5"
                               placeholder="عـدد الـنـجـوم" style="font-size: 20px; color: black;">
                    </div>
                    <div class="form-group ">
                        <label for="usr">عــن الـفـنـدق</label>
                        <textarea class="form-control" name="abouthotel" placeholder="أدخــل مـعـلـومـات عـن الـفـنـدق"
                                   style="text-align: right; font-size:20px; color: black;" rows="4">{{old('abouthotel')}}</textarea>
                    </div>
                    <div class="form-group ">
                        <label for="usr">الـمـوقـع الإلـكـتـرونـي</label>
                        <input type="email" class="form-control" name="email" id="usr"
                               value="{{old('email')}}" placeholder="أدخــل  الـمـوقـع الإلـكـتـرونـي" style="font-size: 20px; color: black;">
                    </div>

                    <div class="form-group ">
                        <label for="usr">رقــم الـهـاتــف</label>
                        <input type="text" class="form-control" name="phone" id="usr" placeholder="رقــم الـهـاتــف"
                               value="{{old('phone')}}" style="font-size: 20px; color: black;">
                    </div>
                    @error('phone')
                    <div class="alert alert-danger">يرجى إدخال رقم الهاتف </div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">مـوقــع الـفـنـدق</label>
                        <input type="text" class="form-control" name="location" id="usr"
                               placeholder="أدخـل مـوقـع  الـفـنـدق مــن خـرائــط غـوغـل"
                               value="{{old('location')}}" style="font-size: 20px; color: black;">
                        {{--<div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
                            <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div><script>(function () {
                                    var setting = {"height":538,"width":435,"zoom":12,"queryString":"Lattakia, Syria","place_id":"ChIJfWDUYS2sJhUR3pVBofhbMo4","satellite":false,"centerCoord":[35.543562132031866,35.7920161],"cid":"0x8e325bf8a14195de","lang":"en","cityUrl":"/syria/latakia-41212","cityAnchorText":"Map of Latakia, Syria","id":"map-9cd199b9cc5410cd3b1ad21cab2e54d3","embed_id":"257270"};
                                    var d = document;
                                    var s = d.createElement('script');
                                    s.src = 'https://1map.com/js/script-for-user.js?embed_id=257270';
                                    s.async = true;
                                    s.onload = function (e) {
                                        window.OneMap.initMap(setting)
                                    };
                                    var to = d.getElementsByTagName('script')[0];
                                    to.parentNode.insertBefore(s, to);
                                })();</script><a href="https://1map.com/map-embed">1 Map</a></div>
                    </div>--}}
                    </div>
                    <div class="form-group">
                        <label for="flag">صـور مـن الـفـنـدق</label>
                        <input id="file-input" type="file" name="images[]" multiple>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-info" name="btnsave"
                            style="color: white; width: 100px;height: 40px; font-size: 20px;"><span
                                class="glyphicon glyphicon-floppy-save" style="color: orange;"></span>&nbsp;حــفــظ
                    </button>
                    <a href="{{route('Hotels.index')}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

                </div>
            </form>
        </div>
    </div>

    <br>
    <br>

@endsection


