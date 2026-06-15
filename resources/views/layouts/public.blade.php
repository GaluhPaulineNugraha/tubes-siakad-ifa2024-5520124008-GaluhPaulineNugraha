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

        /* Main Content - Tanpa Sidebar */
        .main-content {
            padding: 24px 32px;
            transition: all 0.3s;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }
        }

        /* Top Navbar - Publik */
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

        /* Card - Clean White */
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

        /* Button - Soft Colors */
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

        .btn-outline-primary {
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container-fluid px-0">
        <div class="main-content">
            <!-- Top Navbar Publik -->
            <nav class="navbar-top">
                <div>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm rounded-pill px-4">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                </div>
            </nav>
            
            <!-- Page Content -->
            @yield('content')
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>