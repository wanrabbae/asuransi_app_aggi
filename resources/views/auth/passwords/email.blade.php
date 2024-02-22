<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Password Reset | AGGIKU </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/landing') }}/logo-fav.png" />

    <link href="{{ asset('/back') }}/layouts/vertical-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/back') }}/layouts/vertical-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/back') }}/layouts/vertical-light-menu/loader.js"></script>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('/back') }}/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('/back') }}/layouts/vertical-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/back') }}/src/assets/css/light/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('/back') }}/layouts/vertical-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/back') }}/src/assets/css/dark/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex h-100">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @error('email')
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> {{ asset('/back') }}. </svg></button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    
                                    <h2>Password Reset</h2>
                                    <p>Masukan alamat email anda</p>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <button class="btn btn-secondary w-100">RECOVER</button>
                                    </div>
                                </div>
                                
                            </div>                                                          
                            </form>

                            <div class="col-12">
                                <div class="text-center">
                                    <p class="mb-0">Kembali ke <a href="{{ route('landinghome') }}" class="text-warning">BERANDA</a></p>
                                
                                </div>                                    
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>

    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/back') }}/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

</body>
</html>