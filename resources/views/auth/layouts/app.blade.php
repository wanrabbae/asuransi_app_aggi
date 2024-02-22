<!DOCTYPE html>
<html lang="en">

<head>
    @include('auth.includes.meta')

    <title>AGGIKU</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/landing/logo-fav.png') }}" />

    @stack('before-style')
    @include('auth.includes.style')

    @stack('after-style')

</head>

<body class="layout-boxed alt-menu">

    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>

    @include('auth.includes.header')

    <div class="main-container sidebar-closed " id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <div class="sidebar-wrapper sidebar-theme">
            @include('auth.includes.sidebar')
        </div>

        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @yield('content')
            </div>

            @include('auth.includes.footer')

        </div>
    </div>

    @stack('before-script')
    @include('auth.includes.script')
    @stack('after-script')

    <script>
        if (navigator.userAgent.indexOf("Firefox") != -1) {
            history.pushState(null, null, document.URL);
            window.addEventListener('popstate', function() {
                history.pushState(null, null, document.URL);
            })
        }
    </script>
</body>

</html>
