<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.meta')

    <title>AGGIKU</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/landing/logo-fav.png') }}" />

    @stack('before-style')
    <!-- style -->
    @include('admin.includes.style')

    @stack('after-style')

</head>

<body class="layout-boxed alt-menu">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    @include('admin.includes.header')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed " id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            @include('admin.includes.sidebar')
        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @yield('content')
            </div>

            @include('admin.includes.footer')

        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    @stack('before-script')
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    @include('admin.includes.script')

    @stack('after-script')

    <script>
        if (navigator.userAgent.indexOf("Firefox") != -1) {
            history.pushState(null, null, document.URL);
            window.addEventListener('popstate', function() {
                history.pushState(null, null, document.URL);
            })
        }
    </script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    {{ $script ?? '' }}
</body>

</html>
