<?php
$cfg = new \SConfig();
?>
<?=view('templates/head')?>

<?=view('templates/nav')?>

<main class="container">
  <div class="bg-light p-5 rounded">
      <center><h2 class="mb-3">Wisata Desa Kami</h2></center>

      <div class="row">

      <?php foreach ($record as $key) { ?>
      <div class="col-4">
        <div class="card">
          <img class="card-img-top" src="<?= base_url("uploads/wisata/" . $key['foto']) ?>" alt="Card image cap">
          <div class="card-body" style="overflow-y: auto; height: 200px;">
            <h5 style="overflow-y: auto; height: 50px;"><?=$key['nama_wisata']?></h5>
            <span class="badge bg-success"><?=ucwords($key['kategori'])?></span>
            <p class="card-text small mt-3"><?=$key['alamat_lengkap']?></p>
          </div>
          <div class="card-footer">
            <a href="<?=site_url('detail/wisata/' . $key['id'])?>" class="btn btn-primary">Detail</a>
          </div>
        </div>
      </div>
      <?php } ?> 
      </div>

  </div>
</main>

<?=view('templates/foot')?>
      
  </body>
</html>
