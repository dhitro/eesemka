<!-- Main content -->
<div class='row'>
  <div class='col-12'>
    <div class='box'>
      <div class='box-header'>

        <h2 class='box-title'>Form Data Lowongan</h2>
        <br>
        <div class='box box-primary'>

          <form action="<?php echo $action; ?>" class="form-underline" style="max-width: 600px !important;" method="post"  enctype="multipart/form-data">
          <div class="field-input mt-2">
              <label for="pengalaman">Foto Lowongan
                <?php echo form_error('foto') ?></label>
              <div class="row" id="fotoprofil">
                <?php $foto = getfotofeeds($id);
                if (!empty($foto)) : ?>
                  <div class="col-3" id="inputFormRow">
                    <div class="field-group field-file">
                      <label for="foto" class="preview">
                        <img class="img_pre"  src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt="">
                        <i class="la la-cloud-upload-alt"></i>
                      </label>
                      <div class="field-note"><a href="<?= base_url('perusahaan/siswa_delete_file') ?>" data-id="<?= $foto->id ?>" class="btn-sm btn-danger gantiFile"> <i class="la la-exchange-alt"></i> Ganti Foto</a></div>
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
              <input type="hidden" name="id_perusahaan" value="<?php echo $userper; ?>" />
            </div>
          <div class="field-input">
              
              <label for="nama_lowongan">Nama Lowongan <?php echo form_error('nama_lowongan') ?></label>
              <input type="text" name="nama_lowongan" placeholder="Nama Lowongan" id="nama_lowongan" value="<?php echo $nama_lowongan; ?>">
            </div>
            <div class="field-input mt-2">
              <label for="deskripsi">Deskripsi <?php echo form_error('deskripsi') ?></label>
              <textarea name="deskripsi" id="" cols="30" rows="10"><?php echo $deskripsi; ?></textarea>
            </div>
            <div class="field-input mt-2">
              <label for="persyaratan">Persyaratan <?php echo form_error('persyaratan') ?></label>
              <textarea name="persyaratan" id="" cols="30" rows="10"><?php echo $persyaratan; ?></textarea>
            </div>
            <div class="field-input">
              <label for="status">Status Lowongan<?php echo form_error('status') ?></label>
              <div class="text-nowrap mt-2" style="height: 20px !important;">
                <input <?= $status == 'Publish' ? 'checked' : '' ?> class="" style="margin-right:10px; height: 20px !important;width : 20px !important;" value="Publish" type="radio" name="status" id="st1">
                <label class="" for="st1">
                  Publish
                </label>
              </div>
              <div class="text-nowrap mt-2" style="height: 20px !important;">
                <input <?= $status == 'Pending' ? 'checked' : '' ?> class="" style="margin-right: 10px;; height: 20px !important; width : 20px !important;" value="Pending" type="radio" name="status" id="st2">
                <label class="" for="st2">
                  Pending
                </label>
              </div>
              <div class="text-nowrap mt-2 mb-4" style="height: 20px !important;">
                <input <?= $status == 'Close' ? 'checked' : '' ?> class="" style="margin-right: 10px;; height: 20px !important; width : 20px !important;" value="Close" type="radio" name="status" id="st3">
                <label class="" for="st3">
                  Close
                </label>
              </div>
            </div>

            <div class="field-input row">
              <label class="mb-2" for="bidang">Posisi Dibutuhkan : <?php echo form_error('bidang') ?></label>
              <div class="col" >
              <?php
              $no = 1;
              $arr = array();
              $cekposisi = loadposisilowongan($id);
              foreach($cekposisi as $ck):
                array_push($arr,$ck->id_posisi);
              endforeach;
              foreach (loadposisi() as $posisi) : ?>
               <div class="field-check">
											<label for="posisi_list<?=$no?>">
												<input <?= in_array($posisi->id,$arr) ? 'checked' : '' ?> name="posisi_list[]"  id="posisi_list<?=$no?>" type="checkbox" value="<?= $posisi->id ?>">
												<span class="checkmark">
													<i class="la la-check"></i>
												</span>
                        <?= $posisi->nama ?>
											</label>
										</div>
              <?php
                $no++;
              endforeach; ?>
              

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
      CKEDITOR.replace('persyaratan', {
        width: '100%'
      });
    });
  </script>