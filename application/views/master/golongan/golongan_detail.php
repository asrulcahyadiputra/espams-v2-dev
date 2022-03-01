<?php $this->load->view('_partials/head'); ?>
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
					<div class="container">

						<div class="row mb-3 mt-3">
							<div class="col-12">
								<a href="<?=site_url('master/golongan')?>" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i> Kembali</a>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="card-box">
										<table class="table">
											<tr class="table-info">
												<th colspan="3">Info Golongan</th>
											</tr>
											<tr>
												<td style="width: 15%;">ID Golongan</td>
												<td style="width: 1%;">:</td>
												<td><?=$golongan['id_golongan']?></td>
											</tr>
											<tr>
												<td style="width: 15%;">Nama Golongan</td>
												<td style="width: 1%;">:</td>
												<td><?=$golongan['nama_golongan']?></td>
											</tr>
											<tr>
												<td style="width: 15%;">Biaya Admin</td>
												<td style="width: 1%;">:</td>
												<td><?=nominal($golongan['biaya_admin'])?></td>
											</tr>
											<tr>
												<td style="width: 15%;">Beban</td>
												<td style="width: 1%;">:</td>
												<td><?=nominal($golongan['biaya_beban'])?></td>
											</tr>
										</table>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr class="table-info">
														<th colspan="3">Rincian Fluktuasi Tarif</th>
													</tr>
													<tr>
														<th class="text-center">#</th>
														<th>Pemakaian</th>
														<th>Tarif</th>
													</tr>
												</thead>
												<tbody >
													<?php $no=1; foreach($detail as $row): ?>
													<tr>
														<td class="text-center"><?=$no++?></td>
														<td><?=$row['min_pemakaian'].'-'.$row['max_pemakaian']?>M<sup>3</sup></td>
														<td><?=nominal($row['tarif'])?></td>
													</tr>
													<?php endforeach ?>
													<tr>
														<td class="text-center"><?=$no?></td>
														<td><?='>'.$golongan['interval_atas']?>M<sup>3</sup></td>
														<td><?=nominal($golongan['max_tarif'])?></td>
													</tr>
												</tbody>
											</table>
										</div>
								</div>
							</div>
						</div> 
						<!-- end row -->
					</div>
				</div> 
				<!-- container-fluid -->
			 </div> 
			 <!-- content -->
			 <?php $this->load->view('_partials/footer'); ?>
               