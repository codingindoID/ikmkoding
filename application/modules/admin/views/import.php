<form action="<?php echo site_url('admin/importaction') ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
	<section>
		<div class="panel">
			<div class="panel-body">
				Import JAWABAN
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
						<a href="#" class="btn btn-primary">download format</a>
					</div>
				</div>

			</div>
		</div>
	</section>
</form>

<form action="<?php echo site_url('admin/importResponden') ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
	<section>
		<div class="panel">
			<div class="panel-body">
				Import RESPONDEN
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
						<a href="#" class="btn btn-primary">download format</a>
					</div>
				</div>

			</div>
		</div>
	</section>
</form>