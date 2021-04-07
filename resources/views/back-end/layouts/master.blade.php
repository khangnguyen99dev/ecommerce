<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">​

    <base href="{{ asset('') }}">
    <title>@yield('title')</title>


    <!-- Custom fonts for this template-->
    <link href="assets/back-end/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="assets/back-end/css/nunito.css" rel="stylesheet">

<!--     <link href="assets/back-end/css/toastr.css" rel="stylesheet">

    <link href="assets/back-end/css/toastr.min.css" rel="stylesheet"> -->

    <!-- Custom styles for this template-->
    <link href="assets/back-end/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/toastr.css">


</head>

<body id="page-top">
<script src="assets/back-end/vendor/jquery/jquery.min.js"></script>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('back-end.layouts.menu')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                    @include('back-end.layouts.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
                @include('back-end.layouts.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
<!--     <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> -->

    <!-- Logout Modal-->
<!--     <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Bootstrap core JavaScript-->


    <script src="assets/back-end/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/back-end/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/back-end/js/sb-admin-2.min.js"></script>
    
    <script src="assets/js/toastr.min.js"></script>
    <script src="assets/back-end/js/ajax.js"></script>

    <script src="assets/ckeditor/ckeditor.js"></script>
</body>

</html>