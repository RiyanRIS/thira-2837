<?= view("admin/templates/head") ?>

<?= view("admin/templates/nav") ?>

		<div class="main">
			<?= view("admin/templates/atas") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Halaman <strong>Daftar Petani</strong></h1>

					<?php if(count($lahan) == 0){ ?>
					<div class="alert alert-warning" role="alert">
					Data lahan masih kosong. Atur <a href="<?=site_url("admin/lahan")?>">data lahan</a> untuk dapat menggunakan halaman ini dengan optimal. 
					</div>
					<?php } ?>

					<div class="row">
					<div class="col-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
                  					<button class="btn btn-primary tambahModal" title="Tambah data"><i class="fa fa-plus-square"></i> tambah</button>
								</div>
								<div class="card-body">
                
								<table id="datatable" class="table table-hover">
									<thead>
										<tr>
											<th>Aksi</th>
											<th title="Nama Lengkap">Nama Lengkap</th>
											<th title="Lahan">Lahan</th>
											<th title="No Telepon">No Telepon</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($record as $key) {
										?>
										<tr>
											<td>
												<button class="btn btn-sm btn-info ubahModal" data-id="<?=$key['id']?>" title="Ubah data"><i class="fa fa-pencil-square"></i></button>
												<button data-id="<?=$key['id']?>" class="btn btn-sm btn-danger delete_data" title="Hapus data"><i class="fa fa-trash"></i></button>
											</td>
											<td><?=$key['nama_lengkap']?></td>
											<td><?=$key['kepemilikan']?></td>
											<td><?=$key['no_telepon']?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
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
			<div class="form-group" id="notifikasi_nama_lengkap">
				<label for="nama_lengkap">Nama Lengkap<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" required="true" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_id_lahan">
				<label for="id_lahan">Lahan<small style="color:red;vertical-align: top;">*</small></label>
				<select name="id_lahan" id="id_lahan" class="form-select mb-3" required="true">
					<?php foreach ($lahan as $key) { ?>
					<option value="<?=$key['id']?>"><?=$key['kepemilikan']?>, <?=$key['dusun']?>(<?=$key['kategori']?>)</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group" id="notifikasi_no_telepon">
				<label for="no_telepon">No Telepon<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Masukkan No Telepon" required="true" autocomplete="off">
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

<?= view("admin/templates/foot") ?>

<script>
	$("#keterangan-password").hide();

	$(".tambahModal").click(function (){
		$('#modalnya .modal-header #modallabel').text('Tambah Petani');
		$('#modalnya #myForm').attr('action','tambah');
		$('#modalnya').modal('show');
	})

	$(".ubahModal").click(function (){
		let id = $(this).data("id")
		$('#modalnya .modal-header #modallabel').text('Ubah Petani');
		$('#modalnya #myForm').attr('action','ubah');
		var data = getJSON('<?= site_url('admin/petani/ambil/') ?>' + id);
		$('#id').val(data.record.id);
		$('#nama_lengkap').val(data.record.nama_lengkap);
		$('#id_lahan').val(data.record.id_lahan);
		$('#no_telepon').val(data.record.no_telepon);
		$("#keterangan-password").show()
		$('#modalnya').modal('show');
	})

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
    })

	$('#myForm, #myForm1, #myForm2, #myForm3').submit(function(e){
        e.preventDefault()
        var dataToSend  = new FormData(this)
        var formId = $(this)
        var action = $(formId).attr('action')

		$('#modalnya .modal-footer #submit').prop('disabled', true);

        $.ajax({
            url      : '<?= site_url('admin/petani/') ?>'+action,
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
                        var response = getJSON('<?= site_url('admin/petani/hapus/') ?>' + id)
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