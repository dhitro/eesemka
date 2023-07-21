<div class="member-wrap-top">
	<h2>E-Esemka - Data Permintaan siswa_rules</h2>
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
			<th>Nama Perusahaan</th>
			<th class="text-nowrap">Nama Siswa</th>
			<th>Keterangan</th>
			<th>Status</th>
			<th>Tanggal</th>
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
					<b><?= getnamaperusahaan($d->id_perusahaan) ?></b>
				</td>

				<td class="text-nowrap">
					<?php $foto = getfotoprofil($d->id_siswa, 3);
					if (!empty($foto)) : ?>
						<img class="img_pre" width="40px" src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt="">
					<?php endif; ?>
					<?= getsiswa($d->id_siswa) ?>
				</td>
						<td> <?= $d->keterangan ?></td>
				<?php
				$st = '';
				if ($d->status == 'Approve') $st = 'text-success';
				if ($d->status == 'Pending') $st = 'text-warning';
				if ($d->status == 'Reject') $st = 'text-danger';
				?>
				<td class="small text-status <?= $st ?>"><?= $d->status ?></td>
				<td style="width: 350px;"><?= $d->created_at ?></td>
				<td class="">
					<div class="text-nowrap">
					<a href="<?= site_url('admin/permintaan_update/' . $d->id) ?>" class="edit" title="Edit"><i class="las la-edit"></i></a>
					<a href="<?= site_url('admin/permintaan_read/' . $d->id) ?>" class="view" title="View"><i class="la la-eye"></i></a>
					<a href="<?= site_url('admin/permintaan_delete/' . $d->id) ?>" class="delete" title="Delete"><i class="la la-trash-alt"></i></a>
					</div>
					<div class="place-action">
						<a href="<?= site_url('admin/permintaan_approve/') ?>" data-id="<?= $d->id ?>" class="approved" title="Approve">Approve</a>
						<a href="<?= site_url('admin/permintaan_approve/') ?>" data-id="<?= $d->id ?>" class="pending" title="Pending">Pending</a>
						<a href="<?= site_url('admin/permintaan_approve/') ?>" data-id="<?= $d->id ?>" class="reject" title="Reject">Reject</a>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="pagination align-left">
	<?= $this->pagination->create_links(); ?>
</div><!-- .pagination -->