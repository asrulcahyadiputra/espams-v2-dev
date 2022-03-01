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
					<a href="#add-modal" class="btn btn-primary btn-sm waves-effect" data-animation="flash" data-plugin="custommodal" data-overlayColor="#36404a"> <i class="mdi mdi-plus"></i> Tambah Penerimaan</a>
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
							<table class="table table-sm table-hover dt-custome font-12">
								<thead>
									<tr>
										<th>ID Transaksi</th>
										<th>Tanggal</th>
										<th>Uraian</th>
										<th>Nominal</th>
										<th class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($masuk as $row) : ?>
										<tr>

											<td><?= $row['id_transaksi'] ?></td>
											<td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
											<td><?= $row['catatan'] ?></td>
											<td>
												<span class="text-left">Rp</span>
												<span style="float:right;">
													<?= nominal1($row['total']) ?>
												</span>
											</td>
											<td class="text-center">
												<a href="#edit-modal<?= $row['id_transaksi'] ?>" class="btn btn-lighten-primary  btn-sm waves-effect" data-animation="flash" data-plugin="custommodal" data-overlayColor="#36404a"><i class="mdi mdi-lead-pencil"></i></a>
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

	<!-- Modal add Penerimaan -->
	<div id="add-modal" class="modal-demo">
		<button type="button" class="close" onclick="Custombox.modal.close();">
			<span>&times;</span><span class="sr-only">Close</span>
		</button>
		<h4 class="custom-modal-title">Tambah Penerimaan</h4>

		<div class="custom-modal-text">
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Peringatan!</strong>
				<p class=" text-justify ">Setelah Anda menyimpan data, Anda tidak dapat mengubah sumber pemasukan. Mohon berhati-hati pada saat memilih sumber pemasukan</p>
			</div>
			<form action="<?= site_url('keuangan/kas_masuk/store') ?>" method="POST" class="needs-validation" novalidate>
				<div class="form-group">
					<label for="id_transaksi">ID Transaksi</label>
					<input type="text" name="id_transaksi" value="AUTO" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="">Tanggal</label>
					<input type="date" name="tanggal" class="form-control" max="<?= date('Y-m-d') ?>">
				</div>

				<div class="form-group">
					<label for="total">Nominal</label>
					<input type="text" name="total" class="form-control" data-type="currency" required>
				</div>
				<div class="form-group">
					<label for="id_sumber_pemasukan">Sumber Pemasukan</label>
					<select name="id_sumber_pemasukan" class="form-control" required>
						<option value="">-pilih-</option>
						<?php foreach ($sumber as $r) : ?>
							<option value="<?= $r['id_sumber_pemasukan'] ?>"><?= $r['nama_sumber_pemasukan'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="catatan">Uraian</label>
					<textarea name="catatan" id="catatan" cols="30" rows="5" class="form-control" required></textarea>
				</div>
				<div class="form-group text-right">
					<button type="button" class=" btn btn-secondary" onclick="Custombox.modal.close();">Batal</button>
					<button type="submit" class="btn btn-success">Tambahkan</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /.modal add Penerimaan -->


	<!-- Modal edit Penerimaan -->
	<?php foreach ($masuk as $row) : ?>
		<div id="edit-modal<?= $row['id_transaksi'] ?>" class="modal-demo">
			<button type="button" class="close" onclick="Custombox.modal.close();">
				<span>&times;</span><span class="sr-only">Close</span>
			</button>
			<h4 class="custom-modal-title">Edit Penerimaan</h4>

			<div class="custom-modal-text">
				<form action="<?= site_url('keuangan/kas_masuk/update') ?>" method="POST" class="needs-validation" novalidate>
					<div class="form-group">
						<label for="id_transaksi">ID Transaksi</label>
						<input type="text" name="id_transaksi" value="<?= $row['id_transaksi'] ?>" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label for="">Tanggal</label>
						<input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d', strtotime($row['tanggal'])) ?>" max="<?= date('Y-m-d') ?>">
					</div>

					<div class="form-group">
						<label for="total">Nominal</label>
						<input type="text" name="total" class="form-control" value="<?= nominal($row['total']) ?>" data-type="currency" required>
					</div>

					<div class="form-group">
						<label for="catatan">Uraian</label>
						<textarea name="catatan" id="catatan" cols="30" rows="5" class="form-control" required><?= $row['catatan'] ?></textarea>
					</div>
					<div class="form-group text-right">
						<button type="button" class=" btn btn-secondary" onclick="Custombox.modal.close();">Batal</button>
						<button type="submit" class="btn btn-success">Simpan Perubahan</button>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal edit Penerimaan -->
	<?php endforeach ?>

	<?php $this->load->view('_partials/footer'); ?>
