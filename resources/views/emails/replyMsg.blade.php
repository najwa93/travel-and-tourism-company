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

        .content{
        }
    </style>
</head>
<body>
<header class="header">

</header>
<br>
<div class="container" >
    <h1 style="text-align: center;color: #ff9800;margin-bottom: 20px;">TravelRo Company</h1>
    <div class="content" style="background-color:#f2f4f6;height: 100%;width: 100%">
    <div class="col-xs-12" style="margin: 30px 30px 0;height: 50px;padding: 20px 60px">
        <p style="font-size: 20px;color: #000;font-weight: bold">{{$replyMsg}}</p>
    </div>
    </div>
    <footer >
        <div style="font-size: 20px;font-family: cursive; text-align: center; width: 100%; height: 36px;  background-color:#64AEF7;margin-bottom: 0" >
            <p style="color:white;">ترافل رو للسياحة والسفر  2020</p>
        </div>
    </footer>
</div>


</body>
</html>