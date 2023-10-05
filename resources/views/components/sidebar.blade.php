<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->role == 'superadmin')
            <li class="nav-heading">Kelola</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('superadminDashboardPage') ? '' : ' collapsed' }}" href="{{ route('superadminDashboardPage') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('daftarBank') ? '' : ' collapsed' }}" href="{{ route('daftarBank') }}">
                    <i class="bi bi-bank2"></i>
                    <span>Daftar Bank</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jenisLapangan') ? '' : ' collapsed' }}" href="{{ route('jenisLapangan') }}">
                    <i class="ri-football-line"></i>
                    <span>Jenis Lapangan</span>
                </a>
            </li>
        @elseif (Auth::user()->role == 'admin')
            <li class="nav-heading">Validasi</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('adminDashboardPage') ? '' : ' collapsed' }}" href="{{ route('adminDashboardPage') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('validasiPenarikanPage') ? '' : ' collapsed' }}" href="{{ route('validasiPenarikanPage') }}">
                    <i class="bi bi-cash-coin"></i>
                    <span>Penarikan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jenisLapangan') ? '' : ' collapsed' }}" href="{{ route('jenisLapangan') }}">
                    <i class="bi bi-cart3"></i>
                    <span>Pemesanan</span>
                </a>
            </li>
            <li class="nav-heading">Riwayat</li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Riwayat Validasi</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('riwayatValidasiPenarikanPage') }}">
                            <i class="bi bi-cash-coin"></i><span>Penarikan</span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-data.html">
                            <i class="bi bi-cart3"></i><span>Pemesanan</span>
                        </a>
                    </li>
                </ul>
            </li>
        @else
            <li class="nav-heading">halaman</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboardPage') ? '' : ' collapsed' }}" href="{{ route('dashboardPage') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('penarikanPage') ? '' : ' collapsed' }}" href="{{ route('penarikanPage') }}">
                    <i class="bi bi-cash-coin"></i>
                    <span>Penarikan</span>
                </a>
            </li>
            <li class="nav-heading">Kelola</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lapanganPage') ? '' : ' collapsed' }}" href="{{ route('lapanganPage') }}">
                    <i class="ri-football-line"></i>
                    <span>Lapangan & Jadwal</span>
                </a>
            </li>
            <li class="nav-heading">Riwayat</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('riwayatPenarikanPage') || request()->routeIs('riwayatPemesananPage') ? '' : ' collapsed' }}" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Riwayat</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content {{ request()->routeIs('riwayatPenarikanPage') || request()->routeIs('riwayatPemesananPage') ? '' : ' collapse' }} " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('riwayatPenarikanPage') }}">
                            <i class="bi bi-cash-coin"></i><span>Penarikan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('riwayatPemesananPage') }}">
                            <i class="bi bi-calendar"></i><span>Pemesanan</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</aside>
