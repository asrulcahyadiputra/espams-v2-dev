<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<style>
		body {
			margin: 0;
			font-family: Roboto, sans-serif;
			font-size: .9rem;
			font-weight: 400;
			line-height: 1.5;
			color: #212529;
			text-align: left;
			background-color: #fff;
		}

		.text-muted {
			color: #adb5bd;
		}

		.text-center {
			text-align: center;
		}

		.text-right {
			text-align: right;
		}

		.text-left {
			text-align: left;
		}

		.col-12 {
			width: 100%;
		}

		.col-6 {
			width: 50%;
		}

		.col-9 {
			width: 80%;
		}

		.col-3 {
			width: 30%;
		}

		thead th {
			vertical-align: bottom;
			border: 0.5px solid #6c757d;
			background-color: #e9ecef;
		}

		.table th,
		td {
			padding: .85rem;
			vertical-align: top;
			border: 0.5px solid #6c757d;
		}

		.frofile {
			margin-bottom: 15px;
		}
	</style>
	<title><?= $title ?></title>
</head>

<body>
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-12 text-right">

				</div>
				<div class="col-12 text-center">
					<table>
						<tr>
							<th colspan="7" class="text-right">
								<h4>AKUNTANSI -3</h4>
							</th>
						</tr>
						<tr>
							<th colspan="7" class="text-center">
								<h2>TRIAL BALANCE</h2>
							</th>
						</tr>
						<tr>
							<th colspan="7" class="text-center">
								Periode : Bulan <?= format_bulan($month) . ' ' . $year ?>
							</th>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</table>
				</div>
			</div>
			<table class="profile">
				<tr>
					<th class="text-left">KPSPAMS</th>
					<th class="text-left">: <?= $spam['company_name'] ?></th>
				</tr>
				<tr>
					<th class="text-left">Desa</th>
					<th class="text-left">: <?= $spam['village'] ?></th>
				</tr>
				<tr>
					<th class="text-left">Kecamatan/Kabupaten</th>
					<th class="text-left">: <?= $spam['district'] . '/' . $spam['regency'] ?></th>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
			</table>
			<table class="info">
				<tr>
					<th colspan="7" class="text-right">
						<small class="text-muted"><i>(Dalam Rupiah)</i></small>
					</th>
				</tr>
			</table>
			<div class="table-responsive">
				<table class="table table-sm table-bordered font-11">
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
				<table>
					<tr>
						<th colspan="7">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="4" class="text-left"><small class="text-muted"><i>Powered By E-SPAMS V.2.0</i></small></th>
						<th colspan="3" class="text-right"><small class="text-muted"><i>Export at <?= date('d-m-Y H:i:s') ?></i></small></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
	<!-- end row -->
</body>

</html>
