<?= view("admin/templates/head") ?>
<?php
$cfg = new \SConfig();
?>
<?= view("admin/templates/nav") ?>

		<div class="main">
			<?= view("admin/templates/atas") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Halaman <strong>Daftar Komentar</strong></h1>

					<div class="row">
					<div class="col-12 d-flex">
							<div class="card flex-fill">
								<div class="card-body">
								<div class="table-responsive">
								<table id="datatable" class="table table-hover">
									<thead>
										<tr>
											<th style="min-width:20px">Aksi</th>
											<th style="min-width:30px">Nama Wisata</th>
											<th style="min-width:30px">Dari</th>
											<th style="min-width:100px">Isi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($record as $key) {
										?>
										<tr>
											<td>
												<button data-id="<?=$key['id']?>" class="btn btn-sm btn-danger delete_data" title="Hapus data"><i class="fa fa-trash"></i></button>
											</td>
											<td><?=$key['nama_wisata']?></td>
											<td><?=$key['email']?></td>
											<td><?=$key['isi']?></td>
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
                        var response = getJSON('<?= site_url('admin/komentar/hapus/') ?>' + id)
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