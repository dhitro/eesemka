<!-- Main content -->
<div class='row'>
  <div class='col-12'>
    <div class='box'>
      <div class='box-header'>

        <h2 class='box-title'>Form Data Siswa</h2>
        <br>
        <div class='box box-primary'>

          <form action="<?php echo $action; ?>" class="form-underline" style="max-width: 600px !important;" method="post" enctype="multipart/form-data">
            <div class="field-input mt-2">
              <label for="pengalaman">Foto Profil
                <?php echo form_error('foto') ?></label>
              <div class="row" id="fotoprofil">
                <?php $foto = getfotoprofil($id,3);
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
              <label for="id_user">User <?php echo form_error('id_user') ?></label>
              <select name="id_user" id="id_user" class="form-control select2bs4" required>
                <option value="0">-- Pilih User --</option>
                <?php foreach (loaduser(4,5) as $us) :
                  $sel = $us->id == $id_user ? 'selected' : '';
                ?>
                  <option <?= $sel ?> value="<?= $us->id ?>"><?= $us->firstname ?> - <?= $us->username ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="field-input">
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <input type="hidden" name="uuid" value="<?php echo $uuid; ?>" />
              <label for="nik">NIK <?php echo form_error('nik') ?></label>
              <input type="text" name="nik" placeholder="NIK" id="nik" value="<?php echo $nik; ?>">
            </div>
            <div class="field-input">
              <label for="nama_siswa">Nama Siswa <?php echo form_error('nama_siswa') ?></label>
              <input type="text" name="nama_siswa" placeholder="Nama Siswa" id="nama_siswa" value="<?php echo $nama_siswa; ?>">
            </div>

            <div class="field-input">
              <label for="jenis_kelamin">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
              <div class="text-nowrap mt-2" style="height: 20px !important;">
                <input <?= $jenis_kelamin == 'Laki-laki' ? 'checked' : '' ?> class="" style="margin-right:10px; height: 20px !important;width : 20px !important;" value="Laki-laki" type="radio" name="jenis_kelamin" id="jk1">
                <label class="" for="jk1">
                  Laki-laki
                </label>
              </div>
              <div class="text-nowrap mt-2 mb-4" style="height: 20px !important;">
                <input <?= $jenis_kelamin == 'Perempuan' ? 'checked' : '' ?> class="" style="margin-right: 10px;; height: 20px !important; width : 20px !important;" value="Perempuan" type="radio" name="jenis_kelamin" id="jk2">
                <label class="" for="jk2">
                  Perempuan
                </label>
              </div>
            </div>
            <div class="field-input">
              <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
              <input type="text" name="alamat" placeholder="Alamat" id="alamat" value="<?php echo $alamat; ?>">
            </div>
            <div class="field-input">
              <label for="id_sekolah">Sekolah <?php echo form_error('id_sekolah') ?></label>
              <select name="id_sekolah" id="id_sekolah" class="form-control select2bs4" required>
                <option value="0">-- Pilih Sekolah --</option>
                <?php foreach (loadsekolah() as $sk) :
                  $sel = $sk->id == $id_sekolah ? 'selected' : '';
                ?>
                  <option <?= $sel ?> value="<?= $sk->id ?>"><?= $sk->nama_sekolah ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="field-input">
              <label for="status">Status Siswa <?php echo form_error('status') ?></label>
              <div class="text-nowrap mt-2" style="height: 20px !important;">
                <input <?= $status == 'Siswa' ? 'checked' : '' ?> class="" style="margin-right:10px; height: 20px !important;width : 20px !important;" value="Siswa" type="radio" name="status" id="st1">
                <label class="" for="st1">
                  Siswa
                </label>
              </div>
              <div class="text-nowrap mt-2 mb-4" style="height: 20px !important;">
                <input <?= $status == 'Alumni' ? 'checked' : '' ?> class="" style="margin-right: 10px;; height: 20px !important; width : 20px !important;" value="Alumni" type="radio" name="status" id="st2">
                <label class="" for="st2">
                  Alumni
                </label>
              </div>
            </div>
            <div class="field-input">
              <label for="deskripsi">Deskripsi <?php echo form_error('deskripsi') ?></label>
              <textarea name="deskripsi" id="" cols="30" rows="10"><?php echo $deskripsi; ?></textarea>
            </div>
            <div class="field-input mt-2">
              <label for="pengalaman">Pengalaman Kerja <br><button class="badge btn-primary btn-sm rounded tambah-pengalaman"><i class="las la-plus"></i> Tambah</button>
                <?php echo form_error('pengalaman') ?></label>
              <div id="pengalaman">
                <?php foreach ($data = loadsiswapengalaman($id) as $p) : ?>
                  <div class="row" id="inputFormRow">
                    <div class="col-3">
                      <input type="text" value="<?= $p->tahun ?>" name="tahun[]" placeholder="Tahun" autocomplete="off">
                    </div>
                    <div class="col-6">
                      <input type="text" value="<?= $p->pengalaman ?>" name="pengalaman[]" placeholder="Masukkan Pengalaman" autocomplete="off">
                    </div>
                    <div class="col-3">
                      <button id="removeRow" type="button" class="btn-sm btn-danger"> <i class="la la-trash-alt"></i> Hapus</button>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

            </div>
            <div class="field-input mt-2">
              <label for="pengalaman">Sertifikat Keahlian <br><button class="badge btn-primary btn-sm rounded tambah-keahlian"><i class="las la-plus"></i> Tambah</button>
                <?php echo form_error('pengalaman') ?></label>
              <div class="row" id="keahlian">
                <?php foreach ($data = loadsiswakeahlian($id) as $p) : ?>
                  <div class="col-3" id="inputFormRow">
                    <div class="field-group field-file">
                      <label for="sertifikat_keahlian1" class="preview">
                        <img class="img_preview" src="<?= base_url() . "upload/dokumen/" . $p->file ?>" alt="">
                        <i class="la la-cloud-upload-alt"></i>
                      </label>
                      <div class="field-note"><a href="<?= base_url('admin/siswa_delete_file') ?>" data-id="<?= $p->id ?>" class="btn-sm btn-danger removeFiles"> <i class="la la-trash-alt"></i> Hapus</a></div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

            </div>

            <div class="field-input mt-2">
              <label for="pengalaman">Sertifikat Pendukung <br><button class="badge btn-primary btn-sm rounded tambah-pendukung"><i class="las la-plus"></i> Tambah</button>
                <?php echo form_error('pengalaman') ?></label>
              <div class="row" id="pendukung">
                <?php foreach ($data = loadsiswapendukung($id) as $p) : ?>
                  <div class="col-3" id="inputFormRow">
                    <div class="field-group field-file">
                      <label for="sertifikat_pendukung1" class="preview">
                        <img class="img_preview" src="<?= base_url() . "upload/dokumen/" . $p->file ?>" alt="">
                        <i class="la la-cloud-upload-alt"></i>
                      </label>
                      <div class="field-note"><a href="<?= base_url('admin/siswa_delete_file') ?>" data-id="<?= $p->id ?>" class="btn-sm btn-danger removeFiles"> <i class="la la-trash-alt"></i> Hapus</a></div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

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
      CKEDITOR.replace('deskripsi', {
        width: '100%'
      });
    });
  </script>