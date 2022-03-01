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
								<a href="<?=site_url('master/coa')?>" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i> Kembali</a>
							</div>
						</div>
						<div class="row">
							<div class="col-8">
								<div class="card-box">
									<form method="POST" action="<?=site_url('master/coa/update')?>" class="needs-validation" novalidate >
										<div class="form-group row">
											<label for="id_golongan" class="col-sm-2 col-form-label">Kode CoA</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="account_no" name="account_no" value="<?=$coa['account_no']?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="account_name" class="col-sm-2 col-form-label">Nama CoA</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="account_name" id="account_name" value="<?=$coa['account_name']?>" required>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Post CoA</label>
											<div class="col-sm-10">
												<div class="form-check">
													<input class="form-check-input" type="radio" name="post" id="bank" value="bank" <?=$coa['post'] == 'bank' ? 'checked' : ''?>  required>
													<label class="form-check-label" for="bank">
														Bank
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="post" id="kas" value="kas" <?=$coa['post'] == 'kas' ? 'checked' : ''?> required>
													<label class="form-check-label" for="kas">
														Kas
													</label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Saldo Normal CoA</label>
											<div class="col-sm-10">
												<div class="form-check">
													<input class="form-check-input" type="radio" name="normal_balance" id="d" value="d" <?=$coa['normal_balance'] == 'd' ? 'checked' : ''?> required> 
													<label class="form-check-label" for="d">
														Debet
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="normal_balance" id="k" value="k" <?=$coa['normal_balance'] == 'k' ? 'checked' : ''?> required>
													<label class="form-check-label" for="k">
														Kredit
													</label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12 text-right">
												<a href="<?=site_url('master/coa')?>" class="btn btn-danger" onclick="return confirm('Data tidak akan tersimpan, apakah anda yakin ?')" >Batal</a>
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
										<li>Post CoA menetukan laporan atas transaksi akan di tempatkan di Buku kas atas Buku Bank.</li>
										<li>Saldo normal atau saldo normal akun adalah suatu ketetapan yang pasti dalam ilmu akuntansi terkait dengan posisi dari akun atau rekening yang menjadi prinsip pembukuan berpasangan. </li>
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
               