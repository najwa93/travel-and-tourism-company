@extends('Layouts.Admin_app')

@section('styles')

    .btn {
    width: 370px;
    height: 166px;
    padding: 14px 28px;
    font-size: 30px;
    cursor: pointer;
    display: inline-block;
    }

    /* Green */
    .success {
    border-color: #4CAF50;
    color: green;
    }

    .success:hover {
    background-color: #4CAF50;
    color: white;
    }

    /* Blue */
    .info {
    border-color: #2196F3;
    color: dodgerblue;
    }

    .info:hover {
    background: #2196F3;
    color: white;
    }

    /* Orange */
    .warning {
    border-color: #ff9800;
    color: orange;
    }

    .warning:hover {
    background: #ff9800;
    color: white;
    }

    /* Red */
    .danger {
    border-color: #f44336;
    color: red;
    }

    .danger:hover {
    background: #f44336;
    color: white;
    }
    @media screen and (max-width: 1000px) {
    .col-md-4
    {
    text-align: center;
    margin: 25px 0;
    }

    .col-xs-12{
    text-align: center;
    margin: 25px 0;
    }
    }
@endsection
@section('content')
    <div class="well" style="font-size: 25px;font-weight: bold; color: #64AEF7; text-align: center;"><span
                class="glyphicon glyphicon-tower" style="color: orange;"></span>&nbsp; خـيارات المـديـر
    </div>
    <div class="container">
        <br>
        <br>
        <div class="row">

            @if( \Illuminate\Support\Facades\Auth::user()->role->name == 'Admin' )

                <div class=" col-md-4 col-xs-12" style="float: right;"><a href="{{route('Countries.index')}}">
                        <button class="btn success"><span class="glyphicon glyphicon-globe"></span><br>إدارة البلدان
                        </button>
                    </a></div>
            @endif

            @if( \Illuminate\Support\Facades\Auth::user()->role->name == 'Admin' or  \Illuminate\Support\Facades\Auth::user()->role->name == 'Hotel_Manager'  )
                <div class=" col-md-4 col-xs-12" style="float: right;"><a href="{{route('Hotels.index')}}">
                        <button class="btn warning"><span class="glyphicon glyphicon-cutlery"></span><br>إدارة الفنادق
                        </button>
                    </a></div>
            @endif

                @if( \Illuminate\Support\Facades\Auth::user()->role->name == 'Admin' or  \Illuminate\Support\Facades\Auth::user()->role->name == 'Flight_Manager'  )
                <div class=" col-md-4 col-xs-12" style="float: right;"><a href="{{route('Flights.index')}}">
                        <button class="btn info"><span class="glyphicon glyphicon-plane"></span><br>إدارة الرحلات الجوية
                        </button>
                    </a>
                </div>
            @endif
            <br>
        </div>
        <br>

        <div class="row">
            @if( \Illuminate\Support\Facades\Auth::user()->role->name == 'Admin')
                <div class=" col-md-4 col-xs-12" style="float: right;"><a href="{{route('Users.index')}}">
                        <button class="btn info"><span class="glyphicon glyphicon-user"></span><br>إدارة المستخدمين
                        </button>
                    </a>
                </div>
            @endif

                @if( \Illuminate\Support\Facades\Auth::user()->role->name == 'Admin' or  \Illuminate\Support\Facades\Auth::user()->role->name == 'Offer_Manager'  )
                <div class=" col-md-4 col-xs-12" style="float: right;"><a href="{{route('Offers.index')}}">
                        <button class="btn success"><span class="glyphicon glyphicon-gift"></span><br>العروض السياحية
                        </button>
                    </a>
                </div>
            @endif

    @if( \Illuminate\Support\Facades\Auth::user()->role->name == 'Admin' or \Illuminate\Support\Facades\Auth::user()->role->name == 'Support')
        <div class=" col-md-4 col-xs-12" style="float: right;"><a href="{{route('messages')}}">
                <button class="btn danger"><span class="glyphicon glyphicon-envelope"></span><br>الرسـائل
                </button>
            </a>
        </div>
    @endif
    <br>
</div>
<br>
<br>
</div>
</div>

@endsection

