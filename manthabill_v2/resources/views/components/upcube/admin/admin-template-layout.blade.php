
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard | {{config('app.name')}} Version {{config('app.version')}} </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{ config('app.name') ." " . config('app.version')}}" name="description" />
        <meta content="alexistdev" name="author" />
        <!-- App favicon -->

        <x-upcube.admin.header-layout />
        @stack('customCSS')
    </head>

    <body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <x-upcube.admin.topbar-layout />
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!-- User details -->
                <div class="user-profile text-center mt-3">
                    <div class="">
                        <img src="{{asset('template/upcube/assets/images/users/avatar-1.jpg')}}" alt="" class="avatar-md rounded-circle">
                    </div>
                    <div class="mt-3">
                        <h4 class="font-size-16 mb-1">Julia Hudda</h4>
                        <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
                    </div>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <x-upcube.admin.sidebar-layout />
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            {{$slot}}
            <!-- End Page-content -->

            <footer class="footer">
                <x-upcube.admin.footer-layout />
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!-- JAVASCRIPT -->
    <script src="{{asset('template/upcube/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/upcube/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('template/upcube/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('template/upcube/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('template/upcube/assets/libs/node-waves/waves.min.js')}}"></script>


    <!-- apexcharts -->
    <script src="{{asset('template/upcube/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- jquery.vectormap map -->
    <script src="{{asset('template/upcube/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('template/upcube/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}"></script>

    <script src="{{asset('template/upcube/assets/js/pages/dashboard.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('template/upcube/assets/js/app.js')}}"></script>

    @stack('customJS')
    </body>

    </html>
