<!DOCTYPE html>
<html lang="en">

<head>

    @include('landing.includes.meta')
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/img/landing/' . $landing->favicon) }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @stack('before-style')
    @include('landing.includes.style')
    @stack('after-style')

</head>

<body>
    <div class="page-frame bg-pale-primary">
        <div class="content-wrapper">

            @include('landing.includes.header')
            @yield('content')
            @include('landing.includes.footer')            

        </div>
    </div>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    @stack('before-script')
    @include('landing.includes.script')
    @stack('after-script')

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
    if ("serviceWorker" in navigator) {
        navigator.serviceWorker.register("/sw.js").then(
        (registration) => {
            console.log("Service worker registration succeeded:", registration);
        },
        (error) => {
            console.error(`Service worker registration failed: ${error}`);
        },
        );
    } else {
        console.error("Service workers are not supported.");
    }
    </script>

    
</body>

</html>
