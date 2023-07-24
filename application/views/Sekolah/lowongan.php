<div class="container">
    <div class="mw-box">
        <h2></h2>
        <div class="area-places layout-3col">
            <?php
            $no = 1;
            foreach ($data as $d) :
                $foto = getfotofeeds($d->id);

            ?>
                <div class="place-item layout-02 place-hover">
                    <div class="place-inner">
                        <div class="place-thumb hover-img">
                            <?php if (!empty($foto)) : ?>
                                <a class="entry-thumb" href="<?= base_url('sekolah/lowongandetail/').$d->id ?> "><img src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt=""></a>
                            <?php else : ?>
                                <a class="entry-thumb" href="<?= base_url('sekolah/lowongandetail/').$d->id ?> "><img src="<?= base_url('assets/') ?>images/listing.jpg" alt=""></a>
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
                            <h3 class="place-title"><a href="<?= base_url('sekolah/lowongandetail/').$d->id ?> "><?= $d->nama_lowongan ?></a></h3>
                            <div class="entry-address"><i class="las la-map-marker"></i><?= getnamaperusahaan($d->id_perusahaan)  ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div><!-- .member-wrap -->
    <div class="pagination align-left">
        <?= $this->pagination->create_links(); ?>
    </div><!-- .pagination -->
    <br><br>
</div>