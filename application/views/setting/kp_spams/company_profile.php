<?php $this->load->view('_partials/head'); ?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">

			<div class="row">
				<div class="col-sm-12">
					<?php if ($this->session->flashdata()) : ?>
						<?php if ($this->session->flashdata('success')) : ?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Berhasil!</strong> <?= $this->session->flashdata('success') ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php endif ?>
						<?php if ($this->session->flashdata('warning')) : ?>
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong>Peringatan!</strong> <?= $this->session->flashdata('warning') ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php endif ?>
						<?php if ($this->session->flashdata('error')) : ?>
							<div class="alert alert-error alert-dismissible fade show" role="alert">
								<strong>Gagal!</strong> <?= $this->session->flashdata('error') ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php endif ?>
					<?php endif ?>
					<div class="card-box">
						<h4 class="header-title mt-0 mb-3">Pengaturan Info KP-SPAMS</h4>
						<form method="POST" action="<?= site_url('setting/company_profile/update') ?>" class="needs-validation" novalidate>
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Logo</label>
								<div class="col-sm-3">
									<input type="file" class="dropify" name="company_logo" id="company_logo" data-default-file="<?= base_url() ?>uploads/logo/<?= $kpspams['company_logo'] ?>" />
									<input type="hidden" name="old_logo" id="old_logo" value="<?= $kpspams['company_logo'] ?>" />
								</div>
							</div>
							<div class="form-group row">
								<label for="company_name" class="col-sm-2 col-form-label">Nama</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="company_name" id="company_name" value="<?= $kpspams['company_name'] ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="company_telp" class="col-sm-2 col-form-label">Telepon</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" name="company_telp" id="company_telp" value="<?= $kpspams['company_telp'] ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="email" class="col-sm-2 col-form-label">Email</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="email" name="company_email" value="<?= $kpspams['company_email'] ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="company_address" class="col-sm-2 col-form-label">Alamat</label>
								<div class="col-sm-10">
									<textarea name="company_address" id="company_address" cols="30" rows="5" class="form-control" required><?= $kpspams['company_address'] ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="province" class="col-sm-2 col-form-label">Provinsi</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="province" id="province" value="<?= $kpspams['province'] ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="regency" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="regency" id="regency" value="<?= $kpspams['regency'] ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="district" class="col-sm-2 col-form-label">Kecamatan</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="district" id="district" value="<?= $kpspams['district'] ?>" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="village" class="col-sm-2 col-form-label">Desa/Kelurahan</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="village" id="village" value="<?= $kpspams['village'] ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-sm-12 text-right">
									<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
								</div>
							</div>
						</form>


					</div>
				</div>
				<!-- end col -->

			</div>



		</div>


	</div>

</div> <!-- container-fluid -->

</div>
<!-- content -->
<?php $this->load->view('_partials/footer'); ?>
