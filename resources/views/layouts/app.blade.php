<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('template') }}/images/favicon.svg" type="image/x-icon" />
    <title>@yield('title') | Klontong Apps</title>

    <!-- ========== All CSS files linkup ========= -->
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('template') }}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('template') }}/css/lineicons.css" />
    <link rel="stylesheet" href="{{ asset('template') }}/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="{{ asset('template') }}/css/main.css" />

</head>

<body>


    <!-- ======== sidebar-nav start =========== -->
    @include('components.side-bar')


    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">

        <!-- ========== header start ========== -->
        @include('components.header')
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <section>
            @yield('content')
        </section>
        <!-- ========== section end ========== -->


        <!-- ========== footer start ========== -->
        @include('components.footer')
        <!-- ========== footer end ========== -->

    </main>
    <!-- ======== main-wrapper end =========== -->
    @include('sweetalert::alert')
    <script src="{{ asset('template') }}/vendors/js/vendor.bundle.base.js"></script>

    <!-- ========= All Javascript files linkup ======== -->
    @stack('scripts')
    <script src="{{ asset('template') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template') }}/js/Chart.min.js"></script>
    <script src="{{ asset('template') }}/js/main.js"></script>

</body>

</html>