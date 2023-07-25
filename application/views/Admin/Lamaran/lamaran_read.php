<!-- Main content -->
<div class='row' style="max-width: 100% !important;">
	<div class='col-12'>
		<div class='box'>
			<div class='box-header'>

				<h2 class='box-title'>Detail Data Sekolah</h2>
				<br>
				<div class='box box-primary'>

					<div class="field-input">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<label for="nama_sekolah">Nama Sekolah :<?php echo form_error('nama_sekolah') ?></label>
						<?php echo $nama_sekolah; ?>
					</div>
					<div class="field-input">
						<label for="alamat">Alamat :<?php echo form_error('alamat') ?></label>
						<?php echo $alamat; ?>
					</div>
					<div class="field-input">
						<label for="Deskripsi">Deskripsi :<?php echo form_error('deskripsi') ?></label>
						<?php echo $deskripsi; ?>
					</div>
					<div class="field-submit mt-3">
						<a href="#" onclick="history.back()" class="btn btn-danger">Back</a>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>
<div class="row">
	<h2 class='box-title mt-2 mb-2'>Data Siswa</h2>
	<table class="member-place-list owner-booking table-responsive">
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
				<th>NIK</th>
				<th>Nama Siswa</th>
				<th>Jenis Kelamin</th>
				<th>Alamat</th>
				<th>Sekolah</th>
				<th>Status</th>
				<th>Valid?</th>
				<th>Deskripsi</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			foreach ($data = loadsiswasekolah($id) as $d) : ?>
				<tr>
					<!-- <td data-title="">
										<div class="field-check">
											<label for="place01">
												<input id="place01" type="checkbox" value="all">
												<span class="checkmark">
													<i class="la la-check"></i>
												</span>
											</label>
										</div>
									</td> -->
					<td><?= $no++ ?></td>
					<td><b><?= $d->nik ?></b></td>
					<td><b><?= $d->nama_siswa ?></b></td>
					<td><b><?= $d->jenis_kelamin ?></b></td>
					<td class="text-nowrap"><?= $d->alamat ?></td>
					<td><b><?= getnamasekolah($d->id_sekolah) ?></b></td>
					<td><b><?= $d->status ?></b> </td>
					<td class="small <?= $d->is_valid == 'Valid' ? 'text-success' : 'text-danger' ?> text-status text-nowrap"><?= $d->is_valid ?></td>
					<td><?= $d->deskripsi ?></td>
					<td class="place-action">
						<a href="<?= base_url('admin/siswa_approve/') ?>" class="approve text-nowrap" data-id="<?= $d->id ?>" title="Valid">Valid</a>
						<a href="<?= base_url('admin/siswa_approve/') ?>" class="cancel text-nowrap" data-id="<?= $d->id ?>" title="Tidak Valid">Tidak Valid</a>
						<a href="<?= base_url('admin/siswa_read/' . $d->id) ?>" class="view text-nowrap" title="View">Detail</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>