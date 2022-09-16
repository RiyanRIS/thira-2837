<?= view("admin/templates/head") ?>
<?= view("admin/templates/nav") ?>

		<div class="main">
			<?= view("admin/templates/atas") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Halaman <strong>Tentang Desa</strong></h1>

					<div class="row">
						<div class="col-12 d-flex">
								<div class="card flex-fill">
									<div class="card-body">
									<form method="post" action="ubah" id="myForm" enctype="multipart/form-data" accept-charset="utf-8">
										<input type="hidden" name="id" value="1">
			<div class="form-group" id="notifikasi_nama">
				<label for="nama">Nama Desa<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Desa" required="true" value="<?= $record['nama'] ?>" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_kecamatan">
				<label for="kecamatan">Kecamatan<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Masukkan Kecamatan" required="true" value="<?= $record['kecamatan'] ?>" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_kabupaten">
				<label for="kabupaten">Kabupaten<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Masukkan Kabupaten" value="<?= $record['kabupaten'] ?>" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_provinsi">
				<label for="provinsi">Provinsi<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Masukkan Provinsi" value="<?= $record['provinsi'] ?>" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_deskripsi">
				<label for="deskripsi">Deskripsi</label>
				<textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control"><?=$record['deskripsi']?></textarea>
			</div>
			<div class="row mb-3">
				<div class="col-6">
					<label for="gambar" class="small">Gambar Awal</label> <br>
					<img src="<?=base_url("uploads/desa/" . $record['foto'])?>" alt="" width="200" height="" id="img-foto-awal">
				</div>
				<div class="col-6">
					<label for="gambar" class="small">Gambar Baru</label> <br>
					<img id="img-foto-preview" src="#" alt="" width="200" height="" style="display: none;" />
				</div>
			</div>
			<div class="form-group" id="notifikasi_foto">
				<input type="file" name="foto" id="foto" class="form-control foto-preview">
				<small style="vertical-align: top">*kosongi jika tidak merubah gambar</small>
			</div>
			<button type="submit" class="btn btn-primary mt-3" id="submit">Simpan</button>
									</form>
									</div>
								</div>
						</div>
					</div>

				</div>
			</main>

<?= view("admin/templates/foot") ?>

<script>
	function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#' + id).attr('src', e.target.result);
            document.getElementById(id).style.display = "block";
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#foto").change(function() {
        readURL(this, "img-foto-preview");
    });

	$('#myForm, #myForm1, #myForm2, #myForm3').submit(function(e){
        e.preventDefault()
        var dataToSend  = new FormData(this)
        var formId = $(this)
        var action = $(formId).attr('action')

		$('#modalnya .modal-footer #submit').prop('disabled', true);

        $.ajax({
            url      : '<?= site_url('admin/tentang/') ?>'+action,
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
				$('#modalnya .modal-footer #submit').prop('disabled', false);
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