<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="place__left">
                <div class="place__box place__box--npd">
                    <h1></h1>
                    <h1><?= $nama_lowongan ?> </h1>
                </div><!-- .place__box -->
                <div class="place__box place__box-overview">
                    <h3>Overview</h3>
                    <div class="place__desc"><?= htmlspecialchars_decode($deskripsi) ?> </div><!-- .place__desc -->
                    <a href="#" class="show-more" title="Show More">Show more</a>
                </div>
                <div class="place__box">
                    <h3>Contact Info</h3>
                    <ul class="place__contact">
                        <li>
                            <i class="la la-phone"></i>
                            <a title="00 343 7859" href="tel:003437859">00 123 4567</a>
                        </li>
                        <li>
                            <i class="la la-globe"></i>
                            <a title="www.abcsite.com" href="www.abcsite.com">www.abcdefg.com</a>
                        </li>
                        <li>
                            <i class="la la-facebook-f"></i>
                            <a title="fb.com/abc" href="fb.com/abc">facebook.com/eesemka</a>
                        </li>
                        <li>
                            <i class="la la-instagram"></i>
                            <a title="instagram.com/abc" href="instagram.com/abc">instagram.com/eesemka</a>
                        </li>
                    </ul>
                </div><!-- .place__box -->
                <div class="place__box place__box-open">
                    <h3 class="place__title--additional">
                        Persyaratan
                    </h3>
                    <?= htmlspecialchars_decode($persyaratan) ?>
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
                   
                    <form action="<?= base_url('siswa/lamaran_create_action') ?>" method="POST" class="form-underline">
                        <div class="field-select has-sub field-guest">
                            <span class="sl-icon"><i class="la la-user-friends"></i></span>
                            <i class="la la-angle-down"></i>
                            <input type="hidden" name="id_lowongan" id="id_lowongan" value="<?= $id?>" >
                            <select name="id_posisi" id="id_posisi">
                                <option value="" selected>Pilih Posisi</option>
                                <?php foreach (loadposisilowongan($id) as $bp) :  ?>
                                <option value="<?= $bp->id_posisi ?>"><?= getnamaposisi($bp->id_posisi) ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="submit" name="submit" value="Lamar">
                        <p class="note">Lengkapi Data Sebelum Lamar Perkerjaan
                            <div class="text-danger"><?= $this->session->flashdata('message'); ?></div>
                        </p>
                    </form>
                </aside><!-- .widget-reservation -->
            </div><!-- .sidebar -->
        </div>
    </div>
</div>

<div class="similar-places">
    <div class="container">
        <h2 class="similar-places__title title">Similar places</h2>
        <div class="similar-places__content">
            <div class="row">
                <!-- hello -->

                <?php
                $no = 1;
                foreach ($data as $d) :
                    $foto = getfotofeeds($d->id);

                ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="place-item layout-02 place-hover">
                            <div class="place-inner">
                                <div class="place-thumb hover-img">
                                    <?php if (!empty($foto)) : ?>
                                        <a class="entry-thumb" href="<?= base_url('siswa/lowongandetail/') . $d->id ?> "><img src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt=""></a>
                                    <?php else : ?>
                                        <a class="entry-thumb" href="<?= base_url('siswa/lowongandetail/') . $d->id ?> "><img src="<?= base_url('assets/') ?>images/listing.jpg" alt=""></a>
                                    <?php endif; ?>
                                    <a href="#" class="author" title="<?= getnamauser($d->created_by)  ?>"><img src="<?= base_url('assets/') ?>images/avatars/default.jpg" alt="<?= getnamauser($d->created_by)  ?>"></a>
                                </div>
                                <div class="entry-detail">
                                    <div class="entry-head">
                                        <div class="place-type list-item">
                                            <?php foreach (loadposisilowongan($d->id) as $bp) :  ?>
                                                <small><?= getnamaposisi($bp->id_posisi) ?></small>,
                                            <?php endforeach; ?>

                                        </div>
                                        <div class="place-city">
                                            <a href="#">Medan</a>
                                        </div>
                                    </div>
                                    <h3 class="place-title"><a href="<?= base_url('siswa/lowongandetail/') . $d->id ?> "><?= $d->nama_lowongan ?></a></h3>
                                    <div class="entry-address"><i class="las la-map-marker"></i><?= getnamaperusahaan($d->id_perusahaan)  ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div><!-- .similar-places -->