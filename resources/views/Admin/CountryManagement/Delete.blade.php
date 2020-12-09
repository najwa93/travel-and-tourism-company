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
    حذف بـلـد
@endsection



@section('content')
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="p1">
        <div class="p1"><label
                    style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span
                        class="glyphicon glyphicon-remove" style="color: orange;"></span>&nbsp;حذف بلد
                </label></div>
    </div>
    <div class="container">
        <br>
        <div class="col-md-6 col-xs-12" style="float: right;">
            <label style=" font-size: 25px;
    color:#f73917; font-weight: bold;"><span class="glyphicon glyphicon-remove" style="color:#f73917;"></span>&nbsp;
                هل تريد بالتأكيد القيام بعملية حذف بلد ؟</label>
            <hr>
            <br>
            <br>
            <form action="{{route('Countries.destroy',$country->id)}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('DELETE')
                <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                    <div class="form-group ">
                        <label for="usr">اســم الـبــلــد:</label>
                        <input type="text" class="form-control" id="usr" name="countryname" value="{{$country->name}}"
                               style="font-size: 22px; color: black;" readonly>
                    </div>
                    @error('countryname')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    @if($country->img_path != null)
                    <div class="form-group">
                        <label for="flag">عـلــم الـبــلــد:</label>
                        <img src="{{url($country->img_path)}}" style="width: 150px;height: 140px;">
                    </div>
                    @endif
                    @error('image')
                    <div class="alert alert-danger"><?php echo("upload an image please")?></div>
                    @enderror

                    <button type="submit" class="btn btn-info" name="btnc"
                            style="color: white; width: 100px;height: 40px; font-size: 20px;"><span
                                class="glyphicon glyphicon-remove" style="color: #ff3928;"></span>&nbsp;حذف
                    </button>
                    <a href="{{route('Countries.index')}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

                </div>
            </form>

        </div>
    </div>
    <br>
    <br>
@endsection