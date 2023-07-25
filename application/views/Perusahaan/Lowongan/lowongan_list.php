<div class="member-wrap-top">
	<h2>E-Esemka - Data Lowongan</h2>
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

			<th>ID</th>
			<th></th>
			<th>Lowongan</th>
			<th>Deskripsi</th>
			<th>Persyaratan</th>
			<th>Status</th>
			<th>Posisi Yang Dibutuhkan</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($data as $d) : ?>
			<tr>

				<td><?= $no++ ?></td>
				<td style="min-width: 100px;">
					<?php $foto = getfotofeeds($d->id);
					if (!empty($foto)) : ?>
						<img class="img_pre"  src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt="">
					<?php endif; ?>
				</td>
				<td><?= $d->nama_lowongan ?></td>
				<td style="min-width: 250px !important;"><?= mb_substr($d->deskripsi,0,100)."...."  ?></td>
				<td><?= $d->persyaratan ?></td>
				<?php 
				$st = '';
				if($d->status == 'Publish') $st = 'text-success';
				if($d->status == 'Pending') $st = 'text-warning';
				if($d->status == 'Close') $st = 'text-danger';
				?>
				<td class="small text-status <?= $st ?>"><?= $d->status ?></td>
				<td>
					<ul>
						<?php foreach (loadposisilowongan($d->id) as $bp) :  ?>
							<li><?= getnamaposisi($bp->id_posisi) ?></li>
						<?php endforeach; ?>
					</ul>
				</td>
				<td class="">
					<div class="text-nowrap">
						<a href="<?= base_url('perusahaan/lowongan_update/' . $d->id) ?>" class="edit" title="Edit"><i class="las la-edit"></i></a>
						<a href="<?= base_url('perusahaan/lowongan_read/' . $d->id) ?>" class="view" title="View"><i class="la la-eye"></i></a>
						<a href="<?= base_url('perusahaan/lowongan_delete/' . $d->id) ?>" class="delete" title="Delete"><i class="la la-trash-alt"></i></a>
					</div>
					<div class="place-action">
						<a href="<?= base_url('perusahaan/lowongan_approve/') ?>" data-id="<?= $d->id ?>" class="publish" title="Publish">Publish</a>
						<a href="<?= base_url('perusahaan/lowongan_approve/') ?>" data-id="<?= $d->id ?>" class="pending" title="Pending">Pending</a>
						<a href="<?= base_url('perusahaan/lowongan_approve/') ?>" data-id="<?= $d->id ?>" class="close" title="Close">Close</a>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="pagination align-left">
	<?= $this->pagination->create_links(); ?>
</div><!-- .pagination -->