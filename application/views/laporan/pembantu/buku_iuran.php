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
						<form method="GET" action="<?= site_url('laporan/buku_iuran') ?>" class="form-inline">
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
						<a href="<?= site_url('laporan/buku_iuran/export_excel/' . $year . '/' . $month) ?>" class="btn btn-lighten-success  btn-sm mb-2"><i class="mdi mdi-microsoft-excel"></i> Export Excel</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<div class="row">
								<div class="col-12 text-right">
									<h4>LAMPIRAN-3</h4>
								</div>
								<div class="col-12 text-center">
									<h2>BUKU IURAN</h2>
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
											<th rowspan="2" style="vertical-align: middle;">Nama Pelanggan</th>
											<th rowspan="2" style="vertical-align: middle;">Alamat</th>
											<th rowspan="2" style="vertical-align: middle;">Golongan</th>
											<th rowspan="2" style="vertical-align: middle;">Meter Awal (M<sup>3</sup>)</th>
											<th rowspan="2" style="vertical-align: middle;">Meter Akhir (M<sup>3</sup>)</th>
											<th rowspan="2" style="vertical-align: middle;">Jumlah Pemakaian (M<sup>3</sup>)</th>
											<th colspan="5">Penerimaan Iuran (Rupiah)</th>
										</tr>
										<tr>
											<th>Abunemen</th>
											<th>Pemakaian Air</th>
											<th>Denda</th>
											<th>Tunggakan</th>
											<th>Jumlah</th>
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
											<th>9</th>
											<th>10</th>
											<th>11</th>
											<th>12</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($iuran) : ?>
											<?php
											$no = 1;
											$total = 0;
											$t_wajib = 0;
											$t_pemakaian = 0;
											$t_denda = 0;
											$t_tunggakan = 0;
											foreach ($iuran as $row) : ?>
												<tr>
													<td class="text-center"><?= $no++ ?></td>
													<td><?= '(' . $row['id_pelanggan'] . ') ' . $row['nama_pelanggan'] ?></td>
													<td><?= $row['alamat'] ?></td>
													<td><?= $row['nama_golongan'] ?></td>
													<td class="text-center"><?= nominal1($row['meteran_awal']) ?></td>
													<td class="text-center"><?= nominal1($row['meteran_akhir']) ?></td>
													<td class="text-center"><?= nominal1($row['meteran_akhir'] - $row['meteran_awal']) ?></td>
													<td>
														<span style="float:right;">
															<?= nominal1($row['wajib']) ?>
														</span>
													</td>
													<td>
														<span style="float:right;">
															<?= nominal1($row['pemakaian']) ?>
														</span>
													</td>
													<td>
														<span style="float:right;">
															<?= nominal1($row['denda']) ?>
														</span>
													</td>
													<td>
														<span style="float:right;">
															<?= nominal1($row['tunggakan']) ?>
														</span>
													</td>
													<td>
														<?php
														$jumlah = $row['wajib'] + $row['pemakaian'] + $row['denda'] + $row['tunggakan'];
														?>
														<span style="float:right;">
															<?= nominal1($jumlah) ?>
														</span>
													</td>
													<?php
													$total 		= $total + $jumlah;
													$t_pemakaian 	= $t_pemakaian + $row['pemakaian'];
													$t_wajib 		= $t_wajib + $row['wajib'];
													$t_denda 		= $t_denda + $row['denda'];
													$t_tunggakan 	= $t_tunggakan + $row['tunggakan'];

													?>
												</tr>
											<?php endforeach ?>
											<tr>
												<td class="text-right" colspan="7"><b>JUMLAH</b></td>
												<td>
													<b>
														<span style="float:right;">
															<?= nominal1($t_wajib) ?>
														</span>
													</b>
												</td>
												<td>
													<b>
														<span style="float:right;">
															<?= nominal1($t_pemakaian) ?>
														</span>
													</b>
												</td>
												<td>
													<b>
														<span style="float:right;">
															<?= nominal1($t_denda) ?>
														</span>
													</b>
												</td>
												<td>
													<b>
														<span style="float:right;">
															<?= nominal1($t_tunggakan) ?>
														</span>
													</b>
												</td>
												<td>
													<b>
														<span style="float:right;">
															<?= nominal1($total) ?>
														</span>
													</b>
												</td>
											</tr>
										<?php endif ?>

										<?php if (!$iuran) : ?>
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
