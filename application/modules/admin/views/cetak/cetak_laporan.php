<!DOCTYPE html>
<html>

<head>
	<title>Laporan</title>
	<style>
		table {
			width: 100%;
			text-align: center;
			border-collapse: collapse;
		}
	</style>
</head>

<body>
	<?php
	header("Content-Type: application/vnd.msword");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Laporan-Kepuasan-$tgl_indo-tahun-$tahun-unsur-$unsur.doc");
	?>
	<p>
	<h4>
		<center>DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) <br>
			<?php if ($tgl_indo == 'setahun') : ?>
				<span>TAHUN <?= $tahun ?></span>
			<?php else : ?>
				<span>BULAN : <?= strtoupper($tgl_indo)  ?> , TAHUN : <?= $tahun ?> </span>
			<?php endif ?>
		</center>
	</h4>
	</p>
	<p>
	<h4>Hasil Survey <br> Karakteristik Responden</h4>
	</p>
	<p>
		Dalam Survey Kepuasan Masyarakat di DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) Jepara periode Januari s/d <?= $tgl_indo . ' ' . date('Y') ?> menggunakan sampel sebanyak <?= $pengunjung ?> orang pengunjung / pengguna layanan dan dari <?= $pengunjung ?> kuesioner yang disediakan semuanya kembali dengan jawaban lengkap dan layak untuk digunakan analisis.
	</p>
	<p>
		Berikut ini dipaparkan karakteristik responden secara umum menurut umur, dan jenis kelamin dan mata pencaharian di DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) Jepara
	</p>
	<p>
	<ol type="a">
		<li>Karakteristik Responden Berdasarkan Kelompok Umur</li>
		<p>Karakteristik responden yang menjadi subyek dalam penelitian ini menurut umur dibagi berdasarkan nilai mean yaitu 3.49. Hal ini dapat ditunjukkan dalam tabel berikut : </p>
		<p>Tabel Karakteristik Responden Berdasarkan Umur</p>
		<p>
		<table border="1px">
			<thead>
				<tr>
					<th>Umur</th>
					<th>Jumlah</th>
					<th>Presentase (%)</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$umursum = 0;
				$presentase = 0;
				foreach ($umur as $um) : ?>
					<tr>
						<td><?= $um['index'] ?></td>
						<td><?= $um['jumlah'] ?></td>
						<td><?= $um['presentase'] ?> %</td>
					</tr>

				<?php
					$umursum 	+= $um['jumlah'];
					$presentase += $um['presentase'];
				endforeach ?>
				<tr>
					<td><strong>Total</strong></td>
					<td><strong><?= $umursum; ?></strong></td>
					<td><strong><?= $presentase; ?> % </strong></td>
				</tr>
			</tbody>
		</table>
		</p>
		<p>
			Berdasarkan tabel di atas dapat diketahui kelompok umur dibawah 40 tahun sebanyak <?= $umur['up40']['jumlah'] ?> orang (<?= $umur['up40']['presentase'] ?>%) dan di atas sama dengan 40 tahun sebanyak <?= $umur['min40']['jumlah'] ?> orang (<?= $umur['min40']['presentase'] ?>%)
		</p>
		<li>Karakteristik Responden Berdasarkan Jenis Kelamin</li>
		<p>
			Karakteristik responden pada penelitian ini menurut jenis kelamin dapat diketahui berdasarkan tabel sebagai berikut :
		</p>
		<p>Tabel Karakteristik Responden Berdasarkan Jenis Kelamin</p>
		<p>
		<table border="1px">
			<thead>
				<tr>
					<th>Jenis Kelamin</th>
					<th>Jumlah</th>
					<th>Presentase (%)</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sumjk	= 0;
				$presentasejk = 0;
				foreach ($jk as $j) : ?>
					<tr>
						<td><?= $j['jk'] ?></td>
						<td><?= $j['jumlah'] ?></td>
						<td><?= $j['presentase'] ?></td>
					</tr>
				<?php
					$sumjk += $j['jumlah'];
					$presentasejk += $j['presentase'];
				endforeach ?>
				<tr>
					<td><strong>Total</strong></td>
					<td><strong><?= $sumjk; ?></strong></td>
					<td><strong><?= $presentasejk; ?> % </strong></td>
				</tr>
			</tbody>
		</table>
		</p>
		<p>
			Berdasarkan tabel diatas menunjukkan bahwa responden yang berjenis kelamin laki-laki sebanyak <?= $jk['laki']['jumlah'] ?> orang (<?= $jk['laki']['presentase'] ?>%), dan yang berjenis kelamin perempuan sebanyak <?= $jk['pr']['jumlah'] ?> orang ( <?= $jk['pr']['presentase'] ?>%)
		</p>
	</ol>
	</p>

	<p>
	<h4>Deskripsi Jawaban Responden</h4>
	</p>
	<p>Berikut ini disajikan tabel nilai rata-rata unsur pelayanan hasil pengisian kuesioner yang dilakukan oleh responden di DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) Jepara.</p>
	<p>Tabel Nilai Rata-Rata Unsur Pelayanan di DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) Jepara Tahun <?= date('Y') ?></p>
	<p>
	<table border="1px">
		<thead>
			<tr>
				<th colspan="2">Unsur SKM</th>
				<th><?= date('Y') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($hasil as $h) : ?>
				<tr>
					<td><strong><?= $h['kode_soal'] ?></strong></td>
					<td><?= $h['kategori'] ?></td>
					<td><?= number_format($h['kepuasan'], 2) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	</p>
	<?php
	if ($kepuasan > 88.31) {
		$mutu = 'A';
		$index = "Sangat Baik";
	} else if ($kepuasan > 76.61) {
		$mutu = 'B';
		$index = 'Baik';
	} else if ($kepuasan > 65.00) {
		$mutu = 'C';
		$index = 'Kurang Baik';
	} else if ($kepuasan > 25.00) {
		$mutu = 'D';
		$index = 'Tidak Baik';
	} else {
		$mutu = null;
		$index = null;
	}
	?>

	<p>
		Dari nilai rata-rata yang ada maka dapat ditarik kesimpulan nilai SKM yang diperoleh adalah <b><?= number_format($kepuasan, 2) ?> %</b> <br>
		Sehingga dapat diperoleh hasil sebagai berikut : <br>
		Mutu pelayanan <strong><?= $index ?></strong> <br>
		Kinerja unit pelayanan <strong><?= $mutu ?></strong>
	</p>
	<h4>Analisis</h4>
	<p>
		Dari tabel dapat dilihat bahwa dengan nilai SKM <b><?= number_format($kepuasan, 2) ?></b> disimpulkan bahwa Kategorisasi Mutu Pelayanan <b>"<?= $mutu ?>"</b> dan Kinerja Unit Pelayanan adalah <b><?= $index ?></b>. Jika dilihat dari Nilai Rata-Rata (NRR) unsur pelayanan, unsur yang memiliki nilai tertinggi adalah unsur <b>"<?= $max['kategori'] ?>" (NRR <?= number_format($max['kepuasan'], 2) ?>)</b>, sedangkan unsur dengan Nilai Rata-Rata terendah adalah unsur <b>"<?= $min['kategori']  ?>" (NRR <?= number_format($min['kepuasan'], 2) ?>)</b>. Angka ini menunjukkan bahwa tingkat pelayanan paling tinggi diperoleh dari <strong><?= $max['kategori'] ?></strong>, sedangkan tingkat kepuasan paling rendah berada pada unsur <strong><?= $min['kategori'] ?></strong>.
	</p>
	<p>Secara umum capaian di DINAS PENANAMAN MODAL & PELAYANAN TERPADU SATU PINTU (DPMPTSP) Jepara ditingkatkan sebagai berikut:</p>
	<p>
	<table border="1px">
		<thead>
			<tr>
				<th>No</th>
				<th>Unsur SKM</th>
				<th>Nilai Rata - rata</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$x = 'a';
			foreach ($prioritas as $h) : ?>
				<tr>
					<td><strong><?= $x++ ?></strong></td>
					<td><?= $h['kategori'] ?></td>
					<td><?= number_format($h['kepuasan'], 4) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	</p>
	<h4>
		<p>Permasalahan yang dihadapi :</p>

		<p>
			Solusi yang diharapkan :
		</p>
		<p>
			Persentase Survey Responden Terhadap Kelompok Pelayanan :
		</p>
	</h4>
</body>

</html>