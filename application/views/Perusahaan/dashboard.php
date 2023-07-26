<div class="member-statistical">
	<div class="row">
		<?php
        $respon = array_filter($data, function ($row) {
            return ($row->status == 'Publish')  && $row->status == 'Close';
        });
        ?>
		<div class="col-lg-4 col-6">
			<div class="item blue">
				<h3>Lowongan</h3>
				<span class="number"><?= count(loadlowonganid($ui)) ?></span>
				<span class="line"></span>
			</div>
		</div>
		<div class="col-lg-4 col-6">
			<div class="item green">
				<h3>Pelamar</h3>
				<span class="number"><?= count(loadlamaran($ui)) ?></span>
				<span class="line"></span>
			</div>
		</div>
		<div class="col-lg-4 col-6">
			<div class="item yellow">
				<h3>Permintaan Siswa</h3>
				<span class="number"><?= count(loadpermintaanid($ui)) ?></span>
				<span class="line"></span>
			</div>
		</div>
	</div>
</div><!-- .member-statistical -->
<div class="owner-box">
	<div class="row">
		<div class="col-lg-4">
			<div class="ob-item">
				<div class="ob-head">
					<h3>Pelamar Terbaru</h3>
					<a href="perusahaan/pelamar" class="view-all" title="View All">View all</a>
				</div>
				<div class="ob-content">
					<ul>
						<?php
							$sis =  loadlamaran($ui);
							foreach($sis as $lam):
						?>
						<?php
						$st = '';
						if ($lam->status == 'Approve') $st = 'approve';
						if ($lam->status == 'Pending') $st = 'pending';
						if ($lam->status == 'Reject') $st = 'reject';
						?>
						<li class="<?php echo $st ?>" >
							<p class="date"><b>Date:</b><?= $lam->created_at ?></p>
							<p class="place"><b>Nama:</b><?= getnamasiswa($lam->id_siswa) ?></p>
							<p class="place"><b>Lowongan:</b><?= getnamalowongan($lam->id_lowongan) ?></p>
							<p class="status"><b>Status:</b><span><?= $lam->status ?></span></p>
						</li>
						<?php endforeach; ?>
					</ul>
						
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="ob-item">
				<div class="ob-head">
					<h3>Permintaan Siswa</h3>
					<a href="#" class="view-all" title="View All">View all</a>
				</div>
				<div class="ob-content">
					<ul>
					<?php
						$Perm =  loadpermintaanid($ui);
						$Perm  = array_filter($Perm, function ($row) {
							return $row->status == "Approve";
						});
						foreach($Perm as $per):
						?>
						<li class="approve">
							<p class="date"><b>Date:</b><?= $per->created_at ?></p>
							<p class="place"><b>Nama:</b><?= getnamasiswa($per->id_siswa) ?></p>
							<p class="status"><b>Status:</b><span>Approve</span></p>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="upgrade-box">
				<h1>Cari Siswa Magang disini!</h1>
				<p>anda dapat memilih siswa mana yang kompeten untuk perusahaan anda.</p>
				<a href="<?= base_url() . "perusahaan/siswa" ?>" class="btn" title="Upgrade now">Cari Siswa</a>
				<a href="#" class="close" data-close="upgrade-box"><i class="las la-times"></i></a>
			</div>
		</div>

		
	</div>
</div><!-- .owner-box -->

