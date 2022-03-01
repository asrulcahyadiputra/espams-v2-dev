<?php $this->load->view('_partials/head'); ?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
	<div class="content">
		<!-- Start Content-->
		<div class="container-fluid">
			<div class="row mb-3 mt-3">
				<div class="col-12">
					<a href="<?= site_url('master/aset') ?>" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i> Kembali</a>
				</div>
			</div>
			<div class="row">
				<div class="col-8">
					<div class="card-box">
						<form action="<?= site_url('master/aset/store') ?>" method="POST" class="needs-validation" novalidate>
							<div class="form-group">
								<label for="aset_code">Kode Aset</label>
								<input type="text" name="aset_code" value="AUTO" class="form-control" readonly>
							</div>
							<div class="form-group">
								<label for="aset_name">Nama Aset</label>
								<input type="text" name="aset_name" value="" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="aset_unit">Satuan Aset</label>
								<input type="text" name="aset_unit" value="" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="id_ref">Kategori Aset</label>
								<select class="form-control select2" name="subhead_code" required>
									<option value="">Pilih/cari...</option>
									<?php foreach ($head as $r1) : ?>
										<optgroup label="<?= $r1['head_code'] . ' ' . $r1['head_name'] ?>">
											<?php foreach ($sub as $r2) : ?>
												<?php if ($r2['head_code'] == $r1['head_code']) : ?>
													<option value="<?= $r2['subhead_code'] ?>"><?= $r2['subhead_code'] . ' ' . $r2['subhead_name'] ?></option>
												<?php endif ?>
											<?php endforeach ?>
										</optgroup>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="id_ref">Rekening Aset</label>
								<select class="form-control select2" name="account_no" required>
									<option value="">Pilih/cari...</option>

									<optgroup label="Aktiva Tetap">
										<?php foreach ($coa as $c) : ?>
											<option value="<?= $c['account_no'] ?>"><?= $c['account_no'] . ' ' . $c['account_name'] ?></option>
										<?php endforeach ?>
									</optgroup>

								</select>
							</div>
							<div class="form-group text-right">
								<a href="<?= site_url('master/aset') ?>" class=" btn btn-secondary">Batal</a>
								<button type="submit" class="btn btn-success">Tambahkan</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-4">
					<div class="card-box">
						<h4 class="text-warning"><i class="mdi mdi-information"></i> Informasi</h4>
						<ul>
							<li>Master Aset akan digunakan sebagai referensi pada peroleahan aset di Manajamen Aset dan Buku Inventaris.</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- container-fluid -->
	</div>
	<!-- content -->
	<?php $this->load->view('_partials/footer'); ?>
