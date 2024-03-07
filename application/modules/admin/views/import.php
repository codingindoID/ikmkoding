<form action="<?php echo site_url('admin/importData') ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
	<section>
		<div class="panel">
			<div class="panel-body">
				IMPORT DATA
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="form">PILIH FILE</label>
							<input type="file" name="file" required class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div style="height: 25px;"></div>
						<button type="submit" class="btn btn-success">Import</button>
						<a href="<?= site_url('excelMaster/quis.xlsx') ?>" class="btn btn-primary">download format</a>
					</div>
				</div>

			</div>
		</div>
	</section>
</form>