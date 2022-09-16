<?php
$cfg = new \SConfig();
?>
<?=view('templates/head')?>

<link rel="stylesheet" href="<?= base_url() ?>\plugins\leaflet\leaflet.css">

<?=view('templates/nav')?>

<main class="container">
  <div class="bg-light p-5 rounded">
      <h2 class="mb-3">Detail Wisata</h2>

      <div class="row">

      <div class="col-12">
        <div class="card">
          <img class="card-img-top" src="<?= base_url("uploads/wisata/" . $key['foto']) ?>" alt="Card image cap">
          <div class="card-body small">
            <h5 style="overflow-y: auto; height: 50px;"><?=$key['nama_wisata']?></h5>
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
        <div class="card mt-3">
          <div class="card-body small">
            <h6>Tambahkan Komentar</h6>
            <hr>
            <div class="row">
              <div class="col-4">
                <form action="tambah" id="myForm" enctype="multipart/form-data" accept-charset="utf-8"method="post">
                  <input type="hidden" name="id_lahan" value="<?=$id?>">
            			<div class="form-group" id="notifikasi_email">
                    <input type="email" class="form-control mt-3" name="email" required="true" value="" placeholder="Masukkan Email Kamu" id="email">
                  </div>
            			<div class="form-group" id="notifikasi_isi">
                  <textarea name="isi" id="isi" class="form-control mt-3" cols="30" rows="5" placeholder="Masukkan Pesan"></textarea>
                  </div>
                  <input type="submit" id="submit" value="Simpan" class="btn btn-primary mt-3">
                </form>
              </div>
              <div class="col-8">
                <?php if(count($komentar) == 0){ ?>
                  <div class="mt-3">
                  <p><strong>Belum ada komentar</strong></br>
                  </div>
                <?php } else { foreach ($komentar as $kunci) { ?>
                  <div class="mt-3">
                  <p><strong>Dari:</strong> <?=$kunci['email']?></br>
                  <strong>Pesan:</strong> <?=$kunci['isi']?></p>
                  </div>
                <?php } } ?>
                  </div>
                </div>
              </div>
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

$('#myForm, #myForm1, #myForm2, #myForm3').submit(function(e){
        e.preventDefault()
        var dataToSend  = new FormData(this)
        var formId = $(this)
        var action = $(formId).attr('action')

		    $('#submit').prop('disabled', true);

        $.ajax({
            url      : '<?= site_url('tambah-komentar') ?>',
            dataType : 'json',
            type     : 'post',
            data     : dataToSend,
            processData :false,
            contentType :false,
            cache       :false,
            beforeSend:function(){
				
                $('#loading').show()
            },
            complete:function(){
                $('#loading').hide()
				$('#submit').prop('disabled', false);
            },
			error:function(){
				$.alert({
					title: 'Error',
					content: 'Terjadi kesalahan pada server!',
				});
			},
            success  : function(data){
                // console.log(data)
                // $('#pesan_notifikasi div').remove()
                $('.invalid-feedback').remove()
                $('.is-invalid').removeClass('is-invalid');

                if(typeof(data.file) != "undefined" && data.file !== null){
                    if(data.file == false){
                        $.each(data.error_file, function(key, value){
                            $('#'+key).addClass('is-invalid')
                            $('#notifikasi_'+key).append(`<div class="invalid-feedback">`+value+`</div>`)
                        })
                    }else{
                        $.each(data.error_file, function(key, value){
                            $('#'+key).removeClass('is-invalid')
                            $('#notifikasi_'+key).append('')
                        })
                    }
                }else{
                    if(data.status){
                        window.location.replace(data.url);
                    }else{
                        if(data.errors){
                            $.each(data.errors, function(key, value){
                                $('#'+key).addClass('is-invalid')
                                $('#notifikasi_'+key).append(`<div class="invalid-feedback">`+value+`</div>`)
                            })
                        }
                        $('html,body').animate({scrollTop: $('body').offset().top},'fast');
                    }
                }
            }
        })
    })
    </script>

  </body>
</html>
