<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= $title ?></title>
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!-- favicons -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/favicon.ico">

    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/fonts/jost/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/line-awesome/css/line-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/fontawesome-pro/css/fontawesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/bootstrap/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/quilljs/css/quill.bubble.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/quilljs/css/quill.core.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/quilljs/css/quill.snow.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/chosen/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/datetimepicker/jquery.datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/venobox/venobox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->


    <script src="<?php echo base_url() ?>assets/js/jquery-1.12.4.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/popper/popper.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/slick/slick.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/slick/jquery.zoom.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/isotope/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/quilljs/js/quill.core.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/quilljs/js/quill.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/chosen/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/datetimepicker/jquery.datetimepicker.full.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/venobox/venobox.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.1/basic/ckeditor.js"></script>
    <!-- orther script -->
    <script src="<?php echo base_url() ?>assets/js/main.js"></script>
</head>

<body>
    <div id="wrapper">
        <header id="header" class="site-header">
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
                            <?php $menuaktif = $this->uri->segment(1); ?>
                            <div class="site__brand">
                                <a title="Logo" href="<?= base_url($menuaktif) ?>" class="site__brand__logo"><img src="<?= base_url() ?>assets/images/assets/logo.png" alt="Golo"></a>
                            </div><!-- .site__brand -->

                            <div class="site__search layout-02">
                                <a title="Close" href="#" class="search__close">
                                    <i class="la la-times"></i>
                                </a><!-- .search__close -->
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
                            </div><!-- .site__search -->

                        </div><!-- .site -->
                    </div><!-- .col-md-6 -->
                    <div class="col-xl-6 col-7">
                        <div class="right-header align-right">
                            <nav class="main-menu">
                                <ul>
                                    <li><a title="Page" href="<?= base_url($menuaktif . '/lowongankerja') ?>">Lowongan Kerja</a></li>
                                </ul>
                            </nav>

                            <div class="ava">
                                <?php
                                $foto = [];
                                if ($this->session->userdata('id_level') == 4) :
                                    $foto = getfotoprofil($this->session->userdata('id_siswa'), 3);
                                elseif ($this->session->userdata('id_level') == 2) :
                                    $foto = getfotoprofil($this->session->userdata('id_sekolah'), 5);
                                elseif ($this->session->userdata('id_level') == 3) :
                                    $foto = getfotoprofil($this->session->userdata('id_perusahaan'), 6);
                                else:
                                    $foto = [];
                                endif;
                                
                                ?>
                                <a title="Icon" href="#"><img src="<?= base_url() . "upload/dokumen/" . $foto->file ?>" alt=""></a>
                            </div>
                        </div><!-- .right-header -->
                    </div><!-- .col-md-6 -->
                </div><!-- .row -->
            </div><!-- .container-fluid -->
        </header><!-- .site-header -->
        <main id="main" class="site-main ">
            <div class="site-content owner-content">
                <div class="member-menu">
                    <div class="container">
                        <?php
                        $menuaawal = $this->uri->segment(1);
                        $menuaktif = $this->uri->segment(2);
                        $menuparam = $this->uri->segment(3);
                        // echo $menuaawal.$menuaktif;
                        ?>
                        <ul>
                            <?php if ($menuaawal == 'perusahaan') : ?>
                                <li class="<?= $menuaktif == '' ? 'active' : '' ?>"><a href="<?= base_url('perusahaan') ?>">Dashboard</a></li>
                                <li class="<?= $menuaktif == 'lowongan' ? 'active' : '' ?>"><a href="<?= base_url('perusahaan/pelamar') ?>">Pelamar</a></li>
                                <li><a href="<?= base_url('perusahaan/lowongan') ?>">Lowongan Kerja</a></li>
                                <li><a href="<?= base_url('perusahaan/permintaan') ?>">Permintaan Siswa</a></li>
                                <li><a href="<?= base_url('perusahaan/profile') ?>">Profile</a></li>
                            <?php elseif ($menuaawal == 'siswa') : ?>
                                <li class="<?= $menuaktif == '' ? 'active' : '' ?>"><a href="<?= base_url('siswa') ?>">Dashboard</a></li>
                                <li class="<?= $menuaktif == 'lowongan' || $menuaktif == 'lowongandetail'  ?  'active' : '' ?>"><a href="<?= base_url('siswa/lowongan') ?>">Lowongan Kerja</a></li>
                                <li class="<?= $menuaktif == 'permintaan' ? 'active' : '' ?>"><a href="<?= base_url('siswa/permintaan') ?>">Permintaan Perusahaan</a></li>
                                <li class="<?= $menuaktif == 'profile' ? 'active' : '' ?>"><a href="<?= base_url('siswa/profile') ?>">Profile</a></li>
                            <?php elseif ($menuaawal == 'sekolah') : ?>
                                <li class="<?= $menuaktif == '' ? 'active' : '' ?>"><a href="<?= base_url('sekolah') ?>">Dashboard</a></li>
                                <li><a href="<?= base_url('sekolah/siswa') ?>">Data Siswa</a></li>
                                <li><a href="<?= base_url('sekolah/lowongan') ?>">Lowongan Kerja</a></li>
                                <li><a href="<?= base_url('sekolah/permintaan') ?>">Permintaan Perusahaan</a></li>
                                <li><a href="<?= base_url('sekolah/profile') ?>">Profile</a></li>
                            <?php elseif ($menuaawal == 'admin') : ?>
                                <li class="<?= $menuaktif == '' ? 'active' : '' ?>"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                                <li class="<?= $menuaktif == 'sekolah' || $menuaktif == 'sekolah_create' || $menuaktif == 'sekolah_update' || $menuaktif == 'sekolah_read' ? 'active' : '' ?>"><a href="<?= base_url('admin/sekolah') ?>">Sekolah</a></li>
                                <li class="<?= $menuaktif == 'siswa' || $menuaktif == 'siswa_profile' || $menuaktif == 'siswa_create' || $menuaktif == 'siswa_update' || $menuaktif == 'siswa_read' ? 'active' : '' ?>"><a href="<?= base_url('admin/siswa') ?>">Siswa</a></li>
                                <li class="<?= $menuaktif == 'perusahaan' || $menuaktif == 'perusahaan_create' || $menuaktif == 'perusahaan_update' || $menuaktif == 'perusahaan_read' ? 'active' : '' ?>"><a href="<?= base_url('admin/perusahaan') ?>">Perusahaan</a></li>
                                <li class="<?= $menuaktif == 'lowongan' || $menuaktif == 'lowongan_create' || $menuaktif == 'lowongan_update' || $menuaktif == 'lowongan_read'  ? 'active' : '' ?>"><a href="<?= base_url('admin/lowongan') ?>">Lowongan Kerja</a></li>
                                <li class="<?= $menuaktif == 'lamaran' || $menuaktif == 'lamaran_create' || $menuaktif == 'lamaran_update' || $menuaktif == 'lamaran_read' ? 'active' : '' ?>"><a href="<?= base_url('admin/lamaran') ?>">Lamaran Kerja</a></li>
                                <li class="<?= $menuaktif == 'permintaan' || $menuaktif == 'permintaan_create' || $menuaktif == 'permintaan_update' || $menuaktif == 'permintaan_read' ? 'active' : '' ?>"><a href="<?= base_url('admin/permintaan') ?>">Permintaan Siswa</a></li>
                                <li class="<?= $menuaktif == 'user' ||$menuaktif == 'user_update' ? 'active' : '' ?>"><a href="<?= base_url('admin/user') ?>">User</a></li>
                            <?php endif; ?>
                            <li class="text-danger"><a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="<?= base_url("auth/logout") ?>"> Logout</a>
                        </ul>
                    </div>
                </div>
                <div class="container">
                    <div class="member-wrap">
                        <?php
                        echo $contents;
                        ?>
                    </div>
                </div>
            </div>
        </main><!-- .site-main -->

        <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ">Preview File</h5>

                    </div>
                    <div class="modal-body">
                        <object id="viewer" data="" width="100%" height="500px">
                            This browser does not support PDFs. Please download the PDF to view it:
                            <a id="downloader" href="" target="_blank">Download PDF</a>
                        </object>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div><!-- Modal -->
        </div>

        <footer id="footer" class="footer">
            <div class="container">
                <div class="footer__bottom">
                    <p class="footer__bottom__copyright">2023 &copy; <a title="domain esemka" href="#">domain esemka</a>. All rights reserved.</p>
                </div><!-- .top-footer -->
            </div><!-- .container -->
        </footer><!-- site-footer -->
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvPDNG6pePr9iFpeRKaOlaZF_l0oT3lWk&callback=initMap" async defer></script>
        <script src="<?= base_url() ?>assets/js/map-single.js"></script> -->

    </div><!-- #wrapper -->
</body>

</html>

</html>