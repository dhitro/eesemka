<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>E-Esemka | SMK Siap Kerja</title>
	<meta name="robots" content="index, follow"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>

	<!-- favicons -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/favicon.ico">

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/fonts/jost/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/line-awesome/css/line-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/fontawesome-pro/css/fontawesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/quilljs/css/quill.bubble.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/quilljs/css/quill.core.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/quilljs/css/quill.snow.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/chosen/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/datetimepicker/jquery.datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/libs/venobox/venobox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   
    <!-- jQuery -->    
    <script src="<?php echo base_url() ?>/assets/js/jquery-1.12.4.js"></script>
	<script src="<?php echo base_url() ?>/assets/libs/popper/popper.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>/assets/libs/slick/slick.min.js"></script>
	<script src="<?php echo base_url() ?>/assets/libs/slick/jquery.zoom.min.js"></script>
	<script src="<?php echo base_url() ?>/assets/libs/isotope/isotope.pkgd.min.js"></script>
	<script src="<?php echo base_url() ?>/assets/libs/quilljs/js/quill.core.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/quilljs/js/quill.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/chosen/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/datetimepicker/jquery.datetimepicker.full.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/venobox/venobox.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
   
    <!-- orther script -->
    <script src="<?php echo base_url() ?>/assets/js/main.js"></script>
</head>

