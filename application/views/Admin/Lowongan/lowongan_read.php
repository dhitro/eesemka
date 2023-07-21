<!-- Main content -->
<div class='row' style="max-width: 100% !important;">
	<div class='col-12'>
		<div class='box'>
			<div class='box-header'>

				<h2 class='box-title'>Detail Data Perusahaan</h2>
				<br>
				<div class='box box-primary'>

					<div class="field-input">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<label for="nama_perusahaan">Nama Lowongan <?php echo form_error('nama_perusahaan') ?></label>
						<?php echo $nama_lowongan; ?>
					</div>
					<div class="field-input">
						<label for="deskripsi">Deskripsi <?php echo form_error('deskripsi') ?></label>
						<?php echo $deskripsi; ?>
					</div>
					<div class="field-input">
						<label for="persyaratan">Persyaratan <?php echo form_error('persyaratan') ?></label>
						<?php echo $persyaratan; ?>
					</div>
					<div class="field-input">
						<label class="mb-2" for="bidang">Posisi Yang Dibutuhkan : <?php echo form_error('bidang') ?></label>
						<ul class="list-unstyled">
							<?php
							foreach (loadposisilowongan($id) as $posisi) : ?>
								<li> <?= $posisi->nama ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="field-submit mt-3">
						<a href="#" onclick="history.back()" class="btn btn-danger">Back</a>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.row -->

<div class="row">
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
				<th>Nama Lowongan</th>
				<th class="text-nowrap">Nama Pelamar</th>
				<th>Posisi Lamaran</th>
				<th>Status</th>
				<th>Tanggal</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;

			foreach ($data =  loadlamaran($id) as $d) : ?>
				<tr>

					<td><?= $no++ ?></td>
					<td class="text-nowrap">
						<b><?= getlowongan($d->id_lowongan) ?></b>
					</td>

					<td class="text-nowrap">
						<?php $foto = getfotoprofil($d->id_siswa, 3);
						if (!empty($foto)) : ?>
							<img class="img_preview"  width="40px" src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt="">
						<?php endif; ?>
						<?= getsiswa($d->id_siswa) ?>
					</td>
					<td class="text-nowrap"><?= getnamaposisi($d->id_posisi) ?></td>
					<?php
					$st = '';
					if ($d->status == 'Approve') $st = 'text-success';
					if ($d->status == 'Pending') $st = 'text-warning';
					if ($d->status == 'Reject') $st = 'text-danger';
					?>
					<td class="small text-status <?= $st ?>"><?= $d->status ?></td>
					<td style="width: 350px;"><?= $d->created_at ?></td>
					<td class="place-action text-nowrap">
						<!-- <a href="<?= site_url('admin/lamaran_update/' . $d->id) ?>" class="edit" title="Edit"><i class="las la-edit"></i></a>
						<a href="<?= site_url('admin/lamaran_read/' . $d->id) ?>" class="view" title="View"><i class="la la-eye"></i></a>
						<a href="<?= site_url('admin/lamaran_delete/' . $d->id) ?>" class="delete" title="Delete"><i class="la la-trash-alt"></i></a> -->
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>