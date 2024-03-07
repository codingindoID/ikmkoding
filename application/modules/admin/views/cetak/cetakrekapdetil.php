<!DOCTYPE html>
<html>

<head>
	<title>cetak rekap</title>
	<style>
		.head {
			height: 40px;
			background-color: blue;
			color: white;
			vertical-align: middle;
			text-align: center;
		}

		table {
			width: 100%;
			font-size: 15px;
			border-collapse: collapse;
		}

		td {
			padding: 8px;
			text-align: center;
		}

		th {
			font-weight: bold;
		}
	</style>
</head>

<body>
	<?php
	$unsurPelayanan = isset($unsur) ? strtoupper($unsur->keperluan) : 'PELAYANAN';

	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename= SURVEY_KEPUASAN_MASYARAKAT_PER_RESPONDEN_" . $bulan . "_" . $tahun . "_UNSUR_" . $unsurPelayanan . ".xls");
	?>

	<center>
		<strong>PENGOLAHAN SURVEY KEPUASAN MASYARAKAT PER RESPONDEN</strong><br>
		<strong>DAN PER UNSUR <?= $unsurPelayanan  ?> <?php echo $bulan != 'setahun' ? "BULAN " . strtoupper($bulan) : '' ?> TAHUN <?php echo $tahun; ?></strong>
	</center>
	<br>
	<table border="1px">
		<thead>
			<tr>
				<th rowspan="2" width="10%" height="60px">NO</th>
				<th rowspan="2" width="10%" height="60px">No.Responden</th>
				<th rowspan="2" width="10%" height="60px">Nama</th>
				<th rowspan="2" width="10%" height="60px">Tanggal Input</th>
				<th colspan="<?= count($soal) ?>">Nilai Unsur Pelayanan</th>
			</tr>
			<tr>
				<?php foreach ($soal as $soal) : ?>
					<th><?php echo $soal->kode_soal ?></th>
				<?php endforeach ?>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			foreach ($rekap as $r) : ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $r['id_responden'] ?></td>
					<td><?= $r['nama'] ?></td>
					<td><?= $r['created_date'] ?></td>
					<?php foreach ($r['jawaban'] as $j) : ?>
						<td><?= $j['jawaban'] ?></td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>

</html>