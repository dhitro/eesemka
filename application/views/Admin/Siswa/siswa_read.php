<!-- Main content -->
<div class='row' style="max-width: 100% !important;">
  <div class='col-12'>
    <div class='box'>
      <div class='box-header'>

        <h2 class='box-title'>Detail Data Sekolah</h2>
        <br>
        <div class='box box-primary'>
        <div class="field-input">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <label for="nik">NIK :<?php echo form_error('nik') ?></label>
            <?php echo $nik; ?>
          </div>
          <div class="field-input">
            <label for="nama_siswa">Nama Siswa :<?php echo form_error('nama_siswa') ?></label>
            <?php echo $nama_siswa; ?>
          </div>
          <div class="field-input">
            <label for="jenis_kelamin">Jenis Kelamin :<?php echo form_error('jenis_kelamin') ?></label>
            <?php echo $jenis_kelamin; ?>
          </div>
          <div class="field-input">
            <label for="alamat">Alamat :<?php echo form_error('alamat') ?></label>
            <?php echo $alamat; ?>
          </div>
          <div class="field-input">
            <label for="status">Status Siswa :<?php echo form_error('status') ?></label>
            <?php echo $status; ?>
          </div>
          <div class="field-input">
            <label for="Deskripsi">Deskripsi :<?php echo form_error('deskripsi') ?></label>
            <?php echo $deskripsi; ?>
          </div>
          <div class="field-submit mt-3">
            <a href="#" onclick="history.back()" class="btn btn-danger">Back</a>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->