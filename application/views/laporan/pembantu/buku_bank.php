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
						<form method="GET" action="<?= site_url('laporan/bank') ?>" class="form-inline">
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
						<a href="<?= site_url('laporan/bank/export_excel/' . $year . '/' . $month) ?>" class="btn btn-lighten-success  btn-sm mb-2"><i class="mdi mdi-microsoft-excel"></i> Export Excel</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<div class="row">
								<div class="col-12 text-right">
									<h4>LAMPIRAN -1</h4>
								</div>
								<div class="col-12 text-center">
									<h2>BUKU BANK</h2>
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
											<th>No</th>
											<th>Tanggal</th>
											<th>Uraian</th>
											<th>No Bukti</th>
											<th>Debet (Rp)</th>
											<th>Kredit (Rp)</th>
											<th>Saldo (Rp)</th>
										</tr>
										<tr>
											<th>1</th>
											<th>2</th>
											<th>3</th>
											<th>4</th>
											<th>5</th>
											<th>6</th>
											<th>7</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center"><b>1</b></td>
											<td class="text-center"><b><?= '01-' . $month . '-' . $year ?></b></td>
											<td><b>Saldo Awal</b></td>
											<td colspan="3"></td>
											<td class="text-right"><?= nominal1($saldo_awal) ?></td>
										</tr>
										<?php
										$no 		= 2;
										$saldo 	= 0;
										$kredit = 0;
										$debet = 0;
										foreach ($bank as $b) : ?>
											<tr>
												<td class="text-center"><?= $no++ ?></td>
												<td class="text-center"><?= date('d-m-Y', strtotime($b['tanggal'])) ?></td>
												<td><?= $b['note'] ?></td>
												<td><?= $b['id_transaksi'] ?></td>
												<td class="text-right">
													<?= nominal1($b['debet']) ?>
													<?php $debet = $b['debet'] ?>
												</td>
												<td class="text-right">
													<?= nominal1($b['kredit']) ?>
													<?php $kredit = $b['kredit'] ?>
												</td>
												<td class="text-right">
													<?php $saldo = ($saldo + $kredit) - $debet;  ?>
													<?= nominal1($saldo + $saldo_awal) ?>
												</td>
											</tr>
										<?php endforeach ?>
										<tr style="background-color: #ccff33;">
											<td class="text-left" colspan="6"><b>Saldo Akhir (Bank)</b></td>
											<td class="text-right">
												<strong><?= nominal1($saldo + $saldo_awal) ?></strong>
											</td>
										</tr>
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
