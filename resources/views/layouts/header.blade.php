<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme no-print"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0" href="">
                    <span class="text-muted">@yield('breadcrumb-items')@yield('title')</span>
                </a>
            </div>
        </div>
        <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">

                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">

                    <span class="position-relative">
                        <i class="icon-base bx bx-cake icon-md"></i>

                        <!-- Badge jumlah ulang tahun -->
                        <span id="birthdayNotificationBadge"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="display:none; font-size:9px;">
                            0
                        </span>
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end p-0">

                    <!-- Header -->
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">

                            <h6 class="mb-0 me-auto">
                                <i class="bx bx-cake me-1 text-danger"></i>
                               Ulang Tahun hari ini
                            </h6>

                            <div class="d-flex align-items-center h6 mb-0">
                                <span id="birthdayTotal" class="badge bg-label-primary me-2">
                                    0 orang
                                </span>
                            </div>

                        </div>
                    </li>

                    <!-- List -->
                    <li class="dropdown-notifications-list scrollable-container">

                        <ul class="list-group list-group-flush" id="birthdayNotificationList">

                            <!-- Loading -->
                            <li class="list-group-item text-center py-4" id="birthdayLoading">

                                <div class="spinner-border spinner-border-sm text-primary"></div>

                                <div class="small text-muted mt-2">
                                    Memuat data...
                                </div>
                            </li>

                        </ul>

                    </li>

                    <!-- Footer -->
                    <li class="border-top">
                        <div class="d-flex justify-content-center py-2">
                            <small class="text-muted">
                                ❤️ Dari Keluarga Besar Universitas Global Jakarta
                            </small>
                        </div>
                    </li>

                </ul>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ Auth::user()->image() }}" alt class="w-40 h-40 rounded-circle"
                            style="object-fit: cover;">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::user()->image() }}" class="w-40 h-40 rounded-circle"
                                            style="object-fit: cover;">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="">
                        <a class="dropdown-item {{ Route::currentRouteName()=='user.profile' ? 'active' : '' }}"
                            href="{{ route('user.profile') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Profil Saya</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="dropdown-item {{ Route::currentRouteName()=='user.edit' ? 'active' : '' }}"
                            href="{{ route('user.edit') }}">
                            <i class="bx bx-cog  me-2"></i>
                            <span class="align-middle">Edit Profil</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="dropdown-item {{ Route::currentRouteName()=='wifi' ? 'active' : '' }}"
                            href="{{ route('wifi') }}">
                            <i class="bx bx-wifi  me-2"></i>
                            <span class="align-middle">Portal Wifi</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" target="_blank" href="http://s.jgu.ac.id/m/itic">
                            <i class="bx bx-support me-2"></i>
                            <span class="align-middle">Bantuan</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Keluar</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->