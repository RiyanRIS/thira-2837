<?php
$cfg = new \SConfig();
?>
<?=view('templates/head')?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />

<?=view('templates/nav')?>

<main class="container">
  <div class="bg-light p-5 rounded">
     <div id="map"></div>
  </div>
</main>


<?=view('templates/foot')?>

<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

    <script>
      var map = L.map('map').setView([-0.712412, 119.975704], 12);

      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      <?php foreach ($record as $key) {
        $judul = (@$key['nama_wisata'] ?: @$key['kepemilikan']);
        ?>
        L.marker(['<?=$key['latitude']?>', '<?=$key['longitude']?>']).addTo(map)
          .bindPopup('<?=$judul?>');
        <?php } ?>
    </script>

      
  </body>
</html>
