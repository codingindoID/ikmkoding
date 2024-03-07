<?php
$form = $jenis == 'countHasil' ? 'admin/helperAuto' : 'admin/helperRekapHasil';

?>
<form action="<?= site_url($form) ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
	<section>
		<div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="form">TENTUKAN TAHUN YANG AKAN DIPROSES</label>
							<select name="tahun" class="form-control">
								<option value="">--PILIH TAHUN--</option>
								<?php foreach ($tahun as $var) : ?>
									<option value="<?= $var->tahun ?>"><?= $var->tahun ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div style="height: 25px;"></div>
						<button type="submit" class="btn btn-success" onclick="return confirm('PROSES AUTOMATION?')">PROSES</button>
					</div>
				</div>

			</div>
		</div>
	</section>
</form>