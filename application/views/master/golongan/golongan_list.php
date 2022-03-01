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
							<a href="<?=site_url('master/golongan/create')?>" class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah Golongan Tarif</a>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
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
								<div class="table-responsive">
									<table id="datatable" class="table  table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>ID Golongan</th>
												<th>Nama Golongan</th>
												<th>Biaya Admin</th>
												<th>Beban</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach($all as $row): ?>
												<tr>
													<td><?=$no++?></td>
													<td><?=$row['id_golongan']?></td>
													<td><?=$row['nama_golongan']?></td>
													<td><?=nominal($row['biaya_admin'])?></td>
													<td><?=nominal($row['biaya_beban'])?></td>
													<td>
														<a href="<?=site_url('master/golongan/detail/'.$row['id_golongan'])?>" class="btn btn-info btn-sm mb-1"><i class="mdi mdi-format-list-bulleted"></i></a>
														<a href="<?=site_url('master/golongan/edit/'.$row['id_golongan'])?>" class="btn btn-warning btn-sm mb-1"><i class="mdi mdi-table-edit"></i></a>
													</td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div> 
					<!-- end row -->
				</div> 
				<!-- container-fluid -->
			 </div> 
			 <!-- content -->
			 <?php $this->load->view('_partials/footer'); ?>
               