<body>
	<div id="wrapper">
		<header id="header" class="site-header float-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-5">
                        <div class="site">
                            <div class="site__menu">
                                <a title="Menu Icon" href="#" class="site__menu__icon">
                                    <i class="las la-bars la-24-black"></i>
                                </a>
                                <div class="popup-background"></div>
                                <div class="popup popup--left">
                                    <a title="Close" href="#" class="popup__close">
                                        <i class="las la-times la-24-black"></i>
                                    </a><!-- .popup__close -->
                                    <div class="popup__content">
                                        <div class="popup__user popup__box open-form">
                                            <a title="Login" href="#" class="open-login">Login</a>
                                            <a title="Sign Up" href="#" class="open-signup">Sign Up</a>
                                        </div><!-- .popup__user -->
                                        <div class="popup__menu popup__box">
                                            <ul class="menu-arrow">
                                                <li><a title="Page" href="#">Lowongan Kerja</a></li>
                                            </ul>
                                        </div><!-- .popup__menu -->
                                    </div><!-- .popup__content -->
                                    <div class="popup__button popup__box">
                                        <a title="Add place" href="add-place.html" class="btn">
                                            <i class="la la-plus"></i>
                                            <span>Add place</span>
                                        </a>
                                    </div><!-- .popup__button -->
                                </div><!-- .popup -->
                            </div><!-- .site__menu -->
                            <div class="site__brand">
                                <a title="Logo" href="<?= base_url() ?>" class="site__brand__logo"><img src="<?php echo base_url() ?>assets/images/assets/logo.png" alt="Golo"></a>
                                <?= $this->session->flashdata('message'); ?>
                            </div><!-- .site__brand -->
                            
                        </div><!-- .site -->
                    </div><!-- .col-md-6 -->
                    <div class="col-xl-6 col-7">
                        <div class="right-header align-right">
                            <nav class="main-menu">
                                <ul>
                                    <li><a title="Page" href="<?= base_url('lowongankerja') ?> ">Lowongan Kerja</a></li>
                                </ul>
                            </nav>
                            <div class="popup popup-form">
                                <a title="Close" href="#" class="popup__close">
                                    <i class="las la-times la-24-black"></i>
                                </a><!-- .popup__close -->
                                <ul class="choose-form">
                                    <li class="nav-signup"><a title="Sign Up" href="#signup">Sign Up</a></li>
                                    <li class="nav-login"><a title="Log In" href="#login">Log In</a></li>
                                </ul>
                                <div class="popup-content">
                                    <form action="<?= base_url('auth/signup') ?>" method="POST" class="form-sign form-content" id="signup">
                                        <div class="field-inline">
                                            <div class="field-input">
                                                <input type="text" placeholder="First Name" value="" name="first_name">
                                            </div>
                                            <div class="field-input">
                                                <input type="text" placeholder="Last Name" value="" name="last_name">
                                            </div>
                                        </div>
                                        <div class="field-input">
                                            <input type="email" placeholder="Email" value="" name="email">
                                        </div>
                                        <div class="field-input">
                                            <input type="password" placeholder="Password" value="" name="password">
                                        </div>
                                        <div class="field-check">
                                            <label for="accept">
                                                <input type="checkbox" id="accept" value="">
                                                Accept the <a title="Terms" href="#">Terms</a> and <a title="Privacy Policy" href="#">Privacy Policy</a>
                                                <span class="checkmark">
                                                    <i class="la la-check"></i>
                                                </span>
                                            </label>
                                        </div>
                                        <input type="submit" name="submit" value="Sign Up">
                                    </form>
                                    <form action="<?= base_url('auth/login') ?>" method="POST" class="form-log form-content" id="login">
                                        <div class="field-input">
                                            <input type="text" placeholder="Username or Email" value="" name="user" id="user">
                                        </div>
                                        <div class="field-input">
                                            <input type="password" placeholder="Password" value="" name="password" id="password">
                                        </div>
                                        <a title="Forgot password" class="forgot_pass" href="#">Forgot password</a>
                                        <input type="submit" name="submit" value="Login">
                                    </form>
                                </div>
                            </div><!-- .popup-form -->
                            <div class="right-header__search">
                                <a title="Search" href="#" class="search-open">
                                    <i class="las la-search la-24-black"></i>
                                </a>
                                <div class="site__search">
                                    <a title="Close" href="#" class="search__close">
                                        <i class="la la-times"></i>
                                    </a><!-- .search__close -->
                                    <form action="#" class="site__search__form" method="GET">
                                        <div class="site__search__field">
                                            <span class="site__search__icon">
                                                <i class="las la-search la-24-black"></i>
                                            </span><!-- .site__search__icon -->
                                            <input class="site__search__input" type="text" name="s" placeholder="Search places, cities">
                                        </div><!-- .search__input -->
                                    </form><!-- .search__form -->
                                </div><!-- .site__search -->
                            </div>
                            <div class="right-header__button btn">
                                <a title="Login" class="open-login" href="#">Login</a>
                                </a>
                            </div><!-- .right-header__button -->
                        </div><!-- .right-header -->
                    </div><!-- .col-md-6 -->
                </div><!-- .row -->
            </div><!-- .container-fluid -->
        </header><!-- .site-header -->

		<main id="main" class="site-main">
			<section class="site-banner layout-03" style="background-image: url(<?= base_url()?>/assets/images/main-banner.png);">
                <div class="container">
                    <div class="site-banner__content">
                        <h1 class="site-banner__title">Cari Lowongan & Tenaga Kerja</h1>
                        <form action="#" class="site-banner__search layout-02">
                            <div class="field-input">
                                <label for="s">Cari</label>
                                <input class="site-banner__search__input open-suggestion" id="s" type="text" name="s" placeholder="Ex: Desain Grafis, Videografer" autocomplete="off">
                                
                            </div><!-- .site-banner__search__input -->
                            <div class="field-input">
                                <label for="loca">Lokasi</label>
                                <input class="site-banner__search__input open-suggestion" id="loca" type="text" name="where" placeholder="Your city" autocomplete="off">
                                <div class="search-suggestions location-suggestions">
                                    <ul>
                                        <li><a href="#"><i class="las la-location-arrow"></i><span>Current location</span></a></li>
                                        <li><a href="#"><span>Medan</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .site-banner__search__input -->
                            <div class="field-submit">
                                <button><i class="las la-search la-24-black"></i></button>
                            </div>
                        </form><!-- .site-banner__search -->
                    </div><!-- .site-banner__content -->
                </div>
            </section><!-- .site-banner -->
            <section class="list-categories layout-02">
                <div class="container">
                    <div class="inner">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="item hover__box" style="background-image: url(<?= base_url()?>/assets/images/cat.png); background-color: #fccb02">
                                    <a href="#">
                                        <span class="info">
                                            <span class="title">Sekolah</span>
                                            <span class="number">10 Sekolah</span>
                                            <span class="btn">Telusuri</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="item hover__box" style="background-image: url(<?= base_url()?>/assets/images/cat.png); background-color: #23d3d3">
                                    <a href="#">
                                        <span class="info">
                                            <span class="title">Siswa</span>
                                            <span class="number">60 Orang</span>
                                            <span class="btn">Telusuri</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="item hover__box" style="background-image: url(<?= base_url()?>/assets/images/cat.png); background-color: #005450">
                                    <a href="#">
                                        <span class="info">
                                            <span class="title">Perusahaan</span>
                                            <span class="number">12 Perusahaan</span>
                                            <span class="btn">Telusuri</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- .list-categories -->
            <section class="places-wrap">
                <div class="container">
                    <div class="title-wrap align-center">
                        <h2>Popular Loker</h2>
                    </div>
                    <div class="slick-sliders offset-item">
                        <div class="slick-slider trending-slider slider-pd30" data-item="4" data-arrows="true" data-itemScroll="1" data-dots="true" data-centerPadding="30" data-tabletitem="2" data-mobileitem="1" data-mobilearrows="false">
                            <div class="place-item layout-02 place-hover">
                                <div class="place-inner">
                                    <div class="place-thumb hover-img">
                                        <a class="entry-thumb" href="<?= base_url('lowongankerja/detail/').'1'?>"><img src="<?php echo base_url() ?>assets/images/listing.jpg" alt=""></a>
                                        <a href="#" class="author" title="Author"><img src="<?php echo base_url() ?>assets/images/avatars/default.jpg" alt="Author"></a>
                                    </div>  
                                    <div class="entry-detail">
                                        <div class="entry-head">
                                            <div class="place-type list-item">
                                                <span>Desain Grafis</span>
                                            </div>
                                            <div class="place-city">
                                                <a href="#">Medan</a>
                                            </div>
                                        </div>
                                        <h3 class="place-title"><a href="<?= base_url('lowongankerja/detail/').'1'?>">Lowongan Kerja Desain Grafis Part Time</a></h3>
                                        <div class="entry-address"><i class="las la-map-marker"></i>PT. ESEMKA MEDAN</div>
                                    </div>
                                </div>
                            </div>
                            <div class="place-item layout-02 place-hover">
                                <div class="place-inner">
                                    <div class="place-thumb hover-img">
                                        <a class="entry-thumb" href="<?= base_url('lowongankerja/detail/').'1'?>"><img src="<?php echo base_url() ?>assets/images/listing.jpg" alt=""></a>
                                        <a href="#" class="author" title="Author"><img src="<?php echo base_url() ?>assets/images/avatars/default.jpg" alt="Author"></a>
                                    </div>  
                                    <div class="entry-detail">
                                        <div class="entry-head">
                                            <div class="place-type list-item">
                                                <span>Desain Grafis</span>
                                            </div>
                                            <div class="place-city">
                                                <a href="#">Medan</a>
                                            </div>
                                        </div>
                                        <h3 class="place-title"><a href="<?= base_url('lowongankerja/detail/').'1'?>">Lowongan Kerja Desain Grafis Part Time</a></h3>
                                        <div class="entry-address"><i class="las la-map-marker"></i>PT. ESEMKA MEDAN</div>
                                    </div>
                                </div>
                            </div>
                            <div class="place-item layout-02 place-hover">
                                <div class="place-inner">
                                    <div class="place-thumb hover-img">
                                        <a class="entry-thumb" href="<?= base_url('lowongankerja/detail/').'1'?>"><img src="<?php echo base_url() ?>assets/images/listing.jpg" alt=""></a>
                                        <a href="#" class="author" title="Author"><img src="<?php echo base_url() ?>assets/images/avatars/default.jpg" alt="Author"></a>
                                    </div>  
                                    <div class="entry-detail">
                                        <div class="entry-head">
                                            <div class="place-type list-item">
                                                <span>Desain Grafis</span>
                                            </div>
                                            <div class="place-city">
                                                <a href="#">Medan</a>
                                            </div>
                                        </div>
                                        <h3 class="place-title"><a href="<?= base_url('lowongankerja/detail/').'1'?>">Lowongan Kerja Desain Grafis Part Time</a></h3>
                                        <div class="entry-address"><i class="las la-map-marker"></i>PT. ESEMKA MEDAN</div>
                                    </div>
                                </div>
                            </div>
                            <div class="place-item layout-02 place-hover">
                                <div class="place-inner">
                                    <div class="place-thumb hover-img">
                                        <a class="entry-thumb" href="<?= base_url('lowongankerja/detail/').'1'?>"><img src="<?php echo base_url() ?>assets/images/listing.jpg" alt=""></a>
                                        <a href="#" class="author" title="Author"><img src="<?php echo base_url() ?>assets/images/avatars/default.jpg" alt="Author"></a>
                                    </div>  
                                    <div class="entry-detail">
                                        <div class="entry-head">
                                            <div class="place-type list-item">
                                                <span>Desain Grafis</span>
                                            </div>
                                            <div class="place-city">
                                                <a href="#">Medan</a>
                                            </div>
                                        </div>
                                        <h3 class="place-title"><a href="<?= base_url('lowongankerja/detail/').'1'?>">Lowongan Kerja Desain Grafis Part Time</a></h3>
                                        <div class="entry-address"><i class="las la-map-marker"></i>PT. ESEMKA MEDAN</div>
                                    </div>
                                </div>
                            </div>
                            <div class="place-item layout-02 place-hover">
                                <div class="place-inner">
                                    <div class="place-thumb hover-img">
                                        <a class="entry-thumb" href="<?= base_url('lowongankerja/detail/').'1'?>"><img src="<?php echo base_url() ?>assets/images/listing.jpg" alt=""></a>
                                        <a href="#" class="author" title="Author"><img src="<?php echo base_url() ?>assets/images/avatars/default.jpg" alt="Author"></a>
                                    </div>  
                                    <div class="entry-detail">
                                        <div class="entry-head">
                                            <div class="place-type list-item">
                                                <span>Desain Grafis</span>
                                            </div>
                                            <div class="place-city">
                                                <a href="#">Medan</a>
                                            </div>
                                        </div>
                                        <h3 class="place-title"><a href="<?= base_url('lowongankerja/detail/').'1'?>">Lowongan Kerja Desain Grafis Part Time</a></h3>
                                        <div class="entry-address"><i class="las la-map-marker"></i>PT. ESEMKA MEDAN</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="place-slider__nav slick-nav">
                            <div class="place-slider__prev slick-nav__prev">
                                <i class="la la-arrow-left"></i>
                            </div><!-- .place-slider__prev -->
                            <div class="place-slider__next slick-nav__next">        
                                <i class="la la-arrow-right"></i>
                            </div><!-- .place-slider__next -->
                        </div><!-- .place-slider__nav -->
                    </div>
                </div>
            </section><!-- .places-wrap -->
            <section class="banner-contact">
                <div class="container">
                    <div class="banner-inner">
                        <h2>Mencari Tenaga Kerja yang sesuai dengan kebutuhanmu.</h2>
                        <a href="#" class="btn">Hubungi 00 111 2222 33</a>
                    </div>
                </div>
            </section><!-- .banner-wrap -->
		</main><!-- .site-main -->

		<footer id="footer" class="footer">
			<div class="container">
				<div class="footer__bottom">
					<p class="footer__bottom__copyright">2023 &copy; <a title="domain esemka" href="#">domain esemka</a>. All rights reserved.</p>
				</div><!-- .top-footer -->
			</div><!-- .container -->
		</footer><!-- site-footer -->
	</div><!-- #wrapper -->
</body>
</html>