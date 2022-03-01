 <!-- ========== Left Sidebar Start ========== -->
 <div class="left-side-menu">

 	<div class="slimscroll-menu">

 		<!-- User box -->
 		<div class="user-box text-center">
 			<img src="<?= base_url('uploads/pengurus/' . $userdata['foto']) ?>" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
 			<div class="dropdown">
 				<a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown" aria-expanded="false"> <?= $userdata['nama_pengurus'] ?></a>
 				<div class="dropdown-menu user-pro-dropdown">

 					<!-- item-->
 					<a href="javascript:void(0);" class="dropdown-item notify-item">
 						<i class="fe-user mr-1"></i>
 						<span>Profil</span>
 					</a>
 					<!-- item-->
 					<a href="<?= site_url('logout') ?>" class="dropdown-item notify-item">
 						<i class="fe-log-out mr-1"></i>
 						<span>Logout</span>
 					</a>

 				</div>
 			</div>
 			<p class="text-muted">Admin Head</p>

 		</div>

 		<!--- Sidemenu -->
 		<div id="sidebar-menu">

 			<ul class="metismenu" id="side-menu">
 				<?php foreach ($menu['menu_head'] as $mh) : ?>
 					<?php if ($mh['head_level'] == 0) : ?>
 						<!-- level 0 -->
 						<li>
 							<a href="<?= site_url($mh['head_uri']) ?>">
 								<i class="<?= $mh['head_icon'] ?>"></i>
 								<span> <?= $mh['head_name'] ?> </span>
 							</a>
 						</li>
 					<?php endif ?>
 					<!-- /.level 0 -->

 					<?php if ($mh['head_level'] == 1) : ?>
 						<!-- level 1 -->
 						<li>
 							<a href="javascript: void(0);">
 								<i class="<?= $mh['head_icon'] ?>"></i>
 								<span> <?= $mh['head_name'] ?> </span>
 								<span class="menu-arrow"></span>
 							</a>
 							<ul class="nav-second-level" aria-expanded="false">
 								<?php foreach ($menu['menu_sub'] as $ms) : ?>
 									<?php if ($mh['head_id'] == $ms['head_id']) : ?>
 										<li><a href="<?= site_url($ms['sub_uri']) ?>"><?= $ms['sub_name'] ?></a></li>
 									<?php endif ?>
 								<?php endforeach ?>
 							</ul>
 						</li>
 					<?php endif ?>
 					<!-- /.level 1 -->
 				<?php endforeach ?>
 			</ul>

 		</div>
 		<!-- End Sidebar -->

 		<div class="clearfix"></div>

 	</div>
 	<!-- Sidebar -left -->

 </div>
 <!-- Left Sidebar End -->
