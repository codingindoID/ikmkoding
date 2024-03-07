<style>
	.head {
		height: 40px;
		vertical-align: middle;
		background-color: #f6f6f6;
		text-align: center;
	}

	table {
		font-size: 15px;
	}

	td {
		padding: 8px;
	}

	a {
		color: black;
	}
</style>
<div class="col-12">
	<div class="box">
		<div class="box-header" style="cursor: pointer;">
			<h3 class="box-title"><strong>Daftar Pertanyaan</strong></h3>

			<a onclick="modalPertanyaan(this)" data-id="" class="btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Soal</a>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="box-body" style="padding: 20px;">
			<table border="1px" width="100%">
				<thead>
					<tr class="head">
						<th class="text-center" width="5%">No</th>
						<th class="text-center">Jenis Pertanyaan</th>
						<th class="text-center">Kategori</th>
						<th class="text-center" width="60%">Pertanyaan</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<?php
				foreach ($soal as $soal) : ?>
					<tr>
						<td class="text-center"><?php echo $soal->id_soal ?></td>
						<td><?php echo $soal->keperluan ?></td>
						<td><?php echo $soal->kategori ?></td>
						<td style="word-wrap: break-word;"><?php echo $soal->soal ?></td>
						<td class="text-center">
							<span class="btn btn-sm btn-success" onclick="modalPertanyaan(this)" data-id="<?= $soal->id_soal ?>">EDIT</span>
							<a onclick="return confirm('HAPUS PERTANYAAN?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/hapuspertanyaan/') . $soal->id_soal ?>">HAPUS</a>
						</td>
					</tr>
				<?php endforeach ?>

			</table>
		</div>
		<div class=" box-footer">
		</div>
	</div>
	<!-- end box -->
</div>

<!-- Modal edit -->
<form method="post" action="<?php echo site_url('admin/simpanPertanyaan') ?>">
	<div class="modal fade" id="modal_pertanyaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<input type="hidden" id="base" value="<?php echo site_url() ?>">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-blue">
					<h5 class="modal-title" id="exampleModalLongTitle">Edit <strong>(Pertanyaan)</strong></h5>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id_soal" value="">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="staticEmail" class="col-form-label">Jenis Pertanyaan</label>
								<select class="form-control" name="jenis_pertanyaan" id="jenis_pertanyaan">
									<option value=""> -- PILIH -- </option>
									<?php foreach ($jenis as $var) : ?>
										<option value="<?= $var->id_jenispertanyaan ?>"> <?= $var->keperluan ?> </option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="staticEmail" class="col-form-label">Kode Soal</label>
								<input id="kode_soal" name="kode_soal" rows="3" class="form-control" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="staticEmail" class="col-form-label">Kategori</label>
								<input id="kategori" name="kategori" rows="3" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Pertanyaan</label>
						<textarea name="soal" id="soal" rows="3" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<a style="float: left" id="btn_hapus" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> tutup</a>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	function modalPertanyaan(ctx) {
		var id = $(ctx).data('id')
		var base = $('#base').val()
		$('#jenis_pertanyaan').val("")
		$('#kategori').val("")
		$('#kode_soal').val("")
		$('#soal').text("")

		$('input[name="id_soal"]').val(id)
		if (id != "") {
			$.ajax({
					url: base + 'admin/detilpertanyaan/' + id,
					type: 'get',
					dataType: 'json',
				})
				.done(function(data) {
					$('#jenis_pertanyaan').val(data.jenis_pertanyaan)
					$('#kategori').val(data.kategori)
					$('#kode_soal').val(data.kode_soal)
					$('#soal').text(data.soal)
				})
				.fail(function(data) {
					console.log("error");
				});
		}
		$('#modal_pertanyaan').modal('show')

	}
</script>