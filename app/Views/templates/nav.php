</head>
  <body>
  <?php
$cfg = new \SConfig();
?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
  <img src="<?=base_url("uploads/desa/" . session()->get('desa_logo'));?>" alt="" width="200px">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link <?php $cfg->is_active("home", @$nav) ?>" href="<?=site_url()?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php $cfg->is_active("wisata", @$nav) ?>" href="<?=site_url("wisata")?>">Wisata</a>
        </li>
        <?php if(session()->isLogin){ ?>
        <li class="nav-item">
          <a class="nav-link <?php $cfg->is_active("lahan", @$nav) ?>" href="<?=site_url("lahan")?>">Lahan Pertanian</a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link <?php $cfg->is_active("desa", @$nav) ?>" href="<?=site_url("desa")?>">Informasi Desa</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
      <?php if(session()->isLogin){ ?>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?=session()->user_nama?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="<?=site_url('admin/logout')?>">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      <?php } else { ?>
        <a href="<?=site_url('admin/login')?>" class="btn btn-outline-success">Login</a>
      <?php } ?>
      </form>
    </div>
  </div>
</nav>