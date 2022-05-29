<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>{{env('APP_NAME','Training Center Application')}}</title>
</head>
<body>

    @include('includes.navbar');
    <div class="container">
        @include('includes.messages')
        @yield('content')
    </div>
   <script src="{{asset('js/app.js')}}"></script>
   
</body>
</html>