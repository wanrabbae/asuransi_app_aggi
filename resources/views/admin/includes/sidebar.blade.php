            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row  text-center">
                    <div class="nav-logo">
                        <div class="nav-item theme-logo">
                            <a href="javascript:void(0);">
                                <img src="{{ asset('/img/landing/logo-fav.png') }}" class="navbar" alt="logo">
                            </a>
                        </div>
                        <div class="nav-item theme-text">
                            <a href="javascript:void(0);" class="nav-link"> AGGI </a>
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
                        <!-- home -->
                        <li class="menu  {{ Route::is('dashboard.index') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.index') }}" aria-expanded="false" class="dropdown-toggle">
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
                        <!-- userdata -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>USER DATA</span>
                            </div>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.userdata.index',
                                'dashboard.userdata.create',
                                'dashboard.userdata.createagent',
                                'dashboard.userdata.edit',
                                'dashboard.userdata.affliator',
                                'dashboard.userdata.editaffliator',
                                'dashboard.userdata.nasabahaff',
                                'dashboard.userdata.agent',
                                'dashboard.userdata.editagent',
                                'dashboard.userdata.datanasabahaff',
                                'dashboard.userdata.datanasabahagent',
                                'dashboard.userdata.nasabahagent',
                                'dashboard.userdata.admin',
                                'dashboard.userdata.editadmin',
                                'dashboard.userdata.agent.request',
                                'dashboard.userdata.editagentrequest',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#home" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span>Data Users</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="home" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.userdata.index') }}"> Data Nasabah </a></li>
                                <li><a href="{{ route('dashboard.userdata.affliator') }}"> Data Affiliator </a></li>
                                <li><a href="{{ route('dashboard.userdata.agent.request') }}"> Mitra Request </a></li>
                                <li><a href="{{ route('dashboard.userdata.agent') }}"> Data Mitra </a></li>
                                <li><a href="{{ route('dashboard.userdata.admin') }}"> Data Admin </a></li>
                            </ul>
                        </li>
                        <!-- sales -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>Sales Data</span>
                            </div>
                        </li>
                        <li class="menu {{ Route::is('dashboard.userdata.affsales') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.userdata.affsales') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <span>Affiliator</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.userdata.agentsales') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.userdata.agentsales') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                        <rect x="9" y="9" width="6" height="6"></rect>
                                        <line x1="9" y1="1" x2="9" y2="4"></line>
                                        <line x1="15" y1="1" x2="15" y2="4"></line>
                                        <line x1="9" y1="20" x2="9" y2="23"></line>
                                        <line x1="15" y1="20" x2="15" y2="23"></line>
                                        <line x1="20" y1="9" x2="23" y2="9"></line>
                                        <line x1="20" y1="14" x2="23" y2="14">
                                        </line>
                                        <line x1="1" y1="9" x2="4" y2="9"></line>
                                        <line x1="1" y1="14" x2="4" y2="14"></line>
                                    </svg>
                                    <span>Mitra</span>
                                </div>
                            </a>
                        </li>
                        <!-- product -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>PRODUCT</span>
                            </div>
                        </li>
                        <li class="menu {{ Route::is('dashboard.onlineproductdata.index', 'dashboard.onlineproductdata.create', 'dashboard.onlineproductdata.edit') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.onlineproductdata.index') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>Online Product</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.offlineproductdata.index', 'dashboard.offlineproductdata.create', 'dashboard.offlineproductdata.edit') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.offlineproductdata.index') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M22.61 16.95A5 5 0 0 0 18 10h-1.26a8 8 0 0 0-7.05-6M5 5a8 8 0 0 0 4 15h9a5 5 0 0 0 1.7-.3"></path>
                                        <line x1="1" y1="1" x2="23" y2="23"></line>
                                    </svg>
                                    <span>Offline Product</span>
                                </div>
                            </a>
                        </li>
                        <!-- transaction -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>TRANSACTION</span>
                            </div>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.onlinetransaction.alltrx',
                                'dashboard.onlinetransaction.index',
                                'dashboard.onlinetransaction.pending',
                                'dashboard.onlinetransaction.paid',
                                'dashboard.onlinetransaction.process',
                                'dashboard.onlinetransaction.completed',
                                'dashboard.onlinetransaction.followup',
                                'dashboard.onlinetransaction.expired',
                                'dashboard.onlinetransaction.show',
                                'dashboard.onlinetransaction.alltrx.filter',
                                'dashboard.onlinetransaction.index.filter',
                                'dashboard.onlinetransaction.pending.filter',
                                'dashboard.onlinetransaction.paid.filter',
                                'dashboard.onlinetransaction.complete.filter',
                                'dashboard.onlinetransaction.follow.filter',
                                'dashboard.onlinetransaction.expired.filter',
                                'dashboard.onlinetransaction.process.filter',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#datatransactiononline" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                    <span>Online Trx</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datatransactiononline" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.onlinetransaction.alltrx') }}"> All Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.index') }}"> Request Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.pending') }}"> Pending Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.paid') }}"> Paid Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.process') }}"> Process Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.completed') }}"> Completed Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.followup') }}"> Followup Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.expired') }}"> Expired Data </a></li>
                            </ul>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.offlinetransaction.alltrx',
                                'dashboard.offlinetransaction.index',
                                'dashboard.offlinetransaction.show',
                                'dashboard.offlinetransaction.process',
                                'dashboard.offlinetransaction.payment',
                                'dashboard.offlinetransaction.paid',
                                'dashboard.offlinetransaction.polisprocess',
                                'dashboard.offlinetransaction.completed',
                                'dashboard.offlinetransaction.followup',
                                'dashboard.offlinetransaction.expired',
                                'dashboard.offlinetransaction.alltrx.filter',
                                'dashboard.offlinetransaction.index.filter',
                                'dashboard.offlinetransaction.process.filter',
                                'dashboard.offlinetransaction.payment.filter',
                                'dashboard.offlinetransaction.paid.filter',
                                'dashboard.offlinetransaction.polisprocess.filter',
                                'dashboard.offlinetransaction.completed.filter',
                                'dashboard.offlinetransaction.follow.filter',
                                'dashboard.offlinetransaction.expired.filter',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#datatransactioffonline" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                    </svg>
                                    <span>Offline Trx</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datatransactioffonline" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.offlinetransaction.alltrx') }}"> All Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.index') }}"> Request Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.process') }}"> Process Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.payment') }}"> Payment Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.paid') }}"> Paid Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.polisprocess') }}"> Polis Process </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.completed') }}"> Completed Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.followup') }}"> Followup Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.expired') }}"> Expired Data </a></li>
                            </ul>
                        </li>
                        <!-- finance -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>FINANCE</span>
                            </div>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.onlinetransaction.alldata',
                                'dashboard.onlinetransaction.premi',
                                'dashboard.offlinetransaction.premi',
                                'dashboard.onlinetransaction.showfinance',
                                'dashboard.onlinetransaction.premi.filter',
                                'dashboard.offlinetransaction.showfinance',
                                'dashboard.onlinetransaction.showall',
                                'dashboard.onlinetransaction.alldata.filter',
                                'dashboard.offlinetransaction.premi.filter',
                                'dashboard.onlinetransaction.adminfee',
                                'dashboard.onlinetransaction.adminfee.filter',
                                'dashboard.onlinetransaction.materai',
                                'dashboard.onlinetransaction.materai.filter',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#dataincomes" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>Data Incomes</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="dataincomes" data-bs-parent="#accordionExample">
                                <li> <a href="{{ route('dashboard.onlinetransaction.alldata') }}"> All Incomes </a></li>
                                <li> <a href="{{ route('dashboard.onlinetransaction.premi') }}"> Online Premi </a></li>
                                <li> <a href="{{ route('dashboard.offlinetransaction.premi') }}"> Offline Premi </a></li>
                                <li> <a href="{{ route('dashboard.onlinetransaction.adminfee') }}"> Admin Fee </a></li>
                                <li> <a href="{{ route('dashboard.onlinetransaction.materai') }}"> Materai </a></li>
                            </ul>
                        </li>
                        <li class="menu {{ Route::is('dashboard.expensedata.index', 'dashboard.expensedata.create', 'dashboard.expensedata.filter', 'dashboard.expensedata.edit') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.expensedata.index') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                    </svg>
                                    <span>Data Expenses</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.poindata.index', 'dashboard.poindata.index.filter') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.poindata.index') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                    <span>Data Poin Partner</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.poindata.index_poin', 'dashboard.poindata.index_poin.filter') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.poindata.index_poin') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z"></path>
                                        <polyline points="8 10 12 14 16 10"></polyline>
                                    </svg>
                                    <span>Data Poin</span>
                                </div>
                            </a>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.redeemdata.index',
                                'dashboard.redeemdata.request',
                                'dashboard.redeemdata.process',
                                'dashboard.redeemdata.success',
                                'dashboard.redeemdata.index.Filter',
                                'dashboard.redeemdata.request.Filter',
                                'dashboard.redeemdata.process.Filter',
                                'dashboard.redeemdata.success.Filter',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#dataredeem" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                        <rect x="2" y="7" width="20" height="5"></rect>
                                        <line x1="12" y1="22" x2="12" y2="7"></line>
                                        <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                                    </svg>
                                    <span>Data Redeem</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="dataredeem" data-bs-parent="#accordionExample">
                                <li> <a href="{{ route('dashboard.redeemdata.index') }}"> Redeem Poins </a></li>
                                <li> <a href="{{ route('dashboard.redeemdata.request') }}"> Redeem Request </a></li>
                                <li> <a href="{{ route('dashboard.redeemdata.process') }}"> Redeem Process </a></li>
                                <li> <a href="{{ route('dashboard.redeemdata.success') }}"> Redeem Success </a></li>
                            </ul>
                        </li>
                        <!-- setting -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>SETTING</span>
                            </div>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.landingdata.company',
                                'dashboard.landingdata.edit',
                                'dashboard.landingdata.home',
                                'dashboard.landingdata.edithome',
                                'dashboard.landingdata.kawan',
                                'dashboard.landingdata.editkawan',
                                'dashboard.landingdata.aturan',
                                'dashboard.landingdata.editaturan',
                                'dashboard.landingdata.kebijakan',
                                'dashboard.landingdata.editkebijakan',
                                'dashboard.landingdata.faq',
                                'dashboard.landingdata.createfaq',
                                'dashboard.landingdata.editfaq',
                                'dashboard.landingdata.klaim',
                                'dashboard.landingdata.editklaim',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#settingdata" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="3" y1="9" x2="21" y2="9"></line>
                                        <line x1="9" y1="21" x2="9" y2="9"></line>
                                    </svg>
                                    <span>Landing Page</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="settingdata" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.landingdata.company') }}"> Company Data </a></li>
                                <li><a href="{{ route('dashboard.landingdata.home') }}"> Home page</a></li>
                                <li><a href="{{ route('dashboard.landingdata.kawan') }}"> Kawan page </a></li>
                                <li><a href="{{ route('dashboard.landingdata.aturan') }}"> Aturan page </a></li>
                                <li><a href="{{ route('dashboard.landingdata.kebijakan') }}"> Kebijakan page </a></li>
                                <li><a href="{{ route('dashboard.landingdata.faq') }}"> FAQ page </a></li>
                                <li><a href="{{ route('dashboard.landingdata.klaim') }}"> Klaim page </a></li>
                            </ul>
                        </li>
                        <li class="menu {{ Route::is('dashboard.landingdata.fee', 'dashboard.landingdata.editfee') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.landingdata.fee') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                    <span>Admin Fee Setup</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.landingdata.popup', 'dashboard.landingdata.editpopup') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.landingdata.popup') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <polyline points="17 11 12 6 7 11"></polyline>
                                        <polyline points="17 18 12 13 7 18"></polyline>
                                    </svg>
                                    <span>Popups Setup</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.targetdata.index') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.targetdata.index') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-target">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="12" r="6"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                    </svg>
                                    <span>Commission Setup</span>
                                </div>
                            </a>
                        </li>
                        <li
                            class="menu {{ Route::is('dashboard.categoryartikeldata.index', 'dashboard.artikeldata.index', 'dashboard.artikeldata.create', 'dashboard.artikeldata.edit') ? 'active' : '' }}">
                            <a href="#artikel" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                        <rect x="1" y="3" width="22" height="5"></rect>
                                        <line x1="10" y1="12" x2="14" y2="12"></line>
                                    </svg>
                                    <span>Data Artikel</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>

                            <ul class="collapse submenu list-unstyled" id="artikel" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.categoryartikeldata.index') }}"> Category Artikel </a></li>
                                <li><a href="{{ route('dashboard.artikeldata.index') }}"> Artikel </a></li>
                            </ul>
                        </li>
                    @elseif (auth()->user()->roles == 1)
                        <!-- home -->
                        <li class="menu  {{ Route::is('dashboard.staff') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.staff') }}" aria-expanded="false" class="dropdown-toggle">
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
                        <!-- product -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>PRODUCT</span>
                            </div>
                        </li>
                        <li class="menu {{ Route::is('dashboard.onlineproductdata.index', 'dashboard.onlineproductdata.create', 'dashboard.onlineproductdata.edit') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.onlineproductdata.index') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>Online Product</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.offlineproductdata.index', 'dashboard.offlineproductdata.create', 'dashboard.offlineproductdata.edit') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.offlineproductdata.index') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M22.61 16.95A5 5 0 0 0 18 10h-1.26a8 8 0 0 0-7.05-6M5 5a8 8 0 0 0 4 15h9a5 5 0 0 0 1.7-.3"></path>
                                        <line x1="1" y1="1" x2="23" y2="23"></line>
                                    </svg>
                                    <span>Offline Product</span>
                                </div>
                            </a>
                        </li>
                        <!-- setting -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>SETTING</span>
                            </div>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.landingdata.company',
                                'dashboard.landingdata.edit',
                                'dashboard.landingdata.home',
                                'dashboard.landingdata.edithome',
                                'dashboard.landingdata.kawan',
                                'dashboard.landingdata.editkawan',
                                'dashboard.landingdata.aturan',
                                'dashboard.landingdata.editaturan',
                                'dashboard.landingdata.kebijakan',
                                'dashboard.landingdata.editkebijakan',
                                'dashboard.landingdata.faq',
                                'dashboard.landingdata.createfaq',
                                'dashboard.landingdata.editfaq',
                                'dashboard.landingdata.klaim',
                                'dashboard.landingdata.editklaim',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#settingdata" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="3" y1="9" x2="21" y2="9"></line>
                                        <line x1="9" y1="21" x2="9" y2="9"></line>
                                    </svg>
                                    <span>Landing Page</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="settingdata" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.landingdata.company') }}"> Company Data </a></li>
                                <li><a href="{{ route('dashboard.landingdata.home') }}"> Home page</a></li>
                                <li><a href="{{ route('dashboard.landingdata.kawan') }}"> Kawan page </a></li>
                                <li><a href="{{ route('dashboard.landingdata.aturan') }}"> Aturan page </a></li>
                                <li><a href="{{ route('dashboard.landingdata.kebijakan') }}"> Kebijakan page </a></li>
                                <li><a href="{{ route('dashboard.landingdata.faq') }}"> FAQ page </a></li>
                                <li><a href="{{ route('dashboard.landingdata.klaim') }}"> Klaim page </a></li>
                            </ul>
                        </li>
                        <li class="menu {{ Route::is('dashboard.landingdata.fee', 'dashboard.landingdata.editfee') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.landingdata.fee') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                    <span>Admin Fee Setup</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.landingdata.popup', 'dashboard.landingdata.editpopup') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.landingdata.popup') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <polyline points="17 11 12 6 7 11"></polyline>
                                        <polyline points="17 18 12 13 7 18"></polyline>
                                    </svg>
                                    <span>Popups Setup</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.targetdata.index') ? 'active' : '' }} ">
                            <a href="{{ route('dashboard.targetdata.index') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-target">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="12" r="6"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                    </svg>
                                    <span>Commission Setup</span>
                                </div>
                            </a>
                        </li>
                        <li
                            class="menu {{ Route::is('dashboard.categoryartikeldata.index', 'dashboard.artikeldata.index', 'dashboard.artikeldata.create', 'dashboard.artikeldata.edit') ? 'active' : '' }}">
                            <a href="#artikel" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                        <rect x="1" y="3" width="22" height="5"></rect>
                                        <line x1="10" y1="12" x2="14" y2="12"></line>
                                    </svg>
                                    <span>Data Artikel</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>

                            <ul class="collapse submenu list-unstyled" id="artikel" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.categoryartikeldata.index') }}"> Category Artikel </a></li>
                                <li><a href="{{ route('dashboard.artikeldata.index') }}"> Artikel </a></li>
                            </ul>
                        </li>
                    @elseif (auth()->user()->roles == 2)
                        <!-- home -->
                        <li class="menu  {{ Route::is('dashboard.finance') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.finance') }}" aria-expanded="false" class="dropdown-toggle">
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
                        <!-- update profile -->
                        <li class="menu  {{ Route::is('dashboard.admin_profil') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.admin_profil') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span>Update Profil</span>
                                </div>
                            </a>
                        </li>
                        <!-- finance -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>FINANCE</span>
                            </div>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.onlinetransaction.alldata',
                                'dashboard.onlinetransaction.premi',
                                'dashboard.offlinetransaction.premi',
                                'dashboard.onlinetransaction.showfinance',
                                'dashboard.onlinetransaction.premi.filter',
                                'dashboard.offlinetransaction.showfinance',
                                'dashboard.onlinetransaction.showall',
                                'dashboard.onlinetransaction.show',
                                'dashboard.onlinetransaction.alldata.filter',
                                'dashboard.offlinetransaction.premi.filter',
                                'dashboard.onlinetransaction.adminfee',
                                'dashboard.onlinetransaction.adminfee.filter',
                                'dashboard.onlinetransaction.materai',
                                'dashboard.onlinetransaction.materai.filter',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#dataincomes" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>Data Incomes</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="dataincomes" data-bs-parent="#accordionExample">
                                <li> <a href="{{ route('dashboard.onlinetransaction.alldata') }}"> All Incomes </a></li>
                                <li> <a href="{{ route('dashboard.onlinetransaction.premi') }}"> Online Premi </a></li>
                                <li> <a href="{{ route('dashboard.offlinetransaction.premi') }}"> Offline Premi </a></li>
                                <li> <a href="{{ route('dashboard.onlinetransaction.adminfee') }}"> Admin Fee </a></li>
                                <li> <a href="{{ route('dashboard.onlinetransaction.materai') }}"> Materai </a></li>
                            </ul>
                        </li>
                        <li class="menu {{ Route::is('dashboard.onlinetransaction.completed') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.onlinetransaction.completed') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                    <span>Polis Aktif</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.expensedata.index', 'dashboard.expensedata.create', 'dashboard.expensedata.filter', 'dashboard.expensedata.edit') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.expensedata.index') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                    </svg>
                                    <span>Data Expenses</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.poindata.index', 'dashboard.poindata.index.filter') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.poindata.index') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                    <span>Data Poin Partner</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.poindata.index_poin', 'dashboard.poindata.index_poin.filter') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.poindata.index_poin') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z"></path>
                                        <polyline points="8 10 12 14 16 10"></polyline>
                                    </svg>
                                    <span>Data Poin</span>
                                </div>
                            </a>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.redeemdata.index',
                                'dashboard.redeemdata.request',
                                'dashboard.redeemdata.process',
                                'dashboard.redeemdata.success',
                                'dashboard.redeemdata.index.Filter',
                                'dashboard.redeemdata.request.Filter',
                                'dashboard.redeemdata.process.Filter',
                                'dashboard.redeemdata.success.Filter',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#dataredeem" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                        <rect x="2" y="7" width="20" height="5"></rect>
                                        <line x1="12" y1="22" x2="12" y2="7"></line>
                                        <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                                    </svg>
                                    <span>Data Redeem</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="dataredeem" data-bs-parent="#accordionExample">
                                <li> <a href="{{ route('dashboard.redeemdata.index') }}"> Redeem Poins </a></li>
                                <li> <a href="{{ route('dashboard.redeemdata.request') }}"> Redeem Request </a></li>
                                <li> <a href="{{ route('dashboard.redeemdata.process') }}"> Redeem Process </a></li>
                                <li> <a href="{{ route('dashboard.redeemdata.success') }}"> Redeem Success </a></li>
                            </ul>
                        </li>
                    @elseif (auth()->user()->roles == 3)
                        <!-- home -->
                        <li class="menu  {{ Route::is('dashboard.underwriting') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.underwriting') }}" aria-expanded="false" class="dropdown-toggle">
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
                        <!-- update profile -->
                        <li class="menu  {{ Route::is('dashboard.admin_profil') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.admin_profil') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span>Update Profil</span>
                                </div>
                            </a>
                        </li>
                        <!-- userdata -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>USER DATA</span>
                            </div>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.userdata.index',
                                'dashboard.userdata.show',
                                'dashboard.userdata.create',
                                'dashboard.userdata.edit',
                                'dashboard.userdata.affliator',
                                'dashboard.userdata.editaffliator',
                                'dashboard.userdata.nasabahaff',
                                'dashboard.userdata.agent',
                                'dashboard.userdata.editagent',
                                'dashboard.userdata.datanasabahaff',
                                'dashboard.userdata.datanasabahagent',
                                'dashboard.userdata.nasabahagent',
                                'dashboard.userdata.agent.request',
                                'dashboard.userdata.editagentrequest',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#home" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span>Data Users</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="home" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.userdata.index') }}"> Data Nasabah </a></li>
                                <li><a href="{{ route('dashboard.userdata.affliator') }}"> Data Affiliator </a></li>
                                <li><a href="{{ route('dashboard.userdata.agent.request') }}"> Mitra Request </a></li>
                                <li><a href="{{ route('dashboard.userdata.agent') }}"> Data Mitra </a></li>
                            </ul>
                        </li>
                        <!-- sales -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>Sales Data</span>
                            </div>
                        </li>
                        <li class="menu {{ Route::is('dashboard.userdata.affsales') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.userdata.affsales') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <span>Affiliator</span>
                                </div>
                            </a>
                        </li>
                        <li class="menu {{ Route::is('dashboard.userdata.agentsales') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.userdata.agentsales') }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                        <rect x="9" y="9" width="6" height="6"></rect>
                                        <line x1="9" y1="1" x2="9" y2="4"></line>
                                        <line x1="15" y1="1" x2="15" y2="4"></line>
                                        <line x1="9" y1="20" x2="9" y2="23"></line>
                                        <line x1="15" y1="20" x2="15" y2="23"></line>
                                        <line x1="20" y1="9" x2="23" y2="9"></line>
                                        <line x1="20" y1="14" x2="23" y2="14">
                                        </line>
                                        <line x1="1" y1="9" x2="4" y2="9"></line>
                                        <line x1="1" y1="14" x2="4" y2="14"></line>
                                    </svg>
                                    <span>Mitra</span>
                                </div>
                            </a>
                        </li>
                        <!-- transaction -->
                        <li class="menu menu-heading">
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>TRANSACTION</span>
                            </div>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.onlinetransaction.alltrx',
                                'dashboard.onlinetransaction.index',
                                'dashboard.onlinetransaction.pending',
                                'dashboard.onlinetransaction.paid',
                                'dashboard.onlinetransaction.process',
                                'dashboard.onlinetransaction.completed',
                                'dashboard.onlinetransaction.followup',
                                'dashboard.onlinetransaction.expired',
                                'dashboard.onlinetransaction.show',
                                'dashboard.onlinetransaction.alltrx.filter',
                                'dashboard.onlinetransaction.index.filter',
                                'dashboard.onlinetransaction.pending.filter',
                                'dashboard.onlinetransaction.paid.filter',
                                'dashboard.onlinetransaction.complete.filter',
                                'dashboard.onlinetransaction.follow.filter',
                                'dashboard.onlinetransaction.expired.filter',
                                'dashboard.onlinetransaction.process.filter',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#datatransactiononline" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                    <span>Online Trx</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datatransactiononline" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.onlinetransaction.alltrx') }}"> All Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.index') }}"> Request Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.pending') }}"> Pending Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.paid') }}"> Paid Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.process') }}"> Process Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.completed') }}"> Completed Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.followup') }}"> Followup Data </a></li>
                                <li><a href="{{ route('dashboard.onlinetransaction.expired') }}"> Expired Data </a></li>
                            </ul>
                        </li>
                        <li
                            class="menu {{ Route::is(
                                'dashboard.offlinetransaction.alltrx',
                                'dashboard.offlinetransaction.index',
                                'dashboard.offlinetransaction.show',
                                'dashboard.offlinetransaction.process',
                                'dashboard.offlinetransaction.payment',
                                'dashboard.offlinetransaction.paid',
                                'dashboard.offlinetransaction.polisprocess',
                                'dashboard.offlinetransaction.completed',
                                'dashboard.offlinetransaction.followup',
                                'dashboard.offlinetransaction.expired',
                                'dashboard.offlinetransaction.alltrx.filter',
                                'dashboard.offlinetransaction.index.filter',
                                'dashboard.offlinetransaction.process.filter',
                                'dashboard.offlinetransaction.payment.filter',
                                'dashboard.offlinetransaction.paid.filter',
                                'dashboard.offlinetransaction.polisprocess.filter',
                                'dashboard.offlinetransaction.completed.filter',
                                'dashboard.offlinetransaction.follow.filter',
                                'dashboard.offlinetransaction.expired.filter',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="#datatransactioffonline" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" class="css-i6dzq1">
                                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                    </svg>
                                    <span>Offline Trx</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="datatransactioffonline" data-bs-parent="#accordionExample">
                                <li><a href="{{ route('dashboard.offlinetransaction.alltrx') }}"> All Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.index') }}"> Request Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.process') }}"> Process Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.payment') }}"> Payment Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.paid') }}"> Paid Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.polisprocess') }}"> Polis Process </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.completed') }}"> Completed Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.followup') }}"> Followup Data </a></li>
                                <li><a href="{{ route('dashboard.offlinetransaction.expired') }}"> Expired Data </a></li>
                            </ul>
                        </li>
                    @endif

                    <li class="menu">
                        <a href="route('dashboard.logout_id')" aria-expanded="false" class="dropdown-toggle"
                            onclick="event.preventDefault();document.getElementById('adminLogoutForm').submit();">
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
                        <form action="{{ route('dashboard.logout_id') }}" id="adminLogoutForm" method="POST">@csrf</form>
                    </li>
                </ul>
            </nav>
