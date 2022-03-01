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
							<th colspan="4" class="text-right">
								<h4>AKUNTANSI -4</h4>
							</th>
						</tr>
						<tr>
							<th colspan="4" class="text-center">
								<h2>LAPORAN LABA/RUGI</h2>
							</th>
						</tr>
						<tr>
							<th colspan="4" class="text-center">
								Periode : Bulan <?= format_bulan($month) . ' ' . $year ?>
							</th>
						</tr>
						<tr>
							<th colspan="4">&nbsp;</th>
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
				<table class="table table-sm table-hover font-11">
					<tbody>
						<?php
						$try_laba = 0;
						foreach ($head as $h1) : ?>
							<tr>
								<td class="text-left" colspan="4"><b><?= $h1['head_code'] . ' -' . $h1['head_name'] ?></b></td>
							</tr>
							<?php
							$total = 0;
							foreach ($sub as $h2) : ?>
								<?php if ($h1['head_code'] == $h2['head_code']) : ?>
									<tr>
										<td class="text-left" colspan="4">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<b><?= $h2['sub_code'] . ' -' . $h2['sub_name'] ?></b>
										</td>
									</tr>
									<?php
									$subtotal = 0;
									foreach ($coa as $c) : ?>
										<?php if ($h2['sub_code'] == $c['sub_code']) : ?>
											<tr>
												<td class="text-left">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<?= $c['account_no'] . ' -' . $c['account_name'] ?>
												</td>
												<td class="text-right">

													<?= nominal2($c['total']) ?>
													<?php
													$subtotal = $subtotal + $c['total'];
													?>

												</td>
												<td></td>
												<td></td>
											</tr>

										<?php endif ?>
									<?php endforeach ?>
									<tr>
										<td class="text-left">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<b><?= 'Total ' . $h2['sub_name'] ?></b>
										</td>
										<td></td>
										<td class="text-right">
											<b>
												<?php
												$total = $total + $subtotal;
												?>
												<?= nominal2($subtotal) ?>
											</b>
										</td>
										<td></td>
									</tr>
								<?php endif ?>
							<?php endforeach ?>
							<tr class="table-active">
								<td><b><?= 'Total ' . $h1['head_name'] ?></b></td>
								<td></td>
								<td></td>
								<td class="text-right">
									<b>
										<?= nominal2($total) ?>
									</b>
								</td>
							</tr>

						<?php endforeach ?>
						<tr style="background-color: #ccff33;">
							<?php
							$pendapatan = $income_stat['total_pendapatan'];
							$beban = $income_stat['total_beban'];
							if ($pendapatan > $beban) {
								$pernyataan = 'Laba';
								$try_laba = $pendapatan - $beban;
							} else {
								$pernyataan = 'Laba';
								$try_laba = $beban - $pendapatan;
							}
							?>
							<td colspan="3" class="text-left"><b><?= $pernyataan ?></b></td>
							<td class="text-right">
								<b>
									<?= nominal2($try_laba) ?>
								</b>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- /.table-responsive -->
			<div class="row">
				<table>
					<tr>
						<th colspan="4">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="2" class="text-left"><small class="text-muted"><i>Powered By E-SPAMS V.2.0</i></small></th>
						<th colspan="2" class="text-right"><small class="text-muted"><i>Export at <?= date('d-m-Y H:i:s') ?></i></small></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
	<!-- end row -->
</body>

</html>
