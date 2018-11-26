<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
         <meta name="X-CSRF-TOKEN" content="{{ csrf_token() }}">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <style>
        </style>
         <link rel="stylesheet" href="{{asset('public/css/reset.css')}}">
       <link rel="stylesheet" href="{{asset('public/css/icon-style.scss')}}">
    </head>
    <body>
        <div id="app">
            
        </div>
      
           <script src="{{asset('public/js/main.js')}}"></script>
    </body>
</html>
