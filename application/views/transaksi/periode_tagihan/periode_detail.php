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
					<a href="<?= site_url('transaksi/periode_tagihan') ?>" class="btn btn-secondary btn-sm waves-effect" data-overlayColor="#36404a"> <i class="mdi mdi-arrow-left-bold"></i> Kembali</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h4>Rincian Periode Tagihan Pelanggan</h4>
						<p>Periode : <?= format_bulan($periode['bulan']) . ' ' . $periode['tahun'] ?></p>
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
						<div class="responsive-table-plugin">
							<div class="table-rep-plugin">
								<div class="table-responsive" data-pattern="priority-columns">
									<table id="tech-companies-1" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>#</th>
												<th data-priority="1">ID Pelanggan</th>
												<th data-priority="1">Pelanggan</th>
												<th data-priority="1">Golongan</th>
												<th data-priority="2">Biaya Admin</th>
												<th data-priority="2">Iuran Wajib</th>
												<th data-priority="3">Biaya Pemakaian</th>
												<th data-priority="3">Biaya Denda</th>
												<th data-priority="4">Tunggakan</th>
												<th data-priority="4">Tagihan</th>
												<th data-priority="1">status</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($list as $ls) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $ls['id_pelanggan'] ?></td>
													<td><?= $ls['nama_pelanggan'] ?></td>
													<td><?= $ls['nama_golongan'] ?></td>
													<td><?= nominal($ls['biaya_admin']) ?></td>
													<td><?= nominal($ls['biaya_beban']) ?></td>
													<td><?= nominal($ls['pemakaian']) ?></td>
													<td><?= nominal($ls['denda']) ?></td>
													<td><?= nominal($ls['tunggakan']) ?></td>
													<td><?= nominal($ls['total']) ?></td>
													<td>
														<?php if ($ls['status'] == 0) : ?>
															<span class="text-danger">Belum Dicatat</span>
														<?php endif ?>
														<?php if ($ls['status'] == 1) : ?>
															<span class="text-pink">Tagihan Belum Dibuat</span>
														<?php endif ?>
														<?php if ($ls['status'] == 2) : ?>
															<span class="text-warning">Belum Dibayar</span>
														<?php endif ?>
														<?php if ($ls['status'] == 3) : ?>
															<span class="text-success">Sudah Dibayar</span>
														<?php endif ?>
													</td>

												</tr>
											<?php endforeach ?>

										</tbody>
									</table>
								</div>

							</div>
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
