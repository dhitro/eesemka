<div class="page-title" style="background-image: url(<?= base_url() ?>assets/images/bg/bg-loker.jpg);">
    <div class="container">
        <div class="page-title__content">
            <h1 class="page-title__name">Lowongan Kerja</h1>
        </div>
    </div>
</div><!-- .page-title -->
<div class="container">

    <div class="member-filter mt-5">
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
    <div class="mw-box">
        <h2></h2>
        <div class="area-places layout-3col">
            <?php
            $no = 1;
            foreach ($data as $d) : ?>
                <div class="place-item layout-02 place-hover">
                    <div class="place-inner">
                        <div class="place-thumb hover-img">
                            <a class="entry-thumb" href="<?= base_url('lowongankerja/detail/') . '1' ?>"><?php $foto = getfotofeeds($d->id);
                                                                                                        if (!empty($foto)) : ?>
                                    <img class="img_pre" src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt="">
                                <?php endif; ?></a>
                        </div>
                        <div class="entry-detail">
                            <div class="entry-head">
                                <div class="place-type list-item">
                                    <span>
                                        <?php foreach (loadposisilowongan($d->id) as $bp) :  ?>
                                            <?= getnamaposisi($bp->id_posisi) ?> |
                                        <?php endforeach; ?>
                                    </span>
                                </div>
                            </div>
                            <h3 class="place-title"><a href="<?= site_url('lowongankerja/detail/' . $d->id) ?>"><?= $d->nama_lowongan ?></a></h3>
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