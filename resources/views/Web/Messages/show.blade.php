@extends('layouts.Web_app')

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
    <div class="content"><label style="font-size: 30px; margin-top:9%; color: orange; font-weight: bold; margin-right: 12%;"><span class="glyphicon glyphicon-envelope" style="color: orange;"></span>&nbsp;تفاصـيل الرسـالة</label></div>
    <br>
    <div class="well"  style="font-size: 25px; color: #64AEF7; text-align: center;"><span class="glyphicon glyphicon-comment" style="color: orange;"></span>&nbsp;تـفاصـيل الرسـالة</div>
    <div class="container">
            <div style="font-size: 22px; font-weight: bold; color:#64AEF7;margin-right: 80px;margin-bottom: 20px">
                <br>
                <label for="usr" style="color: #263859;">الرسـالة :</label>
                <span>{{$msg_reply->message->message}}</span>
                <br><br>
                <label for="usr">الرد على الرسـالة :</label>
                <br>
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <span style="font-size: 15px;text-align: center;font-weight: bold">{{ $message->message_reply }}</span>
                    </div>

                @endif
                <textarea class="form-control" name="message" style="text-align: right; font-size:20px; color: black;" rows="4" readonly>{{$msg_reply->message_reply}}
               </textarea>
                <br><br>
                <a href="{{route('show_message_replies')}}"><button type="button" class="btn btn-info" style="color: white; width: 100px;height: 40px; font-size: 20px;">  العودة</button></a>
            </div>


    </div>
@endsection

@include('Partials.Web._javascript')


