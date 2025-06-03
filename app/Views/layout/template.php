<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title; ?></title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<div class="d-flex">
		<nav class="sidebar d-flex flex-column flex-shrink-0 position-fixed">
			<button class="toggle-btn" onclick="toggleSidebar()">
				<i class="fas fa-chevron-left"></i>
			</button>

			<div class="p-4">
				<h4 class="logo-text fw-bold mb-0">NexusFlow</h4>
				<p class="text-muted small hide-on-collapse">Dashboard</p>
			</div>

			<div class="nav flex-column">
				<a href="#" class="sidebar-link active text-decoration-none p-3">
					<i class="fas fa-home me-3"></i>
					<span class="hide-on-collapse">Dashboard</span>
				</a>
				<a href="#" class="sidebar-link text-decoration-none p-3">
					<i class="fas fa-chart-bar me-3"></i>
					<span class="hide-on-collapse">Analytics</span>
				</a>
				<a href="#" class="sidebar-link text-decoration-none p-3">
					<i class="fas fa-users me-3"></i>
					<span class="hide-on-collapse">Customers</span>
				</a>

				<a href="#" class="sidebar-link text-decoration-none p-3">
					<i class="fas fa-box me-3"></i>
					<span class="hide-on-collapse">Products</span>
				</a>
				<a href="#" class="sidebar-link text-decoration-none p-3">
					<i class="fas fa-gear me-3"></i>
					<span class="hide-on-collapse">Settings</span>
				</a>
			</div>

			<div class="profile-section mt-auto p-4">
				<div class="d-flex align-items-center">
					<img src="https://randomuser.me/api/portraits/women/70.jpg" style="height:60px"
						class="rounded-circle" alt="Profile">
					<div class="ms-3 profile-info">
						<h6 class="text-white mb-0">Alex Morgan</h6>
						<small class="text-muted">Admin</small>
					</div>
				</div>
			</div>
		</nav>

		<main class="main-content">
			<div class="container">
				
				<?= $this->rendersection('content'); ?>
				<?= $this->include('layout/footer'); ?>
			</div>
		</main>

	</div>


	<script>
		function toggleSidebar() {
			const sidebar = document.querySelector('.sidebar');
			sidebar.classList.toggle('collapsed');
		}
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
		crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
</body>

</html>