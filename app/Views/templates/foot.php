<script src="<?= base_url() ?>/js/jquery.min.js"></script>

<script src="https://getbootstrap.com/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script> -->

 <!-- Notifications Plugin -->
 <script src="<?= base_url() ?>/plugins/toastr/toastr.min.js"></script>

<script>
<?php if(session()->has('msg')){
if(session()->get('msg')[0] == 1){ ?>
    toastr.success("<?= session()->get('msg')[1] ?>", 'Berhasil');
<?php }elseif(session()->get('msg')[0] == 0){ ?>
    toastr.error("<?= session()->get('msg')[1] ?>", 'Gagal');
<?php }
} ?>
</script>