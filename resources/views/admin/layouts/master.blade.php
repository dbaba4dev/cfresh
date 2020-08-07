<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <script src="{{asset('css/sweetalert.js')}}"></script>
    <link href="{{asset('css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    @yield('head')
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper" >
    <!-- Navbar -->
    @include('admin.includes.top_nav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"  >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('page-header')
        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
{{--        <div class="float-right d-none d-sm-block">--}}
{{--            <b>Version</b> 3.0.3-pre--}}
{{--        </div>--}}
        <strong>Copyright &copy; 2020-2021 <a href="{{route('home')}}">cfresh.org</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
{{--    <aside class="control-sidebar control-sidebar-dark">--}}
{{--        <!-- Control sidebar content goes here -->--}}
{{--    </aside>--}}
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{asset('js/all.js')}}"></script>
<script src="{{asset('frontend/js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>


@yield('scripts')
<script>
    $(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
<script>
        @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>

{{--<script>--}}
{{--    $(function () {--}}
{{--        $('.nav-item .nav-link').on('click',function () {--}}
{{--            var $nav_menu=$(this).closest('.nav');--}}

{{--            $nav_menu.find('.nav-item .nav-link.active').removeClass('active');--}}
{{--            $(this).addClass('active');--}}
{{--        })--}}
{{--    })--}}
{{--</script>--}}
</body>
</html>
