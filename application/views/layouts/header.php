<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ? $title : 'Gugus Penjamin Mutu'; ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css'); ?>">

        <link rel="stylesheet" href="<?= base_url('assets/vendors/iconly/bold.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/vendors/apexcharts/apexcharts.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/app.css'); ?>">
        <link rel="shortcut icon" href="<?= base_url('assets/images/logo/logo.png'); ?>" type="image/x-icon">
        <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?> ">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php if ($withNavbar): ?>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url(); ?>">
                    <img src="<?= base_url('assets/images/logo/logo.png'); ?>" alt="logo"
                        style="height:40px; width:40px;">
                    <span>Survei GPM</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="d-flex" role="search">
                    <a class="btn btn-primary me-2" aria-current="page" href="<?= base_url('login'); ?>">Login</a>
                    <a class="btn btn-outline-primary " aria-current="page"
                        href="<?= base_url('register'); ?>">Register</a>
                </div>
            </div>
        </nav>
        <?php endif ?>
        <main id="app">
            <?php if ($withSidebar): ?>
            <div id="sidebar" class="active">
                <div class="sidebar-wrapper active">
                    <div class="sidebar-header">
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block ms-auto"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                        <div class="d-flex justify-content-center pt-2">
                            <div class="logo">
                                <a href="<?= base_url('auth'); ?>">
                                    <img src="<?= base_url('assets/images/logo/logo.png'); ?>"
                                        style="height:75px; width:75px;" alt="Logo" srcset="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-menu">
                        <ul class="menu">
                            <li class="sidebar-title">Menu</li>
                            <li
                                class="sidebar-item <?= $this->uri->segment(1) === 'dashboard' || $this->uri->segment(2) === 'dashboard' ? 'active' : ''; ?> ">
                                <a href="<?= base_url('dashboard'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <?php if($this_user['role'] === 'dosen') :?>
                            <li class="sidebar-title">Isi Survei</li>
                            <li class="sidebar-item <?= $this->uri->segment(1) === 'dashboard' ?> ">
                                <a href="<?= base_url('dashboard'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Kepuasan Dosen</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(1) === 'survei-pembelajaran-dosen' ?> ">
                                <a href="<?= base_url('dashboard'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Pembelajaran dosen</span>
                                </a>
                            </li>
                            <li class="sidebar-title">Hasil Survei</li>
                            <li class="sidebar-item <?= $this->uri->segment(3) === 'mahasiswa' ?'active' :''?>">
                                <a href="<?= base_url('dosen/result/mahasiswa'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Mahasiswa</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(3) === 'dosen' ?'active' :''?>">
                                <a href="<?= base_url('dosen/result/dosen'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dosen</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(3) === 'tendik' ?'active' :''?>">
                                <a href="<?= base_url('dosen/result/tendik'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Tenaga Pendidikan</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(3) === 'alumni' ?'active' :''?>">
                                <a href="<?= base_url('dosen/result/alumni'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Alumni</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(3) === 'mitra' ?'active' :''?>">
                                <a href="<?= base_url('dosen/result/mitra'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Mitra</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(3) === 'pengguna' ?'active' :''?>">
                                <a href="<?= base_url('dosen/result/pengguna'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Pengguna</span>
                                </a>
                            </li>

                            <?php endif ?>
                            <?php if($this_user['role'] === 'superadmin') :?>
                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>survei mahasiswa</span>
                                </a>
                                <ul class="submenu">
                                    <li class="submenu-item">
                                        <a href="<?= base_url('/survei/mahasiswa-d4'); ?>">D4</a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="<?= base_url('/survei/mahasiswa-s1'); ?>">S1</a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="<?= base_url('/survei/mahasiswa-s2'); ?>">S2</a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="<?= base_url('/survei/mahasiswa-s3'); ?>">S3</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(2) === 'dosen' ? 'active' : ''; ?>">
                                <a href="<?= base_url('survei/dosen'); ?>" class='sidebar-link'>
                                    <i class="bi bi-collection-fill"></i>
                                    <span>survei dosen</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(2) === 'tendik' ? 'active' : ''; ?>">
                                <a href="<?= base_url('survei/tendik'); ?>" class='sidebar-link'>
                                    <i class="bi bi-collection-fill"></i>
                                    <span>survei tendik</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(2) === 'alumni' ? 'active' : ''; ?>">
                                <a href="<?= base_url('survei/alumni'); ?>" class='sidebar-link'>
                                    <i class="bi bi-collection-fill"></i>
                                    <span>survei alumni</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(2) === 'mitra' ? 'active' : ''; ?>">
                                <a href="<?= base_url('survei/mitra'); ?>" class='sidebar-link'>
                                    <i class="bi bi-collection-fill"></i>
                                    <span>survei mitra</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(2) === 'pengguna' ? 'active' : ''; ?>">
                                <a href="<?= base_url('survei/pengguna'); ?>" class='sidebar-link'>
                                    <i class="bi bi-collection-fill"></i>
                                    <span>survei pengguna</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(2) === 'manage-period' ? 'active' : ''; ?>">
                                <a href="<?= base_url('manage-period'); ?>" class='sidebar-link'>
                                    <i class="bi bi-collection-fill"></i>
                                    <span>Kelola Periode</span>
                                </a>
                            </li>
                            <?php endif;?>
                            <li class="sidebar-item">
                                <a href="<?= base_url('logout'); ?>" class='sidebar-link'>
                                    <i class="bi bi-door-open-fill"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
                </div>
            </div>
            <div id="main">
                <header class="mb-3 d-flex">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                    <div class="d-flex align-items-center dropdown ms-auto">
                        <span class="me-3 mt-2">Halo, <?= $this_user['username']; ?></span>
                        <button class="btn " type="button" id="profileButton" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="avatar">
                                <img src="<?= base_url('assets/images/faces/1.jpg'); ?>" alt="Face 1">
                            </div>
                        </button>
                        <div class="dropdown-menu mt-2 shadow" aria-labelledby="profileButton">
                            <a class="dropdown-item d-flex align-items-center" href="#"><i
                                    class="bi bi-person-fill me-2"></i>My Profile</a>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('logout'); ?>"><i
                                    class="bi bi-door-open-fill me-2"></i>Logout</a>
                        </div>
                    </div>
                </header>
                <?php if ( $this->session->flashdata('alertForm')): ?>
                <div class="alert alert-<?= $this->session->flashdata('alertType'); ?> alert-dismissible show fade"
                    role="alert">
                    <p class="text-center"><?= $this->session->flashdata('alertForm'); ?></p>
                </div>
                <?php endif ?>
                <?php endif ?>