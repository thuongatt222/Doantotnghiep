<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../../images/admin/logo/logo.png" rel="icon">
    <title>RuangAdmin - Dashboard</title>
    <link href="{{ asset('vendors/admin/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendors/admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/admin/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/admin/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <link href="{{ asset('vendors/admin/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" >
    <link href="{{ asset('vendors/admin/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" >
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    @include('admin.layouts.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
            @include('admin.layouts.topbar')
            <!-- Topbar -->

            <!-- Container Fluid-->
            @yield('content')
            <!---Container Fluid-->

            @include('admin.layouts.footer')

        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="{{ asset('vendors/admin/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/admin/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/admin/demo/chart-area-demo.js') }}"></script>

    <script src="{{ asset('vendors/admin/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable(); // ID From dataTable
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover

            $('#simple-date4 .input-daterange').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                todayBtn: 'linked',
            });

            $('#simple-date1 .input-group.date').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: 'linked',
                todayHighlight: true,
                autoclose: true,
            });

            $('#touchSpin1').TouchSpin({
                min: 0,
                max: 1000000,
                boostat: 5,
                maxboostedstep: 10,
                initval: 0
            });

            $('#touchSpin3').TouchSpin({
                min: 0,
                max: 100,
                initval: 0,
                boostat: 5,
                maxboostedstep: 10,
                verticalbuttons: true,
            });
        });
    </script>

</body>

</html>
