<!DOCTYPE html>
<html>
<head>
	<title>Cetak Kuisioner</title>
	<style>
		table{
			border : 1px solid black;
			width: 100%;
			border-collapse: collapse;
		}

		tr{
			border : 1px solid black;
		}

		td{
			border : 1px solid black;
			padding: 5px;
		}
		p{
			font-size: 13px;
		}

		.no_border{
			border : none;
		}

		.table2{
			border : none;
		}

	</style>
</head>
<body onload="window.print()">
	<center><h5>KUESIONER SURVEI KEPUASAN MASYARAKAT (SKM) <br>
	PADA MAL PELAYANAN PUBLIK</h5></center>

	<table>
		<tr>
			<td>
				<p style="margin: 0">Tanggal : <br> 
					<?php echo date('d - m - Y', strtotime($responden->created_date)) ?>
				</p>
			</td>
			<td>
				<p style="margin: 0">
					Waktu : <br>
					<?php echo date('h : i : s ', strtotime($responden->created_date)) ?>
				</p>
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="">
				<p style="margin: 0"><strong>Jenis Layanan yang diterima : </strong> <?php echo $responden->nama_loket ?></p>
			</td>
		</tr>
		<tr>
			<td><p style="margin: 0">Jenis Kelamin : <?php echo $responden->jk ?></p> </td>
			<td><p style="margin: 0">Usia : <?php echo $responden->umur ?></p></td>
		</tr>
		<tr>
			<td colspan="2" rowspan=""><p style="margin: 0">Pendidikan : <?php echo $responden->pendidikan ?></p> </td>
		</tr>
		<tr>
			<td colspan="2" rowspan=""><p style="margin: 0">Pekerjaan : <?php echo $responden->pekerjaan ?></p></td>
		</tr>
	</table>

	<center>
		<h5><strong>PENDAPAT RESPONDEN TENTANG PELAYANAN</strong></h5>
	</center>

	<table class="table2">
		<tr>
			<td style="width: 49%; "  valign="top">
				<table style="margin: -4px">
					<?php 
					$no = 1;
					for ($i=0; $i < 7; $i++) { ?>
						<tr>
							<td style="height: 90px" valign="top">
								<p style="margin: 0; text-align: justify;">
									<strong><?php echo $no++; ?>. <?php echo $jawaban[$i]['pertanyaan'] ?></strong>
								</p>
								<p style="margin-bottom: 0; margin-top: 5px">Jawaban : <?php echo $jawaban[$i]['jawaban'] ?></p>
							</td>
						</tr>
					<?php } ?>
				</table>


			</td>
			<td class="no_border" style="width: 2%"></td>
			<td style="width: 49%; "  valign="top">
				<table style="margin: -4px">
					<?php 
					for ($i=7; $i < 14; $i++) { ?>
						<tr>
							<td style="height: 90px" valign="top">
								<p style="margin: 0; text-align: justify;">
									<strong><?php echo $no++; ?>. <?php echo $jawaban[$i]['pertanyaan'] ?></strong>
								</p>
								<p style="margin-bottom: 0; margin-top: 5px">Jawaban : <?php echo $jawaban[$i]['jawaban'] ?> </p>
							</td>
						</tr>
					<?php } ?>
				</table>

			</td>
		</tr>
		<tr>
			<td colspan="3" style="vertical-align: baseline; height: 150px">
				<p style="margin: 0"><strong>SARAN DAN MASUKAN : </strong></p>
				<p style="margin: 0"><?php echo $saran->saran ?></p>
			</td>
		</tr>
	</table>

	<p><center>--- Dicetak Dari <strong>SKMPP.Jepara.go.id</strong> ---</center></p>

	<script>
		window.onafterprint = function () {
			window.close();
		}
	</script>

</body>
</html>