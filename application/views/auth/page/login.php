<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
	<meta name="description" content="Sistem Informasi Pengelolaan Administrasi Keuangan Kelompok Pengelola Air dan Sanitasi Berbasis Masyrakat merupakan sistem informasi yang dibuat sebagai wujud kecintaan dan semangat kami untuk ikut berkontribusi dalam memajukan negeri ini melalui teknologi khususnya dalam bidang teknologi informasi. E-SPAMS merupakan sistem informasi yang ditujukan kepada KP-SPAMS dalam mengelola tagihan pelanggan, kas masuk, kas keluar, pengadaan aset, csr, dan pelaporan khususnya pelaporan keuangan.">
	<meta name="keywords" content="KPSPAMS,PAMSIMAS,pamsimas,kpspams,tagihan,accounting,software,accounting software,desa,membangun desa,pencatatan tagihan,tagihan air, software kpspams,spams,e-spams">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Asrul Cahyadi Putra" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Bootstrap Css -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="<?= base_url() ?>assets/css/app.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />

</head>


<body>
	<div class="account-pages mt-5 mb-5 mx-auto">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6 col-xl-5 mt-5">

					<div class="card mt-5">

						<div class="card-body p-4">

							<div class="text-center mb-4">
								<h4 class="text-uppercase mt-0">E-SPAMS V.2.0</h4>
							</div>
							<?php if ($this->session->flashdata()) : ?>
								<?php if ($this->session->flashdata('success')) : ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<?= $this->session->flashdata('success') ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								<?php endif ?>
								<?php if ($this->session->flashdata('warning')) : ?>
									<div class="alert alert-warning alert-dismissible fade show" role="alert">
										<?= $this->session->flashdata('warning') ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								<?php endif ?>
								<?php if ($this->session->flashdata('error')) : ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<?= $this->session->flashdata('error') ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								<?php endif ?>
							<?php endif ?>
							<form action="<?= site_url('login/validate') ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

								<div class="form-group mb-3">
									<label for="username">Username</label>
									<input class="form-control" type="text" name="username" id="username" minlength="5" required="" placeholder="Masukkan username" autofocus>

								</div>

								<div class="form-group mb-3">
									<label for="password">Password</label>
									<input class="form-control" type="password" name="password" minlength="5" required="" id="password" placeholder="Masukkan password">
								</div>
								<div class="form-group mb-3">
									<button class="btn btn-primary btn-block btn-rounded" type="submit"> Masuk </button>
								</div>

							</form>

						</div> <!-- end card-body -->
					</div>
					<!-- end card -->
					<div class="row mt-4">
						<div class="col-12 text-center">
							<p class="text-muted">
								<?= '2019 - ' . date('Y') ?> &copy; E-SPAMS V.2.0 by <a href="https://www.linkedin.com/in/asrul-cahyadi-putra/" target="_blank">Asrul Cahyadi Putra</a>
							</p>
						</div> <!-- end col -->
					</div>
					<!-- end row -->


				</div> <!-- end col -->
			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
	</div>
	<!-- end page -->



	<!-- Vendor js -->
	<script src="<?= base_url() ?>assets/js/vendor.min.js"></script>

	<!-- App js -->
	<script src="<?= base_url() ?>assets/js/app.min.js"></script>
	<!-- bootstrap validation -->
	<script>
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();
	</script>

	<script>
		$(document).ready(function() {
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function() {
					$(this).remove();
				});
			}, 4000);
		});
	</script>
</body>

</html>
