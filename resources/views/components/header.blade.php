<!-- ======= Header ======= -->
@php
$photoPath = asset('assets/img/user.png');
$user = Auth::user();
$userRole = $user->role;
$userPhoto = $user->$userRole->foto ?? null;
@endphp
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="@if ($userRole == 'superadmin') {{ route('superadminDashboardPage') }} @elseif ($userRole == 'admin') {{ route('adminDashboardPage') }} @else {{ route('dashboardPage') }} @endif" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/icon-2.png') }}" alt="">
            <span class="d-none d-lg-block">
                Sportscamp
            </span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ $userPhoto ? asset('storage/'.$userPhoto) : $photoPath }}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ $user->email }}</span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>
                            @if ($userRole == 'superadmin')
                                {{ $user->email }}
                            @elseif ($userRole == 'penyedia')
                                {{ $user->$userRole->nama_bisnis }}
                            @else
                                {{ $user->$userRole->nama }}
                            @endif
                        </h6>
                        <span>{{ $user->role }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @if ($userRole != 'superadmin')
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="@if ($userRole == 'penyedia') {{ route('profilePenyedia') }} @else {{ route('profileAdmin') }} @endif">
                                <i class="bi bi-person"></i>
                                <span>Profile Saya</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="@if ($userRole == 'penyedia') {{ route('profilePenyedia') }} @else {{ route('profileAdmin') }} @endif">
                                <i class="bi bi-gear"></i>
                                <span>Pengaturan Akun</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    @else
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('superadminChangePasswordPage') }}">
                                <i class="bi bi-gear"></i>
                                <span>Ubah Kata Sandi</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    @endif
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->
