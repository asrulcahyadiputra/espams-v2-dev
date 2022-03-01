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
								<h4>AKUNTANSI -2</h4>
							</th>
						</tr>
						<tr>
							<th colspan="4" class="text-center">
								<h2>BUKU BESAR</h2>
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
						<tr>
							<td class="text-left" colspan="4"><b><?= Romawi(1) . '. SALDO AWAL' ?></b></td>
						</tr>
						<tr>
							<td class="text-left" colspan="4">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Kas</b>
							</td>
						</tr>
						<?php
						$sub_kas = 0;
						foreach ($opening as $op) : ?>
							<?php if ($op['post'] == 'kas') : ?>
								<tr>
									<td class="text-left">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<?= $op['kode_akun'] . ' -' . $op['nama_akun'] ?>
									</td>
									<td class="text-right">
										<?php
										$saldo_awal_kas = $op['opening_debet'] - $op['opening_kredit'];
										$sub_kas = $sub_kas + $saldo_awal_kas;
										?>
										<?= nominal2($saldo_awal_kas) ?>
									</td>
									<td></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endforeach ?>
						<tr>
							<td class="text-left">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Saldo Awal Kas</b>
							</td>
							<td></td>
							<td class="text-right">
								<b>
									<?= nominal2($sub_kas) ?>
								</b>
							</td>
							<td></td>
						</tr>
						<!-- /.saldo awal kas -->
						<tr>
							<td class="text-left" colspan="4">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Bank</b>
							</td>
						</tr>
						<?php $sub_bank = 0;
						foreach ($opening as $op) : ?>
							<?php if ($op['post'] == 'bank') : ?>
								<tr>
									<td class="text-left">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<?= $op['kode_akun'] . ' -' . $op['nama_akun'] ?>
									</td>
									<td class="text-right">
										<?php
										$saldo_awal_bank = $op['opening_debet'] - $op['opening_kredit'];
										$sub_bank = $sub_bank + $saldo_awal_bank;
										?>
										<?= nominal2($saldo_awal_bank) ?>
									</td>
									<td></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endforeach ?>
						<tr>
							<td class="text-left">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Saldo Awal Bank</b>
							</td>
							<td></td>
							<td class="text-right">
								<b>
									<?= nominal2($sub_bank) ?>
								</b>
							</td>
							<td></td>
						</tr>
						<!-- /.saldo awal bank -->
						<tr class="table-active">
							<td><b>SALDO AWAL</b></td>
							<td></td>
							<td></td>
							<td class="text-right">
								<b>
									<?php $saldo_awal = $sub_kas + $sub_bank ?>
									<?= nominal2($saldo_awal) ?>
								</b>
							</td>
						</tr>
						<!-- saldo awal -->
						<tr>
							<td class="text-left" colspan="4"><b><?= Romawi(2) . '. AKTIVITAS PENERIMAAN' ?></b></td>
						</tr>
						<?php
						$total_penerimaan = 0;
						foreach ($sub as $h2) : ?>
							<?php if ($h2['activity'] == 'penerimaan') : ?>
								<tr>
									<td class="text-left" colspan="4">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<b><?= $h2['sub_code'] . ' -' . $h2['sub_name'] ?></b>
									</td>
								</tr>
								<?php
								$sub_penerimaan = 0;
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
												$sub_penerimaan = $sub_penerimaan + $c['total'];
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
											$total_penerimaan = $total_penerimaan + $sub_penerimaan;
											?>
											<?= nominal2($sub_penerimaan) ?>
										</b>
									</td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endforeach ?>
						<tr class="table-active">
							<td><b>TOTAL AKTIVITAS PENERIMAAN</b></td>
							<td></td>
							<td></td>
							<td class="text-right">
								<b>
									<?= nominal2($total_penerimaan) ?>
								</b>
							</td>
						</tr>
						<!-- /.penerimaan -->
						<tr>
							<td class="text-left" colspan="4"><b><?= Romawi(3) . '. AKTIVITAS PENGELUARAN' ?></b></td>
						</tr>
						<?php
						$total_pengeluaran = 0;
						foreach ($sub as $h2) : ?>
							<?php if ($h2['activity'] == 'pengeluaran') : ?>
								<tr>
									<td class="text-left" colspan="4">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<b><?= $h2['sub_code'] . ' -' . $h2['sub_name'] ?></b>
									</td>
								</tr>
								<?php
								$sub_pengeluaran = 0;
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
												$sub_pengeluaran = $sub_pengeluaran + $c['total'];
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
											$total_pengeluaran = $total_pengeluaran + $sub_pengeluaran;
											?>
											<?= nominal2($sub_pengeluaran) ?>
										</b>
									</td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endforeach ?>


						<tr class="table-active">
							<td><b>TOTAL AKTIVITAS PENGELUARAN</b></td>
							<td></td>
							<td></td>
							<td class="text-right">
								<b>

									(<?= nominal2($total_pengeluaran) ?>)
								</b>
							</td>
						</tr>
						<!-- /.pengeluaran -->
						<tr>
							<?php
							$debet = ($saldo_awal + $total_penerimaan);
							if ($debet >= $total_pengeluaran) {
								$try_surflus = $debet - $total_pengeluaran;
								$pernyataan = 'SURFLUS';
							} else {
								$try_surflus = $total_pengeluaran - $debet;
								$pernyataan = 'DEFISIT';
							}

							?>
							<td colspan="3" class="text-left"><b><?= Romawi(4) . '. ' . $pernyataan ?></b></td>
							<td class="text-right">
								<b>
									<?= nominal2($try_surflus) ?>
								</b>
							</td>
						</tr>
						<!-- /.surflus/defisi -->
						<tr>
							<td class="text-left" colspan="4"><b><?= Romawi(5) . '. SALDO AKHIR' ?></b></td>
						</tr>
						<?php $saldo_akhir = 0;
						foreach ($close as $cl) : ?>
							<tr>
								<td class="text-left">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<?= $cl['nama'] ?>
								</td>
								<td class="text-right">
									<?= nominal2($cl['saldo_akhir']) ?>
									<?php $saldo_akhir = $saldo_akhir + $cl['saldo_akhir'] ?>
								</td>
								<td></td>
								<td></td>
							</tr>
						<?php endforeach ?>

						<tr class="table-active">
							<td><b>SALDO AKHIR</b></td>
							<td></td>
							<td></td>
							<td class="text-right">
								<b>
									(<?= nominal2($saldo_akhir) ?>)
								</b>
							</td>
						</tr>
						<!-- /.saldo_akhir -->
						<tr style="background-color: #ccff33;">
							<td class="text-left" colspan="3"><b><?= Romawi(6) . '. SELISIH' ?></b></td>
							<td class="text-right">
								<b><?= nominal2($try_surflus - $saldo_akhir) ?></b>
							</td>
						</tr>
						<!-- /.selisih -->
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
