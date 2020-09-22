<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/' ?>bootstrap.min.css">

	<title>Hello, world!</title>
</head>
<body>
	<div class="container">
		<input type="hidden" id="base" value="<?php echo site_url() ?>">
		<input type="hidden" name="noreg" value="<?php echo $noreg ?>">
		<input type="hidden" id="n_soal" value="<?php echo $nsoal ?>">
		<input id="id_soal" value="<?php echo $soal[0]->id_soal ?>">
		<p id="pertanyaan"><?php echo $soal[0]->soal ?></p>
		<div class="row">
			<div class="col">
				<div class="form-check form-check-inline">
					<input required class="form-check-input" type="radio" name="pilihan" id="c1" value="a">
					<label class="form-check-label" for="inlineRadio1" id="a">a</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pilihan" id="c2" value="b">
					<label class="form-check-label" for="inlineRadio1" id="b">b</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pilihan" id="c3" value="c">
					<label class="form-check-label" for="inlineRadio1" id="c">c</label>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pilihan" id="c4" value="d">
					<label class="form-check-label" for="inlineRadio1" id="d">d</label>
				</div>
			</div>
		</div>
		<button id="tampil" class="btn btn-success">tampil</button>
		<button id="lanjut" class="btn btn-success">simpan</button>
		<button id="selesai" hidden="true" class="btn btn-success">selesai</button>
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?php echo base_url().'assets/js' ?>/jquery.min.js"></script>
	<script>
		$(function() {
			var base = document.getElementById('base').value;
			var nsoal = document.getElementById('n_soal').value;

			//button
			var lanjut = document.getElementById('lanjut');
			var selesai = document.getElementById('selesai');

			//pertanyaan
			var id_soal 	= document.getElementById('id_soal');
			var jawaban		= document.getElementsByName('pilihan');
			var pertanyaan 	= document.getElementById('pertanyaan');
			var a 			= document.getElementById('a');
			var b 			= document.getElementById('b');
			var c 			= document.getElementById('c');
			var d 			= document.getElementById('d');

			var no = 1;
			lanjut.addEventListener('click', function(){
				$.ajax({
					url: base+"tes2/get_soal/"+ no++,
					type: 'get',
					dataType: 'json'
				})
				.done(function(data) {
					var isian = {
					"id_soal" : id_soal.value,
					"jawaban" : jawaban.value
					};

					console.log(jawaban.value);

					//set jawaban next
					id_soal.value = data['id_soal'];
					pertanyaan.innerHTML = data['soal'];
					a.innerHTML = data['a'];
					b.innerHTML = data['b'];
					c.innerHTML = data['c'];
					d.innerHTML = data['d'];


					//reset checkbox
					["c1", "c2", "c3", "c4"].forEach(function(id) {
						document.getElementById(id).checked = false;
					});
				})
				.fail(function(data) {
					console.log("error");
				});

			}, false);

		/*$.ajax({
			url: base+"tes2/get_soal/"+2,
			type: 'get',
			dataType: 'json'
		})
		.done(function(data) {
			console.log(data);
		})
		.fail(function(data) {
			console.log("error");
		});*/
		
	});
</script>

</body>
</html>

