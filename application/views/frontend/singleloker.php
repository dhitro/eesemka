			<div class="place">	
				<div class="container">
					<div class="row">
						<div class="col-lg-8">
							<div class="place__left">
								<div class="place__box place__box--npd">
									<h1></h1>
                                    <h1><?php echo $nama_lowongan; ?></h1>
									<div class="entry-address"><i class="las la-map-marker"></i><?= getnamaperusahaan($d->id_perusahaan)  ?></div>
								</div><!-- .place__box -->
								<div class="place__box place__box-overview">
									<h3>Detail</h3>
									<div class="place__desc"><?php echo $deskripsi; ?></div>
								</div>
								<div class="place__box place__box-open">
									<h3 class="place__title--additional">
										Persyaratan
									</h3>
	                                <table class="open-table">
									<?php echo $persyaratan; ?>
	                                </table>
								</div><!-- .place__box -->
							</div><!-- .place__left -->
						</div>
						<div class="col-lg-4">
							<div class="sidebar sidebar--shop sidebar--border">
								<div class="widget-reservation-mini">
	                                <h3>Make a reservation</h3>
	                                <a href="#" class="open-wg btn">Request</a>
	                            </div>
								<aside class="widget widget-shadow widget-reservation">
									<h3>lowongan Kerja Tersedia</h3>
                                    
									<form action="#" method="POST" class="form-underline">
										<div class="field-select has-sub field-guest">
											<span class="sl-icon"><i class="la la-user-friends"></i></span>
											<i class="la la-angle-down"></i>
											<select name="price_range" id="price_range">
											<?php foreach (loadposisilowongan($id) as $posisi) : ?>
                                                <option value="<?= $posisi->id ?>"><?= $posisi->nama ?></option>
												<?php endforeach; ?>
                                            </select>
											
										</div>
										<input type="submit" name="submit" value="Lamar">
										<p class="note">Lengkapi Data Sebelum Lamar Perkerjaan</p>
									</form>
								</aside><!-- .widget-reservation -->
							</div><!-- .sidebar -->
						</div>
					</div>
				</div>
			</div><!-- .place -->
		