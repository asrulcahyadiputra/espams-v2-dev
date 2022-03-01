<?php $this->load->view('_partials/head'); ?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<div class="content">
		<!-- Start Content-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<form class="form-inline">
							<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Periode</label>
							<input type="month" class="form-control mr-2" name="periode" id="periode">

							<button type="submit" class="btn btn-primary my-1"><i class=" mdi mdi-table-search"></i></button>
						</form>

					</div>
				</div>

				<?php if ($trx) : ?>
					<div class="col-12">
						<div class="card-box">
							<div class="row">
								<div class="col-8">
									<h4>
										Pencatatan Meteran Pelanggan
										<?php if ($trx['status'] == 0) : ?>
											<span class="badge badge-purple"><i class="mdi mdi-lock-open"> Open</i></span>
										<?php endif ?>
										<?php if ($trx['status'] == 1) : ?>
											<span class="badge badge-purple"><i class="mdi mdi-lock"> Closed</i></span>
										<?php endif ?>
									</h4>
									<p>Periode : <?= format_bulan($month) . ' ' . $year ?></p>

								</div>
								<div class="col-4 text-right">
									<?php if ($trx['status'] == 0 && nominal1($progress) == 100) : ?>
										<a href="<?= site_url('transaksi/pencatatan_tagihan/tutup/' . $trx['id_transaksi']) ?>" class="btn btn-lighten-purple">Tutup Pencatatan</a>
									<?php endif ?>
								</div>
							</div>
							<div class="progress mb-3" style="height: 20px;">
								<div class="progress-bar bg-success" role="progressbar" style="width: <?= nominal1($progress) ?>%;" aria-valuenow="<?= nominal1($progress) ?>" aria-valuemin="0" aria-valuemax="100"><?= 'Pembayaran ' . nominal1($progress) ?>%</div>
							</div>
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

							<div class="responsive-table-plugin">
								<input type="text" id="nama_pelanggan" class="form-control col-sm-12 mb-3" onkeyup="myFunction()" placeholder="Cari Nama.." title="Masukkan Nama Pelanggan">
								<div class="table-responsive" data-pattern="priority-columns">
									<table id="TableSearch" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>#</th>
												<th data-priority="1">ID Pelanggan</th>
												<th data-priority="1">Pelanggan</th>
												<th data-priority="1">Golongan</th>
												<th data-priority="2">Meteran Awal</th>
												<th data-priority="2">Meteran Akhir</th>
												<th data-priority="1">status</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($list as $ls) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td>
														<a href="<?= site_url('transaksi/pencatatan_tagihan/show/' . $ls['id_tagihan']) ?>"><?= $ls['id_pelanggan'] ?></a>
													</td>
													<td><?= $ls['nama_pelanggan'] ?></td>
													<td><?= $ls['nama_golongan'] ?></td>
													<td><?= nominal1($ls['meteran_awal']) ?> M<sup>3</sup> </td>
													<td><?= nominal1($ls['meteran_akhir']) ?> M<sup>3</sup></td>
													<td>
														<?php if ($ls['status'] == 0) : ?>
															<span class="text-danger">Belum Dicatat</span>
														<?php endif ?>
														<?php if ($ls['status'] == 1) : ?>
															<span class="text-pink">Tagihan Belum Final</span>
														<?php endif ?>
														<?php if ($ls['status'] == 2) : ?>
															<span class="text-warning">Belum Dibayar</span>
														<?php endif ?>
														<?php if ($ls['status'] == 3) : ?>
															<span class="text-success">Sudah Dibayar</span>
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
				<?php endif ?>

				<?php if (!$trx) : ?>
					<div class="col-12">
						<div class="card-box text-center">
							<h2 class="text-primary"><i class="mdi mdi-emoticon-cry-outline"></i></h2>
							<h5>Oops ! Data tidak ditemukan....</h5>
						</div>
					</div>
				<?php endif ?>
			</div>
			<!-- end row -->
		</div>
		<!-- container-fluid -->
	</div>
	<!-- content -->



	<?php $this->load->view('_partials/footer'); ?>
