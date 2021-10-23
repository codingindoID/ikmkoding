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
	<table class="table table-hover" style="font-size: 1.4rem;">
		<tr>
			<td>TOTAL RESPONDEN</td>
			<td><?php echo $total_responden ?></td>
		</tr>
		<tr>
			<th class="text-center" width="10%">#</th>
			<th class="text-center" width="40%">Nama Loket</th>
			<th class="text-center" width="20%">Jumlah Responden ( orang )</th>
			<th class="text-center" width="20%">Jumlah Responden ( % )</th>
			<th class="text-center" width="30%">Kepuasan</th>
		</tr>
		<?php 
		$no = 1;
		foreach ($loket as $l): ?>
			<tr>
				<td class="text-center"><?php echo $no++ ?></td>
				<td ><?php echo $l['jenis_layanan'] ?></td>
				<td class="text-center"><?php echo $l['jumlah_responden'] != 0 ? '<b class="text-danger text-bold">'.$l['jumlah_responden'].'</b>' : '-' ?></td>
				<td class="text-center"><?php echo $l['persen'] != 0 ? '<b class="text-danger text-bold">'.number_format($l['persen'],2).'</b>' : '-' ?></td>
				<td class="text-center" style="font-weight: bold;"><?php echo $l['kepuasan'] != 0 ? number_format($l['kepuasan'],2) : '-' ?> </td>
			</tr>
		<?php endforeach ?>
	</table>
</body>
</html>


