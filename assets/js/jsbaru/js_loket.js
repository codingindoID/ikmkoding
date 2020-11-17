$(document).on('click', '.modal_edit', function(event) {
	var id 	= $(this).data('id')
	var base = $('#base').val()

	$('input[name="id_loket"]').val(id)

	$.ajax({
		url:base+'admin/detil_loket/'+id,
		type: 'get',
		dataType: 'json',
	})
	.done(function(data) {
		$('input[name="nama_loket"]').val(data.nama_loket)
	})
	.fail(function(data) {
		alert("error");
	});

	$('#btn_hapus').click(function(event) {
		var result = confirm('Anda Akan Menghapus Data Ini? Semua data Statistik Terkait akan terhapus..')
		if (result == true) {
			location.href = base + "admin/hapus_loket/"+id
		}
	});
});