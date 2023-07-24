<div class="owner-top">
    <div class="container">
        <?php
        $respon = array_filter($data, function ($row) {
            return ($row->status == 'Approve')  && $row->status == 'Reject';
        });
        ?>
        <div class="member-statistical">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <div class="item blue">
                        <h3>Masukan Lowongan</h3>
                        <span class="number"><?= count($data) ?></span>
                        <span class="line"></span>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="item green">
                        <h3>Respon Lowongan</h3>
                        <span class="number"><?= count($respon) ?> </span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .owner-top -->
<div class="owner-page-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="owner-page-content">
                    <?php if (count($data) > 0) : ?>
                        <h2>Lowongan Yang Anda Masukan</h2>

                    <?php else : ?>
                        <h2 class="text-danger"> Belum Ada Lamaran Yang Anda Masukan</h2>
                    <?php endif; ?>
                    <div class="area-places layout-3col">
                        <?php
                        $no = 1;
                        foreach ($data as $d) :
                            $foto = getfotofeeds($d->id_lowongan);

                            $st = '';
                            if ($d->status == 'Approve') $st = 'text-success';
                            if ($d->status == 'Pending') $st = 'text-warning';
                            if ($d->status == 'Reject') $st = 'text-danger';

                        ?>
                            <div class="place-item layout-02 place-hover">
                                <div class="place-inner">
                                    <div class="place-thumb hover-img">
                                        <?php if (!empty($foto)) : ?>
                                            <a class="entry-thumb" href="<?= base_url('siswa/lowongandetail/') . $d->id_lowongan ?> "><img src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt=""></a>
                                        <?php else : ?>
                                            <a class="entry-thumb" href="<?= base_url('siswa/lowongandetail/') . $d->id_lowongan ?> "><img src="<?= base_url('assets/') ?>images/listing.jpg" alt=""></a>
                                        <?php endif; ?>
                                        <a href="#" class="author" title="<?= getnamauser($d->created_by)  ?>"><img src="<?= base_url('assets/') ?>images/avatars/default.jpg" alt="<?= getnamauser($d->created_by)  ?>"></a>
                                    </div>
                                    <div class="entry-detail">
                                        <div class="entry-head">
                                            <div class="place-type list-item">
                                                <small><?= getnamaposisi($d->id_posisi) ?></small>,

                                            </div>
                                            <div class="place-city">
                                                <a href="#">Medan</a>
                                            </div>
                                        </div>
                                        <h3 class="place-title"><a href="<?= base_url('siswa/lowongandetail/') . $d->id_lowongan . '/' . $d->id_posisi ?> "><?= getnamalowongan($d->id_lowongan)  ?></a></h3>
                                        <div class="entry-address"><i class="las la-map-marker"></i><?= getnamaperusahaan($d->id_lowongan)  ?></div>
                                        <div class="<?= $st ?>"><?= $d->status ?></div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="pagination align-left">
                        <?= $this->pagination->create_links(); ?>
                    </div><!-- .pagination -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="ob-item">
                        <div class="ob-head">
                            <h3>Notifications <span>(5)</span></h3>
                            <a href="#" class="clear-all" title="Clear All">Clear all</a>
                        </div>
                        <div class="ob-content">
                            <ul>
                                <li class="noti-item unread">
                                    <p>Lowongan Anda Diterima <br> Permintaan ID: #123434</p>
                                    <span>1d ago</span><a href="#" class="delete-noti" title="Delete">Delete</a>
                                </li>
                                <li class="noti-item unread">
                                    <p>Lowongan Anda Ditolak <br> Permintaan ID: #123434</p>
                                    <span>1d ago</span><a href="#" class="delete-noti" title="Delete">Delete</a>
                                </li>
                                <li class="noti-item unread">
                                    <p>Lowongan Anda Diterima <br> Permintaan ID: #123434</p>
                                    <span>1d ago</span><a href="#" class="delete-noti" title="Delete">Delete</a>
                                </li>
                                <li class="noti-item unread">
                                    <p>Lowongan Anda Diterima <br> Permintaan ID: #123434</p>
                                    <span>1d ago</span><a href="#" class="delete-noti" title="Delete">Delete</a>
                                </li>
                                <li class="noti-item unread">
                                    <p>Lowongan Anda Ditolak <br> Permintaan ID: #123434</p>
                                    <span>1d ago</span><a href="#" class="delete-noti" title="Delete">Delete</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>