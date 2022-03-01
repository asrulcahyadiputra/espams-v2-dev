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
					<a href="#add-modal" class="btn btn-primary btn-sm waves-effect" data-animation="flash" data-plugin="custommodal" data-overlayColor="#36404a"> <i class="mdi mdi-plus"></i> Tambah Sumber Pemasukan</a>
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
							<table id="datatable" class="table table-sm table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>ID Sumber Pemasukan</th>
										<th>Nama Sumber Pemasukan</th>
										<th>Kategori</th>
										<th class="no_content"></th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($sumber_pemasukan as $row) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td>
												<?= $row['id_sumber_pemasukan'] ?>
											</td>
											<td><?= $row['nama_sumber_pemasukan'] ?></td>
											<td><?= $row['nama_ref'] ?></td>
											<td>
												<?php if ($row['manual_entry'] == 0) : ?>
													<span><i class="mdi mdi-lock"></i></span>
												<?php endif ?>
												<?php if ($row['manual_entry'] == 1) : ?>
													<span>
														<i class="mdi mdi-lock-open"></i>
														<i class="mdi mdi-plus"></i>
													</span>
												<?php endif ?>
											</td>

											<td>
												<?php if ($row['manual_entry'] == 1) : ?>
													<a href="#edit-modal<?= $row['id_sumber_pemasukan'] ?>" class="btn btn-lighten-primary  btn-sm waves-effect" data-animation="flash" data-plugin="custommodal" data-overlayColor="#36404a"><i class="mdi mdi-lead-pencil"></i></a>
												<?php endif ?>
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
		<h4 class="custom-modal-title">Tambah Sumber Pemasukan</h4>
		<div class="custom-modal-text">
			<form action="<?= site_url('master/sumber_pemasukan/store') ?>" method="POST" class="needs-validation" novalidate>
				<div class="form-group">
					<label for="id_sumber_pemasukan">Kode Sumber Pemasukan</label>
					<input type="text" name="id_sumber_pemasukan" value="AUTO" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="nama_sumber_pemasukan">Nama Sumber Pemasukan</label>
					<input type="text" name="nama_sumber_pemasukan" value="" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="id_ref">Kategori Sumber Pemasukan</label>
					<select name="id_ref" class="form-control" required>
						<option value="">-pilih-</option>
						<?php foreach ($ref as $r) : ?>
							<option value="<?= $r['id_ref'] ?>"><?= $r['nama_ref'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group text-right">
					<button type="button" class=" btn btn-secondary" onclick="Custombox.modal.close();">Batal</button>
					<button type="submit" class="btn btn-success">Tambahkan</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /.modal add sumber pemasukan -->


	<!-- Modal edit sumber pemasukan -->
	<?php foreach ($sumber_pemasukan as $row) : ?>
		<?php if ($row['manual_entry'] == 1) : ?>
			<div id="edit-modal<?= $row['id_sumber_pemasukan'] ?>" class="modal-demo">
				<button type="button" class="close" onclick="Custombox.modal.close();">
					<span>&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="custom-modal-title">Edit Sumber Pemasukan</h4>
				<div class="custom-modal-text">
					<form action="<?= site_url('master/sumber_pemasukan/update') ?>" method="POST" class="needs-validation" novalidate>
						<div class="form-group">
							<label for="id_sumber_pemasukan">Kode Sumber Pemasukan</label>
							<input type="text" name="id_sumber_pemasukan" value="<?= $row['id_sumber_pemasukan'] ?>" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label for="nama_sumber_pemasukan">Nama Sumber Pemasukan</label>
							<input type="text" name="nama_sumber_pemasukan" value="<?= $row['nama_sumber_pemasukan'] ?>" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="id_ref">Kategori Sumber Pemasukan</label>
							<select name="id_ref" id="id_ref" class="form-control" required>
								<option value="">-pilih-</option>
								<?php foreach ($ref as $r) : ?>
									<option <?= $row['id_ref'] ==  $r['id_ref']  ? 'selected' : '' ?> value="<?= $r['id_ref'] ?>"><?= $r['nama_ref'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group text-right">
							<button type="button" class=" btn btn-secondary" onclick="Custombox.modal.close();">Batal</button>
							<button type="submit" class="btn btn-success">Simpan Perubahan</button>
						</div>
					</form>
				</div>
			</div>
		<?php endif ?>
	<?php endforeach ?>
	<!-- /.modal edit sumber pemasukan -->
	<?php $this->load->view('_partials/footer'); ?>
