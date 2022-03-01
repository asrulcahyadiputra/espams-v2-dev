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
						<form method="GET" action="<?= site_url('akuntansi/trial_balance') ?>" class="form-inline">
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
						<a href="<?= site_url('akuntansi/trial_balance/export_excel/' . $year . '/' . $month) ?>" class="btn btn-lighten-success  btn-sm mb-2"><i class="mdi mdi-microsoft-excel"></i> Export Excel</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<div class="row">
								<div class="col-12 text-right">
									<h4>AKUNTANSI -3</h4>
								</div>
								<div class="col-12 text-center">
									<h3>TRIAL BALANCE</h3>
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
							<div class="row">
								<div class="col-12 text-right">
									<small class="text-muted"><i>(Dalam Rupiah)</i></small>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-sm table-bordered table-hover font-11">
									<thead>
										<tr>
											<th rowspan="2" class="text-center" style="vertical-align: middle;">Akun</th>
											<th colspan="2" class="text-center">Saldo Awal</th>
											<th colspan="2" class="text-center">Pergerakan/Perubahan</th>
											<th colspan="2" class="text-center">Saldo Akhir</th>
										</tr>
										<tr>
											<th class="text-center">Debet</th>
											<th class="text-center">Kredit</th>
											<!-- /.saldo awal -->
											<th class="text-center">Debet</th>
											<th class="text-center">Kredit</th>
											<!-- /.pergerakan -->
											<th class="text-center">Debet</th>
											<th class="text-center">Kredit</th>
											<!-- /.saldo akhir -->
										</tr>
									</thead>
									<tbody>
										<?php
										$t_opening_debet = 0;
										$t_opening_kredit = 0;
										$t_mutasi_debet = 0;
										$t_mutasi_kredit = 0;
										$t_saldo_debet = 0;
										$t_saldo_kredit = 0;
										foreach ($head as $h1) : ?>
											<tr class="table-active">
												<td class="text-left" colspan="7"><b><?= $h1['head_name'] ?></b></td>
											</tr>
											<?php foreach ($sub as $h2) : ?>
												<?php if ($h2['head_code'] == $h1['head_code']) : ?>
													<tr class="table-active">
														<td class="text-left" colspan="7">
															<b>
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																<?= $h2['sub_name'] ?>
															</b>
														</td>
													</tr>
													<?php
													foreach ($coa as $c) : ?>
														<?php if ($c['header'] == $h2['sub_code']) : ?>
															<tr>
																<td class="text-left">
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	<?= $c['kode_akun'] . ' ' . $c['nama_akun'] ?>
																</td>
																<td class="text-right">
																	<?php
																	if ($c['saldo_normal'] == 'd') {
																		$opening = $c['opening_debet'] - $c['opening_kredit'];
																	} else {
																		$opening = 0;
																	}
																	$t_opening_debet = $t_opening_debet + $opening;
																	?>

																	<?= nominal2($opening) ?>
																</td>
																<td class="text-right">
																	<?php
																	if ($c['saldo_normal'] == 'k') {
																		$opening = $c['opening_kredit'] - $c['opening_debet'];
																	} else {
																		$opening = 0;
																	}
																	$t_opening_kredit = $t_opening_kredit + $opening;
																	?>
																	<?= nominal2($opening) ?>
																</td>
																<!-- /.oepning balance -->
																<td class="text-right">
																	<?php
																	if ($c['saldo_normal'] == 'd') {
																		$mutasi = $c['mutasi_debet'] - $c['mutasi_kredit'];
																	} else {
																		$mutasi = 0;
																	}
																	$t_mutasi_debet = $t_mutasi_debet + $mutasi;
																	?>
																	<?= nominal2($mutasi) ?>
																</td>
																<td class="text-right">
																	<?php
																	if ($c['saldo_normal'] == 'k') {
																		$mutasi = $c['mutasi_kredit'] - $c['mutasi_debet'];
																	} else {
																		$mutasi = 0;
																	}
																	$t_mutasi_kredit = $t_mutasi_kredit + $mutasi;
																	?>
																	<?= nominal2($mutasi) ?>
																</td>
																<!-- /.mutasi -->
																<td class="text-right">
																	<?php

																	if ($c['saldo_normal'] == 'd') {
																		$saldo = ($c['opening_debet'] - $c['opening_kredit']) + ($c['mutasi_debet'] - $c['mutasi_kredit']);
																		echo nominal2($saldo);
																	} else {
																		$saldo = 0;
																		echo nominal2($saldo);
																	}
																	$t_saldo_debet = $t_saldo_debet + $saldo;
																	?>

																</td>
																<td class="text-right">
																	<?php

																	if ($c['saldo_normal'] == 'k') {
																		$saldo = ($c['opening_kredit'] - $c['opening_debet']) + ($c['mutasi_kredit'] - $c['mutasi_debet']);
																		echo nominal2($saldo);
																	} else {
																		$saldo = 0;
																		echo nominal2($saldo);
																	}
																	$t_saldo_kredit = $t_saldo_kredit + $saldo;
																	?>

																</td>
															</tr>
														<?php endif ?>
													<?php endforeach ?>
												<?php endif ?>
											<?php endforeach ?>
										<?php endforeach ?>
										<tr>
											<td class="text-left"><b>Balance</b></td>
											<td class="text-right">
												<b><?= nominal2($t_opening_debet) ?></b>
											</td>
											<td class="text-right">
												<b><?= nominal2($t_opening_kredit) ?></b>
											</td>
											<td class="text-right">
												<b><?= nominal2($t_mutasi_debet) ?></b>
											</td>
											<td class="text-right">
												<b><?= nominal2($t_mutasi_kredit) ?></b>
											</td>
											<td class="text-right">
												<b><?= nominal2($t_saldo_debet) ?></b>
											</td>
											<td class="text-right">
												<b><?= nominal2($t_mutasi_kredit) ?></b>
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
