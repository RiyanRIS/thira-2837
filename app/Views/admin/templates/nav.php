</head>
<?php
$cfg = new \SConfig();
?>
<body>
<div id="load"></div>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="javascript:void(0)">
					<?php $namasistem = (@$nama_sistem ?: "Silihay"); ?>
					<img src="<?=base_url("uploads/desa/" . session()->get('desa_logo'));?>" alt="" width="200px">
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Sistem
					</li>

					<li class="sidebar-item <?php $cfg->is_active("dashboard", @$nav) ?>">
						<a class="sidebar-link" href="<?= base_url("admin") ?>">
						<i class="align-middle fa fa-home"></i> <span class="align-middle">Dashboard</span>
            			</a>
					</li>
					<li class="sidebar-item <?php $cfg->is_active("wisata", @$nav) ?>">
						<a class="sidebar-link" href="<?= base_url("admin/wisata") ?>">
							<i class="align-middle fa fa-id-card-o"></i> <span class="align-middle">Lahan Wisata</span>
            			</a>
					</li>
					<li class="sidebar-item <?php $cfg->is_active("lahan", @$nav) ?>">
						<a class="sidebar-link" href="<?= base_url("admin/lahan") ?>">
							<i class="align-middle fa fa-hashtag"></i> <span class="align-middle">Lahan Pertanian</span>
            			</a>
					</li>
					<li class="sidebar-item <?php $cfg->is_active("petani", @$nav) ?>">
						<a class="sidebar-link" href="<?= base_url("admin/petani") ?>">
							<i class="align-middle fa fa-users"></i> <span class="align-middle">Petani</span>
            			</a>
					</li>
					<li class="sidebar-item <?php $cfg->is_active("komentar", @$nav) ?>">
						<a class="sidebar-link" href="<?= base_url("admin/komentar") ?>">
							<i class="align-middle fa fa-comment"></i> <span class="align-middle">Komentar</span>
            			</a>
					</li>

					<li class="sidebar-header">
						Master Data
					</li>

					<li class="sidebar-item <?php $cfg->is_active("pengguna", @$nav) ?>">
						<a class="sidebar-link" href="<?= base_url("admin/pengguna") ?>">
              				<i class="align-middle" data-feather="user"></i> <span class="align-middle">Pengguna</span>
            			</a>
					</li>
					<li class="sidebar-item <?php $cfg->is_active("infodesa", @$nav) ?>">
						<a class="sidebar-link" href="<?= base_url("admin/infodesa") ?>">
              				<i class="align-middle fa fa-fort-awesome"></i> <span class="align-middle">Desa</span>
            			</a>
					</li>

					<li class="sidebar-header">
						Pengaturan
					</li>

					<li class="sidebar-item <?php $cfg->is_active("tentang", @$nav) ?>">
						<a class="sidebar-link" href="<?= base_url("admin/tentang") ?>">
              				<i class="align-middle fa fa-info-circle"></i> <span class="align-middle">Tentang</span>
            			</a>
					</li>
					<li class="sidebar-item <?php $cfg->is_active("logout", @$nav) ?>">
						<a class="sidebar-link" href="<?= base_url("admin/logout") ?>">
              				<i class="align-middle fa fa-sign-out"></i> <span class="align-middle">Logout</span>
            			</a>
					</li>
				</ul>

				
			</div>
		</nav>