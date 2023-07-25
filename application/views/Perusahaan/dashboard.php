<div class="member-statistical">
	<div class="row">
		<div class="col-lg-3 col-6">
			<div class="item blue">
				<h3>Active Lowongan</h3>
				<span class="number"><?= count(loadlowongan($id)) ?></span>
				<span class="line"></span>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="item green">
				<h3>Pelamar</h3>
				<span class="number"><?= count(loadlamaranall($id)) ?></span>
				<span class="line"></span>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="item yellow">
				<h3>Permintaan Siswa</h3>
				<span class="number"><?= count(loadsekolah()) ?></span>
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
							$User = loadlamaranall();
							$user  = array_filter($User, function ($row) {
								return $row->is_active == "0";
							});

							foreach($user as $us):
						?>
						<li class="pending">
							<p class="date"><b>Date:</b><?= $us->created_at ?></p>
							<p class="place"><b>Nama:</b><?= $us->firstname ?></p>
							<p class="place"><b>Lulusan:</b>S1</p>
							<p class="status"><b>Status:</b><span><?= $us->firstname ?></span></p>
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
				<a href="#" class="close" data-close="upgrade-box"><i class="las la-times"></i></a>
			</div>
		</div>
	</div>
</div><!-- .owner-box -->