<?php
$cfg = new \SConfig();
?>
<?=view('templates/head')?>

<link rel="stylesheet" href="<?= base_url() ?>\plugins\leaflet\leaflet.css">

<?=view('templates/nav')?>

<main class="container">
  <div class="bg-light p-5 rounded">
      <h2 class="mb-3">Detail Lahan</h2>

      <div class="row">

      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="<?= base_url("uploads/lahan/" . $key['foto']) ?>" alt="Card image cap">
          <div class="card-body small">
            <h5 style="overflow-y: auto; height: 50px;"><?=$key['kepemilikan']?></h5>
            <?php
            if($key['kategori'] == "wisata kuliner"){ ?>
            <span class="badge bg-success"><?=ucwords($key['kategori'])?></span>
            <?php } else { ?>
            <span class="badge bg-primary"><?=ucwords($key['kategori'])?></span>
            <?php } ?>

            <p class="card-text mt-3">Alamat: <?=$key['alamat_lengkap']?></p>
            <p class="card-text">Deskripsi: <?=$key['deskripsi']?></p>
            <p>Dusun : <?=$key['dusun']?></p>
            <p>Kecamatan : <?=$key['kecamatan']?></p>
            <p>Kabupaten : <?=$key['kabupaten']?></p>
            <p>Provinsi : <?=$key['provinsi']?></p>
            <div id="mapid" style="height:200px"></div>
          </div>
        </div>
      </div>
      </div>

  </div>
</main>

<?=view('templates/foot')?>

<script src="<?=base_url()?>\plugins\leaflet\leaflet.js"></script>
      <script>
        var map = L.map('mapid').setView(['<?=$key['latitude']?>','<?=$key['longitude']?>'], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker(['<?=$key['latitude']?>','<?=$key['longitude']?>']).addTo(map);
      </script>
  </body>
</html>
