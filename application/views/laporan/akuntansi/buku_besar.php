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
						<form method="GET" action="<?= site_url('akuntansi/buku_besar') ?>">
							<div class="row">
								<div class="col-4">
									<div class="form-group mb-2">
										<select class="form-control select2" name="account_no" required>
											<option value="">Pilih/cari...</option>
											<?php foreach ($sub as $r1) : ?>
												<optgroup label="<?= $r1['sub_code'] . ' ' . $r1['sub_name'] ?>">
													<?php foreach ($coa as $r2) : ?>
														<?php if ($r2['sub_code'] == $r1['sub_code']) : ?>
															<option value="<?= $r2['account_no'] ?>"><?= $r2['account_no'] . ' ' . $r2['account_name'] ?></option>
														<?php endif ?>
													<?php endforeach ?>
												</optgroup>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group mb-2">
										<input type="month" class="form-control" id="periode" placeholder="periode" name="periode" required>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group mb-2">
										<button type="submit" class="btn btn-primary btn-sm mb-2"><i class="mdi mdi-filter"></i> Tampilkan</button>
									</div>
								</div>
							</div>

						</form>
					</div>
					<div class="col-6 text-right d-print-none">
						<a href="javascript:window.print()" class="btn btn-lighten-secondary btn-sm mb-2"><i class="mdi mdi-printer"></i> Cetak</a>
						<a href="<?= site_url('akuntansi/buku_besar/export_excel/' . $year . '/' . $month . '/' . $account) ?>" class="btn btn-lighten-success  btn-sm mb-2"><i class="mdi mdi-microsoft-excel"></i> Export Excel</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<div class="row">
								<div class="col-12 text-right">
									<h4>AKUNTANSI -2</h4>
								</div>
								<div class="col-12 text-center">
									<h2>BUKU BESAR</h2>
									<p>Periode : Bulan <?= format_bulan($month) . ' ' . $year ?></p>
								</div>
							</div>
							<div class="font-11">
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
							</div>
							<div class="table-responsive">
								<table class="table table-sm table-bordered table-hover font-11">
									<thead>
										<tr>
											<th colspan="7"><?= $account . ' -' . $acc['account_name'] ?></th>
										</tr>
										<tr>
											<th class="text-center">No</th>
											<th class="text-center">Tanggal</th>
											<th class="text-left">Uraian</th>
											<th class="text-left">Ref</th>
											<th class="text-center">Debet (Rp)</th>
											<th class="text-center">Kredit (Rp)</th>
											<th class="text-center">Saldo (Rp)</th>
										</tr>
										<tr>
											<th class="text-center">1</th>
											<th class="text-center">2</th>
											<th class="text-left">3</th>
											<th class="text-left">4</th>
											<th class="text-center">5</th>
											<th class="text-center">6</th>
											<th class="text-center">7</th>
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
										foreach ($kas as $b) : ?>
											<tr>
												<td class="text-center"><?= $no++ ?></td>
												<td class="text-center"><?= date('d-m-Y', strtotime($b['tanggal'])) ?></td>
												<td><?= $b['catatan'] ?></td>
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
													<?php
													if ($b['normal_balance'] == 'd') {
														$saldo = ($saldo + $debet) - $kredit;
													} else {
														$saldo = ($saldo + $kredit) - $debet;
													}
													?>
													<?= nominal1($saldo + $saldo_awal) ?>
												</td>
											</tr>
										<?php endforeach ?>
										<tr style="background-color: #ccff33;">
											<td class="text-left" colspan="6"><b>Saldo Akhir</b></td>
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
