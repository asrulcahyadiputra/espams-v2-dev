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
					<a href="#add-modal" class="btn btn-primary btn-sm waves-effect" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#36404a"> <i class="mdi mdi-plus"></i> Buat Periode Tagihan Baru</a>
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
						<table id="responsive-datatable" class="table dt-responsive table-sm nowrap" style="width: 100%;">
							<thead>
								<tr>
									<th style="width: 5%;">#</th>
									<th>No Transaksi</th>
									<th>Periode</th>
									<th>Iuran Wajib</th>
									<th>Pemakaian</th>
									<th>Denda</th>
									<th>Tunggakan</th>
									<th>Total</th>
								</tr>
							</thead>


							<tbody>
								<?php $no = 1;
								foreach ($periode as $row) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td>
											<a href="<?= site_url('transaksi/periode_tagihan/show/' . $row['id_transaksi']) ?>" class="text-purple"><?= $row['id_transaksi'] ?></a>
										</td>
										<td><?= format_bulan($row['bulan']) . ' ' . $row['tahun'] ?></td>
										<td><?= nominal($row['iuran_wajib']) ?></td>
										<td><?= nominal($row['pemakaian']) ?></td>
										<td><?= nominal($row['denda']) ?></td>
										<td><?= nominal($row['tunggakan']) ?></td>
										<td><?= nominal($row['total']) ?></td>
									</tr>
								<?php endforeach ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- container-fluid -->
	</div>
	<!-- content -->


	<!-- Modal add periode -->
	<div id="add-modal" class="modal-demo">
		<button type="button" class="close" onclick="Custombox.modal.close();">
			<span>&times;</span><span class="sr-only">Close</span>
		</button>
		<h4 class="custom-modal-title">Buat Periode Tagihan</h4>
		<div class="custom-modal-text">
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Pastikan data Pelanggan anda telah sesuai, tagihan akan automatis di generate sesuai jumlah data Pelanggan pada Data master
			</div>
			<form action="<?= site_url('transaksi/periode_tagihan/store') ?>" method="POST" class="needs-validation" novalidate>
				<div class="form-group">
					<label for="id_sumber_pemasukan">Kode Periode Tagihan</label>
					<input type="text" name="id_sumber_pemasukan" value="AUTO" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="periode">Periode Tagihan</label>
					<input type="month" name="periode" class="form-control" max="<?= date('Y-m') ?>" required>
				</div>
				<div class="form-group text-right">
					<button type="button" class=" btn btn-secondary" onclick="Custombox.modal.close();">Batal</button>
					<button type="submit" class="btn btn-success">Buat</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /.modal add periode -->
	<?php $this->load->view('_partials/footer'); ?>
