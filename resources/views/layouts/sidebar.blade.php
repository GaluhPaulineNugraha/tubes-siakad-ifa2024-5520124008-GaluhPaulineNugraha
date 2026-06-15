<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h5 class="mb-0">
            <i class="fas fa-graduation-cap me-2"></i> SIAKAD
        </h5>
        <small>Universitas Nugraha</small>
    </div>

    <ul class="sidebar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @role('admin')
        <!-- Data Master -->
        <li class="nav-item has-submenu">
            <a href="#" class="nav-link {{ request()->routeIs('dosen.*') || request()->routeIs('mahasiswa.*') || request()->routeIs('matakuliah.*') ? 'active' : '' }}" data-submenu="data-master">
                <i class="fas fa-database"></i>
                <span>Data Master</span>
                <i class="fas fa-chevron-right submenu-icon"></i>
            </a>
            <ul class="submenu" id="submenu-data-master">
                <li>
                    <a href="{{ route('dosen.index') }}" class="{{ request()->routeIs('dosen.*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-user"></i> Data Dosen
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.index') }}" class="{{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Data Mahasiswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('matakuliah.index') }}" class="{{ request()->routeIs('matakuliah.*') ? 'active' : '' }}">
                        <i class="fas fa-book"></i> Mata Kuliah
                    </a>
                </li>
            </ul>
        </li>

        <!-- Akademik -->
        <li class="nav-item has-submenu">
            <a href="#" class="nav-link {{ request()->routeIs('krs.admin') || request()->routeIs('jadwal.*') || request()->routeIs('nilai.*') ? 'active' : '' }}" data-submenu="akademik">
                <i class="fas fa-graduation-cap"></i>
                <span>Akademik</span>
                <i class="fas fa-chevron-right submenu-icon"></i>
            </a>
            <ul class="submenu" id="submenu-akademik">
                <li>
                    <a href="{{ route('krs.admin') }}" class="{{ request()->routeIs('krs.admin') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Manajemen KRS
                    </a>
                </li>
                <li>
                    <a href="{{ route('jadwal.index') }}" class="{{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i> Jadwal Kuliah
                    </a>
                </li>
                <li>
                    <a href="{{ route('nilai.index') }}" class="{{ request()->routeIs('nilai.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i> Nilai Mahasiswa
                    </a>
                </li>
            </ul>
        </li>
        @endrole

        @role('mahasiswa')
        <!-- Menu untuk Mahasiswa -->
        <li class="nav-item">
            <a href="{{ route('krs.index') }}" class="nav-link {{ request()->routeIs('krs.index') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i>
                <span>KRS Saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('jadwal.index') }}" class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Jadwal Kuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('nilai.index') }}" class="nav-link {{ request()->routeIs('nilai.*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Nilai Saya</span>
            </a>
        </li>
        @endrole
    </ul>
</div>