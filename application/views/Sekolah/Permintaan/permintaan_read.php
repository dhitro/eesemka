<!-- Main content -->
<div class='row' style="max-width: 100% !important;">
	<div class='col-12'>
		<div class='box'>
			<div class='box-header'>

				<h2 class='box-title'>Detail Data Permintaan</h2>
				<br>
				<div class='box box-primary'>

					<div class="field-input">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<label for="id_perusahaan">Nama Perusahaan :<?php echo form_error('id_perusahaan') ?></label>
						<?php echo $id_perusahaan; ?>
					</div>
					<div class="field-input">
						<label for="id_siswa">Nama Siswa :<?php echo form_error('id_siswa') ?></label>
						<?php echo $id_siswa; ?>
					</div>
					<div class="field-input">
						<label for="keterangan">Keterangan :<?php echo form_error('keterangan') ?></label>
						<?php echo $keterangan; ?>
					</div>
					<div class="field-submit mt-3">
						<a href="#" onclick="history.back()" class="btn btn-danger">Back</a>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>