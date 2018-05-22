<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title>StoryTourist</title>
    <!--  Scripts-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj12GSbaiQuGph88RC2U-io27b3DO46j8"></script>
</head>
<body>

<!--NAVBAR-->
@include('layouts.navbar')


<main>
    <div class="container">
        @yield('content')
    </div>
</main>


<!--FOOTER-->
@include('layouts.footer')


</body>
</html>