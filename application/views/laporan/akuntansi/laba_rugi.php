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
						<form method="GET" action="<?= site_url('akuntansi/laba_rugi') ?>" class="form-inline">
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
						<a href="<?= site_url('akuntansi/laba_rugi/export_excel/' . $year . '/' . $month) ?>" class="btn btn-lighten-success  btn-sm mb-2"><i class="mdi mdi-microsoft-excel"></i> Export Excel</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<div class="row">
								<div class="col-12 text-right">
									<h4>AKUNTANSI -4</h4>
								</div>
								<div class="col-12 text-center">
									<h2>LAPORAN LABA/RUGI</h2>
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
