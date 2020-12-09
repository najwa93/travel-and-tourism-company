@extends('Layouts/Admin_app')

@section('title')
    إضافة غـرفـة جـديـدة
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
<div class="p1"><label style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span class="glyphicon glyphicon-globe" style="color: orange;"></span>&nbsp;إضـافـة غـرفـة جـديـدة</label></div>
<br>
<br>
<br>

<form action="{{route('StoreRoom.store',$hotel->id)}}" method="POST">
    {{csrf_field()}}
    <div class="container">
        <div class="col-md-6 col-xs-12" style="float: right;">
            <label style=" font-size: 25px;
    color:#64AEF7; font-weight: bold;"><span class="glyphicon glyphicon-list" style="color: orange;"></span>&nbsp;امـلأ الـنـمـوذج الـتـالــي لإضــافـة  غـرفـة إلـى قـائـمـة الـغـرف </label>
            <hr>
            <br>
            <br>
            <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;">
                <div class="form-group ">
                    <label for="usr">الاسم</label>
                    <input type="text" class="form-control" name="name" id="usr" placeholder="أدخــل اســم الـغرفة" style="font-size: 20px; color: black;">
                </div>
                @error('name')
                <div class="alert alert-danger">يرجى إدخال اسم الغرفة </div>
                @enderror
                <div class="form-group ">
                    <label for="usr">النوع</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">اختر النوع</option>
                        @foreach($roomTypes as $roomType)
                            <?php $roomType ?>
                        <option value="{{$roomType->id}}">{{$roomType->name}}</option>
                            @endforeach
                    </select>
                </div>
                @error('type')
                <div class="alert alert-danger">يرجى اختيار نوع الغرفة </div>
                @enderror
                <div class="form-group ">
                    <label for="usr">عـدد الاشخاص</label>
                    <input type="number" class="form-control" name="custcount" id="usr" min="1" max="10" placeholder="عـدد الاشخاص" style="font-size: 20px; color: black;">
                </div>
                @error('custcount')
                <div class="alert alert-danger">يرجى إدخال عدد الأشخاص </div>
                @enderror
                <div class="form-group ">
                    <label for="usr">تكلفة الليلة</label><br>
                   <input type="text" class="col-xs-8 col-md-10 form-control" name="price" id="usr" placeholder="تكلفة الليلة" style="font-size: 20px; color: black;"> <label for="credit" class=" col-form-label text-md-right" style="border:2px solid #FFA500;margin: 1px 5px;padding: 1px 6px;border-radius: 5px;font-size: 20px"><span style="color: black">$</span></label>

                </div>
                @error('price')
                <div class="alert alert-danger">يرجى إدخال تكلفة الليلة </div>
                @enderror
                <div class="form-group ">
                    <label for="usr">التفاصيل</label>
                    <input type="text" class="form-control" name="about" id="usr" placeholder="أدخـل  مزايا تتمتع بها الغرفة" style="font-size: 20px; color: black;">
                </div>
                <div class="form-group">
                    <input type="checkbox" class="switch-input"  name="available"  />
                    <label class="form-check-label" for="exampleCheck1">الغرفة متاحة</label>
                </div>
                <br>
                <button type="submit" class="btn btn-info" name="btnsave" style="color: white; width: 100px;height: 40px; font-size: 20px;"><span class="glyphicon glyphicon-floppy-save" style="color: orange;"></span>&nbsp;حــفــظ</button>
                <a href="{{route('Hotels.show',$hotel->id)}}"> <button type="button" class="btn btn-warning" style="color: white; width: 84px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;إلغاء</button></a><br>

            </div>
        </div>
    </div>
</form>

<br>
<br>
@endsection