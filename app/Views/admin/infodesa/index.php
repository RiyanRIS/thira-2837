<?= view("admin/templates/head") ?>

<?= view("admin/templates/nav") ?>

		<div class="main">
			<?= view("admin/templates/atas") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Halaman <strong>Info Desa</strong></h1>

					<div class="row">
					<div class="col-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
                  					<button class="btn btn-primary tambahModal" title="Tambah data"><i class="fa fa-plus-square"></i> tambah</button>
								</div>
								<div class="card-body">
								<div class="table-responsive">
								<table id="datatable" class="table table-hover">
									<thead>
										<tr>
											<th style="min-width:100px">Aksi</th>
											<th style="min-width:100px">Nama Desa</th>
											<th style="min-width:100px">Kecamatan</th>
											<th style="min-width:100px">Kabupaten</th>
											<th style="min-width:120px">Provinsi</th>
											<!-- <th>Deskripsi</th> -->
											<th>Foto</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($record as $key) {
										?>
										<tr>
											<td>
												<button data-id="<?=$key['id']?>" class="btn btn-sm btn-success lihat_data" title="Lihat data"><i class="fa fa-eye"></i></button>
												<button class="btn btn-sm btn-info ubahModal" data-id="<?=$key['id']?>" title="Ubah data"><i class="fa fa-pencil-square"></i></button>
												<button data-id="<?=$key['id']?>" class="btn btn-sm btn-danger delete_data" title="Hapus data"><i class="fa fa-trash"></i></button>
											</td>
											<td><?=$key['nama']?></td>
											<td><?=$key['kecamatan']?></td>
											<td><?=$key['kabupaten']?></td>
											<td><?=$key['provinsi']?></td>
											<!-- <td><?=$key['deskripsi']?></td> -->
											<td><a href="javascript:void(0)" onclick="showImg('<?= $key['foto'] ?>')"><?= $key['foto'] ?></a></td>
											
										</tr>
										<?php } ?>
									</tbody>
								</table>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</main>

<!-- Modal -->
<div class="modal fade" id="modalnya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modallabel">Tambah Data</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="post" action="tambah" id="myForm" enctype="multipart/form-data" accept-charset="utf-8">
		<div class="modal-body">
			<input type="hidden" name="id" id="id" />
			<div class="form-group" id="notifikasi_nama">
				<label for="nama">Nama Desa<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Desa" required="true" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_kecamatan">
				<label for="kecamatan">Kecamatan<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Masukkan Kecamatan" required="true" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_kabupaten">
				<label for="kabupaten">Kabupaten<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Masukkan Kabupaten" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_provinsi">
				<label for="provinsi">Provinsi<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Masukkan Provinsi" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_deskripsi">
				<label for="deskripsi">Deskripsi</label>
				<textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control"></textarea>
			</div>
			<div class="row mb-3">
				<div class="col-6">
					<label for="gambar" class="small">Gambar Awal</label> <br>
					<img src="" alt="" width="200" height="" id="img-foto-awal">
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
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
			<button type="submit" class="btn btn-primary" id="submit">Simpan</button>
		</div>
	  </form>
    </div>
  </div>
</div>

<!-- Modal Gambar -->
<div class="modal fade" id="ModalGambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalCrudLabel">Preview Gambar</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <img src="" width="70%" id="modal-gambarnya" alt="">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" id="cancel1" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalLihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modallabel">Detail Data</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="post" action="tambah" id="myForm" enctype="multipart/form-data" accept-charset="utf-8">
		<div class="modal-body">
			<div class="form-group" id="notifikasi_nama">
				<label for="nama">Nama Desa<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="ml-nama" name="nama" placeholder="Masukkan Nama Desa" required="true" autocomplete="off" disabled="true">
			</div>
			<div class="form-group" id="notifikasi_kecamatan">
				<label for="kecamatan">Kecamatan<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="ml-kecamatan" name="kecamatan" placeholder="Masukkan Kecamatan" required="true" autocomplete="off" disabled="true">
			</div>
			<div class="form-group" id="notifikasi_kabupaten">
				<label for="kabupaten">Kabupaten<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="ml-kabupaten" name="ml-kabupaten" placeholder="Masukkan Kabupaten" autocomplete="off" disabled="true">
			</div>
			<div class="form-group" id="notifikasi_provinsi">
				<label for="provinsi">Provinsi<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="ml-provinsi" name="ml-provinsi" placeholder="Masukkan Provinsi" autocomplete="off" disabled="true">
			</div>
			<div class="form-group" id="notifikasi_deskripsi">
				<label for="deskripsi">Deskripsi</label>
				<textarea name="deskripsi" id="ml-deskripsi" cols="30" rows="5" class="form-control" disabled="true"></textarea>
			</div>
			<div class="row mb-3">
				<div class="col-12">
					<label for="gambar">Foto Desa<small style="color:red;vertical-align: top;">*</small></label> <br>
					<img src="" alt="" width="450" height="" id="ml-img-foto-awal">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
		</div>
	  </form>
    </div>
  </div>
