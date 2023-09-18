<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Pages</li>
        @if (Auth::user()->role == 'superadmin')
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
        @endif
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="tables-general.html">
                <i class="bi bi-circle"></i><span>General Tables</span>
                </a>
            </li>
            <li>
                <a href="tables-data.html">
                <i class="bi bi-circle"></i><span>Data Tables</span>
                </a>
            </li>
            </ul>
        </li>
    </ul>
</aside>
