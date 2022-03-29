<style>
	table {
		font-size: 15px;
	}
</style>
<div class="box">
	<div class="box-body">
		<input type="hidden" id="base" value="<?php echo site_url() ?>">
		<div class="table-responsive">
			<div class="row" style="margin-bottom: 1em;">
				<div class="col-md-3">
					<select id="bulanPublish" name="bulan" class="form-control" required>
						<option value="">Bulan..</option>
						<?php $bulanOpsi = $this->db->get('bulan')->result(); ?>
						<?php foreach ($bulanOpsi as $b) : ?>
							<option <?php echo $bulan == $b->id_bulan ? 'selected' : '' ?> value="<?php echo $b->id_bulan ?>"><?php echo $b->bulan ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-md-3">
					<select id="tahunPublish" name="tahun" class="form-control" required>
						<option value="">Tahun..</option>
						<?php $tahunOpsi = $this->db->get('tahun')->result(); ?>
						<?php foreach ($tahunOpsi as $t) : ?>
							<option <?php echo $tahun == $t->tahun ? 'selected' : '' ?> value="<?php echo $t->tahun ?>"><?php echo $t->tahun ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-sm-3 col-xs-12">
					<button id="btn_filter_publish" class="btn bg-purple"><i class="fa fa-filter"></i> Filter</button>
				</div>
			</div>
			<table class="table" id="responden">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">id responden</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Tanggal Mengisi</th>
						<th class="text-center">TimeStamp</th>
						<th class="text-center">Score Rata-rata</th>
						<th class="text-center">#</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($rekap as $data) : ?>
						<tr id="tr_<?= $data['id_responden']  ?>">
							<td class="text-center"><?php echo $no++; ?></td>
							<td><strong><?php echo $data['id_responden'] ?></strong></td>
							<td><strong><?php echo $data['nama_responden'] ?></strong></td>
							<td class="text-center"><?php echo $data['tanggal'] ?></td>
							<td class="text-center"><?php echo $data['jam_isi'] ?></td>
							<td class="text-center"><?php echo $data['rata'] ?></td>
							<td class="text-center">
								<div class="btn-group" role="group" aria-label="Basic example">
									<a href="#" onclick="getFrame('<?= $data['id_responden'] ?>')" data-toggle="modal" data-target="#modalPublish" class="btn-sm btn-warning" title="detil">Lihat<i class="fa fa-eye"></i></a>
									<a href="#" class="btn-sm btn-danger" title="detil" onclick="hapusPilihan('<?= $data['id_responden'] ?>')"><i class="fa fa-trash"></i>hapus</a>
								</div>
							</td>
							<!-- <td class="text-center"><a data-target="modal" href="<?php echo site_url('admin/detil/') . $data['id_responden'] ?>" class="btn-sm btn-warning" title="detil"><i class="fa fa-eye"></i></a></td> -->
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="modalPublish" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<iframe src="" frameborder="0" id="frameDetil" style="width:100%; height:60vh; overflow: hidden !important;" scrolling="no"></iframe>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-6">
						<input type="hidden" id="bantuPublish">
						<button class="btn btn-success" id="btn-publish" onclick="publish()">Publish</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	$(document).ready(function() {
		var base = $('#base').val()
		$('#btn_filter_publish').click(function(e) {
			var bulan = $('#bulanPublish').val()
			var tahun = $('#tahunPublish').val()
			if (tahun != '' && bulan != '') {
				location.href = base + 'admin/publish/' + bulan + '/' + tahun
			}
		});
	});

	function getFrame(id) {
		var base = $('#base').val()
		$('#frameDetil').attr('src', base + "admin/detil2/" + id)
		$('#bantuPublish').val(id)
	}

	function hapusPilihan(id) {
		var base = $('#base').val()
		var res = confirm('hapus data?')

		if (res) {
			$.ajax({
				type: "post",
				url: base + "admin/hapusUnPublish/" + id,
				dataType: "json",
				success: function(response) {
					$('#tr_' + id).remove()
				}
			});
		}
	}

	function publish(id) {
		var base = $('#base').val()
		var id_responden = $('#bantuPublish').val()
		$.ajax({
			type: "post",
			url: base + "admin/aksiPublish/" + id_responden,
			dataType: "json",
			success: function(response) {
				$('#tr_' + id_responden).remove()
				$('#modalPublish').modal('hide')
			}
		});
	}
</script>