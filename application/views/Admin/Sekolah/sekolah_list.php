<div class="member-wrap-top">
							<h2>E-Esemka - Data Sekolah</h2>
						</div><!-- .member-wrap-top -->
						<a href="<?= $actionadd ?>" class="btn btn-danger mb-4"><i class="las la-plus"></i> Tambah Data</a>
						
						 <div class="member-filter">
							<div class="mf-left">
								<form action="<?= $actionfilter ?>" method="POST">
									<div class="field-select">
										<select name="per_hal" id="per_hal">
											<option value="10" <?= $this->session->userdata('perhal') == "10" ? "selected" : "" ?> >Show 10</option>
											<option value="20" <?= $this->session->userdata('perhal') == "20" ? "selected" : "" ?> >Show 20</option>
											<option value="40" <?= $this->session->userdata('perhal') == "40" ? "selected" : "" ?> >Show 40</option>
											<option value="50" <?= $this->session->userdata('perhal') == "50" ? "selected" : "" ?> >Show 50</option>
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
									<th></th>
									<th>Nama Sekolah</th>
									<th>Alamat</th>
									<th>Deskripsi</th>
									<th>User</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php 
								$no = 1;
								foreach($data as $d) : ?>
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
									<td ><?= $no++ ?></td>
									<td style="min-width: 100px;">
									<?php $foto = getfotoprofil($d->id);
                					if (!empty($foto)) : ?>
										<img class="img_preview" src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt="">
									<?php endif; ?>	
									</td>
									<td class="text-nowrap"> 
									
										<b><?= $d->nama_sekolah ?></b></td>
									<td class="text-nowrap"><?= $d->alamat ?></td>
									<td style="width: 350px;" ><?= $d->deskripsi ?></td>
									<td class="text-nowrap small"><?= getnamauser($d->id_user) ?></td>
									<td class="place-action text-nowrap">
										<a href="<?= site_url('admin/sekolah_update/' . $d->id) ?>" class="edit" title="Edit"><i class="las la-edit"></i></a>
										<a href="<?= site_url('admin/sekolah_read/' . $d->id) ?>" class="view" title="View"><i class="la la-eye"></i></a>
										<a href="<?= site_url('admin/sekolah_delete/' . $d->id) ?>" class="delete" title="Delete"><i class="la la-trash-alt"></i></a>
									</td>
								</tr>
                                <?php endforeach; ?>
							</tbody>
						</table>
						<div class="pagination align-left">
						<?=  $this->pagination->create_links(); ?>
						</div><!-- .pagination -->