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
			margin-left: 10px;
			margin-bottom: 10px;
			margin-right: 10px;
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

		.table {
			padding: 20px;
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
							<th colspan="5" class="text-right">
								<h4>Akuntansi -1</h4>
							</th>
						</tr>
						<tr>
							<th colspan="5" class="text-center">
								<h2>JURNAL UMUM</h2>
							</th>
						</tr>
						<tr>
							<th colspan="5" class="text-center">
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
			<div class="table-responsive">

				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center">Tanggal</th>
							<th class="text-left">Keterangan</th>
							<th class="text-left">Ref</th>
							<th class="text-center">Debet</th>
							<th class="text-center">Kredit</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($row_jurnal) : ?>
							<?php foreach ($jurnal as $r2) : ?>
								<tr>
									<td class="text-left"><?= mediumdate_indo(date('Y-m-d', strtotime($r2['tanggal'])))  ?></td>
									<?php if ($r2['posisi'] == 'd') : ?>
										<td width="70"><?= $r2['account_no'] . ' ' . $r2['account_name'] ?></td>
									<?php endif ?>
									<?php if ($r2['posisi'] == 'k') : ?>
										<td width="70">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r2['account_no'] . ' ' . $r2['account_name'] ?></td>
									<?php endif ?>
									<td><?= $r2['id_transaksi'] ?></td>
									<td>
										<span class="text-left">Rp</span>
										<span class="text-right">
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
										<span class="text-right">
											<?php
											if ($r2['posisi'] == 'k') {
												echo nominal1($r2['nominal']);
											} else {
												echo "-";
											} ?>
										</span>
									</td>
								</tr>
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
			<!-- /.table-responsive -->
			<div class="row">
				<table>
					<tr>
						<th colspan="5">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="3" class="text-left"><small class="text-muted"><i>Powered By E-SPAMS V.2.0</i></small></th>
						<th colspan="2" class="text-right"><small class="text-muted"><i>Export at <?= date('d-m-Y H:i:s') ?></i></small></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
	<!-- end row -->
</body>

</html>
