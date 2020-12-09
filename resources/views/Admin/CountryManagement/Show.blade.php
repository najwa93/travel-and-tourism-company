@extends('Layouts.Admin_app')

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
    إدارة المدن
@endsection


@section('content')
    <div class="p1"><label
                style="font-size: 40px; margin-top:9%; color: white; font-weight: bold; margin-right: 12%;"><span
                    class="glyphicon glyphicon-globe" style="color: orange;"></span>&nbsp;إدارة الـمـدن</label></div>
    <div class="container">
        <br><br>
        <a href="{{route('GetCity.create',$country->id)}}" style="text-decoration:none ;">
            <button href="add-globe.php" type="button" class="btn btn-block"
                    style="background-color:#64AEF7; color: white; height: 40px; font-size: 22px; font-weight: bold;">
                <span class="glyphicon glyphicon-plus" style="color: orange;"></span>&nbsp;&nbsp;إضــافــة مــديــنــة
                جــديــدة
            </button>

        </a>
        <br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="text-align: center" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span style="font-size: 25px;text-align: center;font-weight: bold">{{ $message }}</span>
            </div>
        @endif
        <div class="row">
            <div class="col-md-4 col-xs-12" style="float: right;">
                <label style=" font-size: 22px; color:#64AEF7; font-weight: bold; "><span
                            class="glyphicon glyphicon-search" style="color: orange;"></span>&nbsp;&nbsp; الــبـحـث
                    بـاســم الـمــديـنـة </label>
            </div>

            <div class="col-md-8 col-xs-12">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                       placeholder="الـبـحـث بـاسـم المدينـة...." style="text-align: right;">
            </div>
        </div>

        <hr>
        <br>
        <div style="text-align: center; color:#64AEF7; font-size: 28px;"><label>قــائـــمـــة الـمــدن</label></div>
        <!-- Table -->
        <table class="table table-striped table-bordered" id="myTable">

            <tr class="header">
                <th class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">الـمـديـنـة
                </th>
                <th class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">الـبــلــد
                </th>
                <th class="text-center col-xs-8" style="font-size: 18px; color: white;background-color: #64AEF7">
                    خــيــارات
                </th>
            </tr>

            <tbody style="text-align: center;" dir="ltr">
            @foreach($allData as $value)
                <tr>
                    <td>{{$value['city']}}</td>
                    <td>{{$value['country']}}</td>
                    <td>
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <a href="{{route('Cities.delete',$value['city_id'])}}">
                                    <button type="button" class="btn btn-danger">حذف</button>
                                </a>
                            </div>
                            <div class="btn-group" role="group">
                                <a href="{{route('Cities.edit',$value['city_id'])}}">
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
    <div style="text-align: center"> <a href="{{route('Countries.index')}}"> <button type="button" class="btn btn-success" style="color: white; width: 170px;height: 41px; font-size: 20px;padding: 4px ;font-weight: bold">&nbsp;عودة إلى قائمة البلدان</button></a></div><br>

    <br>
@endsection

{{--<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>--}}

