	<div class="container">
		<div class="member-wishlist-wrap">
				<div class="member-wrap-top">
				<h2>Permintaan Siswa <?php echo $ini; ?>   <a href="<?= base_url() . "perusahaan/siswa" ?>" class="btn" title="Data Siswa">Data Seluruh Siswa</a></h2>
			</div><!-- .member-wrap-top -->
			<div><?= $this->session->flashdata('message'); ?></div>
			<div class="container">

			<div class="mw-box">
        <h2></h2>
        <div class="area-places layout-3col">
				<?php
				$no = 1;
				foreach ($data as $d) : ?>
                <div class="place-item layout-02 place-hover">
                    <div class="place-inner">
						<?php
						$st = '';
						if ($d->status == 'Approve') $st = 'background:#b5ffae!important;';
						if ($d->status == 'Pending') $st = '';
						if ($d->status == 'Reject') $st = 'background:#ffa6a6!important;';
						?>
                        <div class="place-thumb hover-img">
						<?php $foto = getfotoprofil($d->id_siswa, 3);
							if (!empty('$foto')) : ?>
                                <a class="entry-thumb" href="#"><img src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt=""></a>
                            <?php else : ?>
                                <a class="entry-thumb" href="#"><img src="<?= base_url('assets/') ?>images/listing.jpg" alt=""></a>
                            <?php endif; ?>
                            <a href="#" class="author" title="<?= getnamauser($d->created_by)  ?>"><img src="<?= base_url('assets/') ?>images/avatars/default.jpg" alt="<?= getnamauser($d->created_by)  ?>"></a>
                        </div>
                        <div class="entry-detail" style="<?= $st ?>">
                            <div class="entry-head">
                                <div class="place-type list-item">
                                    <small><?= getnamasekolah('$d->id_sekolah') ?></small>
                                </div>
                            </div>
                            <h3 class="place-title"><a href="#"><?= getsiswa($d->id_siswa) ?></a></h3>
                            	
							<td class="small text-status <?= $st ?>"><b><?= $d->status ?></b></td>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div><!-- .member-wrap -->


		<br><br>
	</div>



<div class="pagination align-left">
	<?= $this->pagination->create_links(); ?>
</div><!-- .pagination -->