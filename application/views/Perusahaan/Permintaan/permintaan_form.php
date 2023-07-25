<!-- Main content -->
<div class='row'>
  <div class='col-12'>
    <div class='box'>
      <div class='box-header'>

        <h2 class='box-title'>Form Perekrutan  <i><?php echo $namasiswa ?></i></h2>
        <br>
        <div class='box box-primary'>

          <form action="<?php echo $action; ?>" class="form-underline" style="max-width: 600px !important;" method="post" enctype="multipart/form-data">
            <div class="field-input">
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <input type="hidden" name="uuid" value="<?php echo $uuid; ?>" />
              <input type="hidden" name="id_perusahaan" id="id_perusahaan" value="<?php echo $idper; ?>" />
              <input type="hidden" name="id_siswa" id="id_siswa" value="<?php echo $idsiswa; ?>" />
            </div>
            <div class="field-input">
              <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
              <textarea name="keterangan" id="" cols="30" rows="10"><?php echo $keterangan; ?></textarea>
            </div>
            <div class="field-submit mt-3">
              <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
              <a href="#" onclick="history.back()" class="btn btn-danger">Cancel</a>
            </div>
          </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  <script>
    $(document).ready(function() {
      CKEDITOR.replace('keterangan', {
        width: '100%'
      });

    });
  </script>