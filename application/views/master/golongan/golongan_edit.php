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
									<?php if($this->session->flashdata()): ?>
										<?php if($this->session->flashdata('success')): ?>
											<div class="alert alert-success alert-dismissible fade show" role="alert">
												<strong>Berhasil!</strong> <?=$this->session->flashdata('success')?>
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										<?php endif ?>
										<?php if($this->session->flashdata('warning')): ?>
											<div class="alert alert-warning alert-dismissible fade show" role="alert">
												<strong>Peringatan!</strong> <?=$this->session->flashdata('warning')?>
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										<?php endif ?>
										<?php if($this->session->flashdata('error')): ?>
											<div class="alert alert-error alert-dismissible fade show" role="alert">
												<strong>Gagal!</strong> <?=$this->session->flashdata('error')?>
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										<?php endif ?>
									<?php endif ?>
									<form method="POST" action="<?=site_url('master/golongan/update')?>" class="needs-validation" novalidate >
										<div class="form-group row">
											<label for="id_golongan" class="col-sm-2 col-form-label">ID Golongan</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="id_golongan" id="id_golongan" value="<?=$id_golongan?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="nama_golongan" class="col-sm-2 col-form-label">Nama Golongan</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama_golongan" id="nama_golongan" value="<?=$golongan['nama_golongan']?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="biaya_admin" class="col-sm-2 col-form-label">Biaya Admin</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="biaya_admin" id="biaya_admin" value="<?=nominal($golongan['biaya_admin'])?>" data-type="currency" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="biaya_beban" class="col-sm-2 col-form-label">Beban</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="biaya_beban" id="biaya_beban" value="<?=nominal($golongan['biaya_beban'])?>" data-type="currency" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="biaya_beban" class="col-sm-2 col-form-label">Maksimal Pemakaian (M<sup>3</sup>)</label>
											<div class="col-sm-10">
												<input type="number" class="form-control" name="interval_atas" min="1" id="interval_atas" value="<?=$golongan['interval_atas']?>"  required>
											</div>
										</div>
										<div class="form-group row">
											<label for="biaya_beban" class="col-sm-2 col-form-label">Tarif Maksimal</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="max_tarif" id="max_tarif" value="<?=nominal($golongan['max_tarif'])?>" data-type="currency" required>
											</div>
										</div>
										<div class="table-responsive">
											<div class="text-right">
												<a href="#custom-modal" class="btn btn-outline-primary btn-sm waves-effect mb-2" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#36404a"><i class="mdi mdi-plus"></i>Tambah Fluktuasi Tarif</a>
											</div>
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
													<?php $no=1; foreach($detail as $d): ?>
													<tr>
														<td class="text-center">
															<span class="sn"><?=$no++?></span>
														</td>
														<td>
															<input type="hidden" name="id_golongan_detail[]" value="<?=$d['id_golongan_detail']?>" readonly>
															<input type="number" name="min_pemakaian[]" min="1"  class="form-control" value="<?=$d['min_pemakaian']?>" required >
														</td>
														<td>
															<input type="number" name="max_pemakaian[]" min="1"  class="form-control" value="<?=$d['max_pemakaian']?>" required>
														</td>
														<td>
															<input type="text" name="tarif[]"  class="form-control" data-type="currency" value="<?=nominal($d['tarif'])?>" required>
														</td>
														<td class="text-center">
															<a href="<?=site_url('master/golongan/delete_item/'.$d['id_golongan'].'/'.$d['id_golongan_detail'])?>" class="btn btn-outline-warning  btn-icon  btn-sm" onclick="return confirm('Data tidak dapat dikembalikan, apakah anda yakin ?')" ><i class="mdi mdi-minus-circle-outline"></i></a>
														</td>
													</tr>
													<?php endforeach ?>
												</tbody>
											</table>
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
			 
			 <!-- modal -->
			 <div id="custom-modal" class="modal-demo">
                    <button type="button" class="close" onclick="Custombox.modal.close();">
                        <span>&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="custom-modal-title">Tambah Fluktuasi Tarif</h4>
                    <div class="custom-modal-text">
				   <form action="<?=site_url('master/golongan/add_item')?>" method="POST" class="needs-validation" novalidate>
					   <div class="form-group">
						   <label for="id_golongan">ID Golongan</label>
						   <input type="text" class="form-control" name="id_golongan" id="id_golongan" value="<?=$id_golongan?>" readonly>
					   </div>
					   <div class="form-group">
						   <label for="min_pemakaian">Batas Bawah (M<sup>3</sup> )</label>
						   <input type="number" name="min_pemakaian" min="1"  class="form-control" id="min_pemakaian" required >
					   </div>
					   <div class="form-group">
						   <label for="max_pemakaian">Batas Atas (M<sup>3</sup> )</label>
						   <input type="number" name="max_pemakaian" min="1"  class="form-control" id="max_pemakaian" required>
					   </div>
					   <div class="form-gruop">
						   <label for="tarif">Tarif</label>
						   <input type="text" name="tarif"  class="form-control" data-type="currency" id="tarif" required>
					   </div>
					   <div class="form-group text-right mt-4">
						   <button type="button" class="btn btn-lighten-secondary" onclick="Custombox.modal.close();">Batal</button>
						   <button type="submit" class="btn btn-lighten-primary">Tambahkan</button>
					   </div>
				   </form>
                    </div>
                </div>
			 <?php $this->load->view('_partials/footer'); ?>
               