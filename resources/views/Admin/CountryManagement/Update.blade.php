@extends('Layouts/Admin_app')

@section('styles')


    .p1 {
    background-image: url("{{asset('images/globe.jpg')}}");
    width: 100%;
    height: 300px;
    background-size: cover;
    overflow-y: auto;
    overflow-x: auto;
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    margin-top: -1px;
    opacity: 0.9;
    }
@endsection

@section('title')
    تعديل بـلـد
@endsection



@section('content')
    <div class="p1">
        <div class="p1"><label
                    style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span
                        class="glyphicon glyphicon-pencil" style="color: orange;"></span>&nbsp;تعديل بلد</label></div>
    </div>
    @if ($message = Session::get('error'))
        <div class="alert alert-danger" style="text-align: center" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <span style="font-size: 25px;text-align: center;font-weight: bold">{{ $message }}</span>
        </div>
    @endif
    <div class="container">
        <br>
        <div class="col-md-6 col-xs-12" style="float: right;">
            <label style=" font-size: 25px;
    color:#64AEF7; font-weight: bold;"><span class="glyphicon glyphicon-pencil" style="color: orange;"></span>&nbsp;تعديل بلد</label>
            <hr>
            <br>
            <br>
            <form action="{{route('Countries.update',$country->id)}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                    <div class="form-group ">
                        <label for="usr">اســم الـبــلــد:</label>
                        <input type="text" class="form-control" id="usr" name="countryname" value="{{$country->name}}"
                               style="font-size: 22px; color: black;">
                    </div>
                    @error('countryname')
                    <div class="alert alert-danger">يرجى إدخال اسم البلد</div>
                    @enderror
                    <br>

                    @if($country->img_path != null)
                    <div class="form-group">
                        <label for="flag">عـلــم الـبــلــد:</label>
                        <input type="file" name="image">
                        <img src="{{url($country->img_path)}}" >
                    </div>
                    @endif

                    <button type="submit" class="btn btn-info" name="btnc"
                            style="color: white; width: 100px;height: 40px; font-size: 20px;"><span
                                class="glyphicon glyphicon-floppy-save" style="color: orange;"></span>&nbsp;تعديل
                    </button>
                    <a href="{{route('Countries.index')}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

                </div>
            </form>

        </div>
    </div>
    <br>
    <br>
@endsection