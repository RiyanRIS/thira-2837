<?= view("admin/templates/head") ?>
<?php
$cfg = new \SConfig();
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
	#mapid { height: 300px; }
	#mapid2 { height: 300px; }
</style>
<?= view("admin/templates/nav") ?>

		<div class="main">
			<?= view("admin/templates/atas") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Halaman <strong>Daftar Lahan Pertanian</strong></h1>

					<?php if(count($desa) == 0){ ?>
					<div class="alert alert-warning" role="alert">
					Data desa masih kosong. Atur <a href="<?=site_url("admin/infodesa")?>">data desa</a> untuk dapat menggunakan halaman ini dengan optimal. 
					</div>
					<?php } ?>

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
											<th style="min-width:100px">Kepemilikan</th>
											<th style="min-width:100px">Alamat</th>
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
											<td><?=$key['kepemilikan']?></td>
											<td><?=$key['alamat_lengkap']?></td>
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
			<div class="form-group" id="notifikasi_kepemilikan">
				<label for="kepemilikan">Kepemilikan<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="kepemilikan" name="kepemilikan" placeholder="Masukkan Kepemilikan" required="true" autocomplete="off">
			</div>
			<div class="form-group" id="notifikasi_kategori">
				<label for="kategori">Kategori<small style="color:red;vertical-align: top;">*</small></label>
				<select name="kategori" id="kategori" class="form-select mb-3" id="kategori" required="true">
					<option value="sawah">Sawah</option>
					<option value="kopi">Kopi</option>
					<option value="cengkeh">Cengkeh</option>
					<option value="sayur">Sayur</option>
					<option value="karet">Karet</option>
				</select>
			</div>
			<div class="form-group" id="notifikasi_alamat_lengkap">
				<label for="alamat_lengkap">Alamat Lengkap<small style="color:red;vertical-align: top;">*</small></label>
				<textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="5" class="form-control"></textarea>
			</div>
			<div class="form-group" id="notifikasi_desa_id">
				<label for="desa_id">Desa<small style="color:red;vertical-align: top;">*</small></label>
				<select name="desa_id" id="desa_id" class="form-select mb-3" id="desa_id" required="true">
					<?php foreach ($desa as $key) { ?>
					<option value="<?=$key['id']?>"><?=$key['nama']?>, <?=$key['kecamatan']?>, <?=$key['kabupaten']?></option>
					<?php } ?>
				</select>
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
			<div class="row">
				<div class="col-6">
					<div class="form-group" id="notifikasi_latitude">
						<label for="latitude">Latitude<small style="color:red;vertical-align: top;">*</small></label>
						<input type="text" class="form-control" id="latitude" name="latitude" placeholder="" required="true" autocomplete="off">
					</div>
				</div>
				<div class="col-6">
					<div class="form-group" id="notifikasi_longitude">
						<label for="longitude">Longitude<small style="color:red;vertical-align: top;">*</small></label>
						<input type="text" class="form-control" id="longitude" name="longitude" placeholder="" required="true" autocomplete="off">
					</div>
				</div>
			</div>
			<div id="mapid"></div>
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
			<input type="hidden" name="id" id="id" />
			<div class="form-group" id="notifikasi_kepemilikan">
				<label for="kepemilikan">Kepemilikan<small style="color:red;vertical-align: top;">*</small></label>
				<input type="text" class="form-control" id="ml-kepemilikan" name="kepemilikan" placeholder="Masukkan Kepemilikan" required="true" autocomplete="off" disabled="true">
			</div>
			<div class="form-group" id="notifikasi_kategori">
				<label for="kategori">Kategori<small style="color:red;vertical-align: top;">*</small></label>
				<select name="kategori" id="ml-kategori" class="form-select mb-3" id="kategori" required="true" disabled="true">
					<option value="Sawah">Sawah</option>
					<option value="Kebun">Kebun</option>
					<option value="lahankosong">Lahan Kosong</option>
				</select>
			</div>
			<div class="form-group" id="notifikasi_alamat_lengkap">
				<label for="alamat_lengkap">Alamat Lengkap<small style="color:red;vertical-align: top;">*</small></label>
				<textarea name="alamat_lengkap" id="ml-alamat_lengkap" cols="30" rows="5" class="form-control" disabled="true"></textarea>
			</div>
			<div class="form-group" id="notifikasi_desa_id">
				<label for="desa_id">Desa<small style="color:red;vertical-align: top;">*</small></label>
				<select name="desa_id" id="ml-desa_id" class="form-select mb-3" id="desa_id" required="true" disabled="true">
					<?php foreach ($desa as $key) { ?>
					<option value="<?=$key['id']?>"><?=$key['nama']?>, <?=$key['kecamatan']?>, <?=$key['kabupaten']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group" id="notifikasi_deskripsi">
				<label for="deskripsi">Deskripsi</label>
				<textarea name="deskripsi" id="ml-deskripsi" cols="30" rows="5" class="form-control" disabled="true"></textarea>
			</div>
			<div class="row mb-3">
				<div class="col-12">
					<label for="gambar">Foto Lahan<small style="color:red;vertical-align: top;">*</small></label> <br>
					<img src="" alt="" width="450" height="" id="ml-img-foto-awal">
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<div class="form-group" id="notifikasi_latitude">
						<label for="latitude">Latitude<small style="color:red;vertical-align: top;">*</small></label>
						<input type="text" class="form-control" id="ml-latitude" name="latitude" placeholder="" required="true" autocomplete="off" disabled="true">
					</div>
				</div>
				<div class="col-6">
					<div class="form-group" id="notifikasi_longitude">
						<label for="longitude">Longitude<small style="color:red;vertical-align: top;">*</small></label>
						<input type="text" class="form-control" id="ml-longitude" name="longitude" placeholder="" required="true" autocomplete="off" disabled="true"s>
					</div>
				</div>
				<div id="mapid2"></div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
		</div>
	  </form>
    </div>
  </div>
</div>


<?= view("admin/templates/foot") ?>

<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

	<script>
    var mapCenter = ['<?=$cfg->lf_lat?>', '<?=$cfg->lf_lon?>'];
    var map = L.map('mapid').setView(mapCenter, <?=$cfg->lf_zoom?>);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Your location :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);

	$(".tambahModal").click(function (){
		$('#modalnya .modal-header #modallabel').text('Tambah Lahan');
		$('#modalnya #myForm').attr('action','tambah');
		$('#modalnya').modal('show');
	})

	$(".ubahModal").click(function (){
		let id = $(this).data("id")
		$('#modalnya .modal-header #modallabel').text('Ubah Lahan');
		$('#modalnya #myForm').attr('action','ubah');
		var data = getJSON('<?= site_url('admin/lahan/ambil/') ?>' + id);
		$('#id').val(data.record.id);
		$('#kepemilikan').val(data.record.kepemilikan);
		$("#kategori").val(data.record.kategori);
		$("#desa_id").val(data.record.desa_id);
		$('#deskripsi').html(data.record.deskripsi);
		$('#latitude').val(data.record.latitude);
		$('#longitude').val(data.record.longitude);
		$('#alamat_lengkap').html(data.record.alamat_lengkap);

		// $('.mdl-info-layanan').html(htmll)
		$('#img-foto-awal').attr("src", "<?= base_url("uploads/lahan") ?>/"+ data.record.foto);

		$('#modalnya').modal('show');

		map.off();
		map.remove();

		mapCenter = [data.record.latitude, data.record.longitude];
		map = L.map('mapid').setView(mapCenter, <?=$cfg->lf_zoom?>);

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		marker = L.marker(mapCenter).addTo(map);
		function updateMarker(lat, lng) {
			marker
			.setLatLng([lat, lng])
			.bindPopup("Your location :  " + marker.getLatLng().toString())
			.openPopup();
			return false;
		};

		map.on('click', function(e) {
			let latitude = e.latlng.lat.toString().substring(0, 15);
			let longitude = e.latlng.lng.toString().substring(0, 15);
			$('#latitude').val(latitude);
			$('#longitude').val(longitude);
			updateMarker(latitude, longitude);
		});

		var updateMarkerByInputs = function() {
			return updateMarker( $('#latitude').val() , $('#longitude').val());
		}
		$('#latitude').on('input', updateMarkerByInputs);
		$('#longitude').on('input', updateMarkerByInputs);
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
        $('#modal-gambarnya').attr('src', "<?= base_url("uploads/lahan") ?>/" + src)
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
		$('#deskripsi').html("");
		$('#alamat_lengkap').html("");
		$('#img-foto-awal').attr("src", "");
		$('#img-foto-preview').attr("src", "");
		map.off();
		map.remove();
		mapCenter = ['<?=$cfg->lf_lat?>', '<?=$cfg->lf_lon?>'];
		map = L.map('mapid').setView(mapCenter, <?=$cfg->lf_zoom?>);

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		marker = L.marker(mapCenter).addTo(map);
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
            url      : '<?= site_url('admin/lahan/') ?>'+action,
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
		var data = getJSON('<?= site_url('admin/lahan/ambil/') ?>' + id);
		$('#ml-kepemilikan').val(data.record.kepemilikan);
		$('#ml-deskripsi').html(data.record.deskripsi);
		$('#ml-desa_id').val(data.record.desa_id);
		$('#ml-kategori').val(data.record.kategori);
		$('#ml-longitude').val(data.record.longitude);
		$('#ml-latitude').val(data.record.latitude);
		$('#ml-deskripsi').html(data.record.deskripsi);
		$('#ml-alamat_lengkap').html(data.record.alamat_lengkap);
		$('#ml-img-foto-awal').attr("src", "<?= base_url("uploads/lahan") ?>/"+ data.record.foto);
		map.off();
		map.remove();

		mapCenter = [data.record.latitude, data.record.longitude];
		map = L.map('mapid2').setView(mapCenter, <?=$cfg->lf_zoom?>);

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		marker = L.marker(mapCenter).addTo(map);

		$('#modalLihat').modal('show');
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
                        var response = getJSON('<?= site_url('admin/lahan/hapus/') ?>' + id)
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