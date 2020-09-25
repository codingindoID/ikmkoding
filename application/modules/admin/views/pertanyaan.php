<div class="col-12">
	<div class="box" >
		<div class="box-header"></div>
		<div class="box-body" style="padding: 20px;">
			<table class="table table-striped table-responsive" >
				<thead>
					<tr>
						<th width="2%">No</th>
						<th width="60%">Pertanyaan</th>
						<th>Jawaban</th>
						<th width="5%" class="text-center">Point</th>
					</tr>
				</thead>
				<?php 
				$no = 1;
				foreach ($soal as $soal): ?>
					<tr>
						<td rowspan="4"><?php echo $no++ ?></td>
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

