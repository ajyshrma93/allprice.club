<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @stack('css')
    <!-- Styles -->
    @include('layouts.includes.header-files')
    <style>
        .overlay {
            left: 0;
            top: 0;
            z-index: 9999;
            width: 100%;
            height: 100%;
            position: fixed;
            background: #222;
            opacity: .5;
        }

        .overlay__inner {
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            position: absolute;
        }

        .overlay__content {
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .spinner {
            width: 75px;
            height: 75px;
            display: inline-block;
            border-width: 2px;
            border-color: rgba(255, 255, 255, 0.05);
            border-top-color: #fff;
            animation: spin 1s infinite linear;
            border-radius: 100%;
            border-style: solid;
        }

        .icon-wrapper {
            position: absolute;
            left: 60%;
            top: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            height: 40px;
            width: 40px;
            border-radius: 50%;
            background-color: #fff;
            cursor: pointer;
            overflow: hidden;
            margin: 0 auto;
            font-size: 17px;
            -webkit-box-shadow: 0 0 6px 3px rgb(68 102 242 / 10%);
            box-shadow: 0 0 6px 3px rgb(68 102 242 / 10%);
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
            </filter>
        </svg>
    </div>
    <div class="overlay" id="process_request" style="display: none ;">
        <div class="overlay__inner">
            <div class="overlay__content"><span class="spinner"></span></div>
        </div>
    </div>
    <!-- loader ends-->

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('layouts.includes.header')
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('layouts.includes.sidebar')
            <!-- Page Sidebar Ends-->
            @yield('content')
            <!-- footer start-->
            <!-- -->
        </div>
    </div>
    @yield('modals')
    @include('layouts.includes.footer-files')
    @auth
    <script>
        var compare_location_url = "{{route('user.compare.location')}}";
        var update_location_url = "{{route('user.update.location')}}"
    </script>
    <script src="{{asset('assets/geolocation.js')}}"></script>
    @endauth

    @stack('scripts')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @if(Session::has('success'))
    <script>
        showToast('{{Session::get("success")}}', 'success')
    </script>
    @endif

    @if(Session::has('error'))
    <script>
        showToast('{{Session::get("error")}}', 'danger')
    </script>
    @endif

    <form action="{{route('logout')}}" method="POST" id="logout-form">
        @csrf
    </form>
</body>

</html>
