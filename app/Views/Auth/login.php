<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
            padding: 20px;
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
            position: relative;
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

        .login-header i {
            font-size: 3rem;
            margin-bottom: 1rem;
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

        .form-control {
            border: 2px solid #e9ecef;
            border-left: none;
            border-radius: 0 12px 12px 0;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-group:focus-within .input-group-text {
            border-color: #667eea;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .input-group:has(.is-invalid) .input-group-text {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #dc3545;
            margin-top: 0.25rem;
        }

        .form-check {
            margin: 1.5rem 0;
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
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
            color: white;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .login-divider {
            margin: 2rem 0 1.5rem;
            border-top: 1px solid #e9ecef;
        }

        .login-links {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }

        .login-links a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-links a:hover {
            text-decoration: underline;
        }

        .login-links p {
            margin: 0.5rem 0;
        }

        .alert {
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: none;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .loading-overlay {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1000;
            border-radius: 20px;
        }

        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #5a6fd8;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .login-card {
                margin: 1rem;
                border-radius: 16px;
            }

            .login-header,
            .login-body {
                padding: 1.5rem;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid login-container">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="card login-card">
                    <div class="loading-overlay" id="loadingOverlay">
                        <div class="loading-spinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>

                    <div class="login-header">
                        <i class="ti ti-lock-access"></i>
                        <h2><?= lang('Auth.loginTitle') ?></h2>
                        <p>Silakan masuk ke akun Anda</p>
                    </div>

                    <div class="login-body">
                        <?= view('App\Views\Auth\_message_block') ?>

                        <form action="<?= url_to('login') ?>" method="post" id="loginForm">
                            <?= csrf_field() ?>

                            <?php if ($config->validFields === ['email']): ?>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                    <input type="email"
                                        class="form-control <?php if (session('errors.login')): ?>is-invalid<?php endif ?>"
                                        name="login"
                                        placeholder="<?= lang('Auth.email') ?>"
                                        id="login"
                                        value="<?= old('login') ?>">
                                </div>
                                <?php if (session('errors.login')): ?>
                                    <div class="invalid-feedback d-block" style="margin-top: -1rem; margin-bottom: 1rem;">
                                        <?= session('errors.login') ?>
                                    </div>
                                <?php endif ?>
                            <?php else: ?>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-user"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control <?php if (session('errors.login')): ?>is-invalid<?php endif ?>"
                                        name="login"
                                        placeholder="<?= lang('Auth.emailOrUsername') ?>"
                                        id="login"
                                        value="<?= old('login') ?>">
                                </div>
                                <?php if (session('errors.login')): ?>
                                    <div class="invalid-feedback d-block" style="margin-top: -1rem; margin-bottom: 1rem;">
                                        <?= session('errors.login') ?>
                                    </div>
                                <?php endif ?>
                            <?php endif; ?>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="ti ti-lock"></i>
                                </span>
                                <input type="password"
                                    name="password"
                                    id="password"
                                    class="form-control <?php if (session('errors.password')): ?>is-invalid<?php endif ?>"
                                    placeholder="<?= lang('Auth.password') ?>">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                                    style="border: 2px solid #e9ecef; border-left: none; border-radius: 0 12px 12px 0;">
                                    <i class="ti ti-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                            <?php if (session('errors.password')): ?>
                                <div class="invalid-feedback d-block" style="margin-top: -1rem; margin-bottom: 1rem;">
                                    <?= session('errors.password') ?>
                                </div>
                            <?php endif ?>

                            <div class="d-flex justify-content-between align-items-center">
                                <?php if ($config->allowRemembering): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            <?php if (old('remember')): ?>checked<?php endif ?>>
                                        <label class="form-check-label" for="remember">
                                            <?= lang('Auth.rememberMe') ?>
                                        </label>
                                    </div>
                                <?php endif; ?>

                                <?php if ($config->activeResetter): ?>
                                    <a href="<?= url_to('forgot') ?>" class="forgot-password"><?= lang('Auth.forgotYourPassword') ?></a>
                                <?php endif; ?>
                            </div>

                            <button type="submit" class="btn btn-login" id="loginBtn">
                                <i class="ti ti-login me-2"></i><?= lang('Auth.loginAction') ?>
                            </button>
                        </form>

                        <?php if ($config->allowRegistration): ?>
                            <div class="login-links">
                                <p class="mb-0"><?= lang('Auth.needAnAccount') ?> <a href="<?= url_to('register') ?>">Daftar sekarang</a></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
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

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const loadingOverlay = document.getElementById('loadingOverlay');
            const loginBtn = document.getElementById('loginBtn');

            // Show loading state
            loadingOverlay.style.display = 'block';
            loginBtn.disabled = true;
            loginBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                if (bsAlert) bsAlert.close();
            });
        }, 5000);

        // Focus on login field when page loads
        window.addEventListener('load', function () {
            document.getElementById('login').focus();
        });
    </script>
</body>

</html>

<?= $this->endSection() ?>