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
							<a href="<?=site_url('master/coa/create')?>" class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah Chart of Account</a>
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
												<th>Chart of Account</th>
												<th>Saldo Normal</th>
												<th>Post</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php $no = 1; foreach ($head as $h) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><b><?= $h['head_code'] . ' ' . $h['head_name'] ?></b></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<?php foreach ($sub as $s) : ?>
												<?php if ($s['head_code'] == $h['head_code']) : ?>
													<tr>
														<td><?= $no++ ?></td>
														<td><b>&nbsp;&nbsp;&nbsp;<?= $s['sub_code'] . ' ' . $s['sub_name'] ?></b></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
														<?php foreach ($all as $row) : ?>
															<?php if ($s['sub_code'] == $row['sub_code']) : ?>
																<tr>
																	<td><?= $no++ ?></td>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $row['account_no'] . ' ' . $row['account_name'] ?></td>
																	<td><?php
																		if ($row['normal_balance'] == 'd') {
																			echo "Debet";
																		} else {
																			echo "Kredit";
																		}
																		?></td>
																	<td><?=ucwords($row['post'])?></td>
																	<td>
																		<a href="<?=site_url('master/coa/edit/'.$row['account_no'])?>"><i class="mdi mdi-table-edit"></i></a>
																	</td>
																</tr>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>
												<?php endforeach ?>
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
               