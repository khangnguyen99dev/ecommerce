
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">​
    <link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">

    <link rel="stylesheet" type="text/css" href="assets/front-end/CSS/base.css" />
    <link rel="stylesheet" type="text/css" href="assets/front-end/CSS/main.css" />
    <link rel="stylesheet" type="text/css" href="assets/front-end/CSS/grid.css" />
    <link rel="stylesheet" type="text/css" href="assets/front-end/CSS/responsive.css" />
    <link rel="stylesheet" href="assets/front-end/fonts/fontawesome-free-5.14.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/front-end/CSS/product-info.css" />
    <link rel="stylesheet" type="text/css" href="assets/front-end/CSS/product-cart.css" />
    <link rel="stylesheet" href="assets/css/toastr.css">

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

</head>
<script src="assets/back-end/vendor/jquery/jquery.min.js"></script>
<script src="assets/owlcarousel/owl.carousel.min.js"></script>

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
<script src="assets/front-end/Javascript/bugs.js"></script>
<!-- <script src="assets/front-end/Javascript/validator.js"></script> -->
<!-- <script>
    Validator('#register-form', '.auth-form__group', 3);
    Validator('#login-form', '.auth-form__group', 3);
</script> -->
<!-- <script src="assets/front-end/Javascript/handleform.js"></script> -->
<script src="assets/js/toastr.min.js"></script>
<script src="assets/js/pagination.js"></script>

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
        fetch('http://kanestore.com/message')
        .then(response => response.text())
        .then(blob => {
            $('#message-fixed').html(blob);
        });
    }
</script>
</html>