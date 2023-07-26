<div class="member-statistical">
	<div class="row">
		<div class="col-lg-6 col-6">
			<div class="item blue">
				<h3>Siswa  / Alumni</h3>
				<span class="number"><?= count(loadsiswasekolah($usekola)) ?></span>
				<span class="line"></span>
			</div>
		</div>
		<div class="col-lg-6 col-6">
			<div class="item yellow">
				<h3>Permintaan</h3>
				<span class="number"><?= count($data) ?></span>
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
					<h3>Siswa / Alumni Terbaru</h3>
					<a href="sekolah/siswa" class="view-all" title="View All">View all</a>
				</div>
				<div class="ob-content">
					<ul>
						<?php
						$Perm =  loadsiswasekolah($usekola);
						foreach($Perm as $per):
						?>

						<li class="approve">
							<p class="date"><b>Date:</b><?= $per->created_at ?></p>
							<p class="place"><b>Nama:</b><?= $per->nama_siswa ?></p>
							<p class="place"><b>Status:</b><?= $per->status ?></p>
							<p class="place"><b>Verifikasi:</b><?= $per->is_valid ?></p>
							<a href="#" title="More" class="more"><i class="las la-angle-right"></i></a>
						</li>

						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="ob-item">
				<div class="ob-head">
					<h3>Permintaan Terbaru</h3>
					<a href="sekolah/siswa" class="view-all" title="View All">View all</a>
				</div>
				<div class="ob-content">
					<ul>
						<?php
						$Perm =  $data;
						foreach($Perm as $per):
						?>
						<?php
						$st = '';
						if ($per->status == 'Approve') $st = 'approve';
						if ($per->status == 'Pending') $st = 'pending';
						if ($per->status == 'Reject') $st = 'reject';
						?>

						<li class="<?php echo $st ?>" >
							<p class="date"><b>Date:</b><?= $per->created_at ?></p>
							<p class="place"><b>Nama:</b><?= getnamasiswa($per->id_siswa) ?></p>
							<p class="place"><b>Status:</b><?= $per->status ?></p>
							<a href="#" title="More" class="more"><i class="las la-angle-right"></i></a>
						</li>

						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="ob-item">
				<div class="ob-head">
					<h3>Lamaran Terbaru</h3>
				</div>
				<div class="ob-content">
					<ul>
						<?php
						$Perm =  $lowongan;
						foreach($Perm as $per):
						?>

						<li class="approve">
							<p class="date"><b>Date:</b><?= $per->created_at ?></p>
							<p class="place"><b>Nama:</b><?= getnamasiswa($per->id_siswa) ?></p>
							<p class="place"><b>Status:</b><?= $per->status ?></p>
						</li>

						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>

		<!-- <div class="col-lg-4">
			<div class="upgrade-box">
				<h1>Cari Siswa Magang disini!</h1>
				<p>anda dapat memilih siswa mana yang kompeten untuk perusahaan anda.</p>
				<a href="siswa-list.html" class="btn" title="Upgrade now">Cari Siswa</a>
				<a href="#" class="close" data-close="upgrade-box"><i class="las la-times"></i></a>
			</div>
		</div> -->
	</div>
</div><!-- .owner-box -->