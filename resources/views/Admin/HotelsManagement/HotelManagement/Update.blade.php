@extends('Layouts/Admin_app')

@section('title')
    تعديل فندق
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
                style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span class="glyphicon glyphicon-pencil" style="color: orange;"></span>&nbsp;تعـديل فنـدق</label>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="col-md-6 col-xs-12" style="float: right;">
            <label style=" font-size: 25px;
    color:#64AEF7; font-weight: bold;"><span class="glyphicon glyphicon-pencil" style="color: orange;margin-left: 7px"></span>تعـديل فنـدق
                </label>
            <hr>
            <br>
            <br>
            <form action="{{route('Hotels.update',$hotel->id)}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                    <div class="form-group ">
                        <label for="usr">اســم الـفـنـدق</label>
                        <input type="text" class="form-control" name="name" id="usr"
                               placeholder="أدخــل اســم الـفـنـدق" value="{{$hotel->name}}"
                               style="font-size: 20px; color: black;">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">يرجى إدخال اسم الفندق</div>
                    @enderror
                    <div class="form-group">
                        <label for="usr">اســم الـبـلــد</label>
                        <select name="country" id="country" class="form-control">
                            <option value="">Select Country</option>
                            @foreach($countries as $key => $value)
                                <option {{$key == $hotel->country_id?'selected="selected"':''}} value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('country')
                    <div class="alert alert-danger">يرجى اختيار اسم البلد</div>
                    @enderror
                    <div class="form-group">
                        <label for="usr">اســم الـمـديـنـة</label>
                        <select name="city" id="city" class="form-control">
                            {{--<option value="{{$city->id}}">{{$city->name}}</option>--}}
                            @foreach($cities as $city)
                                <option {{$city->id == $hotel->city_id?'selected="selected"':''}} value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('city')
                    <div class="alert alert-danger">يرجى اختيار اسم المدينة</div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">عـدد الـنـجـوم</label>
                        <input type="number" class="form-control" name="stars" id="usr" placeholder="عـدد الـنـجـوم"
                               value="{{$hotel->stars}}" style="font-size: 20px; color: black;">
                    </div>
                    <div class="form-group ">
                        <label for="usr">عــن الـفـنـدق</label>
                        <textarea class="form-control" name="abouthotel" placeholder="أدخــل مـعـلـومـات عـن الـفـنـدق"
                                  style="text-align: right; font-size:20px; color: black;"
                                  rows="4">{{$hotel->details}}</textarea>
                    </div>
                    <div class="form-group ">
                        <label for="usr">الـمـوقـع الإلـكـتـرونـي</label>
                        <input type="email" class="form-control" name="email" id="usr"
                               placeholder="أدخــل  الـمـوقـع الإلـكـتـرونـي" value="{{$hotel->email}}"
                               style="font-size: 20px; color: black;">
                    </div>

                    <div class="form-group ">
                        <label for="usr">رقــم الـهـاتــف</label>
                        <input type="text" class="form-control" name="phone" id="usr" placeholder="رقــم الـهـاتــف"
                               value="{{$hotel->phone_number}}" style="font-size: 20px; color: black;">
                    </div>
                    @error('phone')
                    <div class="alert alert-danger">يرجى إدخال رقم الهاتف</div>
                    @enderror
                    <div class="form-group ">
                        <label for="usr">مـوقــع الـفـنـدق</label>
                        <input type="text" class="form-control" name="location" id="usr"
                               placeholder="أدخـل مـوقـع  الـفـنـدق مــن خـرائــط غـوغـل" value="{{$hotel->location}}"
                               style="font-size: 20px; color: black;">
                    </div>
                    <div class="form-group">
                        <label for="flag">صـور مـن الـفـنـدق</label>
                        <input id="file-input" type="file" name="images[]" multiple>
                        <div class="panel-body">
                            @foreach($hotelImgs as $hotelImg)
                                <img src="{{url($hotelImg->img_path)}}" style="width: 150px;height: 140px;">
                            @endforeach
                        </div>

                        {{-- @foreach($hotelImgs as $hotelImg)

                            --}}{{-- <input  type="checkbox" name="photos[]" value="{{$photo->id}}" />--}}{{--
                         @endforeach--}}
                    </div>
                    <br>
                    <button type="submit" class="btn btn-info" name="btnsave"
                            style="color: white; width: 100px;height: 40px; font-size: 20px;"><span
                                class="glyphicon glyphicon-floppy-save" style="color: orange;"></span>تعديل
                    </button>
                    <a href="{{route('Hotels.index')}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

                </div>
            </form>
        </div>
    </div>
    <br>
    <br>

@section('content')
