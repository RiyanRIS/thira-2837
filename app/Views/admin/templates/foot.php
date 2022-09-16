<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								Template by <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> &copy;<?= (@$nama_sistem ?: "Silihay") ?>
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
							<!-- 	<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>  -->
								<li class="list-inline-item">
									<p class="text-muted">v0.1</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="<?= base_url() ?>/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.min.js" integrity="sha512-7rusk8kGPFynZWu26OKbTeI+QPoYchtxsmPeBqkHIEXJxeun4yJ4ISYe7C6sz9wdxeE1Gk3VxsIWgCZTc+vX3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Notifications Plugin -->
    <script src="<?= base_url() ?>/plugins/toastr/toastr.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

	<script src="<?= base_url() ?>/js/app.js"></script>

	<script>
        document.onreadystatechange = function () {
			var state = document.readyState
			if (state == 'complete') {
					document.getElementById('interactive');
					document.getElementById('load').style.visibility="hidden";
			}
		}
    </script>

	<script>
	$(document).ready(function() {
			$('#datatable').DataTable();
		} );
	</script>

    <script>
    <?php if(session()->has('msg')){
    if(session()->get('msg')[0] == 1){ ?>
        toastr.success("<?= session()->get('msg')[1] ?>", 'Berhasil');
    <?php }elseif(session()->get('msg')[0] == 0){ ?>
        toastr.error("<?= session()->get('msg')[1] ?>", 'Gagal');
    <?php }
    } ?>
    </script>