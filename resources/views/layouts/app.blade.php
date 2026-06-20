<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Universitas Nugraha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f7f9fc;
        }

        .sidebar {
            width: 280px;
            background: #ffffff;
            color: #4a5568;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.04);
            border-right: 1px solid #edf2f7;
        }

        .sidebar-header {
            padding: 24px 20px;
            text-align: center;
            border-bottom: 1px solid #edf2f7;
            margin-bottom: 20px;
        }

        .sidebar-header h5 {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .sidebar-header small {
            font-size: 11px;
            color: #a0aec0;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin-bottom: 4px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
            border-radius: 10px;
            margin: 0 10px;
            font-weight: 500;
            font-size: 14px;
        }

        .sidebar-nav .nav-link i:first-child {
            width: 28px;
            margin-right: 12px;
            font-size: 18px;
            color: #718096;
        }

        .sidebar-nav .nav-link span {
            flex: 1;
        }

        .sidebar-nav .nav-link .submenu-icon {
            margin-left: auto;
            font-size: 12px;
            transition: transform 0.3s;
            color: #a0aec0;
        }

        .sidebar-nav .nav-link:hover {
            background: #f7fafc;
            color: #2d3748;
        }

        .sidebar-nav .nav-link:hover i:first-child {
            color: #4299e1;
        }

        .sidebar-nav .nav-link.active {
            background: #ebf8ff;
            color: #3182ce;
        }

        .sidebar-nav .nav-link.active i:first-child {
            color: #3182ce;
        }

        .sidebar-nav .submenu {
            list-style: none;
            padding: 0;
            margin: 0 10px 0 10px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background: #fafbfc;
            border-radius: 10px;
        }

        .sidebar-nav .submenu.show {
            max-height: 400px;
        }

        .sidebar-nav .submenu li a {
            display: flex;
            align-items: center;
            padding: 10px 20px 10px 52px;
            color: #718096;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            margin: 2px 5px;
        }

        .sidebar-nav .submenu li a i {
            width: 20px;
            margin-right: 10px;
            font-size: 12px;
            color: #a0aec0;
        }

        .sidebar-nav .submenu li a:hover {
            background: #edf2f7;
            color: #2d3748;
        }

        .sidebar-nav .submenu li a.active {
            background: #ebf8ff;
            color: #3182ce;
        }

        .sidebar-nav .submenu li a.active i {
            color: #3182ce;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #edf2f7;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
        }

        .main-content {
            margin-left: 280px;
            padding: 24px 32px;
            transition: all 0.3s;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -280px;
            }
            .sidebar.show {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
                padding: 16px;
            }
        }

        .navbar-top {
            background: #ffffff;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
            padding: 12px 24px;
            margin-bottom: 24px;
            border-radius: 16px;
            border: 1px solid #edf2f7;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .user-dropdown {
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 30px;
            transition: all 0.2s;
        }

        .user-dropdown:hover {
            background: #f7fafc;
        }

        .card {
            border-radius: 20px;
            border: 1px solid #edf2f7;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            transition: all 0.2s;
        }

        .card-header {
            background: #ffffff;
            border-bottom: 1px solid #edf2f7;
            padding: 18px 24px;
            font-weight: 600;
            color: #2d3748;
            border-radius: 20px 20px 0 0 !important;
        }

        .btn-primary {
            background: #3182ce;
            border: none;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 500;
            font-size: 13px;
        }

        .btn-primary:hover {
            background: #2c5282;
            transform: translateY(-1px);
        }

        .btn-success {
            background: #38a169;
            border: none;
            border-radius: 12px;
            font-weight: 500;
            font-size: 13px;
        }

        .btn-success:hover {
            background: #2f855a;
        }

        .btn-danger {
            background: #e53e3e;
            border: none;
            border-radius: 12px;
            font-weight: 500;
            font-size: 13px;
        }

        .btn-danger:hover {
            background: #c53030;
        }

        .btn-warning {
            background: #d69e2e;
            border: none;
            border-radius: 12px;
            font-weight: 500;
            font-size: 13px;
            color: white;
        }

        .btn-warning:hover {
            background: #b7791f;
            color: white;
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 12px;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8fafc;
            color: #4a5568;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            border-bottom: 1px solid #edf2f7;
        }

        .table tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            color: #4a5568;
            font-size: 14px;
            border-bottom: 1px solid #edf2f7;
        }

        .table tbody tr:hover {
            background: #fafbfc;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 11px;
        }

        .badge-success {
            background: #c6f6d5;
            color: #276749;
        }

        .badge-primary {
            background: #bee3f8;
            color: #2c5282;
        }

        .badge-warning {
            background: #fefcbf;
            color: #975a16;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #edf2f7;
        }

        .alert {
            border-radius: 16px;
            border: none;
            padding: 14px 20px;
        }

        .alert-info {
            background: #ebf8ff;
            color: #2c5282;
        }

        .pagination .page-link {
            border-radius: 10px;
            margin: 0 3px;
            border: 1px solid #edf2f7;
            color: #4a5568;
            font-weight: 500;
            background: white;
        }

        .pagination .page-item.active .page-link {
            background: #3182ce;
            border-color: #3182ce;
            color: white;
        }

        .pagination .page-link:hover {
            background: #f7fafc;
        }
    </style>
