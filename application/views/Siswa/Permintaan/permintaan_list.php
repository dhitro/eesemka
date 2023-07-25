<div class="member-wrap-top">
	<h2>Permintaan Perusahaan <?php echo $usis; ?></h2>
</div><!-- .member-wrap-top -->
<div><?= $this->session->flashdata('message'); ?></div>
<table class="member-place-list table-responsive">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nama Perusahaan</th>
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