<?php $this->load->view('_partials/head'); ?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">
			<div class="container">
				<div class="row mb-3 mt-3  d-print-none">
					<div class="col-6">
						<a href="<?= site_url('transaksi/pencatatan_tagihan') ?>" class="btn btn-secondary btn-sm waves-effect " data-overlayColor="#36404a"> <i class="mdi mdi-arrow-left-bold"></i> Kembali</a>
					</div>
					<div class="col-6 text-right">

						<button href="#add-modal" class="btn btn-primary btn-sm waves-effect" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#36404a" <?= $ref['tagihan']['status']  > 0  ? 'disabled' : '' ?>> <i class="mdi mdi-border-color"></i> Catat Meteran</button>

						<button href="#koreksi-modal" class="btn btn-warning btn-sm waves-effect" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#36404a" <?= $ref['tagihan']['status']  == 0 || $ref['tagihan']['status']  == 2 || $ref['tagihan']['status']  == 3 ? 'disabled' : '' ?>> <i class="mdi mdi-alert-rhombus-outline"></i> Koreksi Meteran</button>

						<button href="#pembayaran-modal" <?= $ref['tagihan']['status']  == 0 || $ref['tagihan']['status']  == 3 ? 'disabled' : '' ?> class="btn btn-purple btn-sm waves-effect" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#36404a"> <i class="mdi mdi-account-cash"></i> Bayar Sekarang</button>
					</div>

				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ($this->session->flashdata()) : ?>
							<?php if ($this->session->flashdata('success')) : ?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<strong>Berhasil!</strong> <?= $this->session->flashdata('success') ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php endif ?>
							<?php if ($this->session->flashdata('warning')) : ?>
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<strong>Peringatan!</strong> <?= $this->session->flashdata('warning') ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php endif ?>
							<?php if ($this->session->flashdata('error')) : ?>
								<div class="alert alert-error alert-dismissible fade show" role="alert">
									<strong>Gagal!</strong> <?= $this->session->flashdata('error') ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php endif ?>
						<?php endif ?>

						<div class="card-box">
							<div class="panel-body">
								<div class="clearfix">
									<div class="float-left">
										<h3>Tagihan Rekening Pelanggan</h3>
										<h4>#<?= $ref['tagihan']['kode_tagihan'] . '' . Romawi($ref['tagihan']['bulan']) . '/' . $ref['tagihan']['tahun'] ?></h4>
									</div>
									<div class="float-right">
										<?php if ($ref['tagihan']['status'] == 0) : ?>
											<h2 class="text-danger">Belum Dicatat</h2>
										<?php endif ?>
										<?php if ($ref['tagihan']['status'] == 1) : ?>
											<h2 class="text-pink">Tagihan Belum Final</h2>
										<?php endif ?>
										<?php if ($ref['tagihan']['status'] == 2) : ?>
											<h2 class="text-warning">Belum Lunas</h2>
										<?php endif ?>
										<?php if ($ref['tagihan']['status'] == 3) : ?>
											<?php if ($ref['tagihan']['total'] > $ref['tagihan']['bayar']) : ?>
												<h2 class="text-purple">Menunggak</h2>
											<?php endif ?>
											<?php if ($ref['tagihan']['total'] == $ref['tagihan']['bayar']) : ?>
												<h2 class="text-success">Lunas</h2>
											<?php endif ?>
										<?php endif ?>
									</div>

								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-borderless">
											<tr>
												<td style="width: 15%;">Tagihan Bulan</td>
												<td style="width: 1%;">:</td>
												<td><?= format_bulan($ref['tagihan']['bulan']) . ' ' . $ref['tagihan']['tahun'] ?></td>

												<td style="width: 15%;">Kategori Pelanggan</td>
												<td style="width: 1%;">:</td>
												<td><?= $ref['tagihan']['id_golongan'] . ' - ' . $ref['pelanggan']['nama_golongan'] ?></td>
											</tr>
											<tr>
												<td style="width: 15%;">ID Pelanggan</td>
												<td style="width: 1%;">:</td>
												<td><?= $ref['pelanggan']['id_pelanggan'] ?></td>

												<td style="width: 15%;">Meter Awal</td>
												<td style="width: 1%;">:</td>
												<td><?= nominal1($ref['tagihan']['meteran_awal']) ?> M<sup>3</sup></td>
											</tr>
											<tr>
												<td style="width: 15%;">Nama Pelanggan</td>
												<td style="width: 1%;">:</td>
												<td><?= $ref['pelanggan']['nama_pelanggan'] ?></td>

												<td style="width: 15%;">Meter Akhir</td>
												<td style="width: 1%;">:</td>
												<td><?= nominal1($ref['tagihan']['meteran_akhir']) ?> M<sup>3</sup></td>
											</tr>
											<tr>
												<td style="width: 15%;">Nama Pelanggan</td>
												<td style="width: 1%;">:</td>
												<td><?= $ref['pelanggan']['alamat'] ?></td>

												<td style="width: 15%;">Jumlah Pemakaian</td>
												<td style="width: 1%;">:</td>
												<td><?= nominal1($ref['tagihan']['meteran_akhir'] - $ref['tagihan']['meteran_awal']) ?> M<sup>3</sup></td>
											</tr>

										</table>
									</div>

								</div>
								<!-- end row -->

								<div class="row">
									<div class="col-md-12">
										<h5>Rincian Tagihan Rekening</h5>
										<div class="table-responsive">

											<table class="table">
												<thead>
													<tr>
														<th class="text-center">Kelompok Pemakaian</th>
														<th class="text-center">Volume (M<sup>3</sup>)</th>
														<th>Tarif (/M<sup>3</sup>)</th>
														<th>Total Tarif</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$pemakaian = $ref['tagihan']['meteran_akhir'] - $ref['tagihan']['meteran_awal'];
													$sisa	 = 0;
													$t_sisa	 = 0;
													$t_level	 = 0;
													$t_tarif	 = 0;
													foreach ($ref['detail_golongan'] as $row) : ?>
														<tr>

															<td class="text-center"><?= $row['min_pemakaian'] . '-' . $row['max_pemakaian'] ?>M<sup>3</sup></td>
															<td class="text-center">
																<?php
																if ($pemakaian > $row['max_pemakaian']) {
																	$level = ($row['max_pemakaian'] - $row['min_pemakaian']) + 1;
																	$t_level = $t_level + $level;
																	$sisa = $level;
																} elseif ($pemakaian >= $row['min_pemakaian'] && $pemakaian <= $row['max_pemakaian']) {

																	$sisa = $pemakaian - $t_level;
																} else {
																	$sisa = 0;
																}
																$t_sisa = $t_sisa + $sisa;
																?>
																<?= nominal1($sisa) ?>
															</td>
															<td>
																<span class="text-left">Rp</span>
																<span style="float:right;">
																	<?= nominal1($row['tarif']) ?>
																</span>

															</td>
															<td>
																<?php
																$tarif = $sisa * $row['tarif'];
																$t_tarif = $t_tarif + ($sisa * $row['tarif']);
																?>
																<span class="text-left">Rp</span>
																<span style="float:right;">
																	<?= nominal1($tarif) ?>

																</span>
															</td>
														</tr>
													<?php endforeach ?>
													<tr>
														<td class="text-center"><?= '>' . $ref['golongan']['interval_atas'] ?>M<sup>3</sup></td>
														<td class="text-center">
															<?php
															if ($pemakaian > $ref['golongan']['interval_atas']) {

																$max_sisa = $pemakaian - $t_level;
															} else {
																$max_sisa = 0;
															}

															?>
															<?= nominal1($max_sisa) ?>
														</td>
														<td>
															<span class="text-left">Rp</span>
															<span style="float:right;">
																<?= nominal1($ref['golongan']['max_tarif']) ?>

															</span>

														</td>
														<td>
															<?php $t_max = $ref['golongan']['max_tarif'] * $max_sisa;  ?>
															<span class="text-left">Rp</span>
															<span style="float:right;">
																<?= nominal1($t_max) ?>
															</span>

														</td>
													</tr>
													<tr>
														<td colspan="3" class="text-left"><b>Jumlah Biaya Pemakaian Air</b></td>
														<td>
															<b>
																<span class="text-left">Rp</span>
																<span style="float:right;">
																	<?php $biaya_pemakaian = $t_tarif + $t_max; ?>
																	<?= nominal1($biaya_pemakaian) ?>

																</span>
															</b>
														</td>
													</tr>
													<tr>
														<td colspan="3" class="text-left"><b>Biaya Iuran Wajib</b></td>
														<td>
															<b>
																<span class="text-left">Rp</span>
																<span style="float:right;">
																	<?= nominal1($ref['tagihan']['biaya_beban']) ?>
																</span>
															</b>
														</td>
													</tr>
													<tr>
														<td colspan="3" class="text-left"><b>Biaya Admin</b></td>
														<td>
															<b>
																<span class="text-left">Rp</span>
																<span style="float:right;">
																	<?= nominal1($ref['tagihan']['biaya_admin']) ?>

																</span>
															</b>
														</td>
													</tr>
													<tr>
														<td colspan="3" class="text-left"><b>Biaya Denda</b></td>
														<td>
															<b>
																<?php
																$batas_pembayaran = $ref['tagihan']['batas_pembayaran'];
																if ($ref['tagihan']['status_denda'] == 1 && $ref['tagihan']['status'] < 3) {
																	if (date('Y-m-d') > $batas_pembayaran) {
																		$generate_denda = $ref['tagihan']['denda'] + $ref['tagihan']['denda_flat'];
																	} else {
																		$generate_denda = $ref['tagihan']['denda'];
																	}
																} else {
																	$generate_denda = $ref['tagihan']['denda'];
																}
																?>
																<span class="text-left">Rp</span>
																<span style="float:right;">
																	<?= nominal1($generate_denda) ?>

																</span>
															</b>
														</td>
													</tr>
													<tr>
														<td colspan="3" class="text-left"><b>Tunggakan Bulan Lalu</b></td>
														<td>
															<b>
																<span class="text-left">Rp</span>
																<span style="float:right;">
																	<?= nominal1($ref['tagihan']['tunggakan']) ?>
																</span>
															</b>
														</td>
													</tr>
													<tr>
														<td colspan="3" class="text-left"><b>Total Tagihan</b></td>
														<td>
															<b>
																<span class="text-left">Rp</span>
																<span style="float:right;">
																	<?php $total_tagihan = $t_tarif + $t_max + $ref['tagihan']['biaya_beban'] + $ref['tagihan']['biaya_admin'] + $generate_denda + $ref['tagihan']['tunggakan']   ?>
																	<?= nominal1($total_tagihan) ?>
																</span>
															</b>
														</td>
													</tr>
													<tr>
														<td colspan="4" class="text-center">
															<b>Terbilang:</b>
															<p>
																<?= terbilang($total_tagihan, 3) ?>
															</p>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-6 col-6">
										<div class="clearfix mt-4">
											<h5 class="small text-dark">Catatan:</h5>
											<strong>Bayar Sebelum <?= $ref['tagihan']['batas_pembayaran'] ?></strong><br>
											<small>
												<?= $ref['tagihan']['inv_note'] ?>
											</small>
										</div>
									</div>

								</div>
								<div class="row mt-2">
									<div class="col-12">
										<small class="text-muted"><i>Powered By E-SPAMS V.2.0</i></small>
									</div>
								</div>
								<hr>
								<div class="d-print-none">
									<div class="float-left">
										<a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>
									</div>
									<div class="float-right">

										<form action="<?= site_url('transaksi/pencatatan_tagihan/final') ?>" method="POST">

											<input type="hidden" name="id_tagihan" value="<?= $id_tagihan ?>">
											<input type="hidden" name="id_pelanggan" value="<?= $ref['pelanggan']['id_pelanggan'] ?>">
											<input type="hidden" name="pemakaian" value="<?= $biaya_pemakaian ?>">
											<input type="hidden" name="denda" value="<?= $generate_denda ?>">
											<input type="hidden" name="tunggakan" value="<?= $ref['tagihan']['tunggakan'] ?>">
											<input type="hidden" name="total" value="<?= $total_tagihan ?>">


											<button <?= $ref['tagihan']['status']  == 0 || $ref['tagihan']['status']  == 2 || $ref['tagihan']['status']  == 3 ? 'disabled' : '' ?> class="btn btn-success">Buat Tagihan Final</button>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>

						</div>

					</div>

				</div>
				<!-- end row -->
			</div>
			<!-- /.container -->

		</div> <!-- container-fluid -->

	</div> <!-- content -->


	<!-- Modal pencatatan meteran -->
	<div id="add-modal" class="modal-demo">
		<button type="button" class="close" onclick="Custombox.modal.close();">
			<span>&times;</span><span class="sr-only">Close</span>
		</button>
		<h4 class="custom-modal-title">Catat Meteran Akhir</h4>
		<div class="custom-modal-text">
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Setelah pembayaran dilakukan, meteran akhir (Penunjukan meteran) <strong>Tidak dapat dikoreksi !</strong>
			</div>
			<form action="<?= site_url('transaksi/Pencatatan_meteran/store') ?>" method="POST" class="needs-validation" novalidate>
				<input type="hidden" name="id_tagihan" value="<?= $id_tagihan ?>">
				<input type="hidden" name="id_pelanggan" value="<?= $ref['pelanggan']['id_pelanggan'] ?>">
				<div class="form-group">
					<label for="meteran_akhir">Meteran Awal (M<sup>3</sup>)</label>
					<input type="number" value="<?= $ref['tagihan']['meteran_awal'] ?>" name="meteran_akhir" class="form-control" readonly required>
				</div>
				<div class="form-group">
					<label for="meteran_akhir">Meteran Akhir (M<sup>3</sup>)</label>
					<input type="number" min="<?= $ref['tagihan']['meteran_awal'] ?>" name="meteran_akhir" class="form-control" required>
				</div>
				<div class="form-group text-right">
					<button type="button" class=" btn btn-secondary" onclick="Custombox.modal.close();">Batal</button>
					<button type="submit" class="btn btn-success">Catat</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /.modal pencatatan meteran -->

	<!-- Modal koreksi pencatatan meteran -->
	<div id="koreksi-modal" class="modal-demo">
		<button type="button" class="close" onclick="Custombox.modal.close();">
			<span>&times;</span><span class="sr-only">Close</span>
		</button>
		<h4 class="custom-modal-title">Koreksi Meteran Akhir</h4>
		<div class="custom-modal-text">
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Setelah pembayaran dilakukan, meteran akhir (Penunjukan meteran) <strong>Tidak dapat dikoreksi !</strong>
			</div>
			<form action="<?= site_url('transaksi/Pencatatan_meteran/update') ?>" method="POST" class="needs-validation" novalidate>
				<input type="hidden" name="id_tagihan" value="<?= $id_tagihan ?>">
				<input type="hidden" name="id_pelanggan" value="<?= $ref['pelanggan']['id_pelanggan'] ?>">
				<div class="form-group">
					<label for="meteran_akhir">Meteran Awal (M<sup>3</sup>)</label>
					<input type="number" value="<?= $ref['tagihan']['meteran_awal'] ?>" name="meteran_akhir" class="form-control" readonly required>
				</div>
				<div class="form-group">
					<label for="meteran_akhir">Meteran Akhir (M<sup>3</sup>)</label>
					<input type="number" min="<?= $ref['tagihan']['meteran_awal'] ?>" name="meteran_akhir" class="form-control" value="<?= $ref['tagihan']['meteran_akhir'] ?>" required>
				</div>
				<div class="form-group text-right">
					<button type="button" class=" btn btn-secondary" onclick="Custombox.modal.close();">Batal</button>
					<button type="submit" class="btn btn-success">Catat</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /.modal koreksi pencatatan meteran -->


	<!-- Modal pembayaram tagihan -->
	<div id="pembayaran-modal" class="modal-demo">
		<button type="button" class="close" onclick="Custombox.modal.close();">
			<span>&times;</span><span class="sr-only">Close</span>
		</button>
		<h4 class="custom-modal-title">Pembayaran Tagihan</h4>
		<div class="custom-modal-text">
			<form action="<?= site_url('transaksi/Pencatatan_meteran/bayar') ?>" method="POST" class="needs-validation" novalidate>
				<input type="hidden" name="id_transaksi" value="<?= $ref['tagihan']['id_transaksi'] ?>">
				<input type="hidden" name="id_tagihan" value="<?= $id_tagihan ?>">
				<input type="hidden" name="id_pelanggan" value="<?= $ref['pelanggan']['id_pelanggan'] ?>">
				<input type="hidden" name="denda" value="<?= $generate_denda ?>">
				<div class="form-group">
					<label for="total">Total Tagihan</label>
					<input type="text" value="<?= nominal($total_tagihan) ?>" name="total" class="form-control" readonly required>
				</div>
				<div class="form-group">
					<label for="bayar">Jumlah Pembayaran</label>
					<input type="text" name="bayar" class="form-control" data-type="currency" required>
				</div>
				<div class="form-group text-right">
					<button type="button" class=" btn btn-secondary" onclick="Custombox.modal.close();">Batal</button>
					<button type="submit" class="btn btn-success">Bayar Sekarang</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /.modal pembayaran pencatatan meteran -->
	<?php $this->load->view('_partials/footer'); ?>
