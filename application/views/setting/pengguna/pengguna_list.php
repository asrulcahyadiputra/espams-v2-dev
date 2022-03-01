<?php $this->load->view('_partials/head'); ?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<div class="content">
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
		<!-- Start Content-->
		<div class="container-fluid">

			<div class="row">
				<div class="col-xl-4">
					<a href="#add-pengguna" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus"></i> Tambah Pengguna</a>
				</div><!-- end col -->
			</div>
			<!-- end row -->

			<div class="row">

				<?php foreach ($pengguna as $pg) : ?>
					<div class="col-xl-3 col-md-6">
						<div class="card-box widget-user">
							<div class="dropdown float-right">
								<a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<!-- item-->
									<a href="#edit-pengguna<?= $pg['id_user'] ?>" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" class="dropdown-item">Edit</a>
									<?php if ($pg['status'] == 0) : ?>
										<!-- item-->
										<a href="<?= site_url('setting/pengguna/active/1/' . $pg['id_user']) ?>" class="dropdown-item">Aktifkan</a>
									<?php endif ?>
									<!-- item-->
									<?php if ($pg['status'] == 1) : ?>
										<a href="<?= site_url('setting/pengguna/active/0/' . $pg['id_user']) ?>" class="dropdown-item">Tidak Aktif</a>
									<?php endif ?>
								</div>
							</div>
							<div class="media">
								<div class=" avatar-lg mr-3">
									<img src="<?= base_url() ?>uploads/pengurus/<?= $pg['foto'] ?>" class="img-fluid  rounded-circle" alt="user">
								</div>
								<div class="media-body overflow-hidden">
									<h5 class="mt-0 mb-1"><?= $pg['nama_pengurus'] ?></h5>
									<p class="text-muted mb-2 font-13 text-truncate"><?= $pg['role_name'] ?></p>
									<p class="text-muted mb-2 font-13 text-truncate"><?= '-U ' . $pg['username'] ?></p>
									<?php if ($pg['status'] == 1) : ?>
										<small class="text-info"><b>Aktif</b></small>
									<?php endif ?>
									<?php if ($pg['status'] == 0) : ?>
										<small class="text-danger"><b>Tidak Aktif</b></small>
									<?php endif ?>


								</div>
							</div>
						</div>
					</div>
					<!-- end col -->
				<?php endforeach ?>

			</div>
			<!-- end row -->

		</div> <!-- container-fluid -->

	</div> <!-- content -->


	<!-- Modal -->
	<div id="add-pengguna" class="modal-demo">
		<button type="button" class="close" onclick="Custombox.modal.close();">
			<span>&times;</span><span class="sr-only">Close</span>
		</button>
		<h4 class="custom-modal-title">Tambah Pengguna</h4>
		<div class="custom-modal-text text-left">
			<div class="alert alert-info alert-dismissible fade show" role="alert">
				<strong>Info!</strong> Password Default Sistem sama dengan username yang anda masukkan. Mohon pastikan username tidak duplikat.
			</div>
			<form method="POST" action="<?= site_url('setting/pengguna/store') ?>" role="form" enctype="multipart/form-data" class="needs-validation" novalidate>
				<div class="form-group">
					<label for="pengurus">Pengurus</label>
					<select name="id_pengurus" id="pengurus" class="form-control" required>
						<option value="">Pilih Pengurus</option>
						<?php foreach ($pengurus as $pg) : ?>
							<option value="<?= $pg['id_pengurus'] ?>"><?= $pg['id_pengurus']  . ' ' . $pg['nama_pengurus'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" minlength="5" name="username" id="username" placeholder="Masukkan username" required>
				</div>
				<div class="form-group">
					<label for="position">Hak Akses</label>
					<select name="role_id" id="position" class="form-control" required>
						<option value="">Pilih hak akses</option>
						<?php foreach ($role as $rl) : ?>
							<option value="<?= $rl['role_id'] ?>"><?= $rl['role_name'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="position">Wilayah (Hanya untuk cater)</label>
					<select name="id_wilayah" id="position" class="form-control">
						<option value="">Pilih Wilayah</option>
						<?php foreach ($wilayah as $w) : ?>
							<option value="<?= $w['id_wilayah'] ?>"><?= $w['id_wilayah'] . ' ' . $w['nama_wilayah'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="text-right">
					<button type="button" class="btn btn-danger waves-effect waves-light" onclick="Custombox.modal.close();">Batal</button>
					<button type="submit" class="btn btn-success waves-effect waves-light mr-1">Tambahkan</button>
				</div>
			</form>
		</div>
	</div>

	<!-- modal edit -->
	<?php foreach ($pengguna as $pg) : ?>
		<div id="edit-pengguna<?= $pg['id_user'] ?>" class="modal-demo">
			<button type="button" class="close" onclick="Custombox.modal.close();">
				<span>&times;</span><span class="sr-only">Close</span>
			</button>
			<h4 class="custom-modal-title">Edit Pengguna</h4>
			<div class="custom-modal-text text-left">
				<form method="POST" action="<?= site_url('setting/pengguna/update') ?>" role="form" enctype="multipart/form-data" class="needs-validation" novalidate>
					<input type="hidden" name="id_user" value="<?= $pg['id_user'] ?>">
					<div class="form-group">
						<label for="position">Hak Akses</label>
						<select name="role_id" id="position" class="form-control" required>
							<option value="">Pilih hak akses</option>
							<?php foreach ($role as $rl) : ?>
								<option <?= $pg['role_id'] == $rl['role_id'] ? 'selected' : '' ?> value="<?= $rl['role_id'] ?>"><?= $rl['role_name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="position">Wilayah (Hanya untuk cater)</label>
						<select name="id_wilayah" id="position" class="form-control">
							<option value="">Pilih Wilayah</option>
							<?php foreach ($wilayah as $w) : ?>
								<option <?= $pg['id_wilayah'] == $w['id_wilayah'] ? 'selected' : '' ?> value="<?= $w['id_wilayah'] ?>"><?= $w['id_wilayah'] . ' ' . $w['nama_wilayah'] ?></option>
							<?php endforeach ?>
						</select>
					</div>

					<div class="text-right">
						<button type="button" class="btn btn-danger waves-effect waves-light" onclick="Custombox.modal.close();">Batal</button>
						<button type="submit" class="btn btn-success waves-effect waves-light mr-1">Simpan Perubahan</button>
					</div>
				</form>
			</div>
		</div>
	<?php endforeach ?>
	<?php $this->load->view('_partials/footer'); ?>
