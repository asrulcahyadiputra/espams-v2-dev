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
					<a href="<?= site_url('master/pelanggan/create') ?>" class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah Pelanggan</a>
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
							<table id="datatable" class="table table-sm table-hover" style="font-size: 11px;">
								<thead>
									<tr>
										<th>#</th>
										<th>ID Pelanggan</th>
										<th>Nama Pelanggan</th>
										<th>No Hp</th>
										<th>Alamat</th>
										<th>Wilayah</th>
										<th>Golongan</th>
										<th>Meteran Awal</th>
										<th>Tunggakan</th>
										<th>Denda</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($pelanggan as $row) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $row['id_pelanggan'] ?></td>
											<td><?= $row['nama_pelanggan'] ?></td>
											<td><?= $row['no_telp'] ?></td>
											<td><?= $row['alamat'] ?></td>
											<td><?= $row['nama_wilayah'] ?></td>
											<td><?= $row['nama_golongan'] ?></td>
											<td><?= $row['meteran_awal'] ?> M<sup>3</sup> </td>
											<td><?= nominal($row['tunggakan']) ?></td>
											<td><?= nominal($row['denda']) ?></td>
											<td>
												<a href="<?= site_url('master/pelanggan/edit/' . $row['id_pelanggan']) ?>"><i class="mdi mdi-table-edit"></i></a>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- container-fluid -->
	</div>
	<!-- content -->
	<?php $this->load->view('_partials/footer'); ?>
