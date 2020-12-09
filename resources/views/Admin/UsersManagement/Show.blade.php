@extends('Layouts/Admin_app')
@section('title')
    بيانات المستخدم
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

    .table tr th{
    font-size:20px;
    color: #FFA500;
    text-align:center;
    }

    .table tr td{
    text-align:center;
    font-size:16px;
    color: #263859;
    font-weight:bold;
    }

    .data{
    color:#263859
    }
@endsection
@section('content')

    <div class="p1"><label style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span class="glyphicon glyphicon-user" style="color: orange;"></span>&nbsp;بيانات المسـتخدم</label></div>
    <br>
    <div class="well"  style="font-size: 25px;font-weight: bold; color: #64AEF7; text-align: center;"><span class="glyphicon glyphicon-user" style="color: orange;"></span>&nbsp; معلـومـات المسـتخدم</div>
    <div class="container" style="color: #64AEF7; font-size: 20px;">
        <br>
        <br>
        <label class="data">اسـم المسـتخدم:</label><br/>
        <label >{{$user_data['user_name']}}</label><hr><br/>
        <label class="data">الاسـم الأول:</label><br/>
        <label>{{$user_data['first_name']}}</label><hr>
        <label class="data">الاسـم الاخير:</label><br/>
        <label>{{$user_data['last_name']}}</label><hr>
        <label class="data">البريد الالكتروني:</label><br/>
        <label>{{$user_data['email']}}</label><hr>
        <label class="data">البلد:</label><br/>
        <label>{{$user_data['country']}}</label><hr>
        <label class="data">الجنس:</label><br/>
        <label>{{$user_data['gender']}}</label><hr>
        <label class="data">رقـم الهاتف:</label><br/>
        <label>{{$user_data['phone_number']}}</label><hr>
        <label class="data">صلاحيات المستخدم:</label><br/>
        <label>{{$user_data['role']}}</label><hr>
        <label class="data">تاريخ ووقت انشاء الحساب:</label><br/>
        <label>{{$user_data['created_at']}}</label><hr>
        <label class="data">الرصـيد:</label><br>
        <label>{{$user_data['credit']}}</label><hr><br><br>

    </div>
    <div style="text-align: center" class="btnstyle"> <a href="{{route('Users.index')}}"> <button type="button" class="btn " style="color: white; width:215px;height: 41px; background-color:#74828F;font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;عودة</button></a></div><br>

@endsection
{{--
@section('content')
    <div class="p1"><label
                style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span
                    class="glyphicon glyphicon-user" style="color: orange;"></span>&nbsp;بيانات المسـتخدم</label></div>
    <br>
    <div class="well" style="font-size: 25px;font-weight: bold; color: #64AEF7; text-align: center;"><span
                class="glyphicon glyphicon-user" style="color: orange;"></span>&nbsp; معلـومـات المسـتخدم
    </div>
    <div class="container" style="color: #64AEF7; font-size: 20px;">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">اسم المستخدم</th>
                <th scope="col">الاسم الأول</th>
                <th scope="col">الاسم الأخير</th>
                <th scope="col">البريد الالكتروني</th>
                <th scope="col">البلد</th>
                <th scope="col">الجنس</th>
                <th scope="col">رقم الهاتف</th>
                <th scope="col">صلاحيات المستخدم</th>
                <th scope="col">تاريخ ووقت إنشاء الحساب</th>
                <th scope="col">الرصيد</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$user_data['user_name']}}</td>
                <td>{{$user_data['first_name']}}</td>
                <td>{{$user_data['last_name']}}</td>
                <td>{{$user_data['email']}}</td>
                <td>{{$user_data['country']}}</td>
                <td>{{$user_data['gender']}}</td>
                <td>{{$user_data['phone_number']}}</td>
                <td>{{$user_data['role']}}</td>
                <td>{{$user_data['created_at']}}</td>
                <td>{{$user_data['credit']}}</td>
            </tr>
            </tbody>
        </table>
        <br>
        <br>
        --}}
{{-- <label>اسـم المسـتخدم:</label>
         <label>الاسـم الأول:</label>
         <label>الاسـم الاخير:</label><hr>
         <label>البريد الالكتروني:</label><hr>
         <label>البلد:</label><hr>
         <label>الجنس:</label><hr>
         <label>رقـم الهاتف:</label><hr>
         <label>صلاحيات المستخدم:</label><hr>
         <label>تاريخ ووقت انشاء الحساب:</label><hr>
         <label>الرصـيد</label><br><br>--}}{{--

    </div>
@endsection--}}
