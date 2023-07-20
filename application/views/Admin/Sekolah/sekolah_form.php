<!-- Main content -->
  <div class='row'>
    <div class='col-12'>
      <div class='box'>
        <div class='box-header'>

          <h2 class='box-title'>Form Data Sekolah</h2>
          <br>
          <div class='box box-primary'>
            
            <form action="<?php echo $action; ?>" class="form-underline" style="max-width: 600px !important;" method="post"  enctype="multipart/form-data">
            <div class="field-input mt-2">
              <label for="pengalaman">Foto Profil
                <?php echo form_error('foto') ?></label>
              <div class="row" id="fotoprofil">
                <?php $foto = getfotoprofil($id);
                if (!empty($foto)) : ?>
                  <div class="col-3" id="inputFormRow">
                    <div class="field-group field-file">
                      <label for="foto" class="preview">
                        <img class="img_preview" src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt="">
                        <i class="la la-cloud-upload-alt"></i>
                      </label>
                      <div class="field-note"><a href="<?= base_url('admin/siswa_delete_file') ?>" data-id="<?= $foto->id ?>" class="btn-sm btn-danger gantiFile"> <i class="la la-exchange-alt"></i> Ganti Foto</a></div>
                    </div>
                  </div>
                <?php else : ?>
                  <div class="col-3">
                    <div class="field-group field-file">
                      <label for="foto" class="preview">
                        <input type="file" id="foto" name="foto[]" class="upload-file" data-max-size="1024">
                        <img class="img_preview" src="" alt="">
                        <i class="la la-cloud-upload-alt"></i>
                      </label>
                      <div class="field-note">Maximum file size: 1 MB.</div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            
            </div>
            <div class="field-input">
              <label for="id_user">Sekolah <?php echo form_error('id_user') ?></label>
              <select name="id_user" id="id_user" class="form-control select2bs4" required>
                <option value="0">-- Pilih User --</option>
                <?php foreach (loaduser(2) as $us) :
                  $sel = $us->id == $id_user ? 'selected' : '';
                ?>
                  <option <?= $sel ?> value="<?= $us->id ?>"><?= $us->firstname ?> - <?= $us->username ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="field-input">
            <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
            <input type="hidden" name="uuid" value="<?php echo $uuid; ?>" />
								<label for="nama_sekolah">Nama Sekolah <?php echo form_error('nama_sekolah') ?></label>
								<input type="text" name="nama_sekolah" placeholder="Nama Sekolah" id="nama_sekolah" value="<?php echo $nama_sekolah; ?>">
							</div>
              <div class="field-input">
								<label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
								<input type="text" name="alamat" placeholder="Alamat" id="alamat" value="<?php echo $alamat; ?>">
							</div>
              <div class="field-input">
								<label for="Deskripsi">Deskripsi <?php echo form_error('deskripsi') ?></label>
							  <textarea name="deskripsi" id="" cols="30" rows="10"><?php echo $deskripsi; ?></textarea>  </div>
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
        CKEDITOR.replace('deskripsi', {
            width: '100%'
        });
    });
</script>