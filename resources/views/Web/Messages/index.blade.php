@extends('layouts.Web_app')
@section('title','البريد الوارد')

@section('styles')

    .content {
    margin-top: 0;
    background-image: url('{{asset("images/test.png")}}');
    overflow-y: auto;
    overflow-x: auto;
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    }

    .p2 {
    padding-top: 5px;
    font-family: Arial;
    font-style: italic;
    font-size: 38px;
    color: #64AEF7;
    font-weight: bold;
    }

    .table{
    margin-bottom:60px;
    }

    .table tr th{
    font-size:25px;
    color: #FFA500;
    text-align:center;
    }

    .table tr td{
    text-align:center;
    font-size:19px;
    color: #263859;
    font-weight:bold;
    }
@endsection
@section('content')
    <div class="content"><label
                style="font-size: 30px; margin-top:9%; color: orange; font-weight: bold; margin-right: 12%;"><span
                    class="glyphicon glyphicon-envelope" style="color: orange;"></span>&nbsp;الـبريـد الـوارد</label>
    </div>
    <br>
    <div class="container">
        <br>
        <br>
        <br/>
        @if ($message = Session::get('warning'))
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span style="font-size: 15px;text-align: center;font-weight: bold">{{ $message }}</span>
            </div>

        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success " role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span style="font-size: 15px;text-align: center;font-weight: bold">{{ $message }}</span>
            </div>

        @endif
        <div style="text-align: center; color:#64AEF7; font-size: 28px;"><label>&nbsp;&nbsp;قــائـــمـــة
                الـرســائـل</label></div>
        <!-- Table --><br>
        @if($msgs_replies != null)
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td></td>
                <td class="text-center col-xs-4"
                    style="font-size: 18px;width: 200px; color: white; background-color: #64AEF7;">الحالة
                </td>
                <td class="text-center col-xs-4" style="font-size: 18px; color: white;background-color: #64AEF7">
                    خــيــارات
                </td>

            </tr>
            </thead>
            <tbody style="text-align: center;" dir="ltr">

            @foreach($msgs_replies as $msg_reply)
                <tr>
                    <td class="col-xs-2"><i class="far fa-envelope{{$msg_reply['read_by_user'] == 0?'':'-open'}} fa-2x "></i></td>
                    <td class="col-xs-2">{{$msg_reply['read_by_user'] == 0?'غيرمقروءة':'مقروءة'}} </td>
                    <td class="col-xs-4">
                        <div class="btn-group" role="group">
                            <form method="POST" action="{{route('delete_message',$msg_reply['message_id'])}}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('هل تريد بالتأكيد القيام بعملة الحذف؟')">حذف
                                </button>

                            </form>
                        </div>
                        <div class="btn-group" role="group">
                            <a href="{{route('webUsers.show',$msg_reply['message_id'])}}">
                                <button type="button" class="btn btn-primary">قراءة الرسالة</button>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
                @else
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span style="font-size: 15px;text-align: center;font-weight: bold"> البريد الوارد فارغ </span>
                </div>
            @endif
            </tbody>
        </table>
    </div>
    <br>
@endsection

@include('Partials.Web._javascript')