</div>


<?= view("admin/templates/foot") ?>

<script>
	$(".tambahModal").click(function (){
		$('#modalnya .modal-header #modallabel').text('Tambah Info Desa');
		$('#modalnya #myForm').attr('action','tambah');
		$('#modalnya').modal('show');
	})

	$(".ubahModal").click(function (){
		let id = $(this).data("id")
		$('#modalnya .modal-header #modallabel').text('Ubah Info Desa');
		$('#modalnya #myForm').attr('action','ubah');
		var data = getJSON('<?= site_url('admin/infodesa/ambil/') ?>' + id);
		$('#id').val(data.record.id);
		$('#nama').val(data.record.nama);
		$('#kecamatan').val(data.record.kecamatan);
		$('#kabupaten').val(data.record.kabupaten);
		$('#provinsi').val(data.record.provinsi);
		$('#deskripsi').html(data.record.deskripsi);

		// $('.mdl-info-layanan').html(htmll)
		$('#img-foto-awal').attr("src", "<?= base_url("uploads/infodesa") ?>/"+ data.record.foto);

		$('#modalnya').modal('show');
	})

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

	function showImg(src){
        $('#modal-gambarnya').attr('src', "<?= base_url("uploads/infodesa") ?>/" + src)
        $('#ModalGambar').modal('show');
    }

	function getJSON(url,data = [], type = 'GET'){
		return JSON.parse($.ajax({
			type        : type,
			url         : url,
			data        : data,
			dataType    :'json',
			global      : false,
			async       : false,
			beforeSend:function(){
				$('#loading').show();
			},
			complete: function(){
				$('#loading').hide();
			},
			success:function(msg){

			},
		}).responseText);
	}

	$('#modalnya').on('hidden.bs.modal', function(){
        $('#myForm')[0].reset()
        $('#myForm').find('.invalid-feedback').remove()
        $('#myForm').find('.is-invalid').removeClass('is-invalid')
		$("#keterangan-kabupaten").hide();
		$('#deskripsi').html("");
		$('#img-foto-awal').attr("src", "");
		$('#img-foto-preview').attr("src", "");
        // document.getElementById("#myModalSize").classList.remove("modal-xs", "modal-sm", "modal-lg", "modal-md", "modal-xl");
        // $('form').show()
    })

	$('#myForm, #myForm1, #myForm2, #myForm3').submit(function(e){
        e.preventDefault()
        var dataToSend  = new FormData(this)
        var formId = $(this)
        var action = $(formId).attr('action')

		$('#modalnya .modal-footer #submit').prop('disabled', true);

        $.ajax({
            url      : '<?= site_url('admin/infodesa/') ?>'+action,
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

	$(".lihat_data").click(function (){
		let id = $(this).data("id")
		var data = getJSON('<?= site_url('admin/infodesa/ambil/') ?>' + id);
		$('#ml-nama').val(data.record.nama);
		$('#ml-kecamatan').val(data.record.kecamatan);
		$('#ml-kabupaten').val(data.record.kabupaten);
		$('#ml-provinsi').val(data.record.provinsi);
		$('#ml-deskripsi').html(data.record.deskripsi);
		$('#ml-img-foto-awal').attr("src", "<?= base_url("uploads/infodesa") ?>/"+ data.record.foto);
		$('#modalLihat').modal('show');
	})

    //proses Hapus data
    $('.delete_data').click(function(){
        var id = $(this).data('id')
        $.confirm({
            title: 'Delete',
            content: 'Apakah Anda Yakin Akan menghapus data ini ?',
            type: 'red',
			animation: 'RotateX',
            buttons: {
                tryAgain: {
                    text: 'Ya',
                    btnClass: 'btn-green',
                    action: function(){
                        var response = getJSON('<?= site_url('admin/infodesa/hapus/') ?>' + id)
                        if(response.status){
                            window.location.replace(response.url);
                        }else{
                            $.alert({
								title: 'Error',
								content: 'Terjadi kesalahan pada server!',
							});
                        }
                    }
                },
                tryAgain2: {
                    text: 'Batal',
                    btnClass: 'btn-red',
                    action: function(){
                        
                    }
                },
            }
        });
        
    })
</script>

</body>
</html>