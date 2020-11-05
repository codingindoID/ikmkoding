<style>
	.head{
		height: 40px;
		background-color: blue;
		color: white;
		vertical-align: middle;
		text-align: center;
	}
	table{
		width: 100%;
		font-size: 15px;
	}

	td{
		padding: 8px;
	}
</style>
<div>
	<div class="box" >
		<div class="box-header">
			<span style="font-size: 18px; margin-right: 15px;"><strong>Rekap Saran</strong></span>
			<a href="<?php echo site_url('admin/cetaksaran') ?>" target="_blank" title="" class="btn-sm btn-success"><i class="fa fa-print"></i> Cetak</a>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="box-body" style="padding: 20px;">
			<table border="1px" id="responden">
				<thead>
					<tr class="head">
						<th class="text-center" width="5%">No</th>
						<th class="text-center"  width="30%">ID Responden</th>
						<th class="text-center" width="65%">Saran</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach ($rekap as $saran): ?>
						<tr>
							<td class="text-center"><?php echo  $no++ ?></td>
							<td class="text-center"><?php echo  $saran->id_responden ?></td>
							<td style="word-wrap: break-word;"><?php echo  $saran->saran ?></td>
						</tr>	
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="box-footer"></div>
	</div>
	<!-- end box -->
</div>

