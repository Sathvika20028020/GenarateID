<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description"
        content="Zeta admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Zeta admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('/theme/images/favicon-icon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/theme/images/favicon-icon.png') }}" type="image/x-icon">
    <title>@yield('title') - Admin</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/theme/css/vendors/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('/theme/css/vendors/icofont.css') }}">
    <!-- Feather icon-->
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('/theme/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('/theme/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('/theme/css/vendors/photoswipe.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('/theme/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('/theme/css/vendors/select2.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('/theme/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('/theme/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{asset('/theme/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('/theme/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    

    <style>
    .btn-close.white-close {
        filter: invert(1);
    }

    .select2-selection {
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
    }

    .select2-container .select2-selection--multiple {
        min-height: 38px !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border: solid #00000026 1px !important;
    }

  
    </style>
    @yield('style')
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-ball"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i class="fa-solid fa-arrow-up"></i></div>
    <!-- tap on tap ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('admin.layout.header')
        <div class="page-body-wrapper">
            @include('admin.layout.sidebar')
            <div class="page-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    @include('admin.layout.footer')
    <!-- latest jquery-->
    <script src="{{asset('/theme/js/jquery-3.5.1.min.js') }}"></script>

    <script src="{{asset('/theme/js/select2/select2.full.min.js') }}"></script>
    <script src="{{asset('/theme/js/select2/select2-custom.js') }}"></script>
    <!-- Bootstrap js-->

    <script src="{{asset('/theme/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <script src="{{asset('/theme/js/datepicker/daterange-picker/moment.min.js') }}"></script>
    <script src="{{asset('/theme/js/datepicker/daterange-picker/daterangepicker.js') }}"></script>
    <script src="{{asset('/theme/js/datepicker/daterange-picker/daterange-picker.custom.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{asset('/theme/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('/theme/js/datatable/datatables/datatable.custom.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{asset('/theme/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{asset('/theme/js/tooltip-init.js') }}"></script>
    <script src="{{asset('/theme/js/scrollbar/custom.js') }}"></script>







    <!-- Sidebar jquery-->
    <script src="{{asset('/theme/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('/theme/js/sidebar-menu.js') }}"></script>
    <script src="{{asset('/theme/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{asset('/theme/js/height-equal.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('/theme/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>

</html>