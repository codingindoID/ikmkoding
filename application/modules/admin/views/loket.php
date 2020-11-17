<section class="content">
	<div class="row">
		<div class="panel">
			<div class="panel-body">
				<!-- <a  href="#" class="btn-sm btn-success " ><i class="fa fa-user-circle"></i> Tambah Loket</a> -->
				<table class="table table-hover" style="font-size: 13px; margin-top: 5%;">
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
						foreach ($loket as $loket): ?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td ><?php echo $loket['nama_loket'] ?></td>
								<td class="text-center"><?php echo $loket['responden'] ?></td>
								<td class="text-center" style="font-weight: bold;"><?php echo number_format($loket['nilai'],2) ?> %</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>