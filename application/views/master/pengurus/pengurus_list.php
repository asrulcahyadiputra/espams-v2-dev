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
					<a href="#add-pengurus" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus"></i> Tambah Pengurus</a>
				</div><!-- end col -->
			</div>
			<!-- end row -->

			<div class="row">

				<?php foreach ($pengurus as $pg) : ?>
					<div class="col-xl-3 col-md-6">
						<div class="card-box widget-user">
							<div class="dropdown float-right">
								<a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<!-- item-->
									<a href="#edit-pengurus<?= $pg['id_pengurus'] ?>" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" class="dropdown-item">Edit</a>
									<?php if ($pg['status'] == 0) : ?>
										<!-- item-->
										<a href="<?= site_url('master/pengurus/active/1/' . $pg['id_pengurus']) ?>" class="dropdown-item">Aktifkan</a>
									<?php endif ?>
									<!-- item-->
									<?php if ($pg['status'] == 1) : ?>
										<a href="<?= site_url('master/pengurus/active/0/' . $pg['id_pengurus']) ?>" class="dropdown-item">Tidak Aktif</a>
									<?php endif ?>
								</div>
							</div>
							<div class="media">
								<div class=" avatar-lg mr-3">
									<img src="<?= base_url() ?>uploads/pengurus/<?= $pg['foto'] ?>" class="img-fluid  rounded-circle" alt="user">
								</div>
								<div class="media-body overflow-hidden">
									<h5 class="mt-0 mb-1"><?= $pg['nama_pengurus'] ?></h5>
									<p class="text-muted mb-2 font-13 text-truncate"><?= $pg['nama_jabatan'] ?></p>
									<p class="text-muted mb-2 font-13 text-truncate"><?= $pg['alamat'] ?></p>
									<p class="text-muted mb-2 font-13 text-truncate"><?= $pg['no_hp'] ?></p>
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
	<div id="add-pengurus" class="modal-demo">
		<button type="button" class="close" onclick="Custombox.modal.close();">
			<span>&times;</span><span class="sr-only">Close</span>
		</button>
		<h4 class="custom-modal-title">Tambah Pengurus</h4>
		<div class="custom-modal-text text-left">
			<form method="POST" action="<?= site_url('master/pengurus/store') ?>" role="form" enctype="multipart/form-data" class="needs-validation" novalidate>
				<div class="form-group">
					<label for="Nama">Nama</label>
					<input type="text" class="form-control" name="nama_pengurus" id="Nama" placeholder="Masukkan Nama" required>
				</div>
				<div class="form-group">
					<label for="position">Jabatan</label>
					<select name="id_jabatan" id="position" class="form-control" required>
						<option value="">Pilih Jabatan</option>
						<?php foreach ($jabatan as $j) : ?>
							<option value="<?= $j['id_jabatan'] ?>"><?= $j['nama_jabatan'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="no_hp">No Hp</label>
					<input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No Hp" required>
				</div>
				<div class="form-group">
					<label for="alamat">Email address</label>
					<textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat" required></textarea>
				</div>
				<div class="form-group">
					<label for="foto">Foto (Opsional)</label>
					<input type="file" name="foto" id="foto" class="form-control">
				</div>

				<div class="text-right">
					<button type="button" class="btn btn-danger waves-effect waves-light" onclick="Custombox.modal.close();">Batal</button>
					<button type="submit" class="btn btn-success waves-effect waves-light mr-1">Tambahkan</button>
				</div>
			</form>
		</div>
	</div>

	<!-- modal edit -->
	<?php foreach ($pengurus as $pg) : ?>
		<div id="edit-pengurus<?= $pg['id_pengurus'] ?>" class="modal-demo">
			<button type="button" class="close" onclick="Custombox.modal.close();">
				<span>&times;</span><span class="sr-only">Close</span>
			</button>
			<h4 class="custom-modal-title">Edit Pengurus</h4>
			<div class="custom-modal-text text-left">
				<form method="POST" action="<?= site_url('master/pengurus/update') ?>" role="form" enctype="multipart/form-data" class="needs-validation" novalidate>
					<input type="hidden" name="id_pengurus" value="<?= $pg['id_pengurus'] ?>">
					<input type="hidden" name="old_foto" value="<?= $pg['foto'] ?>">
					<div class="form-group">
						<label for="Nama">Nama</label>
						<input type="text" class="form-control" name="nama_pengurus" placeholder="Masukkan Nama" value="<?= $pg['nama_pengurus'] ?>" required>
					</div>
					<div class="form-group">
						<label for="position">Jabatan</label>
						<select name="id_jabatan" class="form-control" required>
							<option value="">Pilih Jabatan</option>
							<?php foreach ($jabatan as $j) : ?>
								<option <?= $pg['id_jabatan'] == $j['id_jabatan'] ? 'selected' : '' ?> value="<?= $j['id_jabatan'] ?>"><?= $j['nama_jabatan'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="no_hp">No Hp</label>
						<input type="number" class="form-control" name="no_hp" placeholder="No Hp" value="<?= $pg['no_hp'] ?>" required>
					</div>
					<div class="form-group">
						<label for="alamat">Email address</label>
						<textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" placeholder="Masukkan alamat" required><?= $pg['alamat'] ?></textarea>
					</div>
					<div class="form-group">
						<label for="foto">Foto (Opsional)</label>
						<input type="file" name="foto" class="form-control">
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
