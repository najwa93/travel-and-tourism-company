@extends('Layouts/Admin_app')
@section('title')
    إدارة البلـدان
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

<div class="p1"><label style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span
                class="glyphicon glyphicon-globe" style="color: orange;"></span>&nbsp;إدارة الـبـلـدان</label></div>
<div class="container">
    <br>
    <a href="{{route('Countries.create')}}" style="text-decoration:none ;">
        <button type="button" class="btn btn-block"
                style="background-color:#64AEF7; color: white; height: 40px; font-size: 22px; font-weight: bold;"><span
                    class="glyphicon glyphicon-plus" style="color: orange;"></span>&nbsp;&nbsp;إضــافــة بــلــد
            جــديــد
        </button>
    </a>
    <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success" style="text-align: center" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <span style="font-size: 25px;text-align: center;font-weight: bold"> {{ $message  }}</span>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 col-xs-12" style="float: right;">
            <label style=" font-size: 22px; color:#64AEF7; font-weight: bold; "><span class="glyphicon glyphicon-search"
                                                                                      style="color: orange;"></span>&nbsp;&nbsp;
                الــبـحـث بـاســم الـبــلــد </label>
        </div>

        <div class="col-md-8 col-xs-12">
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                   placeholder="الـبـحـث بـاسـم  الـبـلـد .." style="text-align: right;">
        </div>
    </div>
    <hr>
    <br>
    <div style="text-align: center; color:#64AEF7; font-size: 28px;"><label>&nbsp;&nbsp;قــائـــمـــة
            الـــبــلــدان</label></div>
    <!-- Table -->
    <table class="table table-striped table-bordered" id="myTable">
        <tr class="header">
            <th class="text-center col-xs-4"
                style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">الـبــلــد
            </th>
            <th class="text-center col-xs-8" style="font-size: 18px; color: white;background-color: #64AEF7">
                خــيــارات
            </th>
        </tr>
        <tbody style="text-align: center;" dir="ltr">
        @foreach($countries as $country)
            <tr>
                <td>{{$country->name}}</td>
                <td>
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                                <a href="{{route('Countries.show',$country->id)}}">
                                    <button type="button" class="btn btn-success">إدارة المدن</button>
                                </a>

                        </div>
                        <div class="btn-group" role="group">
                            <a href="{{route('Countries.delete',$country->id)}}">
                                <button type="button" class="btn btn-danger">حذف</button>
                            </a>
                        </div>
                        <div class="btn-group" role="group">
                            <a href="{{route('Countries.edit',$country->id)}}">
                                <button type="button" class="btn btn-warning">تعديل</button>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div style="text-align: center" class="btnstyle"> <a href="{{route('Main.index')}}"> <button type="button" class="btn " style="color: white; width:215px;height: 41px; background-color:#74828F;font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;عودة إلى إدارة الموقع </button></a></div><br>


