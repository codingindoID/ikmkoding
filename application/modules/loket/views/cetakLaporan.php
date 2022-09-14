<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cetak Laporan</title>
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename= Rekap Kuisioner Berdasarkan Loket Pelayanan.xls");
	?>

</head>

<body>
	<table style="font-size: 1.4rem;" border="1px">
		<tr>
			<td colspan="5" style="text-align: center;">
				Rekap Kepuasan berdasarkan Loket
				<br> Bulan : <b><?= $f_bulan ?> </b> Tahun <b><?= $f_tahun ?></b>
			</td>
		</tr>
		<tr>
			<td>TOTAL RESPONDEN</td>
			<td style="text-align: left; font-weight: bold;"><?php echo $total_responden ?></td>
		</tr>
		<tr>
			<th style="background-color: green ; color: white;" width="10%">#</th>
			<th style="background-color: green ; color: white;" width="40%">Nama Loket</th>
			<th style="background-color: green ; color: white;" width="20%">Jumlah Responden ( orang )</th>
			<th style="background-color: green ; color: white;" width="20%">Persentase Dari Total</th>
			<th style="background-color: green ; color: white;" width="30%">Kepuasan</th>
		</tr>
		<?php
		$no = 1;
		foreach ($loket as $l) : ?>
			<tr>
				<td class="text-center"><?php echo $no++ ?></td>
				<td><?php echo $l['jenis_layanan'] ?></td>
				<td style="text-align: right;"><?php echo $l['jumlah_responden'] != 0 ? '<b class="text-danger text-bold">' . $l['jumlah_responden'] . '</b>' : '-' ?></td>
				<td style="text-align: right;"><?php echo $l['persen'] != 0 ? '<b class="text-danger text-bold">' . number_format($l['persen'], 2) . '</b>' : '-' ?></td>
				<td style="font-weight: bold;text-align: right;"><?php echo $l['kepuasan'] != 0 ? number_format($l['kepuasan'], 2) : '-' ?> </td>
			</tr>
		<?php endforeach ?>
	</table>
</body>

</html>