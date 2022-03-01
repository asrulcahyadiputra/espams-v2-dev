<?php $this->load->view('_partials/head'); ?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<div class="content">
		<div class="container">
			<!-- Start Content-->
			<div class="container-fluid">
				<div class="row mb-2 mt-3 d-print-none">
					<div class="col-6">
						<a href="#FilterModal" class="btn btn-primary waves-effect" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#36404a"> <i class="mdi mdi-filter"></i> Filter</a>
					</div>
					<div class="col-6 text-right d-print-none">
						<div class="btn-group dropdown mt-1">
							<a href="javascript:window.print()" class="btn btn-lighten-secondary"><i class="mdi mdi-printer"></i> Cetak</a>
							<a href="javascript:void()" class="btn btn-lighten-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<i class="mdi mdi-chevron-down"></i>
							</a>
							<div class="dropdown-menu">
								<!-- item-->
								<a href="<?= site_url('akuntansi/jurnal_umum/export_excel/' . $year . '/' . $month) ?>" class="dropdown-item"><i class="mdi mdi-microsoft-excel"></i> Export Excel</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<h2>Jurnal Umum</h2>
							<p>Periode : <?= format_bulan($month) . ' ' . $year ?></p>
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
								<table class="table table-sm table-bordered  table-hover font-11">
									<thead>
										<tr>

											<th>Tanggal</th>
											<th>Keterangan</th>
											<th>Ref</th>
											<th>Debet</th>
											<th>Kredit</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($row_jurnal) : ?>
											<?php foreach ($row_jurnal as $r1) : ?>
												<tr>
													<td rowspan="<?= $r1['row'] + 1 ?>"><?= date('d-m-Y', strtotime($r1['tanggal'])) ?></td>
												</tr>
												<?php foreach ($jurnal as $r2) : ?>
													<?php if ($r1['id_transaksi'] == $r2['id_transaksi']) : ?>
														<tr>
															<?php if ($r2['posisi'] == 'd') : ?>
																<td><?= $r2['account_no'] . ' ' . $r2['account_name'] ?></td>
															<?php endif ?>
															<?php if ($r2['posisi'] == 'k') : ?>
																<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r2['account_no'] . ' ' . $r2['account_name'] ?></td>
															<?php endif ?>
															<td><?= $r2['id_transaksi'] ?></td>
															<td>
																<span class="text-left">Rp</span>
																<span style="float:right;">
																	<?php
																	if ($r2['posisi'] == 'd') {
																		echo nominal1($r2['nominal']);
																	} else {
																		echo "-";
																	}
																	?>
																</span>
															</td>
															<td>
																<span class="text-left">Rp</span>
																<span style="float:right;">
																	<?php
																	if ($r2['posisi'] == 'k') {
																		echo nominal1($r2['nominal']);
																	} else {
																		echo "-";
																	} ?>
																</span>
															</td>
														</tr>
													<?php endif ?>
												<?php endforeach ?>
											<?php endforeach ?>
										<?php endif ?>

										<?php if (!$row_jurnal) : ?>
											<td colspan="12" class="text-center">
												<h2 class="text-primary"><i class="mdi mdi-emoticon-cry-outline"></i></h2>
												<h5>Oops ! Data tidak ditemukan....</h5>
											</td>
										<?php endif ?>
									</tbody>
								</table>
							</div>
							<div class="row">
								<div class="col-12 text-right">
									<small class="text-muted"><i>Powered By E-SPAMS V.2.0</i></small>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end row -->
			</div>
			<!-- container-fluid -->
		</div>

	</div>
	<!-- content -->


	<!-- modal filter jurnal umum -->
	<div id="FilterModal" class="modal-demo">
		<button type="button" class="close" onclick="Custombox.modal.close();">
			<span>&times;</span><span class="sr-only">Close</span>
		</button>
		<h4 class="custom-modal-title">Filter Jurnal Umum</h4>
		<div class="custom-modal-text">
			<form method="GET" action="<?= site_url('akuntansi/jurnal_umum') ?>">
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-calendar"></i></div>
					</div>
					<input type="month" class="form-control" id="periode" placeholder="periode" name="periode" required>
				</div>

				<div class="float-right">
					<button type="submit" class="btn btn-success btn-sm mb-2">Tampilkan</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /.modal filter jurnal umum -->

	<?php $this->load->view('_partials/footer'); ?>
