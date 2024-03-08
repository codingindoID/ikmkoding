<div class="box">
	<div class="box-header">
		<i class="ion ion-clipboard"></i>
		<h3 class="box-title">
			Detil Jawaban
		</h3>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table" style="font-size: 15px;">
				<thead>
					<tr>
						<th width="10%">Kode</th>
						<th>Pertanyaan</th>
						<th width="10%" class="text-center">Bobot Jawaban</th>
					</tr>
				</thead>
				<?php
				$countSoal = count($rekap);
				?>
				<tbody>
					<?php
					$n = 0;
					$no = 1;
					foreach ($rekap as $v) :
						$id_responden = $v->id_responden; ?>
						<tr>
							<td><?= $no++ ?></td>
							<td style="word-wrap: break-word;"><?= $v->soal ?></td>
							<td class="text-center"><?= $v->jawaban ?></td>
						</tr>

					<?php
						$n += $v->jawaban;
					endforeach ?>
					<tr>
						<td colspan="2" class="text-center"><strong>Rata - Rata</strong></td>
						<td class="text-center"><strong><?= number_format(($n / $countSoal), 2) ?></strong></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box-footer">
		<div style="float: right; margin-right: 15px;">
			<a href="<?= base_url('admin/publish') ?>" class="btn btn-warning"> Kembali</a>
			<a onclick="return confirm('PUBLISH JAWABAN?')" href="<?= site_url('admin/aksipublish/') . $id_responden . '/' . $rekap[0]->jenis_pertanyaan ?>" class="btn btn-success"><i class="fa fa-send"></i>publish</a>
		</div>
	</div>
</div>