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
								<a href="<?=site_url('master/golongan')?>" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i> Kembali</a>
							</div>
						</div>
						<div class="row">
							<div class="col-8">
								<div class="card-box">
									<form method="POST" action="<?=site_url('master/golongan/store')?>" class="needs-validation" novalidate >
										<div class="form-group row">
											<label for="id_golongan" class="col-sm-2 col-form-label">ID Golongan</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="id_golongan" value="AUTO" disabled>
											</div>
										</div>
										<div class="form-group row">
											<label for="nama_golongan" class="col-sm-2 col-form-label">Nama Golongan</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama_golongan" id="nama_golongan" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="biaya_admin" class="col-sm-2 col-form-label">Biaya Admin</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="biaya_admin" id="biaya_admin" data-type="currency" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="biaya_beban" class="col-sm-2 col-form-label">Beban</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="biaya_beban" id="biaya_beban" data-type="currency" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="biaya_beban" class="col-sm-2 col-form-label">Maksimal Pemakaian (M<sup>3</sup>)</label>
											<div class="col-sm-10">
												<input type="number" class="form-control" name="interval_atas" min="1" id="interval_atas"  required>
											</div>
										</div>
										<div class="form-group row">
											<label for="biaya_beban" class="col-sm-2 col-form-label">Tarif Maksimal</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="max_tarif" id="max_tarif" data-type="currency" required>
											</div>
										</div>
										<div class="table-responsive">
											<table class="table table-striped" id="tbl_posts">
												<thead>
												<tr>
													<th class="text-center">#</th>
													<th>Batas Bawah (M<sup>3</sup>)</th>
													<th>Batas Atas (M<sup>3</sup>)</th>
													<th>Tarif Dasar /(M<sup>3</sup>)</th>
													<th class="no-content"></th>
												</tr>
												</thead>
												<tbody id="tbl_posts_body" class="contents">
													<tr>
														<td class="text-center">
															<span class="sn">1</span>
														</td>
														<td>
															<input type="number" name="min_pemakaian[]" min="1"  class="form-control" required >
														</td>
														<td>
															<input type="number" name="max_pemakaian[]" min="1"  class="form-control" required>
														</td>
														<td>
															<input type="text" name="tarif[]"  class="form-control" data-type="currency" required>
														</td>
														<td></td>
													</tr>
												</tbody>
											</table>
											<a href="#" class="add-record" data-added="0"><u>+Tambah Baris</u></a>
										</div>
										
										<div class="form-group row">
											<div class="col-sm-12 text-right">
												<a href="<?=site_url('master/golongan')?>" class="btn btn-danger" onclick="return confirm('Data tidak akan tersimpan, apakah anda yakin ?')" >Batal</a>
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
										<li>Contoh maksimal pemakaian adalah 50 dan tarif maksimal adalah Rp 6.000, maka tagihan dengan pemakaian >50 selanjutnya akan dikenakan tarif Rp 6000 /M<sup>3</sup>.</li>
										<li>Contoh batas bawah adalah 1 M<sup>3</sup>, batas atas 10 M<sup>3</sup>, dan tarif dasar Rp 3.000. Maka tagihan dengan pemakaian antara 1-10 M<sup>3</sup> akan dikenakan tarif Rp 3.000 /M<sup>3</sup>. </li>
										<li>Beban adalah iuran wajib (Abunemen) yang wajib dibayarkan setiap bulan.</li>
										<li>Biaya Denda atas tunggakan pembayaran, dapat anda atur pada menu <b>Pengaturan App/Tagihan/Denda.</b></li>
									</ul>
								</div>
							</div>
						</div> 
						<!-- end row -->
				</div> 
				<!-- container-fluid -->
			 </div> 
			 <!-- content -->

			   <!-- invisible tag -->
			   	<div class="invisible">
					<table id="sample_table">
						<tr>
							<td class="text-center">
								<span class="sn">1</span>
							</td>
							<td>
								<input type="number" name="min_pemakaian[]" min="1"  class="form-control" required >
							</td>
							<td>
								<input type="number" name="max_pemakaian[]" min="1"  class="form-control" required>
							</td>
							<td>
								<input type="text" name="tarif[]"  class="form-control" data-type="currency" required>
							</td>
							<td class="text-center">
								<a href="#" class="btn btn-outline-warning  btn-icon delete-record btn-sm" data-id="0"><i
									class="mdi mdi-minus-circle-outline"></i></a>
							</td>
						</tr>
					</table>
    				</div>
			 <?php $this->load->view('_partials/footer'); ?>
               