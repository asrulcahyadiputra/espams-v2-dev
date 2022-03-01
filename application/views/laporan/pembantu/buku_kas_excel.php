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
			margin-left: 30px;
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
			border-top: 0.5px solid #6c757d;
			border-top: 0.5px solid #6c757d;
			background-color: #e9ecef;
		}

		.table th,
		td {
			padding: .85rem;
			vertical-align: top;
			border-bottom: 0.5px solid #6c757d;
			border-top: 0.5px solid #6c757d;
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
								<h4>LAMPIRAN -2</h4>
							</th>
						</tr>
						<tr>
							<th colspan="7" class="text-center">
								<h2>BUKU KAS</h2>
							</th>
						</tr>
						<tr>
							<th colspan="7" class="text-center">
								Periode : Bulan <?= format_bulan($month) . ' ' . $year ?>
							</th>
						</tr>
					</table>
				</div>
			</div>
			<table class="profile">
				<tr>
					<th colspan="2" class="text-left">KPSPAMS</th>
					<th class="text-left">: <?= $spam['company_name'] ?></th>
				</tr>
				<tr>
					<th colspan="2" class="text-left">Desa</th>
					<th class="text-left">: <?= $spam['village'] ?></th>
				</tr>
				<tr>
					<th colspan="2" class="text-left">Kecamatan/Kabupaten</th>
					<th class="text-left">: <?= $spam['district'] . '/' . $spam['regency'] ?></th>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
			</table>
			<div class="table-responsive">
				<table class="table table-sm table-hover font-11">
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
									<?php $saldo = ($saldo + $debet) - $kredit;  ?>
									<?= nominal1($saldo + $saldo_awal) ?>
								</td>
							</tr>
						<?php endforeach ?>
						<tr style="background-color: #ccff33;">
							<td class="text-right" colspan="6"><b>Saldo Akhir (Kas)</b></td>
							<td class="text-right">
								<strong><?= nominal1($saldo + $saldo_awal) ?></strong>
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
