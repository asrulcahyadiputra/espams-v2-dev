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
						<form method="GET" action="<?= site_url('akuntansi/arus_kas') ?>" class="form-inline">
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
						<a href="<?= site_url('akuntansi/arus_kas/export_excel/' . $year . '/' . $month) ?>" class="btn btn-lighten-success  btn-sm mb-2"><i class="mdi mdi-microsoft-excel"></i> Export Excel</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card-box">
							<div class="row">
								<div class="col-12 text-right">
									<h4>AKUNTANSI -5</h4>
								</div>
								<div class="col-12 text-center">
									<h2>LAPORAN ARUS KAS</h2>
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
