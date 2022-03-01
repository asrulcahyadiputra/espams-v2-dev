<?php $this->load->view('_partials/head'); ?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<div class="content">
		<!-- Start Content-->
		<div class="container-fluid">
			<div class="row mb-3 mt-3">
				<div class="col-12">
					<a href="#add-modal" class="btn btn-primary btn-sm waves-effect" data-animation="flash" data-plugin="custommodal" data-overlayColor="#36404a"> <i class="mdi mdi-plus"></i> Tambah Wilayah</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card-box">
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
						<div class="table-responsive">
							<table id="datatable" class="table  table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>ID Wilayah</th>
										<th>Nama Wilayah</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($wilayah as $row) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $row['id_wilayah'] ?></td>
											<td><?= $row['nama_wilayah'] ?></td>
											<td>
												<a href="#edit-modal<?= $row['id_wilayah'] ?>" class="btn btn-primary btn-sm waves-effect" data-animation="flash" data-plugin="custommodal" data-overlayColor="#36404a"><i class="mdi mdi-lead-pencil"></i></a>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content -->

	<!-- Modal add sumber pemasukan -->
	<div id="add-modal" class="modal-demo">
		<button type="button" class="close" onclick="Custombox.modal.close();">
			<span>&times;</span><span class="sr-only">Close</span>
		</button>
		<h4 class="custom-modal-title">Tambah Wilayah</h4>
		<div class="custom-modal-text">
			<form action="<?= site_url('master/wilayah/store') ?>" method="POST" class="needs-validation" novalidate>
				<div class="form-group">
					<label for="id_wilayah">ID Wilayah</label>
					<input type="text" name="id_wilayah" value="AUTO" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="nama_wilayah">Nama Wilayah</label>
					<input type="text" name="nama_wilayah" value="" class="form-control" required>
				</div>
				<div class="form-group text-right">
					<button type="button" class=" btn btn-secondary" onclick="Custombox.modal.close();">Batal</button>
					<button type="submit" class="btn btn-success">Tambahkan</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /.modal add Wilayah -->


	<!-- Modal edit Wilayah -->
	<?php foreach ($wilayah as $row) : ?>
		<div id="edit-modal<?= $row['id_wilayah'] ?>" class="modal-demo">
			<button type="button" class="close" onclick="Custombox.modal.close();">
				<span>&times;</span><span class="sr-only">Close</span>
			</button>
			<h4 class="custom-modal-title">Edit Wilayah</h4>
			<div class="custom-modal-text">
				<form action="<?= site_url('master/wilayah/update') ?>" method="POST" class="needs-validation" novalidate>
					<div class="form-group">
						<label for="id_wilayah">Kode Wilayah</label>
						<input type="text" name="id_wilayah" value="<?= $row['id_wilayah'] ?>" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label for="nama_wilayah">Nama Wilayah</label>
						<input type="text" name="nama_wilayah" value="<?= $row['nama_wilayah'] ?>" class="form-control" required>
					</div>

					<div class="form-group text-right">
						<button type="button" class=" btn btn-secondary" onclick="Custombox.modal.close();">Batal</button>
						<button type="submit" class="btn btn-success">Simpan Perubahan</button>
					</div>
				</form>
			</div>
		</div>
	<?php endforeach ?>
	<!-- /.modal edit Wilayah -->
	<?php $this->load->view('_partials/footer'); ?>