</head>
<body>
    <div id="app">
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
                    <a href="#" class="nav-link {{ request()->routeIs('krs.admin') || request()->routeIs('admin.jadwal*') || request()->routeIs('jadwal.*') || request()->routeIs('nilai.*') ? 'active' : '' }}" data-submenu="akademik">
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
                            <a href="{{ route('admin.jadwal.index') }}" class="{{ request()->routeIs('admin.jadwal*') ? 'active' : '' }}">
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

                @role('dosen')
                <!-- Menu Dosen -->
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
        
        <div class="main-content">
            <!-- Top Navbar -->
            @auth
            <nav class="navbar-top">
                <div class="dropdown">
                    <div class="user-dropdown d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #ebf8ff; color: #3182ce; font-weight: 600;">
                            @php
                                if(Auth::user()->hasRole('admin')) {
                                    $initial = 'A';
                                } else {
                                    $initial = substr(Auth::user()->name, 0, 1);
                                }
                            @endphp
                            {{ $initial }}
                        </div>
                        <div class="d-none d-md-block">
                            <div class="fw-semibold" style="color: #2d3748;">
                                @if(Auth::user()->hasRole('admin'))
                                    Admin
                                @else
                                    {{ Auth::user()->name }}
                                @endif
                            </div>
                            <small class="text-muted" style="color: #a0aec0;">
                                @if(Auth::user()->hasRole('admin'))
                                    Admin Universitas Nugraha
                                @elseif(Auth::user()->hasRole('dosen'))
                                    Dosen
                                @elseif(Auth::user()->hasRole('mahasiswa'))
                                    Mahasiswa
                                @endif
                            </small>
                        </div>
                        <i class="fas fa-chevron-down text-muted" style="font-size: 11px;"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 mt-2 py-2">
                        <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
            @endauth
            
            @yield('content')
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        
        document.querySelectorAll('.has-submenu > .nav-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const submenuId = this.getAttribute('data-submenu');
                const submenu = document.getElementById(`submenu-${submenuId}`);
                
                if (submenu) {
                    submenu.classList.toggle('show');
                    this.classList.toggle('active-submenu');
                }
            });
        });
        
        document.querySelectorAll('.submenu li a').forEach(function(link) {
            if (link.classList.contains('active')) {
                const parentSubmenu = link.closest('.submenu');
                if (parentSubmenu) {
                    parentSubmenu.classList.add('show');
                    const parentNav = parentSubmenu.closest('.has-submenu')?.querySelector('.nav-link');
                    if (parentNav) {
                        parentNav.classList.add('active-submenu');
                    }
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>