<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h5 class="mb-0">
            <i class="fas fa-graduation-cap me-2"></i> SIAKAD
        </h5>
        <small>Universitas Nugraha</small>
    </div>

    <ul class="sidebar-nav">
       
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        
        @if(Auth::user()->email == 'admin@gmail.com')
        <li class="nav-item has-submenu">
            <a href="#" class="nav-link {{ request()->routeIs('dosen.*') || request()->routeIs('mahasiswa.*') || request()->routeIs('matakuliah.*') ? 'active' : '' }}" data-submenu="data-master">
                <i class="fas fa-database"></i>
                <span>Data Master</span>
            </a>
            <ul class="submenu {{ request()->routeIs('dosen.*') || request()->routeIs('mahasiswa.*') || request()->routeIs('matakuliah.*') ? 'show' : '' }}" id="submenu-data-master">
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

        <li class="nav-item has-submenu">
            <a href="#" class="nav-link {{ request()->routeIs('krs.admin') || request()->routeIs('admin.jadwal*') ? 'active' : '' }}" data-submenu="akademik">
                <i class="fas fa-graduation-cap"></i>
                <span>Akademik</span>
            </a>
            <ul class="submenu {{ request()->routeIs('krs.admin') || request()->routeIs('admin.jadwal*') ? 'show' : '' }}" id="submenu-akademik">
                <li>
                    <a href="{{ route('krs.admin') }}" class="{{ request()->routeIs('krs.admin') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Manajemen KRS
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.jadwal.index') }}" class="{{ request()->routeIs('admin.jadwal*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i> Jadwal Kuliah
                    </a>
                </li>
            </ul>
        </li>
        @endif

       
        @if(Auth::user()->nidn != null)
        <li class="nav-item">
            <a href="{{ route('dosen.dashboard') }}" class="nav-link {{ request()->routeIs('dosen.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard Dosen</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dosen.jadwal') }}" class="nav-link {{ request()->routeIs('dosen.jadwal*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Jadwal Mengajar</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dosen.mahasiswa') }}" class="nav-link {{ request()->routeIs('dosen.mahasiswa*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Mahasiswa Bimbingan</span>
            </a>
        </li>
        @endif

       
        @if(Auth::user()->mahasiswa_id != null)
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
        @endif
    </ul>
</div>