<?= view("admin/templates/head") ?>
<?= view("admin/templates/nav") ?>

		<div class="main">
			<?= view("admin/templates/atas") ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Halaman <strong>Dashboard</strong></h1>
					<p>Selamat datang, <strong><?= session()->user_nama ?></strong></p>
				</div>
			</main>

<?= view("admin/templates/foot") ?>

</body>
</html>