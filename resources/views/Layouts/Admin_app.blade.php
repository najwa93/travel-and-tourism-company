<!DOCTYPE html>
<html lang="en">

<head>
    @include('Partials.Admin._head')
</head>

<body>

 @include('Partials.Web._header')
 @yield('content')

 @include('Partials.Web._footer')
 @include('Partials.Admin._javascript')
</body>

</html>


