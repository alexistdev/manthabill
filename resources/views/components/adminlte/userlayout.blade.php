<div>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <x-adminlte.header-layout :title="$title" />
    </head>
    <body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Start: Navbar -->
        <x-adminlte.navbar-layout />
        <!-- End: Navbar -->

        <!-- Start: Sidebar -->
        <x-adminlte.sidebar-layout />
        <!-- End: Sidebar -->

        <!-- Start: Konten -->
        {{$slot}}
        <!-- End: Konten -->

        <!-- Start: Footer -->
        <x-adminlte.footer-layout footertag="Copyright 2018-2021" footersite="AlexistDev" />
        <!-- End: Footer -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
    </body>
    </html>

</div>
