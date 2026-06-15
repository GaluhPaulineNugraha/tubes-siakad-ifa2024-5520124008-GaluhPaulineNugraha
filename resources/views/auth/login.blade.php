<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAKAD Universitas Nugraha</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            position: relative;
        }

        /* Background Gambar Perpustakaan */
        .background-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
        }

        .background-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Overlay gelap */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* Left Side - Branding (Transparan) */
        .brand-section {
            background: rgba(10, 37, 64, 0.85);
            backdrop-filter: blur(8px);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .brand-content {
            text-align: center;
            padding: 40px;
            position: relative;
            z-index: 1;
        }

        .brand-icon {
            font-size: 100px;
            color: rgba(255,255,255,0.2);
            margin-bottom: 30px;
        }

        .brand-title {
            font-size: 56px;
            font-weight: 800;
            color: white;
            margin-bottom: 20px;
            letter-spacing: 3px;
        }

        .brand-subtitle {
            font-size: 20px;
            color: rgba(255,255,255,0.85);
            margin-bottom: 15px;
            font-weight: 500;
        }

        .brand-desc {
            font-size: 16px;
            color: rgba(255,255,255,0.7);
            max-width: 360px;
            margin: 25px auto 0;
            line-height: 1.8;
        }

        .brand-line {
            width: 80px;
            height: 3px;
            background: rgba(255,255,255,0.3);
            margin: 30px auto 0;
            border-radius: 3px;
        }

        .brand-univ {
            font-size: 14px;
            color: rgba(255,255,255,0.5);
            margin-top: 35px;
            letter-spacing: 1px;
        }

        /* Right Side - Form */
        .form-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 440px;
            padding: 40px;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h3 {
            font-size: 26px;
            font-weight: 700;
            color: #1a2a3a;
            margin-bottom: 10px;
        }

        .login-header p {
            font-size: 14px;
            color: #6c757d;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            color: #374151;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 16px;
        }

        .form-control {
            border-radius: 14px;
            padding: 14px 16px 14px 45px;
            border: 1.5px solid #e5e7eb;
            width: 100%;
            font-size: 14px;
            background: #f9fafb;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #0A2540;
            box-shadow: 0 0 0 3px rgba(10,37,64,0.1);
            background: white;
        }

        .btn-login {
            background: linear-gradient(135deg, #0A2540 0%, #0C2D4A 100%);
            border: none;
            padding: 14px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            color: white;
            transition: all 0.3s;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(10,37,64,0.3);
        }

        .forgot-link {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-link a {
            font-size: 12px;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.2s;
        }

        .forgot-link a:hover {
            color: #0A2540;
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border-radius: 14px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 4px solid #dc2626;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .footer small {
            font-size: 11px;
            color: #9ca3af;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .brand-section {
                display: none;
            }
            .form-section {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .brand-title {
                font-size: 40px;
            }
            .brand-subtitle {
                font-size: 16px;
            }
            .brand-desc {
                font-size: 13px;
            }
            .login-card {
                padding: 30px 20px;
            }
            .login-header h3 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <!-- Background Gambar Perpustakaan -->
    <div class="background-wrapper">
        <img src="{{ asset('images/perpustakaan.jpg') }}" alt="Background Perpustakaan Universitas">
    </div>
    <div class="overlay"></div>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Left Side - Branding -->
            <div class="col-lg-6 brand-section">
                <div class="brand-content">
                    <div class="brand-icon">
                        <i class="fas fa-university"></i>
                    </div>
                    <h1 class="brand-title">SIAKAD</h1>
                    <p class="brand-subtitle">Sistem Informasi Akademik</p>
                    <p class="brand-desc">
                        Platform digital untuk mengelola kegiatan akademik<br>
                        Fakultas Teknik Informatika
                    </p>
                    <div class="brand-line"></div>
                    <p class="brand-univ">
                        Universitas Nugraha
                    </p>
                </div>
            </div>

            <!-- Right Side - Form Login -->
            <div class="col-lg-6 form-section">
                <div class="login-card">
                    <div class="login-header">
                        <h3>Akses ke Platform</h3>
                        <p>Silakan masuk dengan akun Anda</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group-custom">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group-custom">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>

                        <button type="submit" class="btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i> MASUK
                        </button>

                        <div class="forgot-link">
                            <a href="#">Lupa nama pengguna dan kata sandi Anda?</a>
                        </div>
                    </form>

                    <div class="footer">
                        <small>© {{ date('Y') }} Universitas Nugraha. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>