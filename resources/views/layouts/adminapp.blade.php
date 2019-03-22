<!DOCTYPE html> 
<html>
<head>
    
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') </title>
    <link href="{{ asset('images/logo.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}"/>
    <link href='https://fonts.googleapis.com/css?family=Alice' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}"/>

</head>
<body>
        
    @include('layouts.sidebar')
    <div id="main" class=main>
        @include('layouts.header')
        @yield('content')
    </div>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{asset('admin')}}/js/index.js"></script> 
    <script src="{{asset('admin')}}/js/add_student.js"></script> 
    <script src="{{asset('admin')}}/js/add_teacher.js"></script> 
    <script src="{{asset('admin')}}/js/set_schedule.js"></script> 



     @yield('script') 

</body>
</html>
