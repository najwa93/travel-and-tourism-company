@extends('Layouts/Admin_app')
@section('title')
    إدارة المستخدمين
@endsection
@section('styles')

    .p1{
    background-image: url("{{asset('images/users.jpg')}}");
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
                    class="glyphicon glyphicon-user" style="color: orange;"></span>&nbsp;إدارة المسـتخدميـن</label>
    </div>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-4 col-xs-12" style="float: right;">
                <label style=" font-size: 24px; color:#64AEF7; font-weight: bold; "><span
                            class="glyphicon glyphicon-search" style="color: orange;"></span>&nbsp;&nbsp; الــبـحـث
                    بـاســم المستخدم</label>
            </div>

            <div class="col-md-8 col-xs-12">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                       placeholder="الـبـحـث بـاسـم الـمسـتخـدم ..." style="text-align: right;">
            </div>
        </div>
        <hr>
        <br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="text-align: center" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span style="font-size: 25px;text-align: center;font-weight: bold"> {{ $message  }}</span>
            </div>
        @endif
        <div style="text-align: center; color:#64AEF7; font-size: 28px;"><label>&nbsp;&nbsp;قــائـــمـــة
                المسـتخدمين</label></div>
        <!-- Table -->
        <table class="table table-striped table-bordered" id="myTable">

            <tr class="header">
                <th class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">اســم المستخدم
                </th>
                <th class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">الاسم الأول
                </th>
                <th class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">الاسم الأخير
                </th>
                <th class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">الصلاحيات
                </th>
                <th class="text-center col-xs-6" style="font-size: 18px; color: white;background-color: #64AEF7">
                    خــيــارات
                </th>

            </tr>
            <tbody style="text-align: center;" dir="ltr">
            @foreach($users_data as $user)
                <tr>
                    <td>{{$user['user_name']}}</td>
                    <td>{{$user['first_name']}}</td>
                    <td>{{$user['last_name']}}</td>
                    <td>{{$user['role']}}</td>
                    <td>
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <a href="{{route('Users.show',$user['user_id'])}}">
                                    <button type="button" class="btn btn-warning">بيانات المستخدم</button>
                                </a>
                            </div>
                            <div class="btn-group" role="group">
                                <a href="{{route('Users.edit',$user['user_id'])}}">
                                    <button type="button" class="btn btn-success">إدارة صلاحيات المستخدم</button>
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

@endsection