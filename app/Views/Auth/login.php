<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<style>
.login-container {
	min-height: 100vh;
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 20px;
	position: relative;
}

.login-container::before {
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="25" cy="75" r="1" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
	opacity: 0.3;
}

.login-card {
	background: rgba(255, 255, 255, 0.95);
	backdrop-filter: blur(20px);
	border: 1px solid rgba(255, 255, 255, 0.2);
	border-radius: 20px;
	box-shadow: 
		0 25px 50px rgba(0, 0, 0, 0.15),
		0 0 0 1px rgba(255, 255, 255, 0.05);
	overflow: hidden;
	width: 100%;
	max-width: 420px;
	position: relative;
	z-index: 1;
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
	background: linear-gradient(135deg, #667eea, #764ba2);
	color: white;
	text-align: center;
	padding: 2rem 1.5rem;
	margin: 0;
	position: relative;
	overflow: hidden;
}

.login-header::before {
	content: '';
	position: absolute;
	top: -50%;
	left: -50%;
	width: 200%;
	height: 200%;
	background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
	animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
	0%, 100% { transform: rotate(0deg); }
	50% { transform: rotate(180deg); }
}

.login-header h2 {
	margin: 0;
	font-weight: 300;
	font-size: 1.8rem;
	position: relative;
	z-index: 1;
}

.login-body {
	padding: 2.5rem;
}

.form-group {
	margin-bottom: 1.5rem;
	position: relative;
}

.form-group label {
	font-weight: 500;
	color: #4a5568;
	margin-bottom: 0.5rem;
	display: block;
	font-size: 0.9rem;
}

.form-control {
	border: 2px solid #e2e8f0;
	border-radius: 12px;
	padding: 0.875rem 1rem;
	font-size: 1rem;
	transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	background: rgba(255, 255, 255, 0.8);
	width: 100%;
}

.form-control:focus {
	outline: none;
	border-color: #667eea;
	box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
	background: white;
	transform: translateY(-1px);
}

.form-control.is-invalid {
	border-color: #e53e3e;
	box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
}

.invalid-feedback {
	display: block;
	font-size: 0.875rem;
	color: #e53e3e;
	margin-top: 0.5rem;
	font-weight: 500;
}

.form-check {
	margin: 1.5rem 0;
	padding: 0;
}

.form-check-label {
	display: flex;
	align-items: center;
	cursor: pointer;
	font-size: 0.9rem;
	color: #4a5568;
}

.form-check-input {
	margin-right: 0.75rem;
	margin-top: 0;
	transform: scale(1.1);
}

.btn-primary {
	background: linear-gradient(135deg, #667eea, #764ba2);
	border: none;
	border-radius: 12px;
	padding: 0.875rem 2rem;
	font-size: 1rem;
	font-weight: 600;
	width: 100%;
	transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	position: relative;
	overflow: hidden;
	margin-top: 1rem;
}

.btn-primary::before {
	content: '';
	position: absolute;
	top: 0;
	left: -100%;
	width: 100%;
	height: 100%;
	background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
	transition: left 0.5s;
}

.btn-primary:hover::before {
	left: 100%;
}

.btn-primary:hover {
	transform: translateY(-2px);
	box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.btn-primary:active {
	transform: translateY(0);
}

.login-divider {
	margin: 2rem 0 1.5rem;
	border: none;
	height: 1px;
	background: linear-gradient(to right, transparent, #e2e8f0, transparent);
}

.login-links {
	text-align: center;
}

.login-links a {
	color: #667eea;
	text-decoration: none;
	font-weight: 500;
	transition: all 0.3s ease;
	display: inline-block;
	position: relative;
}

.login-links a::after {
	content: '';
	position: absolute;
	bottom: -2px;
	left: 0;
	width: 0;
	height: 2px;
	background: #667eea;
	transition: width 0.3s ease;
}

.login-links a:hover {
	color: #764ba2;
	transform: translateY(-1px);
}

.login-links a:hover::after {
	width: 100%;
}

.login-links p {
	margin: 0.5rem 0;
	color: #718096;
}

/* Alert styling */
.alert {
	border-radius: 12px;
	border: none;
	padding: 1rem;
	margin-bottom: 1.5rem;
	font-weight: 500;
}

.alert-danger {
	background: linear-gradient(135deg, #fed7d7, #feb2b2);
	color: #c53030;
}

.alert-success {
	background: linear-gradient(135deg, #c6f6d5, #9ae6b4);
	color: #2d7738;
}

.alert-info {
	background: linear-gradient(135deg, #bee3f8, #90cdf4);
	color: #2c5282;
}

/* Responsive design */
@media (max-width: 576px) {
	.login-container {
		padding: 10px;
	}
	
	.login-body {
		padding: 2rem 1.5rem;
	}
	
	.login-header {
		padding: 1.5rem 1rem;
	}
	
	.login-header h2 {
		font-size: 1.5rem;
	}
}

/* Loading animation for form submission */
.btn-primary.loading {
	pointer-events: none;
	position: relative;
}

.btn-primary.loading::after {
	content: '';
	position: absolute;
	width: 20px;
	height: 20px;
	margin: auto;
	border: 2px solid transparent;
	border-top-color: #ffffff;
	border-radius: 50%;
	animation: spin 1s ease infinite;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

@keyframes spin {
	0% { transform: translate(-50%, -50%) rotate(0deg); }
	100% { transform: translate(-50%, -50%) rotate(360deg); }
}
</style>

<div class="login-container">
	<div class="login-card">
		<div class="login-header">
			<h2><?= lang('Auth.loginTitle') ?></h2>
		</div>
		<div class="login-body">

			<?= view('App\Views\Auth\_message_block') ?>

			<form action="<?= url_to('login') ?>" method="post" id="loginForm">
				<?= csrf_field() ?>

				<?php if ($config->validFields === ['email']): ?>
					<div class="form-group">
						<label for="login"><?= lang('Auth.email') ?></label>
						<input type="email"
							class="form-control <?php if (session('errors.login')): ?>is-invalid<?php endif ?>"
							name="login" placeholder="<?= lang('Auth.email') ?>" id="login">
						<div class="invalid-feedback">
							<?= session('errors.login') ?>
						</div>
					</div>
				<?php else: ?>
					<div class="form-group">
						<label for="login"><?= lang('Auth.emailOrUsername') ?></label>
						<input type="text"
							class="form-control <?php if (session('errors.login')): ?>is-invalid<?php endif ?>"
							name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>" id="login">
						<div class="invalid-feedback">
							<?= session('errors.login') ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="form-group">
					<label for="password"><?= lang('Auth.password') ?></label>
					<input type="password" name="password" id="password"
						class="form-control  <?php if (session('errors.password')): ?>is-invalid<?php endif ?>"
						placeholder="<?= lang('Auth.password') ?>">
					<div class="invalid-feedback">
						<?= session('errors.password') ?>
					</div>
				</div>

				<?php if ($config->allowRemembering): ?>
					<div class="form-check">
						<label class="form-check-label">
							<input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')): ?> checked <?php endif ?>>
							<?= lang('Auth.rememberMe') ?>
						</label>
					</div>
				<?php endif; ?>

				<button type="submit" class="btn btn-primary" id="loginBtn"><?= lang('Auth.loginAction') ?></button>
			</form>

			<!-- <hr class="login-divider"> -->

			<!-- <div class="login-links">
				<?php if ($config->allowRegistration): ?>
					<p><a href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
				<?php endif; ?>
				<?php if ($config->activeResetter): ?>
					<p><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
				<?php endif; ?>
			</div> -->
		</div>
	</div>
</div>

<script>
// Enhanced form interactions
document.addEventListener('DOMContentLoaded', function() {
	const form = document.getElementById('loginForm');
	const submitBtn = document.getElementById('loginBtn');
	const inputs = form.querySelectorAll('input[type="email"], input[type="text"], input[type="password"]');
	
	// Add loading state on form submission
	form.addEventListener('submit', function() {
		submitBtn.classList.add('loading');
		submitBtn.textContent = '';
	});
	
	// Enhanced input focus effects
	inputs.forEach(input => {
		input.addEventListener('focus', function() {
			this.parentNode.style.transform = 'scale(1.02)';
		});
		
		input.addEventListener('blur', function() {
			this.parentNode.style.transform = 'scale(1)';
		});
		
		// Clear invalid state on input
		input.addEventListener('input', function() {
			if (this.classList.contains('is-invalid')) {
				this.classList.remove('is-invalid');
				const feedback = this.parentNode.querySelector('.invalid-feedback');
				if (feedback) {
					feedback.style.opacity = '0';
				}
			}
		});
	});
});
</script>

<?= $this->endSection() ?>