
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/assets/owl.theme.default.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front-end/CSS/base.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front-end/CSS/main.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front-end/CSS/grid.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front-end/CSS/responsive.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front-end/CSS/product-info.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/front-end/fonts/fontawesome-free-5.14.0/css/all.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front-end/CSS/product-cart.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css')}}">

    <script src="{{ asset('assets/js/pusher.min.js')}}"></script>
    <script src="{{ asset('assets/js/axios.min.js')}}"></script>

</head>
<script src="{{ asset('assets/back-end/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/owlcarousel/owl.carousel.min.js')}}"></script>
<body>

    <!-- Block Element Modifier -->


    <div class="app">

        <!-- header -->
        @include('front-end.layouts.header')
        <!-- end header -->

        
        @yield('content')
        

        <!-- footer -->
        @include('front-end.layouts.footer')
        <!-- end footer -->

        
    </div>
    <div id="message-fixed"></div>
</body>
<script src="{{ asset('assets/front-end/Javascript/bugs.js')}}"></script>
<script src="{{ asset('assets/js/toastr.min.js')}}"></script>
<script src="{{ asset('assets/js/pagination.js')}}"></script>

@if(session('message'))
<script>
    toastr.options = {
        "debug": false,
        "positionClass": "toast-top-center",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 1000,
        "timeOut": 1000,
        "extendedTimeOut": 2000
    }
    toastr["info"]('{{session('message')}}');    
</script>
@endif

<script>
    let id = "{{Auth::id()}}";
    if(id){
        $('#message-fixed').load('http://kanestore.com/message');
    }
</script>
</html>