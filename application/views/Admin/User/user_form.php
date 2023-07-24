<!-- Main content -->
<div class='row'>
  <div class='col-12'>
    <div class='box'>
      <div class='box-header'>

        <h2 class='box-title'>Form Data User</h2>
        <br>
        <div class='box box-primary'>

          <form action="<?php echo $action; ?>" class="form-underline" style="max-width: 600px !important;" method="post" enctype="multipart/form-data">

            <div class="field-input">
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <input type="hidden" name="uuid" value="<?php echo $uuid; ?>" />
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
            <div class="field-input">
              <label for="id_level">Level User <?php echo form_error('id_level') ?></label>
              <select name="id_level" id="id_level" class="form-control select2bs4" required>
                <option value="0">-- Pilih Level User --</option>
                <?php foreach (loadlevel() as $lv) :
                  $sel = $lv->id == $id_level ? 'selected' : '';
                ?>
                  <option <?= $sel ?> value="<?= $lv->id ?>"><?= $lv->nama ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <br>
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
  $(document).on("click", ".chk", function() {
    let id = $(this).data("id");
    let val = this.checked == true ? 1 : 0;
    let str = val == 1 ? "Aktif" : "Non Aktif";
    console.log(val);
    $.ajax({
      url: "<?= base_url('admin/user_active') ?>",
      type: "post",
      data: {
        id: id,
        is_active: val
      },
      success: function(response) {

      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);

      }
    });

    $("#lblSwitch" + id).html(str)

  });
</script>