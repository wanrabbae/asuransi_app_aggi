            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row  text-center">
                    <div class="nav-logo">
                        <div class="nav-item theme-logo">
                            <a href="{{ route('dashboard.user') }}">
                                <img src="{{ asset('/img/landing/logo-fav.png') }}" class="navbar" alt="logo">
                            </a>
                        </div>
                        <div class="nav-item theme-text">
                            <a href="{{ route('dashboard.user') }}" class="nav-link"> AGGI </a>
                        </div>
                    </div>
                    <div class="nav-item sidebar-toggle">
                        <div class="btn-toggle sidebarCollapse">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevrons-left">
                                <polyline points="11 17 6 12 11 7"></polyline>
                                <polyline points="18 17 13 12 18 7"></polyline>
                            </svg>
                        </div>
                    </div>
                </div>

                <ul class="list-unstyled menu-categories" id="accordionExample">

                    @if (auth()->user()->roles == 0)
                        <li class="menu {{ Route::is('dashboard.user') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.user') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    <span>Home</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.profile', 'dashboard.editprofile') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.profile') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span>Profil</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.user.linkagen') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.user.linkagen') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>
                                    </svg>
                                    <span>AggiLink</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu  {{ Route::is('dashboard.commission') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.commission') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                    <span>Poinku</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu  {{ Route::is('dashboard.nasabahagen') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.nasabahagen') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span>Data Nasabah</span>
                                </div>                            
                            </a>
                        </li>
                        {{-- <li class="menu {{ Route::is('dashboard.polis.show', 'dashboard.polis', 'dashboard.request', 'dashboard.paid', 'dashboard.process', 'dashboard.expired') ? 'active' : '' }}">
                            <a href="#datapoin" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>Polisku</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datapoin" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.request') }}"> Polis Dipesan </a></li>
                                <li><a href="{{ route('dashboard.paid') }}"> Polis dibayar </a></li>
                                <li><a href="{{ route('dashboard.process') }}"> Polis diproses</a></li>
                                <li><a href="{{ route('dashboard.polis') }}"> Polis Aktif </a></li>
                                <li><a href="{{ route('dashboard.expired') }}">Polis Expired</a></li>
                            </ul>
                        </li> --}}
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>POLISKU</span>
                            </div>
                        </li>
                        <li class="menu {{ Route::is(
                            'dashboard.polis.show', 
                            'dashboard.polis',
                            'dashboard.expired',
                            'dashboard.followup',
                            'dashboard.active',
                            'dashboard.process', 
                            'dashboard.paid',
                            'dashboard.unpaid', 
                            'dashboard.request' 
                            ) ? 'active' : '' }}">
                            <a href="#datatransactiononline" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>Online Polis</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> 
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datatransactiononline" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.polis') }}"> Semua Polis</a></li>
                                <li><a href="{{ route('dashboard.expired') }}">Polis Expired</a></li>
                                <li><a href="{{ route('dashboard.followup') }}"> Jatuh Tempo </a></li>
                                <li><a href="{{ route('dashboard.active') }}"> Polis Aktif </a></li>
                                <li><a href="{{ route('dashboard.process') }}"> Polis diproses</a></li>
                                <li><a href="{{ route('dashboard.paid') }}"> Polis dibayar </a></li>
                                <li><a href="{{ route('dashboard.unpaid') }}"> Menunggu pembayaran </a></li>
                                <li><a href="{{ route('dashboard.request') }}"> Permintaan Polis</a></li>
                            </ul>
                        </li>
                        <li class="menu {{ Route::is(
                            'dashboard.offpolis.show',
                            'dashboard.offexpired',
                            'dashboard.offpolis',
                            'dashboard.offactive',
                            'dashboard.offpolisprocess',
                            'dashboard.offpaid',
                            'dashboard.offunpaid',
                            'dashboard.offprocess',
                            'dashboard.offrequest'
                            ) ? 'active' : '' }}">
                            <a href="#datatransactioffonline" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M22.61 16.95A5 5 0 0 0 18 10h-1.26a8 8 0 0 0-7.05-6M5 5a8 8 0 0 0 4 15h9a5 5 0 0 0 1.7-.3">
                                        </path>
                                        <line x1="1" y1="1" x2="23" y2="23">
                                        </line>
                                    </svg>
                                    <span>Offline Polis</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datatransactioffonline" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.offpolis') }}">Semua Polis</a></li>
                                <li><a href="{{ route('dashboard.offexpired') }}">Polis Expired</a></li>
                                <li><a href="{{ route('dashboard.offactive') }}"> Polis Aktif </a></li>
                                <li><a href="{{ route('dashboard.offpolisprocess') }}"> Polis diproses</a></li>
                                <li><a href="{{ route('dashboard.offpaid') }}"> Polis dibayar </a></li>
                                <li><a href="{{ route('dashboard.offunpaid') }}"> Menunggu Pembayaran</a></li>
                                <li><a href="{{ route('dashboard.offprocess') }}"> Permintaan Diproses </a></li>
                                <li><a href="{{ route('dashboard.offrequest') }}"> Permintaan Polis </a></li>
                            </ul>
                        </li>
                        <li class="menu {{ Route::is('dashboard.belibaru') || Route::is('dashboard.belibaru.detail') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.belibaru') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <line x1="12" y1="20" x2="12" y2="10"></line>
                                        <line x1="18" y1="20" x2="18" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="16"></line>
                                    </svg>
                                    <span>Product Online</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.belibaru.offline') || Route::is('dashboard.belibaru.offline.detail') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.belibaru.offline') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                        <line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="14"></line>
                                    </svg>
                                    <span>Product Offline</span>
                                </div>
                            </a>
                        </li>
                    @elseif (auth()->user()->roles == 1)
                        <li class="menu {{ Route::is('dashboard.user') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.user') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    <span>Home</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.profile', 'dashboard.editprofile') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.profile') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span>Profil</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>POLISKU</span>
                            </div>
                        </li>
                        <li class="menu {{ Route::is(
                            'dashboard.polis.show', 
                            'dashboard.polis',
                            'dashboard.expired',
                            'dashboard.followup',
                            'dashboard.active',
                            'dashboard.process', 
                            'dashboard.paid',
                            'dashboard.unpaid', 
                            'dashboard.request' 
                            ) ? 'active' : '' }}">
                            <a href="#datatransactiononline" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>Online Polis</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> 
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datatransactiononline" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.polis') }}"> Semua Polis</a></li>
                                <li><a href="{{ route('dashboard.expired') }}">Polis Expired</a></li>
                                <li><a href="{{ route('dashboard.followup') }}"> Jatuh Tempo </a></li>
                                <li><a href="{{ route('dashboard.active') }}"> Polis Aktif </a></li>
                                <li><a href="{{ route('dashboard.process') }}"> Polis diproses</a></li>
                                <li><a href="{{ route('dashboard.paid') }}"> Polis dibayar </a></li>
                                <li><a href="{{ route('dashboard.unpaid') }}"> Menunggu pembayaran </a></li>
                                <li><a href="{{ route('dashboard.request') }}"> Permintaan Polis</a></li>
                            </ul>
                        </li>
                        <li class="menu {{ Route::is(
                            'dashboard.offpolis.show',
                            'dashboard.offexpired',
                            'dashboard.offpolis',
                            'dashboard.offactive',
                            'dashboard.offpolisprocess',
                            'dashboard.offpaid',
                            'dashboard.offunpaid',
                            'dashboard.offprocess',
                            'dashboard.offrequest'
                            ) ? 'active' : '' }}">
                            <a href="#datatransactioffonline" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M22.61 16.95A5 5 0 0 0 18 10h-1.26a8 8 0 0 0-7.05-6M5 5a8 8 0 0 0 4 15h9a5 5 0 0 0 1.7-.3">
                                        </path>
                                        <line x1="1" y1="1" x2="23" y2="23">
                                        </line>
                                    </svg>
                                    <span>Offline Polis</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datatransactioffonline" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.offpolis') }}">Semua Polis</a></li>
                                <li><a href="{{ route('dashboard.offexpired') }}">Polis Expired</a></li>
                                <li><a href="{{ route('dashboard.offactive') }}"> Polis Aktif </a></li>
                                <li><a href="{{ route('dashboard.offpolisprocess') }}"> Polis diproses</a></li>
                                <li><a href="{{ route('dashboard.offpaid') }}"> Polis dibayar </a></li>
                                <li><a href="{{ route('dashboard.offunpaid') }}"> Menunggu Pembayaran</a></li>
                                <li><a href="{{ route('dashboard.offprocess') }}"> Permintaan Diproses </a></li>
                                <li><a href="{{ route('dashboard.offrequest') }}"> Permintaan Polis </a></li>
                            </ul>
                        </li>
                    @elseif (auth()->user()->roles == 2 || auth()->user()->roles == 3)
                        <li class="menu {{ Route::is('dashboard.user') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.user') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    <span>Home</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.profile', 'dashboard.editprofile') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.profile') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span>Profil</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.user.link') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.user.link') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>
                                    </svg>
                                    <span>AggiLink</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.commission') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.commission') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                    <span>Poinku</span>
                                </div>
                            </a>
                        </li>
                        {{-- <li class="menu {{ Route::is('dashboard.polis.show', 'dashboard.polis', 'dashboard.request', 'dashboard.paid', 'dashboard.process', 'dashboard.expired') ? 'active' : '' }}">
                            <a href="#datapoin" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>Polisku</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datapoin" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.request') }}"> Polis Dipesan </a></li>
                                <li><a href="{{ route('dashboard.paid') }}"> Polis dibayar </a></li>
                                <li><a href="{{ route('dashboard.process') }}"> Polis diproses</a></li>
                                <li><a href="{{ route('dashboard.polis') }}"> Polis Aktif </a></li>
                                <li><a href="{{ route('dashboard.expired') }}">Polis Expired</a></li>
                            </ul>
                        </li> --}}

                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>POLISKU</span>
                            </div>
                        </li>
                        <li class="menu {{ Route::is(
                            'dashboard.polis.show', 
                            'dashboard.polis',
                            'dashboard.expired',
                            'dashboard.followup',
                            'dashboard.active',
                            'dashboard.process', 
                            'dashboard.paid',
                            'dashboard.unpaid', 
                            'dashboard.request' 
                            ) ? 'active' : '' }}">
                            <a href="#datatransactiononline" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>Online Polis</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> 
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datatransactiononline" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.polis') }}"> Semua Polis</a></li>
                                <li><a href="{{ route('dashboard.expired') }}">Polis Expired</a></li>
                                <li><a href="{{ route('dashboard.followup') }}"> Jatuh Tempo </a></li>
                                <li><a href="{{ route('dashboard.active') }}"> Polis Aktif </a></li>
                                <li><a href="{{ route('dashboard.process') }}"> Polis diproses</a></li>
                                <li><a href="{{ route('dashboard.paid') }}"> Polis dibayar </a></li>
                                <li><a href="{{ route('dashboard.unpaid') }}"> Menunggu pembayaran </a></li>
                                <li><a href="{{ route('dashboard.request') }}"> Permintaan Polis</a></li>
                            </ul>
                        </li>
                        <li class="menu {{ Route::is(
                            'dashboard.offpolis.show',
                            'dashboard.offexpired',
                            'dashboard.offpolis',
                            'dashboard.offactive',
                            'dashboard.offpolisprocess',
                            'dashboard.offpaid',
                            'dashboard.offunpaid',
                            'dashboard.offprocess',
                            'dashboard.offrequest'
                            ) ? 'active' : '' }}">
                            <a href="#datatransactioffonline" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M22.61 16.95A5 5 0 0 0 18 10h-1.26a8 8 0 0 0-7.05-6M5 5a8 8 0 0 0 4 15h9a5 5 0 0 0 1.7-.3">
                                        </path>
                                        <line x1="1" y1="1" x2="23" y2="23">
                                        </line>
                                    </svg>
                                    <span>Offline Polis</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datatransactioffonline" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.offpolis') }}">Semua Polis</a></li>
                                <li><a href="{{ route('dashboard.offexpired') }}">Polis Expired</a></li>
                                <li><a href="{{ route('dashboard.offactive') }}"> Polis Aktif </a></li>
                                <li><a href="{{ route('dashboard.offpolisprocess') }}"> Polis diproses</a></li>
                                <li><a href="{{ route('dashboard.offpaid') }}"> Polis dibayar </a></li>
                                <li><a href="{{ route('dashboard.offunpaid') }}"> Menunggu Pembayaran</a></li>
                                <li><a href="{{ route('dashboard.offprocess') }}"> Permintaan Diproses </a></li>
                                <li><a href="{{ route('dashboard.offrequest') }}"> Permintaan Polis </a></li>
                            </ul>
                        </li>
                    @endif

                    <li class="menu {{ Route::is('dashboard.notifikasi') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.notifikasi') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                                <span>Notifikasi</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="https://wa.me/6281211126199" target="_blank" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.37 8.37 0 0 1-.9 3.8 8.49 8.49 0 0 1-7.6 4.7 8.37 8.37 0 0 1-3.8-.9L3 21l1.9-5.7a8.37 8.37 0 0 1-.9-3.8 8.49 8.49 0 0 1 4.7-7.6 8.37 8.37 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8Z"/>
                                    <path d="M9.49 10a7.58 7.58 0 0 0 .72 1.42A8 8 0 0 0 14 14.5M9.49 10a7.47 7.47 0 0 1-.4-1.4.51.51 0 0 1 .52-.6h0a.54.54 0 0 1 .51.37l.38 1.13ZM14 14.5a7.8 7.8 0 0 0 1.43.41.51.51 0 0 0 .6-.52h0a.54.54 0 0 0-.37-.51l-1.16-.38Z"/>
                                </svg>     
                                <span>Butuh Bantuan..?</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('landinghome') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                                <span>Landing Page</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="route('logout')" aria-expanded="false" class="dropdown-toggle" onclick="event.preventDefault();document.getElementById('adminLogoutForm').submit();">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span>Log Out</span>
                            </div>
                        </a>
                        <form action="{{ route('logout') }}" id="adminLogoutForm" method="POST">@csrf</form>
                    </li>

                </ul>
            </nav>
