<?php
$cfg = new \SConfig();
?>
<?=view('templates/head')?>

<?=view('templates/nav')?>

<main class="container">
  <div class="bg-light p-5 rounded">
      <h2 class="mb-5">Desa <?=$record[0]['nama']?></h2>

      <div class="row">
        <div class="col-8">
          <p><?=$record[0]['deskripsi']?></p>
        </div>
        <div class="col-4">
          <img style="width:100%" src="<?=base_url("uploads/desa/" . $record[0]['foto'])?>" alt="">
        </div>
      </div>

  </div>
</main>


<?=view('templates/foot')?>
      
  </body>
</html>
