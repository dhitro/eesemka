<!-- Main content -->
<div class='row' style="max-width: 100% !important;">
  <div class='col-12'>
    <div class='box'>
      <div class='box-header'>

        <h2 class='box-title'>Detail Data Sekolah</h2>
        <br>
        <div class='box box-primary'>
        <div class="field-input mt-2">
              <label for="pengalaman">Foto Profil
                <?php echo form_error('foto') ?></label>
              <div class="row" id="fotoprofil">
                <?php $foto = getfotoprofil($id,3);
                if (!empty($foto)) : ?>
                  <div class="col-3" id="inputFormRow">
                    <div class="field-group field-file">
                      <label for="foto" class="preview">
                        <img class="img_pre" src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt="">
                        <i class="la la-cloud-upload-alt"></i>
                      </label>
                     
                    </div>
                  </div>
                <?php endif; ?>
              </div>

            </div>
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
          <div class="field-input mt-2">
              <label for="pengalaman">Pengalaman Kerja 
                <?php echo form_error('pengalaman') ?></label>
              <div id="pengalaman">
                <?php foreach ($data = loadsiswapengalaman($id) as $p) : ?>
                  <div class="row" id="inputFormRow">
                    <div class="col-1">
                      <?= $p->tahun ?>
                    </div>
                    <div class="col-8">
                      <?= $p->pengalaman ?>
                    </div>
                    <div class="col-3">
                    
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

            </div>
            <div class="field-input mt-2">
              <label for="pengalaman">Sertifikat Keahlian
                <?php echo form_error('pengalaman') ?></label>
              <div class="row" id="keahlian">
                <?php foreach ($data = loadsiswakeahlian($id) as $p) : 
                   $tipe = explode(".",$p->file);
                   $valid = ['png','jpg','jpeg','gif'];
                  ?>
                  <div class="col-2" width="100px" id="inputFormRow">
                  <?php if(in_array($tipe[1],$valid)) : ?>
                        <img class="img_pre" src="<?= base_url() . "upload/dokumen/" . $p->file ?>" alt="">
                        <?php else: ?>
                          <a  style="margin:100px 0 0 0;" class="btn badge btn-danger img_pre" href="<?= base_url() . "upload/dokumen/" . $p->file ?>"><i class="la la-eye"></i> Dokumen</a>
                        <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>

            </div>
            <div class="field-input mt-2">
              <label for="pengalaman">Sertifikat Pendukung 
                <?php echo form_error('pengalaman') ?></label>
              <div class="row" id="pendukung">
                <?php foreach ($data = loadsiswapendukung($id) as $p) : ?>
                   <div class="col-2" width="100px" id="inputFormRow">
                  <?php if(in_array($tipe[1],$valid)) : ?>
                        <img class="img_pre" src="<?= base_url() . "upload/dokumen/" . $p->file ?>" alt="">
                        <?php else: ?>
                          <a  style="margin:100px 0 0 0;" class="btn badge btn-danger img_pre" href="<?= base_url() . "upload/dokumen/" . $p->file ?>"><i class="la la-eye"></i> Dokumen</a>
                        <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>

            </div>
          <div class="field-submit mt-3">
            <a href="#" onclick="history.back()" class="btn btn-danger">Back</a>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  