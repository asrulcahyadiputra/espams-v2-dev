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
							<th colspan="8" class="text-right">
								<h4>LAMPIRAN -5</h4>
							</th>
						</tr>
						<tr>
							<th colspan="8" class="text-center">
								<h2>BUKU PENGELUARAN</h2>
							</th>
						</tr>
						<tr>
							<th colspan="8" class="text-center">
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
							<th rowspan="2" style="vertical-align: middle;">No</th>
							<th rowspan="2" style="vertical-align: middle;">Tanggal</th>
							<th rowspan="2" style="vertical-align: middle;">Uraian</th>
							<th rowspan="2" style="vertical-align: middle;">No Bukti</th>
							<th colspan="2">Pengeluaran Biaya Usaha </th>
							<th rowspan="2" style="vertical-align: middle;">Pengeluaran Investasi</th>
							<th rowspan="2" style="vertical-align: middle;">Total</th>
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
									<td class="text-center" style="vertical-align: middle;"><?= $no++ ?></td>
									<td style="vertical-align: middle;"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
									<td style="vertical-align: middle;"><?= $row['catatan'] ?></td>
									<td style="vertical-align: middle;"><?= $row['id_transaksi'] ?></td>
									<td class="text-right" style="vertical-align: middle;">
										<span style="float:right;">
											<?php
											if ($row['tipe'] == 'bop') {
												$bop = $row['total'];
											} else {
												$bop = 0;
											}
											?>
											<?= nominal1($bop) ?>
										</span>
									</td>
									<td class="text-right" style="vertical-align: middle;">
										<span style="float:right;">
											<?php
											if ($row['tipe'] == 'bno') {
												$bno = $row['total'];
											} else {
												$bno = 0;
											}
											?>
											<?= nominal1($bno) ?>
										</span>
									</td>
									<td class="text-right" style="vertical-align: middle;">
										<span style="float:right;">
											<?php
											if ($row['tipe'] == 'inv') {
												$inv = $row['total'];
											} else {
												$inv = 0;
											}
											?>
											<?= nominal1($inv) ?>
										</span>
									</td>
									<td class="text-right" style="vertical-align: middle;">
										<?php
										$jumlah = $bop + $bno + $inv;
										$t_bop = $t_bop + $bop;
										$t_bno = $t_bno + $bno;
										$t_inv = $t_inv + $inv;
										$total = $t_bop + $t_bno + $t_inv;

										?>
										<span style="float:right;">
											<?= nominal1($jumlah) ?>
										</span>
									</td>

								</tr>
							<?php endforeach ?>
							<tr>
								<td colspan="4" class="text-right"><b>Jumlah Pada Akhir Bulan</b></td>
								<td class="text-right">
									<span style="float:right;">
										<b><?= nominal1($t_bop) ?></b>
									</span>
								</td class="text-right">
								<td class="text-right">
									<span style="float:right;">
										<b><?= nominal1($t_bno) ?></b>
									</span>
								</td>
								<td class="text-right">
									<span style="float:right;">
										<b><?= nominal1($t_inv) ?></b>
									</span>
								</td>
								<td class="text-right">
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
				<table>
					<tr>
						<th colspan="8">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="4" class="text-left"><small class="text-muted"><i>Powered By E-SPAMS V.2.0</i></small></th>
						<th colspan="4" class="text-right"><small class="text-muted"><i>Export at <?= date('d-m-Y H:i:s') ?></i></small></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
	<!-- end row -->
</body>

</html>
