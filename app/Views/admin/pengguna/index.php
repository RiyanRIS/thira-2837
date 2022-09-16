<?= view("admin/templates/head") ?>

<?= view("admin/templates/nav") ?>

		<div class="main">
			<?= view("admin/templates/atas") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Halaman <strong>Pengguna</strong></h1>

					<div class="row">
					<div class="col-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<!-- <h5 class="card-title mb-3">Tabel Pengguna</h5> -->
                  					<button class="btn btn-primary tambahModal" title="Tambah data"><i class="fa fa-plus-square"></i> tambah</button>
								</div>
								<div class="card-body">
                
								<table id="datatable" class="table table-hover">
									<thead>
										<tr>
											<!-- <th title="No">No</th> -->
											<th>Aksi</th>
											<th title="Nama Lengkap">Nama Lengkap</th>
											<th title="Username">Username</th>
											<th title="Role">Role</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($record as $key) {
										?>
										<tr>
											<!-- <td><?=$no++?></td> -->
											<td>
												<button class="btn btn-sm btn-info ubahModal" data-id="<?=$key['id']?>" title="Ubah data"><i class="fa fa-pencil-square"></i></button>
												<button data-id="<?=$key['id']?>" class="btn btn-sm btn-danger delete_data" title="Hapus data"><i class="fa fa-trash"></i></button>
											</td>
											<td><?=$key['nama_lengkap']?></td>
											<td><?=$key['username']?></td>
											<td><?=$key['role']?></td>
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
			<div class="form-group" id="notifikasi_username">
				<label for="username">Username<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required="true" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_password">
				<label for="password">Password<small style="color:red;vertical-align: top;">*</small></label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" autocomplete="off">
				<small id="keterangan-password" class="text-muted"><span style="vertical-align: top;">*</span>Isi untuk merubah password</small>
			</div>
			<div class="form-group" id="notifikasi_konfirmasi_password">
				<label for="konfirmasi_password">Konfirmasi Password<small style="color:red;vertical-align: top;">*</small></label>
				<input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukkan Konfirmasi Password" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_role">
				<label for="role">Role<small style="color:red;vertical-align: top;">*</small></label>
				<select name="role" id="role" class="form-select mb-3" id="role" required="true">
					<option value="admin">Admin</option>
					<option value="pengepul">Pengepul</option>
				</select>
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
		$('#modalnya .modal-header #modallabel').text('Tambah Pengguna');
		$('#modalnya #myForm').attr('action','tambah');
		$('#modalnya').modal('show');
	})

	$(".ubahModal").click(function (){
		let id = $(this).data("id")
		$('#modalnya .modal-header #modallabel').text('Ubah Pengguna');
		$('#modalnya #myForm').attr('action','ubah');
		var data = getJSON('<?= site_url('admin/pengguna/ambil/') ?>' + id);
		$('#id').val(data.record.id);
		$('#nama_lengkap').val(data.record.nama_lengkap);
		$('#username').val(data.record.username);
		$("#keterangan-password").show()

		// $('#mod-deskripsi-layanan').html(data.record.deskripsi_layanan);
		// $('.mdl-info-layanan').html(htmll)
		// $('#mod-gambar-layanan').attr("src", base_url +"uploads/images/layanan/"+ data.record.gambar_layanan);

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
		$("#keterangan-password").hide()
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
            url      : '<?= site_url('admin/pengguna/') ?>'+action,
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
                        var response = getJSON('<?= site_url('admin/pengguna/hapus/') ?>' + id)
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