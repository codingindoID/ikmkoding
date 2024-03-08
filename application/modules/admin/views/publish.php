<style>
	table {
		font-size: 15px;
	}
</style>
<div class="box">
	<div class="box-header">
		<div class="form-group row">
			<div class="col-sm-3 col-xs-12 text-right" style="margin-top: 0.3em">
				<select name="bulan" id="bulan_filter" onchange="filterPublish(this)" class="form-control" required>
					<option value="">Setahun</option>
					<?php foreach ($bulan as $b) : ?>
						<option <?= $f_bulan == $b->id_bulan ? 'selected' : '' ?> value="<?= $b->id_bulan ?>"><?= $b->bulan ?></option>}
					<?php endforeach ?>
				</select>
			</div>
			<div class="col-sm-3 col-xs-12 text-right" style="margin-top: 0.3em">
				<select name="tahun" id="tahun_filter" onchange="filterPublish(this)" class="form-control" required>
					<option value="">Tahun..</option>
					<?php foreach ($tahun as $t) : ?>
						<option <?= $f_tahun == $t->tahun ? 'selected' : '' ?> value="<?= $t->tahun ?>"><?= $t->tahun ?></option>}
					<?php endforeach ?>
				</select>
			</div>
			<div class="col-sm-3 col-xs-12 text-right" style="margin-top: 0.3em">
				<select name="tahun" id="unsur" onchange="filterPublish(this)" class="form-control" required>
					<option value="<?= KODEPELAYANAN ?>" <?= $unsur == KODEPELAYANAN ? 'selected' : '' ?>>PELAYANAN</option>
					<option value="<?= KODEKPK ?>" <?= $unsur == KODEKPK ? 'selected' : '' ?>>KPK</option>
				</select>
			</div>
		</div>
	</div>
	<div class="box-body">
		<table class="table" id="responden">
			<thead>
				<tr>
					<th class="text-center">No</th>
					<th class="text-center">id responden</th>
					<th class="text-center">Tanggal Mengisi</th>
					<th class="text-center">TimeStamp</th>
					<th class="text-center">Score Rata-rata</th>
					<th class="text-center">#</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($rekap as $data) : ?>
					<tr>
						<td class="text-center"><?= $no++; ?></td>
						<td><strong><?= $data->id_responden ?></strong></td>
						<td class="text-center"><?= date('Y-m-d', strtotime($data->tanggal_mengisi)) ?></td>
						<td class="text-center"><?= date('H:i:s', strtotime($data->tanggal_mengisi)) ?></td>
						<td class="text-center"><?= number_format(($data->total_nilai / $total_soal), 2) ?></td>
						<td class="text-center"><a href="<?= site_url('admin/detil/') . $data->id_responden . '/' . $data->jenis_pertanyaan ?>" class="btn-sm btn-warning" title="detil"><i class="fa fa-eye"></i></a></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	function filterPublish() {
		let baseurl = $('#base_url').data('id')
		let bulan = $('#bulan_filter').val();
		let unsur = $('#unsur').val();
		let tahun = $('#tahun_filter').val();
		bulan = bulan ? bulan : 'setahun';
		location.href = `${baseurl}admin/publish/${bulan}/${tahun}/?unsur=${unsur}`
	}
</script>