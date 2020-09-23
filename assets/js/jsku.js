var base = document.getElementById('base').value;
var nsoal = document.getElementById('n_soal').value;

/*button*/
var lanjut = document.getElementById('lanjut');
var selesai = document.getElementById('selesai');

/*deklarasi variable*/
var id_soal 	= document.getElementById('id_soal');
var idreg 		= document.getElementById('noreg');

/*label untuk checkbox*/
var a 			= document.getElementById('a');
var b 			= document.getElementById('b');
var c 			= document.getElementById('c');
var d 			= document.getElementById('d');

/*event klik save / lanjut*/
var no = 1;
lanjut.addEventListener('click', function(){
	jawaban();
	soal();
	
}, false);


/*menampilkan soal*/
function soal(){
	$.ajax({
		url: base+"tes2/get_soal/"+ no++,
		type: 'get',
		dataType: 'json'
	})
	.done(function(data) {
		id_soal.value = data['id_soal'];
		pertanyaan.innerHTML = data['soal'];
		a.innerHTML = data['a'];
		b.innerHTML = data['b'];
		c.innerHTML = data['c'];
		d.innerHTML = data['d'];

		/*reset checkbox*/
		["c1", "c2", "c3", "c4"].forEach(function(id) {
			document.getElementById(id).checked = false;
		});
	})
	.fail(function(data) {
		Swal.fire({
			title: 'Terimakasih',
			text: "Anda Sudah Berpartisipasi,.",
			icon: 'success',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'Tutup'
		}).then((result) => {
			if (result.isConfirmed) {
				location.href = "index";
			}
		})

	});
}

/*post jawaban*/
function jawaban(){
	var jawaban = document.querySelector('input[type=radio][name=pilihan]:checked').value;
	var data = {
		"id_soal"		: id_soal.value,
		"id_responden"	: idreg.value,
		"jawaban"		: jawaban
	}

	$.ajax({
		url: base+'/tes2/jawaban',
		type: 'post',
		dataType: 'json',
		data: data,
	})
	.done(function(data) {
		console.log(data);
	})
	.fail(function(data) {
		console.log(data);
	});

}