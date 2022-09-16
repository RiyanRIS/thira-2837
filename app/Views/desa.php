<?php
$cfg = new \SConfig();
?>
<?=view('templates/head')?>

<?=view('templates/nav')?>

<main class="container">
  <div class="bg-light p-5 rounded">
      <h2 class="mb-5">Informasi Desa</h2>

      <div class="row">
        <div class="col-4">
          <img style="width:100%" src="<?=base_url("uploads/desa/" . $record[0]['foto'])?>" alt="">
        </div>
        <div class="col-8">
        <form>
          <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">Nama Desa</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control" value="<?=$record[0]['nama']?>">
            </div>
          </div>

          <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">Kecamatan</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control" value="<?=$record[0]['kecamatan']?>">
            </div>
          </div>

          <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">Kabupaten</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control" value="<?=$record[0]['kabupaten']?>">
            </div>
          </div>

          <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">Provinsi</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control" value="<?=$record[0]['provinsi']?>">
            </div>
          </div>

          <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
              <textarea name="ya" id="ya" readonly class="form-control" cols="30" rows="10"><?=$record[0]['deskripsi']?></textarea>
            </div>
          </div>
        </form>
        </div>
      </div>

  </div>
</main>


<?=view('templates/foot')?>
      
  </body>
</html>
