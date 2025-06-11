<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title; ?></title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url('css/styles.min.css'); ?>">
	<!-- <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css'); ?>" /> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>
	<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
		data-sidebar-position="fixed" data-header-position="fixed">

		<!--  App Topstrip -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake"
				src="https://www.adobe.com/id_id/creativecloud/design/discover/media_17770be5de64c9b159b23a7da870ae0bd5bc0f400.jpeg?width=1200&format=pjpg&optimize=medium"
				alt="Logoaisyiah" height="60" width="60" />
		</div>
		<div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
			<div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
				<a class="d-flex justify-content-center" href="#">
					<img class="rounded-circle"
						src="https://www.adobe.com/id_id/creativecloud/design/discover/media_17770be5de64c9b159b23a7da870ae0bd5bc0f400.jpeg?width=1200&format=pjpg&optimize=medium"
						alt="" width="60px">
				</a>


			</div>
			<div class="d-lg-flex align-items-center gap-2">
				<h3 class="text-white mb-2 mb-lg-0 fs-5 text-center">Website Keuangan Sekolah</h3>
				<div class="d-flex align-items-center justify-content-center gap-2">
				</div>
			</div>

		</div>
		<!-- Sidebar Start -->
		<aside class="left-sidebar">
			<!-- Sidebar scroll-->
			<div>
				<div class="brand-logo d-flex align-items-center justify-content-between">
					<a href="./index.html" class="text-nowrap logo-img">
						<h4>Control Panel</h4>
					</a>
					<div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
						<i class="ti ti-x fs-6"></i>
					</div>
				</div>
				<!-- Sidebar navigation-->
				<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
					<ul id="sidebarnav">
						<li class="nav-small-cap">
							<iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
							<span class="hide-menu">Main Menu</span>
						</li>
						<li class="sidebar-item <?= ($title === 'Dashboard Admin') ? 'active' : ''; ?>">
							<a class="sidebar-link" href="<?= base_url('admin/dashboard'); ?>" aria-expanded="false">
								<i class="ti ti-home"></i>
								<span class="hide-menu">Laporan Keuangan</span>
							</a>
						</li>
						<!-- ---------------------------------- -->
						<!-- Dashboard -->
						<!-- ---------------------------------- -->
						<li class="sidebar-item">
							<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
								<div class="d-flex align-items-center gap-3">
									<span class="d-flex"><i class="ti ti-layout-grid"></i></span>
									<span class="hide-menu">Data Tabel</span>
								</div>
							</a>
							<ul class="collapse first-level">
								<li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('admin/data-guru'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Guru</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('admin/data-siswa');?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Siswa</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('admin/data-kelas');?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Kelas</span>
										</div>
									</a>
								</li>
							</ul>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
								<div class="d-flex align-items-center gap-3">
									<span class="d-flex"><i class="ti ti-moneybag-edit"></i></span>
									<span class="hide-menu">Data Kas</span>
								</div>
							</a>
							<ul class="collapse first-level">
								<li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('admin/data-kas-spp'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Kas SPP</span>
										</div>
									</a>
									<a class="sidebar-link" href="<?= base_url('admin/data-kas-gaji'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Kas Gaji</span>
										</div>
									</a>
									<a class="sidebar-link" href="<?= base_url('admin/data-kas-pendaftaran'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Kas Pendaftaran</span>
										</div>
									</a>
								</li>
								<!-- <li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('admin/data-siswa');?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Siswa</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('admin/data-kelas');?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Kelas</span>
										</div>
									</a>
								</li> -->
							</ul>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)"
								aria-expanded="false">
								<div class="d-flex align-items-center gap-3">
									<span class="d-flex">
										<i class="ti ti-moneybag-plus"></i>
									</span>
									<span class="hide-menu">Kas Masuk</span>
								</div>

							</a>
							<ul aria-expanded="false" class="collapse first-level">
								<li class="sidebar-item">
									<a class="sidebar-link justify-content-between" href="#">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Pendaftaran</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link justify-content-between" href="#">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Uang SPP</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link justify-content-between" href="#">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Uang Ujian</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link justify-content-between" href="#">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Jenis Transaksi</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link justify-content-between" href="#">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Pemasukan Lainnya</span>
										</div>
									</a>
								</li>
							</ul>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)"
								aria-expanded="false">
								<div class="d-flex align-items-center gap-3">
									<span class="d-flex">
										<i class="ti ti-moneybag-minus"></i>
									</span>
									<span class="hide-menu">Kas Keluar</span>
								</div>

							</a>
							<ul aria-expanded="false" class="collapse first-level">
								<li class="sidebar-item">
									<a class="sidebar-link justify-content-between" href="#">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Pembayaran Gaji</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link justify-content-between" href="#">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Pengeluaran Lainnya</span>
										</div>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
				<!-- End Sidebar navigation -->
			</div>
			<!-- End Sidebar scroll-->
		</aside>
		<!--  Sidebar End -->
		<!--  Main wrapper -->
		<div class="body-wrapper">
			<!--  Header Start -->
			<header class="app-header">
				<nav class="navbar navbar-expand-lg navbar-light">
					<ul class="navbar-nav">
						<li class="nav-item d-block d-xl-none">
							<a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
								<i class="ti ti-menu-2"></i>
							</a>
						</li>
					</ul>
					<div class="navbar-collapse justify-content-end px-0" id="navbarNav">
						<ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

							<li class="nav-item dropdown">
								<a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
									aria-expanded="false">
									<img src="<?= base_url('assets/img/photo-profile.jpg');?>"
										alt="foto.jpg" width="40" class="rounded-circle">
								</a>
								<div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
									aria-labelledby="drop2">
									<div class="message-body">
										<a href="javascript:void(0)"
											class="d-flex align-items-center gap-2 dropdown-item">
											<i class="ti ti-user fs-6"></i>
											<p class="mb-0 fs-3">My Profile</p>
										</a>
										<a href="javascript:void(0)"
											class="d-flex align-items-center gap-2 dropdown-item">
											<i class="ti ti-user-share fs-6"></i>
											<p class="mb-0 fs-3">Register</p>
										</a>
										<a href="./authentication-login.html"
											class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<!--  Header End -->
			<div class="body-wrapper-inner">
				<div class="container-fluid">
					<!--  Row 1 -->
					<div class="row">
						<?= $this->renderSection('content'); ?>
					</div>
					<div class="py-6 px-6 text-center">
						<?= $this->include('layout/footer'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="<?= base_url('libs/jquery/dist/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?= base_url('js/sidebarmenu.js'); ?>"></script>
	<script src="<?= base_url('js/app.min.js'); ?>"></script>
	<script src="<?= base_url('libs/apexcharts/dist/apexcharts.min.js'); ?>"></script>
	<script src="<?= base_url('libs/simplebar/dist/simplebar.js'); ?>"></script>
	<script src="<?= base_url('js/dashboard.js'); ?>"></script>
	<!-- solar icons -->
	<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
	<!-- <script src="<?= base_url('dist/js/adminlte.js'); ?>"></script> -->
</body>

</html>