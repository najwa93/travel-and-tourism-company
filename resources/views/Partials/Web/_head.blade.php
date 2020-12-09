<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<!-- Bootstrap -->

<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-rtl.min.css')}}" rel="stylesheet">
<link href="{{asset('css/all.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('slick/slick.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('slick/slick-theme.css')}}"/>
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
        background-color:#0d3f67;
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
        color:#0d3f67 !important;
        text-decoration: none;
        margin-right:12px;
        font-size:18px;
        font-weight:bold;
    }

   .navbar-nav li a:hover, .navbar-nav li.active a {
        color: #0d3f67 !important;
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
        background-color:  #0d3f67;
    }
*/
    .icon-style{
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

    .p1 {
        background-size: cover;
        height: 600px;
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
        color: #0d3f67;
        font-weight: bold;
    }


    .cc{
        padding: 10px;
    }
    .cc .features:hover {
        transform: scale(1.1);
        transition: 0.5s;
    }

    .hh {
        text-align: center;
        font-weight: bold;
        font-family: arial;
        border: 4px solid white;
    }

    .hh a {
        font-size: 25px;
        text-align: center;
        color: white;
        border-radius: 10px;
        background-color: #99ccff;
        padding-right: 10px;
        padding-left: 10px;
        margin-top: 75px;
    }

    .hh a:hover {
        color: #0d3f67;
        font-weight: bold;
        background-color: orange;
        padding: 15px;
        transition: all 1s;
    }

    .hr {
        background: orange;
    }

    .contact-form {
        color: #64AEF7;
        padding: 20px;
        box-shadow: 0px 0px 5px 3px orange;
    }

    .modal {
        box-shadow: 2px 2px 2px 2px orange;
    }

    .modal-body {
        color: #64AEF7;
        font-size: 18px;
    }

    .in {
        text-align: right;
    }

    .item {
        color: white;
        font-size: 25px;
        text-align: center;
        padding-top: 30px;
    }

    .tab {
        overflow: hidden;
        border: 1px;
        background-color: #0d3f67;
        color: white;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: right;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 12px 14px;
        font-size: 22px !important;
        line-height: 1.5 !important;
        transition: all 1s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover { /*حركة انيميشن-*/
        background-color: white;
        color: #0d3f67;
        padding-right: 30px;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: white;
        color: #0d3f67;
        padding-right: 30px;
    }

    /* Style the tab content */
    .tabcontent {
        padding: 6px 12px;
        border: 1px solid orange;
        border-top: none;
        text-align: right;
        font-size: 20px;
    }

    * {
        box-sizing: border-box;
    }

    /* Style the input container */
    .input-container {
        display: flex;
        width: 100%;
        margin-bottom: 15px;
    }

    /* Style the form icons */
    .icon {
        padding: 10px;
        background: dodgerblue;
        color: white;
        min-width: 50px;
        text-align: center;
    }

    /* Style the input fields */
    .input-field {
        width: 100%;
        padding: 10px;
        outline: none;
    }

    .input-field:focus {
        border: 1px solid orange;
    }

    /* Set a style for the submit button */
    .btn1 {
        background-color: dodgerblue;
        color: white;
        padding: 15px 20px;
        border: none;
        cursor: pointer;
        width: 40%;
        opacity: 0.9;
        margin: 15px;
    }

    .btn1:hover {
        opacity: 1;

    }

    .social-icon button {
        font-size: 20px;
        color: white;
        height: 50px;
        width: 50px;
        background: #45aba6;
        border-radius: 60%;
        margin: 0px 10px;
        border: none;
        cursor: pointer;
    }

    .social-icons-box{
        margin: -15px;
    }
    .social-icons-box .social-icons-list{
        width: 100%;
        height: auto;
        margin: auto;
        margin-top: 33px;
        margin-bottom: 21px;
    }

    .social-icons-list ul{
        margin: 0;
        padding: 0 0 2px 0;
        text-align: center;
    }

    .social-icons-list ul li{
        display: inline-block;
        width: 35px;
        height: 35px;
        text-align: center;
        border-radius: 100%;
        margin: 0 10px;
    }

    .social-icons-list ul li a{
        display: block;
        color: #F5F5F5;!important;
        font-size: 20px;
    }

    .social-icons-list ul li a i{
        line-height: 38px;
    }

    /* facebook icon */
    .social-icons-list ul li.facebook {
        background: #3b5999;
    }

    /* twitter icon */
    .social-icons-list ul li.twitter {
        background: #55acee;
    }

    /*email icon */
    .social-icons-list ul li.google {
        background: #EA4335;
    }

    #myTable {
        width: 100%; /* Full-width */
        font-size: 20px; /* Increase font-size */
        color: white;
    }

    #myTable th, #myTable td {
        text-align: center; /* Left-align text */
        padding: 3px; /* Add padding */
        border: 1px solid orange;
    }

    #myTable tr {
        /* Add a bottom border to all table rows */
        border: 1px solid orange;
    }

    #myTable tr.header, #myTable tr:hover {
        /* Add a grey background color to the table header and on hover */
        background-color: #0d3f67;
    }

    @section('styles')

        .p1{
        background-image:url('{{asset("images/travel.jpg")}}');
        background-size:cover;
        height:700px;
        overflow-y: auto;
        overflow-x: auto;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
    }
    .p2{
        padding-top: 5px;
        font-family: Arial;
        font-style:italic;
        font-size: 38px;
        color:#64AEF7;
        font-weight: bold;
    }

    .features{
        height:190px;
        padding:20px
    }

    @endsection

    @yield('styles')
</style>

