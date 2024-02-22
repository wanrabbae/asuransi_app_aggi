    <header class="wrapper">
        <nav class="navbar navbar-expand-lg classic transparent position-absolute">
            <div class="container flex-lg-row flex-nowrap align-items-center">
                <div class="navbar-brand w-100">
                    <a href="">
                        <img class="logo-dark" src="{{ asset('/img/landing/logo-01.png') }}" srcset="{{ asset('/img/landing/logo-01.png') }}" alt="" />
                        <img class="logo-light" src="{{ asset('/img/landing/logo-01.png') }}" srcset="{{ asset('/img/landing/logo-01.png') }}" alt="" />
                    </a>
                </div>

                <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                    <div class="offcanvas-header d-lg-none">
                        <h3 class="text-white fs-30 mb-0">AGGIKU</h3>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('landinghome') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->is('kawan-aggi') ? 'active' : '' }}" href="{{ route('kawan-aggi') }}">Aggiku</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->is('klaim') ? 'active' : '' }}" href="{{ route('klaim') }}">Klaim</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->is('artikel') ? 'active' : '' }}" href="{{ route('artikel') }}">Artikel</a></li>
                            @auth
                                <li class="nav-item menutop">
                                    <a href="{{ route('dashboard.user') }}" class="nav-link">Dashboard</a>
                                </li>
                            @endauth
                        </ul>
                        <div class="offcanvas-footer d-lg-none">
                            <div>
                                <a href="mailto:first.last@email.com" class="link-inverse">{{ $landing->email }}</a>
                                <br /> {{ $landing->hotline }} <br />
                            </div>
                        </div>
                    </div>
                </div>

                @if (auth()->check())
                    <div class="navbar-other w-100 d-flex ms-auto menutop2">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item d-none d-md-block">
                                <a href="{{ route('dashboard.user') }}" class="btn btn-sm btn-aggi rounded-pill">Dashboard</a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <button class="hamburger offcanvas-nav-btn"><span></span></button>
                            </li>
                        </ul>
                    </div>
                @endif
                @guest
                    <div class="navbar-other w-100 d-flex ms-auto">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item">
                                <a href="#" class="btn btn-sm btn-aggi rounded" data-bs-toggle="modal" data-bs-target="#modal-signin">Masuk</a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <button class="hamburger offcanvas-nav-btn"><span></span></button>
                            </li>
                        </ul>
                    </div>
                @endguest

            </div>
        </nav>

        <div class="modal fade" id="modal-signin" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content text-center">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h2 class="mb-1 text-start">Hai AGGIKU</h2>
                        <p class="lead mb-6 text-start fs-14">Masukan email dan kata sandi, untuk masuk.</p>

                        <form method="POST" action="{{ route('login') }}" class="text-start mb-3">
                            @csrf
                            @if (Session::get('fail'))
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    {{ session::get('fail') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    {{ $errors->first('email') }}
                                </div>
                            @endif

                            @error('email')
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    {{ $message }}
                                </div>
                            @enderror

                            @error('password')
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" placeholder="Email" id="loginEmail" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <label for="loginEmail">Email</label>
                            </div>
                            <div class="form-floating password-field mb-4">
                                <input type="password" class="form-control" name="password" placeholder="Password" id="loginPassword" required>
                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                <label for="loginPassword">Password</label>
                            </div>
                            <button class="btn btn-primary rounded-pill btn-login w-100 mb-2">MASUK</button>
                        </form>
                        <!-- /form -->
                        <p class="mb-1"><a href="{{ route('password.request') }}" class="hover">Lupa Password?</a></p>

                    </div>
                </div>
            </div>
        </div>

    </header>
    
