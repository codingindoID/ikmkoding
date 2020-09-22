<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>IKM DPMPTSP</title>
</style>
</head>
<body>
	<!-- <form action="<?php echo site_url('tes/save') ?>" method="post"> -->
		<?php 
		$no = 1;
		foreach ($soal as $soal): ?>
			<input type="hidden" name="id_soal[]" value="<?php echo $soal->id_soal ?>">
			<h4>P : <?php echo $no++ ?></h4>
			<p><?php echo $soal->soal ?>
		</p>
		<div class="row">
			<div class="col">
				<div class="form-check form-check-inline">
					<input required class="form-check-input" type="radio" name="pilihan[<?php echo $soal->id_soal?>][]" id="inlineRadio1" value="a">
					<label class="form-check-label" for="inlineRadio1"><?php echo $soal->a ?></label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pilihan[<?php echo $soal->id_soal?>][]" id="inlineRadio1" value="b">
					<label class="form-check-label" for="inlineRadio1"><?php echo $soal->b ?></label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pilihan[<?php echo $soal->id_soal?>][]" id="inlineRadio1" value="c">
					<label class="form-check-label" for="inlineRadio1"><?php echo $soal->c ?></label>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pilihan[<?php echo $soal->id_soal?>][]" id="inlineRadio1" value="d">
					<label class="form-check-label" for="inlineRadio1"><?php echo $soal->d ?></label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
				<div class="col-xs-4">Simpan</div>
				<div class="col-xs-4">sebelum</div>
				<div class="col-xs-4">Selnajutnya</div>
			</div>
		</div>
	<?php endforeach ?>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
