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
              <label for="nama_perusahaan">Nama Perusahaan <?php echo form_error('nama_perusahaan') ?></label>
              <?php echo $nama_perusahaan; ?>
            </div>
            <div class="field-input">
              <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
              <?php echo $alamat; ?>
            </div>
            <div class="field-input">
              <label for="alamat">Jumlah Karyawan <?php echo form_error('jumlah_karyawan') ?></label>
              <?php echo $jumlah_karyawan; ?> Orang
            </div>
            <div class="field-input">
              <label class="mb-2" for="bidang">Bergerak Dibidang : <?php echo form_error('bidang') ?></label>
             <ul class="list-unstyled">
             <?php
              foreach (loadbidangperusahaan($id) as $bidang) : ?>
                  <li>      <?= $bidang->nama ?></li>
						  <?php endforeach; ?>
              </ul>
            </div>
            <div class="field-input mt-2">
              <label for="Deskripsi">Deskripsi <?php echo form_error('deskripsi') ?></label>
              <?php echo $deskripsi; ?>
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
  <table class="member-place-list owner-booking table-responsive">
							<thead>
								<tr>
									<th>ID</th>
									<th>Pelamar</th>
									<th>Tanggal</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td data-title="ID">1201</td>
									<td data-title="Places"><b>Anto</b></td>
									<td data-title="Booking at">13 Juni 2023</td>
									<td data-title="Status" class="approved">Approved</td>
									<td data-title="" class="place-action">
										<a href="#" class="cancel" title="Cancel">Cancel</a>
										<a href="#" class="detail" title="Detail">Detail</a>
									</td>
								</tr>
								<tr>
									<td data-title="ID">1201</td>
									<td data-title="Places"><b>Andi</b></td>
									<td data-title="Booking at">13 Juni 2023</td>
									<td data-title="Status" class="pending">Pending</td>
									<td data-title="" class="place-action">
										<a href="#" class="approve" title="Approve">Approve</a>
										<a href="#" class="cancel" title="Cancel">Cancel</a>
										<a href="#" class="detail" title="Detail">Detail</a>
									</td>
								</tr>
								<tr>
									<td data-title="ID">1201</td>
									<td data-title="Places"><b>Sinta</b></td>
									<td data-title="Booking at">13 Juni 2023</td>
									<td data-title="Status" class="cancel">Cancel</td>
									<td data-title="" class="place-action">
										<a href="#" class="approve" title="Approve">Approve</a>
										<a href="#" class="detail" title="Detail">Detail</a>
									</td>
								</tr>
								<tr>
									<td data-title="ID">1201</td>
									<td data-title="Places"><b>Eko</b></td>
									<td data-title="Booking at">13 Juni 2023</td>
									<td data-title="Status" class="approved">Approved</td>
									<td data-title="" class="place-action">
										<a href="#" class="cancel" title="Cancel">Cancel</a>
										<a href="#" class="detail" title="Detail">Detail</a>
									</td>
								</tr>
								<tr>
									<td data-title="ID">1201</td>
									<td data-title="Places"><b>Rani</b></td>
									<td data-title="Booking at">13 Juni 2023</td>
									<td data-title="Status" class="approved">Approved</td>
									<td data-title="" class="place-action">
										<a href="#" class="cancel" title="Cancel">Cancel</a>
										<a href="#" class="detail" title="Detail">Detail</a>
									</td>
								</tr>
							</tbody>
						</table>
  </div>