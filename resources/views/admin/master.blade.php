<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}"/>

    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <title>CEGA ADMIN PANEL</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Toaster Css -->
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.css')}}">

    <!-- Bootstrap Toggle -->

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    <!--TOASTR --->
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>

    <script src="{{asset('plugins/sweetalert2/sweetalert2.all.js')}}"></script>

    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.css')}}">

    @yield('css')
</head>

<body class="hold-transition sidebar-mini  layout-footer-fixed layout-fixed sidebar-collapse">
@include('admin.modal-confirmation')
<div class="wrapper">
    <!-- Navbar -->
@include('admin.layouts.navbar')
<!-- /.navbar -->

    <!-- Sidebar Container -->

    <!-- Sidebar End --->
@include('admin.layouts.sidebar')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="loading d-none">Loading&#8230;</div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="custom-breadcrumb flat">
                    @yield('breadcrumb')
                </div>
            </div>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Made with <span class="text-danger">&hearts;</span> by  <a href="https://obiwan.space" class="link-black mb-1" target="_blank">ObiWanKenobi</a></strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{asset('js/toast.js')}}"></script>
<script src="{{asset('js/form.js')}}"></script>
<script src="{{asset('js/dialog.js')}}"></script>
@yield('js')
</body>
</html>
