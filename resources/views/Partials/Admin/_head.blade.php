<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<!-- Bootstrap -->
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-rtl.min.css')}}" rel="stylesheet">
<link href="{{asset('css/all.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery-datepicker.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}"/>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    body{
    }
    .header{
        width: 100%;
        height:52px;
    }
    .navbar {
        background-color:#0d3f67 ;
        z-index: 9999;
        border: 0;
        font-size: 20px !important;
        line-height: 1.5 !important;
        border-radius: 0;
    }
    .navbar li a, .navbar .navbar-brand {
        color: white !important;
    }

    .navbar li a.dropdown-item{
        color:#64AEF7 !important;
        text-decoration: none;
        margin-right:12px;
        font-size:18px;
        font-weight:bold;
    }

    .navbar-nav li a:hover, .navbar-nav li.active a {
        color: #64AEF7 !important;
        background-color: #fff !important;
    }
    .navbar-default .navbar-toggle {
        border-color: transparent;
        color: #fff !important;
    }

    .dropdown-menu{
        background-color: #ffffff;
        width:200px;
    }
    /* .dropdown-menu a:hover{
         color: #ffffff;
         background-color:  #64AEF7;
     }
 */
    i{
        color: #FFA500;
    }
    .fas {
        margin-right: 15px;
    }
    .far{
        margin-right: 17px;
    }

    @media screen and (max-width: 800px) {
        .col-sm-4 {
            text-align: center;
            margin: 25px 0;
        }
    }
    @yield('styles')
</style>