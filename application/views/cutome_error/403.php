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

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 col-lg-6 col-xl-6 mt-5 ">
				<div class="text-center">
					<img src="<?= base_url('assets/images/sad_boy.png') ?>" alt="" style="width: 50%;">
				</div>
				<h1 class="text-center">403</h1>
				<h1 class="text-center">FORBIDDEN</h1>
				<p class="text-muted text-center">
					Akses Ditolak untuk URL ini, karena Anda tidak memiliki wewenang untuk mengakses URL ini. Informasi lebih lanjut silahkan hubungi Admin.
				</p>

				<div class="row mt-4">
					<div class="col-12 text-center">
						<a href="<?= site_url('dashboard') ?>" class="btn btn-sm btn-rounded btn-lighten-info"><i class=" mdi mdi-arrow-left "></i> Kembali ke Dashboard</a>
					</div> <!-- end col -->
				</div>
				<!-- end row -->


			</div> <!-- end col -->
		</div>
		<!-- end row -->
	</div>
	<!-- end container -->
	<div class="row fixed-bottom ">
		<div class="col-12 mt-4 text-left ml-4">
			<p class="text-muted">
				Illustration by <a href="undefined">Icons 8</a> from <a href="https://icons8.com/">Icons8</a>
			</p>
		</div> <!-- end col -->
	</div>




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
