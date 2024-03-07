<section class="content">
	<div class="row">
		<div class="panel">
			<div class="panel-header" style="padding: 0.8em">
				<div class="row" style="margin-right: 1em">
					<div class="col-md-6">
						<a href="#" id="btnCetakLaporanLoket" class="btn-sm btn-success"><i class="fa fa-print"></i> export Excel</a>
					</div>
					<div class="col-md-3 col-xs-12 text-right" style="margin-top: 0.4em">
						<select id="bulan_loket" name="bulan" class="form-control" required onchange="filterLoket()">
							<option value="setahun">Setahun</option>
							<?php foreach ($bulan as $b) : ?>
								<option <?php echo $f_bulan == $b->id_bulan ? 'selected' : '' ?> value="<?php echo $b->id_bulan ?>"><?php echo $b->bulan ?></option>}
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-md-3 col-xs-12 text-right" style="margin-top: 0.4em">
						<select id="tahun_loket" name="bulan" class="form-control" required onchange="filterLoket()">
							<option value="">Tahun..</option>
							<?php foreach ($tahun as $t) : ?>
								<option <?php echo $f_tahun == $t->tahun ? 'selected' : '' ?> value="<?php echo $t->tahun ?>"><?php echo $t->tahun ?></option>}
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<div class="card card-body text-center bg-info" style="padding: 10px;">
							<h3 style="margin-top: 1em;margin-bottom: 0;">Total Responden</h3>
							<h2 style="margin-top: 0;margin-bottom: 1em;"><?= $total_responden ?></h2>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card card-body text-center bg-primary" style="padding: 10px;">
							<h3 style="margin-top: 1em;margin-bottom: 0;">Responden Lainnya</h3>
							<h2 style="margin-top: 0;margin-bottom: 1em;"><?= $loket_lainnya ?></h2>
						</div>
					</div>
				</div>
				<hr>
				<div class="table-responsive">
					<table class="table table-hover" id="responden" style="font-size: 1.4rem;">
						<thead>
							<tr>
								<th class="text-center" width="10%">#</th>
								<th class="text-center" width="40%">Nama Loket</th>
								<th class="text-center" width="20%">Jumlah Responden</th>
								<th class="text-center" width="30%">Kepuasan</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($loket as $l) : ?>
								<tr>
									<td class="text-center"><?php echo $no++ ?></td>
									<td><a title="Edit Data" class="modal_edit" href="#modal_edit" data-toggle="modal" data-id="<?php echo $l['id_loket'] ?>" style="color: black;"><?php echo $l['jenis_layanan'] ?></a></td>
									<td class="text-right"><?php echo $l['jumlah_responden'] != 0 ? '<b class="text-danger text-bold">' . $l['jumlah_responden'] . '</b> orang ( <b class="text-danger text-bold">' . number_format($l['persen'], 2) . '</b> %)' : '-' ?></td>
									<td class="text-center" style="font-weight: bold;"><?php echo $l['kepuasan'] != 0 ? number_format($l['kepuasan'], 2) . "%" : '-' ?> </td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	let base = $("#base").val();
	/*FILTER LOKET*/
	function filterLoket() {
		let bulan = $("#bulan_loket").val();
		let tahun = $("#tahun_loket").val();

		if (bulan == "" || tahun == "") {
			Swal.fire({
				icon: "error",
				title: "Oops...",
				text: "Parameter Belum Diisi!",
				footer: "silahkan isi kolom bulan dan tahun",
			});
		} else {
			location.href = base + "loket/index/" + bulan + "/" + tahun;
		}
	}

	$("#btnCetakLaporanLoket").click(function(event) {
		let bulan = $("#bulan_loket").val();
		let tahun = $("#tahun_loket").val();

		if (bulan == "" || tahun == "") {
			Swal.fire({
				icon: "error",
				title: "Oops...",
				text: "Parameter Belum Diisi!",
				footer: "silahkan isi kolom bulan dan tahun",
			});
		} else {
			location.href = base + "loket/index/" + bulan + "/" + tahun + "/cetak";
		}
	});
</script>