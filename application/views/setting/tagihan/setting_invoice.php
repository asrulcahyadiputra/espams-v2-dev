<?php $this->load->view('_partials/head'); ?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
	<div class="content">

		<!-- Start Content-->
		<div class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
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
							<h4 class="header-title mt-0 mb-3">Pengaturan Tagihan</h4>
							<div class="alert alert-info alert-dismissible fade show" role="alert">
								<strong>Info</strong> Perubahan pengaturan tagihan tidak akan mempengarahui tagihan pada periode sebelumnya, Perubahan pengaturan akan mempengaruhi tagihan periode berikutnya.

							</div>
							<form method="POST" action="<?= site_url('setting/tagihan/update') ?>" class="needs-validation" novalidate>
								<div class="form-group row">
									<label for="denda_flat" class="col-sm-2 col-form-label">Denda Flat</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="denda_flat" id="denda_flat" value="<?= nominal($tagihan['denda_flat']) ?>" data-type="currency" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="status_denda_flat" class="col-sm-2 col-form-label">Status Denda Flat</label>
									<div class="col-sm-10">
										<div class="form-check">
											<input class="form-check-input" type="radio" value="1" name="status_denda_flat" id="aktif" <?= $tagihan['status_denda_flat'] == '1' ? 'checked' : '' ?> required>
											<label class="form-check-label" for="aktif">
												Aktif
											</label>

										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" value="0" name="status_denda_flat" id="inaktif" <?= $tagihan['status_denda_flat'] == '0' ? 'checked' : '' ?> required>
											<label class="form-check-label" for="inaktif">
												Tidak Aktif
											</label>

										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="tarif_tunggal" class="col-sm-2 col-form-label">Tarif Tunggal (Rp/M<sup>3</sup>)</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="tarif_tunggal" id="tarif_tunggal" value="<?= nominal($tagihan['tarif_tunggal']) ?>" data-type="currency" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="jenis_tarif" class="col-sm-2 col-form-label">Jenis Tarif</label>
									<div class="col-sm-10">
										<div class="form-check">
											<input class="form-check-input" type="radio" value="1" name="jenis_tarif" id="jenis_tarif1" <?= $tagihan['jenis_tarif'] == '1' ? 'checked' : '' ?> required>
											<label class="form-check-label" for="jenis_tarif1">
												Progresif
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" value="2" name="jenis_tarif" id="jenis_tarif2" <?= $tagihan['jenis_tarif'] == '2' ? 'checked' : '' ?> required>
											<label class="form-check-label" for="jenis_tarif2">
												Tunggal
											</label>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="batas_pembayaran" class="col-sm-2 col-form-label">Batas Pembayaran (Ex.20)</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" name="batas_pembayaran" id="batas_pembayaran" value="<?= $tagihan['batas_pembayaran'] ?>" min="1" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="catatan" class="col-sm-2 col-form-label">Catatan</label>
									<div class="col-sm-10">
										<textarea name="catatan" id="catatan" cols="30" rows="5" class="form-control"><?= $tagihan['catatan'] ?></textarea>
										<small><i>*Catatan akan ditampilkan pada rekening tegihan</i></small>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12 text-right">
										<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
									</div>
								</div>
							</form>


						</div>
					</div>
					<!-- end col -->

				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</div>
	</div>
</div>
<!-- container-fluid -->

</div>
<!-- /.content -->
<?php $this->load->view('_partials/footer'); ?>
