<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Email Verify | AGGIKU </title>
    <link rel="icon" type="image/x-icon" href="{{ asset ('/img/landing') }}/logo-fav.png"/>
    <link href="{{ asset ('/back/layouts/vertical-light-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset ('/back/layouts/vertical-light-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset ('/back/layouts/vertical-light-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset ('/back/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset ('/back/layouts/vertical-light-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset ('/back') }}/src/assets/css/light/authentication/auth-cover.css" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset ('/back/layouts/vertical-light-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset ('/back/src/assets/css/dark/authentication/auth-cover.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
</head>

<div class="row">
                                            
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mx-auto mt-4">

        <div class="card style-2 mb-md-0 mb-4 mt-4"  style="text-align: center" >
            <div class="info-box-1-icon-wrapper mt-4">
                <div class="info-box-1-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>
                </div>
            </div>
            <div class="card-body px-0 pb-0 mb-4">
                 @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Link verifikasi email baru telah dikirim ke email anda.') }}
                    </div>
                @endif
                <h6 class="card-title mb-2">Selamat datang di program afiliasi aggiku, silakan cek email untuk verifikasi</h6>
                <h6 class="card-title mb-2">Jika tidak menerima email verifikasi</h6>
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-secondary mt-3">Klik disini untuk mengirim ulang</button>
                </form>
                <a href="{{ route('logout') }}" aria-expanded="false" class="dropdown-toggle"
                onclick="event.preventDefault();document.getElementById('adminLogoutForm').submit();">
                    <div class="btn btn-danger mt-3"><span>Log Out</span>
                    </div>
                </a>
                <form action="{{ route('logout') }}" id="adminLogoutForm" method="POST">@csrf</form>
            </div>
        </div>
        
    </div>
    
</div>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset ('/back/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset ('/back/src/assets/js/apps/checkbox-register.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>
