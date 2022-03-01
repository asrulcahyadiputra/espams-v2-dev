<?php $this->load->view('_partials/head'); ?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<div class="content">
		<div class="container">
			<!-- Start Content-->
			<div class="container-fluid">
				<div class="row mb-3 mt-3 d-print-none">
					<div class="col-6">
						<form method="GET" action="<?= site_url('laporan/pengeluaran') ?>" class="form-inline">
							<div class="input-group mb-2 mr-sm-2">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
								<input type="month" class="form-control" id="periode" placeholder="periode" name="periode" required>
							</div>

							<button type="submit" class="btn btn-primary btn-sm mb-2"><i class="mdi mdi-filter"></i> Tampilkan</button>
						</form>
					</div>
					<div class="col-6 text-right d-print-none">
						<a href="javascript:window.print()" class="btn btn-lighten-secondary btn-sm mb-2"><i class="mdi mdi-printer"></i> Cetak</a>
						<a href="<?= site_url('laporan/pengeluaran/export_excel/' . $year . '/' . $month) ?>" class="btn btn-lighten-success  btn-sm mb-2"><i class="mdi mdi-microsoft-excel"></i> Export Excel</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<div class="row">
								<div class="col-12 text-right">
									<h4>LAMPIRAN -5</h4>
								</div>
								<div class="col-12 text-center">
									<h2>BUKU PENGELUARAN</h2>
									<p>Periode : Bulan <?= format_bulan($month) . ' ' . $year ?></p>
								</div>
							</div>
							<dl class="row mb-1">
								<dt class="col-sm-3">KPSPAMS</dt>
								<dd class="col-sm-9">: <?= $spam['company_name'] ?></dd>
							</dl>
							<dl class="row mb-1">
								<dt class="col-sm-3">Desa</dt>
								<dd class="col-sm-9">: <?= $spam['village'] ?></dd>
							</dl>
							<dl class="row mb-1">
								<dt class="col-sm-3">Kecamatan/Kabupaten</dt>
								<dd class="col-sm-9">: <?= $spam['district'] . '/' . $spam['regency'] ?></dd>
							</dl>
							<div class="table-responsive">
								<table class="table table-sm table-bordered table-hover font-11">
									<thead class="text-center">
										<tr>
											<th rowspan="2" style="vertical-align: middle;">No</th>
											<th rowspan="2" style="vertical-align: middle;">Tanggal</th>
											<th rowspan="2" style="vertical-align: middle;">Uraian</th>
											<th rowspan="2" style="vertical-align: middle;">No Bukti</th>
											<th colspan="2">Pengeluaran Biaya Usaha (Rp)</th>
											<th rowspan="2" style="vertical-align: middle;">Pengeluaran Investasi (Rp)</th>
											<th rowspan="2" style="vertical-align: middle;">Total (Rp)</th>
										</tr>
										<tr>
											<th>Biaya Operasi & Pemeliharaan</th>
											<th>Biaya Non Operasi</th>
										</tr>
										<tr>
											<th>1</th>
											<th>2</th>
											<th>3</th>
											<th>4</th>
											<th>5</th>
											<th>6</th>
											<th>7</th>
											<th>8</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($pengeluaran) : ?>
											<?php
											$no = 1;
											$total = 0;
											$jumlah = 0;
											$t_bop = 0;
											$t_bno = 0;
											$t_inv = 0;
											foreach ($pengeluaran as $row) : ?>
												<tr>
													<td class="text-center"><?= $no++ ?></td>
													<td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
													<td><?= $row['catatan'] ?></td>
													<td><?= $row['id_transaksi'] ?></td>
													<td>
														<span style="float:right;">
															<?php
															if ($row['tipe'] == 'bop') {
																$pa = $row['total'];
															} else {
																$pa = 0;
															}
															?>
															<?= nominal1($pa) ?>
														</span>
													</td>
													<td>
														<span style="float:right;">
															<?php
															if ($row['tipe'] == 'bno') {
																$pna = $row['total'];
															} else {
																$pna = 0;
															}
															?>
															<?= nominal1($pna) ?>
														</span>
													</td>
													<td>
														<span style="float:right;">
															<?php
															if ($row['tipe'] == 'inv') {
																$pk = $row['total'];
															} else {
																$pk = 0;
															}
															?>
															<?= nominal1($pk) ?>
														</span>
													</td>
													<td>
														<?php
														$jumlah = $pa + $pna + $pk;
														$t_bop = $t_bop + $pa;
														$t_bno = $t_bno + $pna;
														$t_inv = $t_inv + $pk;
														$total = $t_bop + $t_bno + $t_inv;

														?>
														<span style="float:right;">
															<?= nominal1($jumlah) ?>
														</span>
													</td>

												</tr>
											<?php endforeach ?>
											<tr>
												<td colspan="4"><b>Jumlah Pada Akhir Bulan</b></td>
												<td>
													<span style="float:right;">
														<b><?= nominal1($t_bop) ?></b>
													</span>
												</td>
												<td>
													<span style="float:right;">
														<b><?= nominal1($t_bno) ?></b>
													</span>
												</td>
												<td>
													<span style="float:right;">
														<b><?= nominal1($t_inv) ?></b>
													</span>
												</td>
												<td>
													<span style="float:right;">
														<b><?= nominal1($total) ?></b>
													</span>
												</td>
											</tr>

										<?php endif ?>

										<?php if (!$pengeluaran) : ?>
											<td colspan="12" class="text-center">
												<h2 class="text-primary"><i class="mdi mdi-emoticon-cry-outline"></i></h2>
												<h5>Oops ! Data tidak ditemukan....</h5>
											</td>
										<?php endif ?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
							<div class="row">
								<div class="col-12 text-right">
									<small class="text-muted"><i>Powered By E-SPAMS V.2.0</i></small>
								</div>
							</div>
						</div>
						<!-- /.card -->
					</div>
				</div>
				<!-- end row -->
			</div>
			<!-- container-fluid -->
		</div>

	</div>
	<!-- content -->
	<?php $this->load->view('_partials/footer'); ?>
