<!-- Main content -->
  <div class='row'>
    <div class='col-12'>
      <div class='box'>
        <div class='box-header'>

          <h2 class='box-title'>Form Data Lamaran</h2>
          <br>
          <div class='box box-primary'>
            
            <form action="<?php echo $action; ?>" class="form-underline" style="max-width: 600px !important;" method="post"  enctype="multipart/form-data">
            <div class="field-input">
            <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
            <input type="hidden" name="uuid" value="<?php echo $uuid; ?>" />
						
              <label for="id_lowongan">Lowongan <?php echo form_error('id_lowongan') ?></label>
              <select name="id_lowongan" id="id_lowongan" class="form-control select2bs4" required>
                <option value="0">-- Pilih Lowongan --</option>
                <?php foreach (loadlowongan() as $us) :
                  $sel = $us->id == $id_lowongan ? 'selected' : '';
                ?>
                  <option <?= $sel ?> value="<?= $us->id ?>"><?= $us->nama_lowongan ?> - <?= $us->status ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="field-input">
              <label for="id_posisi">Posisi Lamaran <?php echo form_error('id_posisi') ?></label>
              <select name="id_posisi" id="id_posisi" class="form-control select2bs4" required>
                <option value="0">-- Pilih Posisi --</option>
                <?php if(!empty( $id_lowongan)): ?>
                  <?php foreach (loadlowonganposisi($id_lowongan) as $us) :
                  $sel = $us->id == $id_posisi ? 'selected' : '';
                ?>
                  <option <?= $sel ?> value="<?= $us->id ?>"><?= $us->nama ?></option>
                <?php endforeach; ?>
                  <?php endif; ?>
              </select>
            </div>
            <div class="field-input">
              <label for="id_siswa">Siswa Pelamar <?php echo form_error('id_siswa') ?></label>
              <select name="id_siswa" id="id_siswa" class="form-control select2bs4" required>
                <option value="0">-- Pilih Siswa --</option>
                <?php foreach (loadsiswa() as $us) :
                  $sel = $us->id == $id_siswa ? 'selected' : '';
                ?>
                  <option <?= $sel ?> value="<?= $us->id ?>"><?= $us->nama_siswa ?></option>
                <?php endforeach; ?>
              </select>
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
  $(document).ready( function(){

  
  });

  $(document).on("change", "#id_lowongan", function() {
      var th = $(this);
      var id = th.val();
      $.post('<?= base_url('admin/lowongan_posisi') ?>' ,{id:id},function(response){ 
          
        let htm = '<option value="" selected>Pilih Posisi</option>';
          response.forEach(element => {
            htm += "<option value='" + element.id_posisi + "'>" + element.nama + "</option>";
          });
          $('#id_posisi').html(htm);

      });
  });
  
</script>