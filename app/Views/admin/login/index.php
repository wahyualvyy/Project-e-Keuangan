<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <title><?= $title ;?></title>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .login-header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.8rem;
        }
        
        .login-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 0.95rem;
        }
        
        .login-body {
            padding: 2rem;
        }
        
        .form-floating {
            margin-bottom: 1.5rem;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .input-group {
            margin-bottom: 1.5rem;
        }
        
        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #6c757d;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
        
        .form-check {
            margin: 1.5rem 0;
        }
        
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: #5a6fd8;
            text-decoration: underline;
        }
        
        .social-login {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e9ecef;
        }
        
        .btn-social {
            width: 100%;
            margin-bottom: 0.5rem;
            padding: 0.75rem;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-google {
            background-color: #db4437;
            border-color: #db4437;
            color: white;
        }
        
        .btn-google:hover {
            background-color: #c23321;
            border-color: #c23321;
            color: white;
            transform: translateY(-1px);
        }
        
        .register-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }
        
        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 576px) {
            .login-card {
                margin: 1rem;
                border-radius: 16px;
            }
            
            .login-header, .login-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="card login-card">
                    <div class="login-header">
                        <i class="ti ti-lock-access" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <h2>Selamat Datang</h2>
                        <p>Silakan masuk ke akun Anda</p>
                    </div>
                    
                    <div class="login-body">
                        <form id="loginForm" action="#" method="POST">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ti ti-user"></i>
                                </span>
                                <input type="email" class="form-control" id="email" placeholder="Email atau Username" required>
                            </div>
                            
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ti ti-lock"></i>
                                </span>
                                <input type="password" class="form-control" id="password" placeholder="Password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="ti ti-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Ingat saya
                                    </label>
                                </div>
                                <a href="#" class="forgot-password">Lupa password?</a>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-login">
                                <i class="ti ti-login me-2"></i>Masuk
                            </button>
                        </form>
                        
                        <div class="social-login">
                            <p class="text-center text-muted mb-3">Atau masuk dengan</p>
                            <button type="button" class="btn btn-google btn-social">
                                <i class="ti ti-brand-google me-2"></i>Masuk dengan Google
                            </button>
                        </div>
                        <div class="register-link">
                            <p class="mb-0">Belum punya akun? <a href="#">Daftar sekarang</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'ti ti-eye-off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'ti ti-eye';
            }
        });

        // Form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (email && password) {
                // Simulate loading
                const submitBtn = e.target.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                submitBtn.disabled = true;
                
                setTimeout(() => {
                    alert('Login berhasil! (Ini hanya demo)');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 2000);
            }
        });

        // Add floating animation to the card
        const card = document.querySelector('.login-card');
        let isFloating = false;
        
        setInterval(() => {
            if (!isFloating) {
                card.style.transform = 'translateY(-5px)';
                isFloating = true;
            } else {
                card.style.transform = 'translateY(0px)';
                isFloating = false;
            }
        }, 3000);
    </script>
</body>
</html>