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
        * { font-family: 'Inter', sans-serif; }
        body { background: #f7f9fc; }

        .sidebar {
            width: 280px;
            background: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 2px 0 12px rgba(0,0,0,0.04);
            border-right: 1px solid #edf2f7;
        }
        .sidebar-header {
            padding: 24px 20px;
            text-align: center;
            border-bottom: 1px solid #edf2f7;
        }
        .sidebar-header h5 {
            font-weight: 700;
            color: #2d3748;
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
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #4a5568;
            text-decoration: none;
            border-radius: 10px;
            margin: 0 10px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s;
        }
        .sidebar-nav .nav-link i:first-child {
            width: 28px;
            margin-right: 12px;
            font-size: 18px;
            color: #718096;
        }
        .sidebar-nav .nav-link:hover {
            background: #f7fafc;
            color: #2d3748;
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
            margin: 0 10px;
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

        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 12px;
            left: 12px;
            z-index: 1001;
            background: #ffffff;
            border: 1px solid #edf2f7;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 18px;
            color: #2d3748;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .sidebar-toggle:hover {
            background: #f7fafc;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 999;
        }
        .sidebar-overlay.active {
            display: block;
        }

        .main-content {
            margin-left: 280px;
            padding: 24px 32px;
            transition: all 0.3s;
        }

        .navbar-top {
            background: #ffffff;
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

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table {
            margin-bottom: 0;
            min-width: 600px;
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
            white-space: nowrap;
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

        .alert {
            border-radius: 16px;
            border: none;
            padding: 14px 20px;
        }
        .alert-info {
            background: #ebf8ff;
            color: #2c5282;
        }

        /* PAGINATION */
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

      
        .stat-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #edf2f7;
            height: 100%;
        }

        @media (max-width: 992px) {
            .sidebar {
                margin-left: -280px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .sidebar-toggle {
                display: block;
            }
            .main-content {
                margin-left: 0;
                padding: 16px 16px 16px 16px;
                padding-top: 70px;
            }
            .navbar-top {
                padding: 10px 16px;
                flex-wrap: wrap;
                gap: 8px;
            }
            .user-dropdown .d-none {
                display: none !important;
            }
            .card-header {
                padding: 14px 16px;
                flex-wrap: wrap;
                gap: 8px;
            }
            .card-header .d-flex {
                flex-wrap: wrap;
                gap: 8px;
            }
            .card-body {
                padding: 16px !important;
            }
            .table tbody td {
                padding: 8px 10px;
                font-size: 12px;
            }
            .table thead th {
                padding: 10px 10px;
                font-size: 10px;
            }
            .btn-sm {
                padding: 4px 10px;
                font-size: 11px;
            }
            .row.g-3 {
                --bs-gutter-y: 0.75rem;
            }
            .row.g-4 {
                --bs-gutter-y: 1rem;
            }
            .stat-card h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 12px 12px 12px 12px;
                padding-top: 65px;
            }
            .card-header {
                flex-direction: column;
                align-items: stretch !important;
                gap: 8px;
            }
            .card-header .d-flex {
                flex-direction: column;
                align-items: stretch !important;
            }
            .card-header .d-flex .btn {
                width: 100%;
                text-align: center;
            }
            .card-header .d-flex .gap-2 {
                gap: 6px !important;
            }
            .card-header .d-flex .gap-3 {
                gap: 6px !important;
            }
            .text-end {
                text-align: left !important;
            }
            .d-flex.justify-content-between {
                flex-direction: column;
                align-items: stretch !important;
                gap: 8px;
            }
            .d-flex.justify-content-between .text-end {
                text-align: left !important;
            }
            .table tbody td {
                padding: 6px 8px;
                font-size: 11px;
            }
            .table thead th {
                padding: 8px 8px;
                font-size: 9px;
            }
            .btn-sm {
                padding: 4px 8px;
                font-size: 10px;
            }
            .badge {
                padding: 3px 8px;
                font-size: 9px;
            }
            .alert {
                padding: 10px 14px;
                font-size: 12px;
            }
            .sidebar {
                width: 260px;
            }
            .sidebar-toggle {
                top: 10px;
                left: 10px;
                padding: 8px 12px;
                font-size: 16px;
            }
        }

        @media print {
            .sidebar, .sidebar-toggle, .sidebar-overlay, .navbar-top {
                display: none !important;
            }
            .main-content {
                margin-left: 0 !important;
                padding: 20px !important;
            }
            .card {
                border: 1px solid #ddd !important;
                box-shadow: none !important;
            }
            .btn, .btn-sm {
                display: none !important;
            }
            body {
                background: white !important;
            }
        }
    </style>
</head>
<body>
    <div id="app">
       
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
            <i class="fas fa-bars"></i>
        </button>

        
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        
        @include('layouts.sidebar')
        
        <div class="main-content" id="mainContent">
            @auth
            <nav class="navbar-top">
                <div class="dropdown">
                    <div class="user-dropdown d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #ebf8ff; color: #3182ce; font-weight: 600;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="d-none d-md-block">
                            <div class="fw-semibold" style="color: #2d3748;">{{ Auth::user()->name }}</div>
                            <small class="text-muted" style="color: #a0aec0;">
                                @if(Auth::user()->email == 'admin@gmail.com')
                                    Admin
                                @elseif(Auth::user()->nidn != null)
                                    Dosen
                                @elseif(Auth::user()->mahasiswa_id != null)
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
      
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainContent = document.getElementById('mainContent');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
            const icon = sidebarToggle.querySelector('i');
            if (sidebar.classList.contains('active')) {
                icon.className = 'fas fa-times';
            } else {
                icon.className = 'fas fa-bars';
            }
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', toggleSidebar);
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', toggleSidebar);
        }

       
        document.querySelectorAll('.has-submenu > .nav-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const submenuId = this.getAttribute('data-submenu');
                const submenu = document.getElementById(`submenu-${submenuId}`);
                if (submenu) {
                    submenu.classList.toggle('show');
                }
            });
        });

        
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992 && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                const icon = sidebarToggle.querySelector('i');
                if (icon) icon.className = 'fas fa-bars';
            }
        });
    </script>
    @stack('scripts')
</body>
</html>