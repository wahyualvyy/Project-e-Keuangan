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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
	<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
		data-sidebar-position="fixed">

		<!--  App Topstrip -->
		<!-- <div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake"
				src="https://www.adobe.com/id_id/creativecloud/design/discover/media_17770be5de64c9b159b23a7da870ae0bd5bc0f400.jpeg?width=1200&format=pjpg&optimize=medium"
				alt="Logoaisyiah" height="60" width="60" />
		</div> -->
		<div class="app-topstrip bg-white py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
			<div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
				<a class="d-flex justify-content-center" href="#">
					<img class="rounded-circle" src="<?= base_url('assets/img/Logo-SMK-Bisa.png'); ?>" alt=""
						width="70px">
				</a>


			</div>
			<div class="d-lg-flex align-items-center gap-2">
				<h3 class="text-back mb-2 mb-lg-0 fs-5 text-center">SMK HASYIM ASY'ARI</h3>
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
							<a class="sidebar-link" href="<?= base_url('/'); ?>" aria-expanded="false">
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
									<a class="sidebar-link" href="<?= base_url('guru'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Guru</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('siswa'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Siswa</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('kelas'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Kelas</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('jurusan'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Jurusan</span>
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
									<a class="sidebar-link" href="<?= base_url('data-kas/spp'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Kas SPP</span>
										</div>
									</a>
									<a class="sidebar-link" href="<?= base_url('data-kas/gaji'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Kas Gaji</span>
										</div>
									</a>
									<a class="sidebar-link" href="<?= base_url('data-kas/semester'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Kas Semester</span>
										</div>
									</a>
								</li>
								<!-- <li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('data-siswa'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Data Siswa</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link" href="<?= base_url('data-kelas'); ?>">
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
									<a class="sidebar-link justify-content-between"
										href="<?= base_url('kas-masuk/semester'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Semester</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link justify-content-between"
										href="<?= base_url('kas-masuk/spp'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Uang SPP</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link justify-content-between"
										href="<?= base_url('kas-masuk/pemasukan'); ?>">
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
									<a class="sidebar-link justify-content-between"
										href="<?= base_url('kas-keluar/gaji'); ?>">
										<div class="d-flex align-items-center gap-3">
											<div class="round-16 d-flex align-items-center justify-content-center">
												<i class="ti ti-circle"></i>
											</div>
											<span class="hide-menu">Pembayaran Gaji</span>
										</div>
									</a>
								</li>
								<li class="sidebar-item">
									<a class="sidebar-link justify-content-between"
										href="<?= base_url('kas-keluar/pengeluaran'); ?>">
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
									<img src="<?= base_url('assets/img/photo-profile.jpg'); ?>" alt="foto.jpg"
										width="40" class="rounded-circle">
								</a>
								<div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
									aria-labelledby="drop2">
									<div class="message-body">
										<a href="<?= base_url('/profile'); ?>"
											class="d-flex align-items-center gap-2 dropdown-item">
											<i class="ti ti-user fs-6"></i>
											<p class="mb-0 fs-3">Profile Sekolah</p>
										</a>
										<a href="<?= base_url('logout'); ?>"
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		// 1. Tunggu seluruh halaman HTML selesai dimuat sebelum menjalankan script
		document.addEventListener('DOMContentLoaded', function () {

			// BAGIAN NOTIFIKASI (Aman karena tidak bergantung pada elemen spesifik)
			<?php if (session()->getFlashdata('success')): ?>
				Swal.fire({
					icon: 'success',
					title: 'Berhasil!',
					text: '<?= session()->getFlashdata('success') ?>',
					showConfirmButton: false,
					timer: 2000
				});
			<?php endif; ?>

			<?php if (session()->getFlashdata('errors')): ?>
				<?php
				$errors = session()->getFlashdata('errors');
				$errorString = '<ul class="list-unstyled text-start">';
				foreach ($errors as $error) {
					$errorString .= '<li>' . esc($error) . '</li>';
				}
				$errorString .= '</ul>';
				?>
				Swal.fire({
					icon: 'error',
					title: 'Gagal!',
					html: '<?= $errorString ?>',
				});
			<?php endif; ?>


			// BAGIAN FORM EDIT (Hanya berjalan jika elemennya ada)
			const formEdit = document.getElementById('form-edit');
			const submitButton = document.getElementById('btn-update');

			if (formEdit && submitButton) {
				submitButton.addEventListener('click', function (event) {
					event.preventDefault();
					Swal.fire({
						title: "Apakah Anda ingin menyimpan perubahan?",
						showDenyButton: true,
						showCancelButton: true,
						confirmButtonText: "Simpan",
						denyButtonText: `Jangan Simpan`
					}).then((result) => {
						if (result.isConfirmed) {
							formEdit.submit();
						} else if (result.isDenied) {
							Swal.fire("Perubahan tidak disimpan", "", "info");
						}
					});
				});
			}


			// BAGIAN SELECT ALL CHECKBOX (Universal untuk semua halaman)
			const selectAllCheckbox = document.getElementById('select-all');
			if (selectAllCheckbox) {
				selectAllCheckbox.addEventListener('click', function (event) {
					const checkboxes = document.querySelectorAll('.row-checkbox');
					checkboxes.forEach(checkbox => {
						checkbox.checked = event.target.checked;
					});
				});
			}

			// BAGIAN UBAH ICON BUTTON BERDASARKAN AKSI YANG DIPILIH
			const aksiSelect = document.getElementById('aksi-massal-select') || document.querySelector('select[name="aksi_massal"]');
			const bulkActionIcon = document.getElementById('bulk-action-icon') || document.querySelector('.btn-bulk-delete i');

			if (aksiSelect && bulkActionIcon) {
				aksiSelect.addEventListener('change', function () {
					const selectedAction = this.value;
					const iconConfigs = {
						'': 'ti ti-menu-4', // default
						'hapus': 'ti ti-trash',
						'set_aktif': 'ti ti-check',
						'set_tidak_aktif': 'ti ti-x',
						'set_cuti': 'ti ti-calendar-pause',
						'export_excel': 'ti ti-file-export'
					};

					// Reset classes
					bulkActionIcon.className = 'fs-6 mb-0';
					// Add new icon class
					bulkActionIcon.className += ' ' + (iconConfigs[selectedAction] || iconConfigs['']);
				});
			}
			// BAGIAN BULK DELETE (Universal untuk semua halaman)
			const bulkDeleteBtn = document.querySelector('.btn-bulk-delete');
			const bulkForm = document.querySelector('form[action*="bulk-action"]');

			if (bulkDeleteBtn && bulkForm) {
				bulkDeleteBtn.addEventListener('click', function (event) {
					event.preventDefault();

					// Ambil select aksi massal
					const aksiSelect = bulkForm.querySelector('select[name="aksi_massal"]');
					if (!aksiSelect || !aksiSelect.value) {
						Swal.fire({
							icon: "error",
							title: "Aksi belum dipilih!",
							text: "Silakan pilih aksi massal terlebih dahulu.",
						});
						return;
					}
					// Ambil semua checkbox yang dicentang
					const checkedBoxes = bulkForm.querySelectorAll('.row-checkbox:checked');
					if (checkedBoxes.length === 0) {
						Swal.fire({
							icon: "error",
							title: "Tidak ada data!",
							text: "Silakan pilih minimal satu data terlebih dahulu.",
						});
						return;
					}

					// Tentukan nama entitas berdasarkan URL atau form action
					let entityName = "data";
					const formAction = bulkForm.getAttribute('action');
					if (formAction.includes('/jurusan/')) {
						entityName = "jurusan";
					} else if (formAction.includes('/guru/')) {
						entityName = "guru";
					} else if (formAction.includes('/siswa/')) {
						entityName = "siswa";
					} else if (formAction.includes('/kelas/')) {
						entityName = "kelas";
					}

					// Tentukan pesan konfirmasi berdasarkan aksi
					let confirmConfig = getConfirmationConfig(aksiSelect.value, entityName, checkedBoxes.length);

					// Konfirmasi aksi
					Swal.fire(confirmConfig).then((result) => {
						if (result.isConfirmed) {
							bulkForm.submit(); // Submit form secara manual
						}
					});
				});
			}

			// BAGIAN DELETE SINGLE (Universal untuk semua halaman)
			const deleteLinks = document.querySelectorAll('.btn-delete-single');
			deleteLinks.forEach(link => {
				link.addEventListener('click', function (event) {
					event.preventDefault();
					const deleteUrl = this.getAttribute('href');

					// Tentukan nama entitas berdasarkan URL
					let entityName = "data";
					if (deleteUrl.includes('/jurusan/')) {
						entityName = "jurusan";
					} else if (deleteUrl.includes('/guru/')) {
						entityName = "guru";
					} else if (deleteUrl.includes('/siswa/')) {
						entityName = "siswa";
					} else if (deleteUrl.includes('/kelas/')) {
						entityName = "kelas";
					}

					Swal.fire({
						title: "Apakah Anda yakin?",
						text: `Data ${entityName} yang dihapus tidak dapat dikembalikan!`,
						icon: "warning",
						showCancelButton: true,
						confirmButtonColor: '#d33',
						cancelButtonColor: '#3085d6',
						confirmButtonText: "Ya, hapus!",
						cancelButtonText: "Batal"
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = deleteUrl;
						}
					});
				});
			});

			// FUNGSI UNTUK KONFIGURASI KONFIRMASI BERDASARKAN AKSI
			function getConfirmationConfig(action, entityName, count) {
				const configs = {
					'hapus': {
						title: "Apakah Anda yakin?",
						text: `Semua ${entityName} yang dipilih (${count} item) akan dihapus!`,
						icon: "warning",
						showCancelButton: true,
						confirmButtonColor: '#d33',
						cancelButtonColor: '#3085d6',
						confirmButtonText: "Ya, hapus!",
						cancelButtonText: "Batal"
					},
					'aktifkan': {
						title: "Konfirmasi Aktivasi",
						text: `${count} ${entityName} akan diaktifkan`,
						icon: "question",
						showCancelButton: true,
						confirmButtonColor: '#28a745',
						cancelButtonColor: '#6c757d',
						confirmButtonText: "Ya, aktifkan!",
						cancelButtonText: "Batal"
					},
					'nonaktifkan': {
						title: "Konfirmasi Non-aktif",
						text: `${count} ${entityName} akan dinonaktifkan`,
						icon: "warning",
						showCancelButton: true,
						confirmButtonColor: '#ffc107',
						cancelButtonColor: '#6c757d',
						confirmButtonText: "Ya, nonaktifkan!",
						cancelButtonText: "Batal"
					},
					'export': {
						title: "Export Data",
						text: `Export ${count} ${entityName} yang dipilih?`,
						icon: "info",
						showCancelButton: true,
						confirmButtonColor: '#17a2b8',
						cancelButtonColor: '#6c757d',
						confirmButtonText: "Ya, export!",
						cancelButtonText: "Batal"
					},
					'ubah_status': {
						title: "Ubah Status",
						text: `Ubah status ${count} ${entityName}?`,
						icon: "question",
						showCancelButton: true,
						confirmButtonColor: '#007bff',
						cancelButtonColor: '#6c757d',
						confirmButtonText: "Ya, ubah!",
						cancelButtonText: "Batal"
					}
				};

				// Return default config jika aksi tidak ditemukan
				return configs[action] || {
					title: "Konfirmasi",
					text: `Proses ${count} ${entityName}?`,
					icon: "question",
					showCancelButton: true,
					confirmButtonColor: '#007bff',
					cancelButtonColor: '#6c757d',
					confirmButtonText: "Ya, proses!",
					cancelButtonText: "Batal"
				};
			}

		});
	</script>
</body>

</html>