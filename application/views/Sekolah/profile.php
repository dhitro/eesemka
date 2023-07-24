
  <div class="listing-content ml-2">
    <h2>Profil Data</h2>
    <div class="text-danger"><?= $this->session->flashdata('message'); ?></div>
    <form action="<?php echo $action; ?>" class="form-underline" style="max-width: 600px !important;" method="post"  enctype="multipart/form-data">
            <div class="field-input mt-2">
              <label for="pengalaman">Foto Profil
                <?php echo form_error('foto') ?></label>
              <div class="row" id="fotoprofil">
                <?php $foto = getfotoprofil($id,5);
                if (!empty($foto)) : ?>
                  <div class="col-3" id="inputFormRow">
                    <div class="field-group field-file">
                      <label for="foto" class="preview">
                        <img class="img_pre" src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt="">
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

 <hr>
    <h2 id="basic">Basic Data</h2>
    <div class="text-danger"><?= $this->session->flashdata('message'); ?></div>
    <form action="<?php echo $action2; ?>" class="form-underline" style="max-width: 600px !important;" method="post" enctype="multipart/form-data">

      <div class="field-input">
        <input type="hidden" name="id" value="<?php echo $iduser; ?>" />
        <label for="firstname">Nama Depan / Firstname <?php echo form_error('firstname') ?></label>
        <input type="text" name="firstname" placeholder="Nama Depan" id="firstname" value="<?php echo $firstname; ?>">
      </div>
      <div class="field-input">
        <label for="lastname">Nama Belakang / Lastname <?php echo form_error('lastname') ?></label>
        <input type="text" name="lastname" placeholder="Nama Belakang" id="lastname" value="<?php echo $lastname; ?>">
      </div>
      <div class="field-input">
        <label for="lastname">Username <?php echo form_error('username') ?></label>
        <input type="text" name="username" placeholder="Username" id="username" value="<?php echo $username; ?>">
      </div>

      <div class="field-input">
        <label for="password">Password <?php echo form_error('password') ?> <?= !empty($id) == true ? '<span class="text-danger small"> (* Abaikan Jika Tidak Ingin Rubah Password </span>' : '' ?> </label>
        <input type="text" name="password" placeholder="password" id="password" value="<?php echo $password; ?>">
      </div>
      <div class="field-input">
        <label for="email">Email <?php echo form_error('email') ?></label>
        <input type="text" name="email" placeholder="email" id="email" value="<?php echo $email; ?>">
      </div>
      <div class="field-input">
        <label for="phone">Phone <?php echo form_error('phone') ?></label>
        <input type="text" name="phone" placeholder="phone" id="phone" value="<?php echo $phone; ?>">
      </div>
      <div class="field-input">
        <label for="facebook">Facebook <?php echo form_error('facebook') ?></label>
        <input type="text" name="facebook" placeholder="facebook" id="facebook" value="<?php echo $facebook; ?>">
      </div>
      <div class="field-input">
        <label for="instagram">Instagram <?php echo form_error('instagram') ?></label>
        <input type="text" name="instagram" placeholder="instagram" id="instagram" value="<?php echo $instagram; ?>">
      </div>
      <div class="field-submit mt-3">
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
    <a href="#" onclick="history.back()" class="btn btn-danger">Cancel</a>
  </div>
  </div>
  
  </form>

<script>
  $(document).ready(function() {
    CKEDITOR.replace('deskripsi', {
      width: '100%'
    });
  });
</script>