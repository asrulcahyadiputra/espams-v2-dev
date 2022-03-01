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
					<a href="<?= site_url('master/aset/create') ?>" class="btn btn-primary btn-sm waves-effect" data-overlayColor="#36404a"> <i class="mdi mdi-plus"></i> Tambah Aset</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card-box">
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
						<div class="table-responsive">
							<table id="datatable" class="table  table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Aset</th>
										<th>Satuan</th>
										<th>Kode Rekening</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($head as $h) : ?>
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
													<td><b>&nbsp;&nbsp;&nbsp;<?= $s['subhead_code'] . ' ' . $s['subhead_name'] ?></b></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<?php foreach ($all as $row) : ?>
													<?php if ($s['subhead_code'] == $row['subhead_code']) : ?>
														<tr>
															<td><?= $no++ ?></td>
															<td>
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $row['aset_code'] . ' ' . $row['aset_name'] ?>
															</td>
															<td><?= $row['aset_unit'] ?></td>
															<td><?= $row['account_no'] . ' ' . $row['account_name'] ?></td>
															<td>
																<a href="<?= site_url('master/aset/edit/' . $row['aset_code']) ?>"><i class="mdi mdi-table-edit"></i></a>
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
