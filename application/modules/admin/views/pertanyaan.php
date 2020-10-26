<style>
	.head{
		height: 40px;
		background-color: blue;
		color: white;
		vertical-align: middle;
		text-align: center;
	}
	table{
		font-size: 15px;
	}

	td{
		padding: 8px;
	}
</style>
<div class="col-12">
	<div class="box" >
		<div class="box-header"  data-widget="collapse" style="cursor: pointer;">
			<h3 class="box-title"><strong>Daftar Pertanyaan</strong></h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="box-body" style="padding: 20px;">
			<table border="1px">
				<thead>
					<tr class="head">
						<th class="text-center" width="5%">No</th>
						<th class="text-center"  width="60%">Pertanyaan</th>
						<th class="text-center" >Jawaban</th>
						<th class="text-center"  width="5%">Point</th>
					</tr>
				</thead>
				<?php 
				$no = 1;
				foreach ($soal as $soal): ?>
					<tr>
						<td rowspan="4" class="text-center"><?php echo $no++ ?></td>
						<td rowspan="4" style="word-wrap: break-word;"><?php echo $soal->soal ?></td>
						<td><?php echo $soal->a ?></td>
						<td class="text-center">1</td>
					</tr>
					<tr>
						<td><?php echo $soal->b ?></td>
						<td class="text-center">2</td>
					</tr>
					<tr>
						<td><?php echo $soal->c ?></td>
						<td class="text-center">3</td>
					</tr>
					<tr>
						<td><?php echo $soal->d ?></td>
						<td class="text-center">4</td>
					</tr>
				<?php endforeach ?>
				
			</table>
		</div>
		<div class="box-footer"></div>
	</div>
	<!-- end box -->
</div>

