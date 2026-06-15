<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAKAD</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0A2540 0%, #0C2D4A 50%, #0A2540 100%);
            min-height: 100vh;
        }
        .login-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .login-card {
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 420px;
        }
        .login-header {
            background: linear-gradient(135deg, #0A2540 0%, #0C2D4A 100%);
            color: white;
            padding: 35px 30px;
            text-align: center;
            border-radius: 32px 32px 0 0;
        }
        .login-header i { font-size: 56px; margin-bottom: 12px; }
        .login-header h2 { font-size: 26px; font-weight: 700; margin: 0; }
        .login-header p { font-size: 13px; margin: 5px 0 0; opacity: 0.8; }
        .login-body { padding: 35px 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { font-weight: 600; font-size: 13px; margin-bottom: 8px; display: block; color: #0A2540; }
        .form-control {
            border-radius: 14px;
            padding: 12px 16px;
            border: 1.5px solid #E2E8F0;
            width: 100%;
            font-size: 14px;
            background: #F8FAFC;
        }
        .form-control:focus { outline: none; border-color: #0A2540; box-shadow: 0 0 0 4px rgba(10,37,64,0.1); }
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
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(10,37,64,0.3); }
        .alert-danger {
            background: #FFF5F5;
            color: #C53030;
            border-radius: 14px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 4px solid #C53030;
        }
        .demo-info {
            background: #F0F9FF;
            border-radius: 14px;
            padding: 15px;
            margin-top: 20px;
            font-size: 12px;
        }
        .demo-info p { margin: 5px 0; }
        .demo-info strong { color: #0A2540; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="fas fa-landmark"></i>
                <h2>SIAKAD</h2>
                <p>Sistem Informasi Akademik</p>
            </div>
            
            <div class="login-body">
                @if ($errors->any())
                    <div class="alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label><i class="fas fa-envelope me-2"></i>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-lock me-2"></i>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>MASUK
                    </button>
                </form>
                
                <div class="demo-info">
                    <p><strong><i class="fas fa-info-circle me-1"></i> Akun Demo:</strong></p>
                    <p>📧 Admin: admin@siakad.com | 🔑 password123</p>
                    <p>📧 Mahasiswa: mhs_[NPM]@student.com | 🔑 [NPM]</p>
                    <p class="text-muted mt-2">*Contoh: NPM 2024000001, password 2024000001</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>