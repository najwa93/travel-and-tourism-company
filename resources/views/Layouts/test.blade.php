<!DOCTYPE html>
<html>
<head>

    <style type="text/css">
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
            background-color:#64AEF7;
            z-index: 9999;
            border: 0;
            font-size: 20px !important;
            line-height: 1.5 !important;
            border-radius: 0;
        }
        .navbar li a, .navbar .navbar-brand {
            color: white !important;
        }
        .navbar-nav li a:hover, .navbar-nav li.active a {
            color: #64AEF7 !important;
            background-color: #fff !important;
        }
        .navbar-default .navbar-toggle {
            border-color: transparent;
            color: #fff !important;
        }
        @media screen and (max-width: 800px) {
            .col-sm-4 {
                text-align: center;
                margin: 25px 0;
            }

        }
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
    </style>
</head>
<body>
<header class="header">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="border-color:orange;   color: white !important;">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="font-family:Georgia; font-style: italic; font-size: 32px;color:white;">Travel<span style="font-family:Georgia;font-style: italic; color:orange;">Ro</span> </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php"  class="h"><span class="glyphicon glyphicon-home"style="color: orange;"></span>&nbsp;الرئيسية</i></a></li>
                    <li><a href="manager.php"  class="h"><span class="glyphicon glyphicon-wrench"style="color: orange;"></span>&nbsp;إدارة  الموقع</i></a></li>
                    <li><a href="" class="h"><span class="glyphicon glyphicon-user"style="color: orange;"></span>&nbsp;أهـلا بـك</i></a></li>
                    <li><a href="logout.html" class="h"><span class="glyphicon glyphicon-log-out" style="color:orange;"></span>&nbsp;تسجيل الخروج  </i></a></li>
                </ul>
            </div>
    </nav>

</header>
<br>
<div class="well"  style="font-size: 25px;font-weight: bold; color: #64AEF7; text-align: center;"><span class="glyphicon glyphicon-king" style="color: orange;"></span>&nbsp; خـيارات المـديـر</div>
<div class="container">
    <br>
    <br>
    <div class="row">
        <div class=" col-md-4 col-xs-12"  style="float: right;"><a href="man-globe.php"><button class="btn success"><span class="glyphicon glyphicon-globe"></span><br>إدارة البلدان</button></a></div>
        <div class=" col-md-4 col-xs-12" style="float: right;"><a href="man-hotel.php"><button class="btn warning"><span class="glyphicon glyphicon-cutlery"></span><br>إدارة الفنادق</button></a></div>
        <div class=" col-md-4 col-xs-12"  style="float: right;"><a href="man-flights.php"><button class="btn info"><span class="glyphicon glyphicon-plane"></span><br>إدارة الرحلات الجوية</button></a></div>

        <br>
    </div>
    <br>
    <div class="row">
        <div class=" col-md-4 col-xs-12" style="float: right;"><a href="man-users.php"><button class="btn info"><span class="glyphicon glyphicon-user"></span><br>إدارة المستخدمين</button></a></div>
        <div class=" col-md-4 col-xs-12" style="float: right;"><a href="man-offer.php"><button class="btn success"><span class="glyphicon glyphicon-gift"></span><br>العروض السياحية</button></a></div>
        <div class=" col-md-4 col-xs-12" style="float: right;"><a href="man-support.php"><button class="btn danger"><span class="glyphicon glyphicon-envelope"></span><br>الرسـائل</button></a></div>
        <br>
    </div>
    <br>
    <br>
</div>
</div>
<footer>
    <div style="font-size: 20px;font-family: cursive; text-align: center; width: 100%; height: 55px; padding-top: 12px; background-color:#64AEF7" >
        <p style="color:white;">ترافل رو للسياحة والسفر  2020</p>
    </div>
</footer>

<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>