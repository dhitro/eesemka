<div class="listing-main">
<div class="listing-nav">
				<div class="listing-menu nav-scroll">
					<ul>
						<li class="active"><a href="#profilsiswa" title="Profil Siswa"><span class="icon"><i class="la la-cog"></i></span><span>Profil Siswa</span></a></li>
						<li><a href="#pengalamankerja" title="pengalamankerja"><span class="icon"><i class="la la-wifi"></i></span><span>Pengalaman Kerja</span></a></li>
						<li><a href="#sertifikat" title="sertifikat"><span class="icon"><i class="la la-image"></i></span><span>Sertifikat</span></a></li>
					</ul>
				</div>
			</div><!-- .listing-nav -->

<div class="listing-content">
    <h2>Biodata</h2>
    <form action="#" class="upload-form">
        <div class="listing-box" id="profilsiswa">
            <h3>Profil Siswa</h3>
            <?php $foto = getfotoprofil($id, 3);
            if (!empty($foto)) : ?>
                <a href="#" class="hovers"><img src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt=""></a>
            <?php endif; ?>
            <p class="place"><b>NIK :</b> <?php echo $nik; ?></p>
            <p class="place"><b>Nama Siswa :</b> <?php echo $nama_siswa; ?></p>
            <p class="status"><b>Jenis Kelamin:</b><span><?php echo $jenis_kelamin; ?></span></p>
            <p class="status"><b>Alamat:</b><span><?php echo $alamat; ?></span></p>
            <p class="status"><b>Status:</b><span><?php echo $status; ?></span></p>
            <p class="place"><b>Deskripsi :</b> <?php echo $deskripsi; ?></p>

        </div>

        <div class="listing-box" id="pengalamankerja">
            <h3>Pengalaman Kerja</h3>
            <?php foreach ($data = loadsiswapengalaman($id) as $p) : ?>
                <p class="place"><b> <?= $p->tahun ?>:</b> <?= $p->pengalaman ?></p>
            <?php endforeach; ?>


        </div>

        <div class="listing-box" id="sertifikat">
            <h3>Sertifikat</h3>
            <div class="field-group field-file">
                <label for="cover_img">Sertifikat Keahlian</label>
                <?php foreach ($data = loadsiswakeahlian($id) as $p) :
                    $tipe = explode(".", $p->file);
                    $valid = ['png', 'jpg', 'jpeg', 'gif'];
                ?>
                    <label for="cover_img" class="preview">
                        <?php if (in_array($tipe[1], $valid)) : ?>
                            <img class="img_pre" src="<?= base_url() . "upload/dokumen/" . $p->file ?>" alt="">
                        <?php else : ?>
                            <a style="margin:50px 0 50px 25px;" class="btn badge btn-danger img_pre" href="<?= base_url() . "upload/dokumen/" . $p->file ?>">Dokumen</a>
                        <?php endif; ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <div class="field-group field-file">
                <label for="gallery_img">Sertifikat Pendukung</label>
                <?php foreach ($data = loadsiswapendukung($id) as $p) : ?>
                <label for="gallery_img" class="preview">
                <?php if(in_array($tipe[1],$valid)) : ?>
                        <img class="img_pre" src="<?= base_url() . "upload/dokumen/" . $p->file ?>" alt="">
                        <?php else: ?>
                          <a  style="margin:50px 0 50px 25px;" class="btn badge btn-danger img_pre" href="<?= base_url() . "upload/dokumen/" . $p->file ?>">Dokumen</a>
                        <?php endif; ?>
                </label>
                <?php endforeach; ?>
               
            </div>
            <!-- <div class="field-group">
                <label for="place_video">Video (optional)</label>
                <input type="url" id="place_video" placeholder="Youtube video url" name="place_video">
            </div> -->
        </div><!-- .listing-box -->
        <!-- <div class="field-group field-submit">
            <input type="submit" name="submit" value="Kirim Permintaan" class="btn">
        </div> -->

    </form>
    <div class="field-submit mt-3">
            <a href="#" onclick="history.back()" class="btn btn-danger">Back</a>
          </div>
</div><!-- .listing-content -->
</div>