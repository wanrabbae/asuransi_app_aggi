<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SignIn | AGGI - MIKROSITE</title>
    <link rel="icon" type="image/x-icon" href="{{ asset ('/back') }}/src/assets/img/logo-fav.png"/>
    <link href="{{ asset ('/back/layouts/collapsible-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset ('/back/layouts/collapsible-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset ('/back/layouts/collapsible-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset ('/back/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset ('/back/layouts/collapsible-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset ('/back/src/assets/css/light/authentication/auth-boxed.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset ('/back/layouts/collapsible-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset ('/back/src/assets/css/dark/authentication/auth-boxed.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">
            <form method="POST" action="{{ route('dashboard.login_id') }}">
            @csrf
    
            <div class="row">
    
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            @if(Session::get('fail'))
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                {{ session::get('fail') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                <strong>{{ $errors->first('email') }}</strong>
                            </div> 
                            @endif

                            @error('email')
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                <strong>{{ $message }}</strong>
                            </div>                                   
                            @enderror

                            @error('password')
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                <strong>{{ $message }}</strong>
                            </div>                                   
                            @enderror
    
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    
                                    <h2>Sign In</h2>
                                    <p>Enter your email and password to login</p>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email" class="form-control form-control" name="email" value="{{ old('email') }}" autocomplete="email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <button class="btn btn-secondary w-100">SIGN IN</button>
                                    </div>
                                </div>
                                
                                <div class="col-12 mb-4">
                                    <div class="">
                                        <div class="seperator">
                                            <hr>
                                            <div class="seperator-text"> <span>AGGIKU</span></div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            </form>
            
        </div>

    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset ('/back/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>