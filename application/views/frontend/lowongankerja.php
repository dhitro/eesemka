
			<div class="page-title" style="background-image: url(<?= base_url() ?>assets/images/bg/bg-loker.jpg);">
				<div class="container">
					<div class="page-title__content">
						<h1 class="page-title__name">Lowongan Kerja</h1>
					</div>
				</div>	
			</div><!-- .page-title -->
			<div class="container">
                <div class="mw-box">
                    <h2></h2>
                    <div class="area-places layout-3col">
                        <?php
                        $no = 1;
                        foreach ($data as $d) : ?>
                        <div class="place-item layout-02 place-hover">
                            <div class="place-inner">
                                <div class="place-thumb hover-img">
                                    <a class="entry-thumb" href="<?= base_url('lowongankerja/detail/').'1'?>"><?php $foto = getfotofeeds($d->id);
                                        if (!empty($foto)) : ?>
                                            <img class="img_pre"  src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt="">
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
                <div class="pagination">
                    <div class="pagination__numbers">
                        <span>1</span>
                        <a title="2" href="#">2</a>
                        <a title="Next" href="#">
                            <i class="la la-angle-right"></i>
                        </a>
                    </div>
                </div>
                <br><br>  
      