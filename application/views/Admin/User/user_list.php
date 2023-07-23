<div class="member-wrap-top">
	<h2>E-Esemka - Data User</h2>
</div><!-- .member-wrap-top -->
<a href="<?= $actionadd ?>" class="btn btn-danger mb-4"><i class="las la-plus"></i> Tambah Data</a>

<div class="member-filter">
	<div class="mf-left">
		<form action="<?= $actionfilter ?>" method="POST">
			<div class="field-select">
				<select name="per_hal" id="per_hal">
					<option value="10" <?= $this->session->userdata('perhal') == "10" ? "selected" : "" ?>>Show 10</option>
					<option value="20" <?= $this->session->userdata('perhal') == "20" ? "selected" : "" ?>>Show 20</option>
					<option value="40" <?= $this->session->userdata('perhal') == "40" ? "selected" : "" ?>>Show 40</option>
					<option value="50" <?= $this->session->userdata('perhal') == "50" ? "selected" : "" ?>>Show 50</option>
				</select>
				<i class="la la-angle-down"></i>
			</div>
		</form>
	</div><!-- .mf-left -->
	<div class="mf-right">
		<form action="<?= $actionfilter ?>" class="site__search__form" method="GET">
			<div class="site__search__field">
				<span class="site__search__icon">
					<i class="la la-search"></i>
				</span><!-- .site__search__icon -->
				<input class="site__search__input" type="text" name="s" placeholder="Search" value="<?= html_escape($this->input->get('s')) ?>">
			</div><!-- .search__input -->
		</form><!-- .search__form -->
	</div><!-- .mf-right -->
</div>
<div><?= $this->session->flashdata('message'); ?></div>
<table class="member-place-list table-responsive">
	<thead>
		<tr>
			<!-- <th>
										<div class="field-check">
											<label for="all">
												<input id="all" type="checkbox" value="all">
												<span class="checkmark">
													<i class="la la-check"></i>
												</span>
											</label>
										</div>
									</th> -->
			<th>ID</th>
			<th>Fistname</th>
			<th>Lastname</th>
			<th>Username</th>
			<th>Basic Info </th>
			
			<th>Status</th>
			<th>Level User</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($data as $d) : ?>
			<tr>
				<td><?= $no++ ?></td>
				<td class="text-nowrap">
					<b><?= $d->firstname ?></b>
				</td>
				<td class="text-nowrap">
					<b><?= $d->lastname ?></b>
				</td>
				<td class="text-nowrap">
					<b><?= $d->username ?></b>
				</td>
				<td class="text-nowrap">
					<b>Email : <?= $d->email ?></b>
					<br>
					<b>Phone : <?= $d->phone ?></b>
					<br>
					<b>Facebook : <?= $d->facebook ?></b>
					<br>
					<b>Instagram : <?= $d->instagram ?></b>
				</td>
				<td class="text-nowrap">
					<label class="switch">
						<input type="checkbox" class="chk" data-id="<?= $d->id ?>" <?= $d->is_active == 1 ?"checked":"" ?>>
						<span class="slider"></span>
					</label>
					<label id="lblSwitch<?= $d->id ?>" class="custom-control-label small" for="customSwitch<?= $d->id ?>"><?= $d->is_active == 1 ? 'Aktif' : 'Non Aktif'; ?></label>
				
				</td>
				<td style="width: 350px;"><?= getnamalevel($d->id_level) ?></td>
				<!-- <td class="text-nowrap small"><?= getnamauser($d->id_user) ?></td> -->
				<td class="place-action text-nowrap">
					<a href="<?= site_url('admin/user_update/' . $d->id) ?>" class="edit" title="Edit"><i class="las la-edit"></i></a>
					<a href="<?= site_url('admin/user_read/' . $d->id) ?>" class="view" title="View"><i class="la la-eye"></i></a>
					<a href="<?= site_url('admin/user_delete/' . $d->id) ?>" class="delete" title="Delete"><i class="la la-trash-alt"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="pagination align-left">
	<?= $this->pagination->create_links(); ?>
</div><!-- .pagination -->

<script>
	$(document).on("click", ".chk", function() {
      let id = $(this).data("id");
      let val = this.checked == true ? 1 : 0;
      let str =  val == 1 ? "Aktif" : "Non Aktif";
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