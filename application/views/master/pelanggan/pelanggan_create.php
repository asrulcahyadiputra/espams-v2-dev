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
					<a href="<?= site_url('master/pelanggan') ?>" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i> Kembali</a>
				</div>
			</div>
			<div class="row">
				<div class="col-8">
					<div class="card-box">
						<form method="POST" action="<?= site_url('master/pelanggan/store') ?>" class="needs-validation" novalidate>
							<div class="form-group row">
								<label for="id_golongan" class="col-sm-2 col-form-label">ID Pelanggan</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="id_pelanggan" value="AUTO" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label for="nama_pelanggan" class="col-sm-2 col-form-label">Nama Pelanggan</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="no_telp" class="col-sm-2 col-form-label">No Hp</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="no_telp" id="no_telp" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="biaya_beban" class="col-sm-2 col-form-label">Golongan</label>
								<div class="col-sm-10">
									<select name="id_golongan" id="id_golongan" class="form-control select2" required>
										<option value="">Pilih..</option>
										<?php foreach ($golongan as $g) : ?>
											<option value="<?= $g['id_golongan'] ?>"><?= $g['nama_golongan'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="meteran_awal" class="col-sm-2 col-form-label">Meteran Awal (M<sup>3</sup>)</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" name="meteran_awal" id="meteran_awal" min="0">
								</div>
							</div>
							<div class="form-group row">
								<label for="biaya_sr" class="col-sm-2 col-form-label">Biaya Pemasangan Baru </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="biaya_sr" id="biaya_sr" data-type="currency">
								</div>
							</div>
							<div class="form-group row">
								<label for="tunggakan" class="col-sm-2 col-form-label">Tunggakan </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="tunggakan" id="tunggakan" data-type="currency" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="denda" class="col-sm-2 col-form-label">Denda </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="denda" id="denda" data-type="currency" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="biaya_beban" class="col-sm-2 col-form-label">Alamat</label>
								<div class="col-sm-10">
									<textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" required></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="biaya_beban" class="col-sm-2 col-form-label">Wilayah</label>
								<div class="col-sm-10">
									<select name="id_wilayah" id="id_wilayah" class="form-control select2" required>
										<option value="">Pilih..</option>
										<?php foreach ($wilayah as $w) : ?>
											<option value="<?= $w['id_wilayah'] ?>"><?= $w['id_wilayah'] . ' ' . $w['nama_wilayah'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12 text-right">
									<a href="<?= site_url('master/pelanggan') ?>" class="btn btn-danger" onclick="return confirm('Data tidak akan tersimpan, apakah anda yakin ?')">Batal</a>
									<button type="submit" class="btn btn-primary">Simpan</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-4">
					<div class="card-box">
						<h4 class="text-warning"><i class="mdi mdi-information"></i> Informasi</h4>
						<ul>
							<li>Id Pelanggan akan secara otomatis dibuat oleh sistem.</li>
							<li>Golongan merupapakn golongan tarif yang akan dibebankan kepada pelanggan.</li>
							<li>Meteran awal pelanggan merupakan penunjukan akhir meteran jika pelanggan yang anda masukkan sudah ada sebelum anda menggunakan E-SPAMS. Jika pelanggan yang anda masukkan adalah pelanggan baru, anda dapat mengisi 0 atau mengosongkan kolom isian.</li>
							<li>Biaya pemasangan baru merupakan biaya yang dibebankan kepada pelanggan dan akan diakui sebagai <b>Pendapatan atas Pembayaran Pemsangan SR</b>, dan ini hanya berlaku untuk pelanggan baru. Jika pelanggan merupakan pelanggan lama, anda dapat mengosongkan kolom isian atau mengisi dengan 0.</li>
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
