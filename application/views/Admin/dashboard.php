<div class="member-statistical">
	<div class="row">
		<div class="col-lg-3 col-6">
			<div class="item blue">
				<h3>Sekolah</h3>
				<span class="number"><?= count(loadsekolah()) ?> </span>
				<span class="line"></span>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="item green">
				<h3>Siswa</h3>
				<span class="number"><?= count(loadsiswa()) ?></span>
				<span class="line"></span>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="item yellow">
				<h3>Perusahaan</h3>
				<span class="number"><?= count(loadperusahaan()) ?></span>
				<span class="line"></span>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="item purple">
				<h3>Lowongan Kerja</h3>
				<span class="number"><?= count(loadlowongan()) ?></span>
				<span class="line"></span>
			</div>
		</div>
	</div>

</div><!-- .member-statistical -->
<div class="member-statistical">

	<div class="row">
		<div class="col-lg-3 col-6">
			<div class="item blue">
				<h3>Lamaran Kerja</h3>
				<span class="number"><?= count(loadlamaranall()) ?></span>
				<span class="line"></span>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="item green">
				<h3>Permintaan Perusahaan</h3>
				<span class="number"><?= count(loadsekolah()) ?></span>
				<span class="line"></span>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="item yellow">
				<h3>User Pengguna</h3>
				<span class="number"><?= count(loaduserall()) ?></span>
				<span class="line"></span>
			</div>
		</div>
	</div>
</div>
<div class="owner-box">
	<div class="row">
		<div class="col-lg-4">
			<div class="ob-item">
				<div class="ob-head">
					<h3>User Terbaru</h3>
					<a href="#" class="view-all" title="View All">View all</a>
				</div>
				<div class="ob-content">
					<ul>
						<?php
						$User = loaduserall();
						$user  = array_filter($User, function ($row) {
							return $row->is_active == "0";
						});

						foreach($user as $us):
						?>
						<li class="pending">
							<p class="date"><b>Date:</b><?= $us->created_at ?></p>
							<p class="place"><b>Nama:</b><?= $us->firstname ?></p>
							<p class="status"><b>Status:</b><span>Not Active</span></p>
							<a href="<?= base_url('admin/user') ?>" title="More" class="more"><i class="las la-angle-right"></i></a>
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
						$Perm =  loadpermintaan();
						$Perm  = array_filter($Perm, function ($row) {
							return $row->status == "Pending";
						});
						foreach($Perm as $per):
						?>
						<li class="pending">
							<p class="date"><b>Date:</b><?= $per->created_at ?></p>
							<p class="place"><b>Nama:</b><?= getnamasiswa($per->id_siswa) ?></p>
							<p class="status"><b>Status:</b><span>Pending</span></p>
							<a href="<?= base_url('admin/user') ?>" title="More" class="more"><i class="las la-angle-right"></i></a>
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
				<a href="siswa-list.html" class="btn" title="Upgrade now">Cari Siswa</a>
				<a href="<?= base_url('admin/permintaan') ?>" class="close" data-close="upgrade-box"><i class="las la-times"></i></a>
			</div>
		</div>
	</div>
</div><!-- .owner-box -->