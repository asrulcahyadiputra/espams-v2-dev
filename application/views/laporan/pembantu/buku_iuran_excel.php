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
			margin-left: 5px;
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
							<th colspan="12" class="text-right">
								<h4>LAMPIRAN -3</h4>
							</th>
						</tr>
						<tr>
							<th colspan="12" class="text-center">
								<h2>BUKU IURAN</h2>
							</th>
						</tr>
						<tr>
							<th colspan="12" class="text-center">
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
									<td class="text-right">
										<span style="float:right;">
											<?= nominal1($row['wajib']) ?>
										</span>
									</td>
									<td class="text-right">
										<span style="float:right;">
											<?= nominal1($row['pemakaian']) ?>
										</span>
									</td>
									<td class="text-right">
										<span style="float:right;">
											<?= nominal1($row['denda']) ?>
										</span>
									</td>
									<td class="text-right">
										<span style="float:right;">
											<?= nominal1($row['tunggakan']) ?>
										</span>
									</td>
									<td class="text-right">
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
								<td class="text-right">
									<b>
										<span style="float:right;">
											<?= nominal1($t_wajib) ?>
										</span>
									</b>
								</td>
								<td class="text-right">
									<b>
										<span style="float:right;">
											<?= nominal1($t_pemakaian) ?>
										</span>
									</b>
								</td>
								<td class="text-right">
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
								<td class="text-right">
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
				<table>
					<tr>
						<th colspan="12">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="6" class="text-left"><small class="text-muted"><i>Powered By E-SPAMS V.2.0</i></small></th>
						<th colspan="6" class="text-right"><small class="text-muted"><i>Export at <?= date('d-m-Y H:i:s') ?></i></small></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
	<!-- end row -->
</body>

</html>
