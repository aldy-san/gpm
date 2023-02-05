<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ? $title : 'Gugus Penjamin Mutu'; ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/vendors/toastify/toastify.css'); ?>">
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
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
                                    <i class="bi <?= isset($this_user) ? 'bi-house-door' : 'bi-door-open' ?> "></i>
                                    <span><?= isset($this_user) ? 'Beranda' : 'Login' ?></span>
                                </a>
                            </li>
                            <?php if (isset($this_user) && getRole($this_user['level']) === 'dosen') :?>
                            <?php if (in_array($this_user['level'], [8, 9, 10])) :?>
                            <li class="sidebar-item <?= $this->uri->segment(3) === 'all' ?'active' :''?>">
                                <a href="<?= base_url('repository/all'); ?>" class='sidebar-link'>
                                    <i class="bi bi-folder2-open"></i>
                                    <span>Semua Repositori</span>
                                </a>
                            </li>
                            <?php endif ?>
                            <li
                                class="sidebar-item <?= $this->uri->segment(1) === 'repository' && !$this->uri->segment(3) ?'active' :''?>">
                                <a href="<?= base_url('repository'); ?>" class='sidebar-link'>
                                    <i class="bi bi-folder2-open"></i>
                                    <span>Repositori Saya</span>
                                </a>
                            </li>
                            <?php if (count($category_dosen_avail) > 0): ?>
                            <li class="sidebar-title">Isi Survei</li>
                            <?php endif ?>
                            <?php foreach($category_dosen_avail as $c) :?>
                            <li class="sidebar-item">
                                <a href="<?= base_url('dosen/survei/'.$c['id']); ?>"
                                    class='sidebar-link btn <?= in_array($c['name'], $category_dosen_answered) ? 'disabled':  ''; ?>'>
                                    <i class="bi bi-question-octagon"></i>
                                    <span><?= $c['name']; ?></span>
                                </a>
                            </li>
                            <?php endforeach ?>
                            <?php endif ?>

                            <?php  if (isset($this_user) && getRole($this_user['level']) === 'superadmin') :?>
                            <li class="sidebar-item <?= $this->uri->segment(1) === 'manage-period' ? 'active' : ''; ?>">
                                <a href="<?= base_url('manage-period'); ?>" class='sidebar-link'>
                                    <i class="bi bi-calendar-range"></i>
                                    <span>Kelola Periode</span>
                                </a>
                            </li>
                            <li
                                class="sidebar-item <?= $this->uri->segment(1) === 'manage-category' ? 'active' : ''; ?>">
                                <a href="<?= base_url('manage-category'); ?>" class='sidebar-link'>
                                    <i class="bi bi-archive"></i>
                                    <span>Kelola Survei Login</span>
                                </a>
                            </li>
                            <li class="sidebar-title">Kelola Survei Non-login</li>
                            <li class="sidebar-item <?= $this->uri->segment(2) === 'alumni' ? 'active' : ''; ?>">
                                <a href="<?= base_url('survei/alumni'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid"></i>
                                    <span>Survei Alumni</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(2) === 'mitra' ? 'active' : ''; ?>">
                                <a href="<?= base_url('survei/mitra'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid"></i>
                                    <span>Survei Mitra</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(2) === 'pengguna' ? 'active' : ''; ?>">
                                <a href="<?= base_url('survei/pengguna'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid"></i>
                                    <span>Survei Pengguna</span>
                                </a>
                            </li>
                            <?php endif;?>
                            <?php if ((isset($this_user) && (getRole($this_user['level']) === 'dosen' || getRole($this_user['level']) === 'superadmin')) || !isset($this_user)): ?>
                            <li class="sidebar-title">Hasil Survei</li>
                            <li class="sidebar-item has-sub <?= $this->uri->segment(3) === 'mahasiswa' ?'active' :''?>">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-grid"></i>
                                    <span>Mahasiswa</span>
                                </a>
                                <ul class="submenu <?= $this->uri->segment(3) === 'mahasiswa' ?'active' :''?>">
                                    <?php foreach($category_mahasiswa as $c) :?>
                                    <li class="submenu-item <?= $this->uri->segment(4) === $c['id'] ?'active' :''?>">
                                        <a href="<?= base_url('result/mahasiswa/'.$c['id']); ?>"><?= $c['name']; ?></a>
                                    </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                            <li class="sidebar-item has-sub <?= $this->uri->segment(3) === 'dosen' ?'active' :''?>">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-grid"></i>
                                    <span>Dosen</span>
                                </a>
                                <ul class="submenu <?= $this->uri->segment(3) === 'dosen' ?'active' :''?>">
                                    <?php foreach($category_dosen as $c) :?>
                                    <li class="submenu-item <?= $this->uri->segment(3) === 'dosen' ?'active' :''?>">
                                        <a href="<?= base_url('result/dosen/'.$c['id']); ?>"><?= $c['name']; ?></a>
                                    </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                            <li class="sidebar-item has-sub <?= $this->uri->segment(3) === 'tendik' ?'active' :''?>">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-grid"></i>
                                    <span>Tenaga Pendidik</span>
                                </a>
                                <ul class="submenu <?= $this->uri->segment(3) === 'tendik' ?'active' :''?>">
                                    <?php foreach($category_tendik as $c) :?>
                                    <li class="submenu-item <?= $this->uri->segment(3) === 'tendik' ?'active' :''?>">
                                        <a href="<?= base_url('result/tendik/'.$c['id']); ?>"><?= $c['name']; ?></a>
                                    </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(3) === 'alumni' ?'active' :''?>">
                                <a href="<?= base_url('result/alumni'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid"></i>
                                    <span>Alumni</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(3) === 'mitra' ?'active' :''?>">
                                <a href="<?= base_url('result/mitra'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid"></i>
                                    <span>Mitra</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(3) === 'pengguna' ?'active' :''?>">
                                <a href="<?= base_url('result/pengguna'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid"></i>
                                    <span>Pengguna</span>
                                </a>
                            </li>
                            <?php endif;?>

                            <?php  if (isset($this_user) && getRole($this_user['level']) === 'mahasiswa') :?>
                            <?php if (count($category_mahasiswa_avail) > 0): ?>
                            <li class="sidebar-title">Isi Survei</li>
                            <?php endif ?>
                            <?php foreach($category_mahasiswa_avail as $c) :?>
                            <li class="sidebar-item">
                                <a href="<?= base_url('mahasiswa/survei/'.$c['id']); ?>"
                                    class='sidebar-link btn <?= in_array($c['name'], $category_mahasiswa_answered) ? 'disabled':  ''; ?>'>
                                    <i class="bi bi-question-octagon"></i>
                                    <span><?= $c['name']; ?></span>
                                </a>
                            </li>
                            <?php endforeach ?>
                            <?php endif; ?>
                            <?php  if (isset($this_user) && getRole($this_user['level']) === 'tendik') :?>
                            <li class="sidebar-item <?= $this->uri->segment(1) === 'repository' ?'active' :''?>">
                                <a href="<?= base_url('repository'); ?>" class='sidebar-link'>
                                    <i class="bi bi-folder2-open"></i>
                                    <span>Repositori Saya</span>
                                </a>
                            </li>
                            <?php if (count($category_tendik_avail) > 0): ?>
                            <li class="sidebar-title">Isi Survei</li>
                            <?php endif ?>
                            <?php foreach($category_tendik_avail as $c) :?>
                            <li class="sidebar-item">
                                <a href="<?= base_url('tendik/survei/'.$c['id']); ?>"
                                    class='sidebar-link btn <?= in_array($c['name'], $category_tendik_answered) ? 'disabled':  ''; ?>'>
                                    <i class="bi bi-question-octagon"></i>
                                    <span><?= $c['name']; ?></span>
                                </a>
                            </li>
                            <?php endforeach ?>
                            <?php endif; ?>
                            <?php  if (isset($this_user)) :?>
                            <li class="sidebar-item">
                                <a href="<?= base_url('logout'); ?>" class='sidebar-link'>
                                    <i class="bi bi-door-open"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
                </div>
            </div>
            <div id="main">
                <?php if (isset($this_user)): ?>
                <header class="mb-3 d-flex">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                    <div class="d-flex align-items-center dropdown ms-auto">
                        <span class="me-3 mt-2">Halo, <?= $this_user['nama_lengkap']; ?></span>
                        <button class="btn " type="button" id="profileButton" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="avatar">
                                <img src="<?= base_url('assets/images/faces/'.$this_user['jenis_kelamin'].'.jpg'); ?>"
                                    alt="Face 1">
                            </div>
                        </button>
                        <div class="dropdown-menu mt-2 shadow" aria-labelledby="profileButton">
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('profile'); ?>"><i
                                    class="bi bi-person-fill me-2"></i>Profil Saya</a>
                            <a class="dropdown-item d-flex align-items-center"
                                href="<?= base_url('change-password'); ?>"><i class="bi bi-pencil-square me-2"></i>Ubah
                                Kata Sandi</a>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('logout'); ?>"><i
                                    class="bi bi-door-open-fill me-2"></i>Logout</a>
                        </div>
                        <div class="sidebar-menu">
                            <ul class="menu">
                                <li class="sidebar-title">Menu</li>
                                <li
                                    class="sidebar-item <?= $this->uri->segment(1) === 'dashboard' || $this->uri->segment(2) === 'dashboard' ? 'active' : ''; ?> ">
                                    <a href="<?= base_url('dashboard'); ?>" class='sidebar-link'>
                                        <i class="bi <?= isset($this_user) ? 'bi-house-door' : 'bi-door-open' ?> "></i>
                                        <span><?= isset($this_user) ? 'Beranda' : 'Login' ?></span>
                                    </a>
                                </li>
                                <?php if (isset($this_user) && getRole($this_user['level']) === 'dosen') :?>
                                <?php if (in_array($this_user['level'], [8, 9, 10])) :?>
                                <li class="sidebar-item <?= $this->uri->segment(3) === 'all' ?'active' :''?>">
                                    <a href="<?= base_url('dosen/repository/all'); ?>" class='sidebar-link'>
                                        <i class="bi bi-folder2-open"></i>
                                        <span>Semua Repositori</span>
                                    </a>
                                </li>
                                <?php endif ?>
                                <li
                                    class="sidebar-item <?= $this->uri->segment(2) === 'repository' && !$this->uri->segment(3) ?'active' :''?>">
                                    <a href="<?= base_url('dosen/repository'); ?>" class='sidebar-link'>
                                        <i class="bi bi-folder2-open"></i>
                                        <span>Repositori Saya</span>
                                    </a>
                                </li>
                                <?php if (count($category_dosen_avail) > 0): ?>
                                <li class="sidebar-title">Isi Survei</li>
                                <?php endif ?>
                                <?php foreach($category_dosen_avail as $c) :?>
                                <li class="sidebar-item">
                                    <a href="<?= base_url('dosen/survei/'.$c['id']); ?>"
                                        class='sidebar-link btn <?= in_array($c['name'], $category_dosen_answered) ? 'disabled':  ''; ?>'>
                                        <i class="bi bi-question-octagon"></i>
                                        <span><?= $c['name']; ?></span>
                                    </a>
                                </li>
                                <?php endforeach ?>
                                <?php endif ?>

                                <?php  if (isset($this_user) && getRole($this_user['level']) === 'superadmin') :?>
                                <li
                                    class="sidebar-item <?= $this->uri->segment(1) === 'manage-period' ? 'active' : ''; ?>">
                                    <a href="<?= base_url('manage-period'); ?>" class='sidebar-link'>
                                        <i class="bi bi-calendar-range"></i>
                                        <span>Kelola Periode</span>
                                    </a>
                                </li>
                                <li
                                    class="sidebar-item <?= $this->uri->segment(1) === 'manage-category' ? 'active' : ''; ?>">
                                    <a href="<?= base_url('manage-category'); ?>" class='sidebar-link'>
                                        <i class="bi bi-archive"></i>
                                        <span>Kelola Survei Login</span>
                                    </a>
                                </li>
                                <li class="sidebar-title">Kelola Survei Non-login</li>
                                <li class="sidebar-item <?= $this->uri->segment(2) === 'alumni' ? 'active' : ''; ?>">
                                    <a href="<?= base_url('survei/alumni'); ?>" class='sidebar-link'>
                                        <i class="bi bi-grid"></i>
                                        <span>Survei Alumni</span>
                                    </a>
                                </li>
                                <li class="sidebar-item <?= $this->uri->segment(2) === 'mitra' ? 'active' : ''; ?>">
                                    <a href="<?= base_url('survei/mitra'); ?>" class='sidebar-link'>
                                        <i class="bi bi-grid"></i>
                                        <span>Survei Mitra</span>
                                    </a>
                                </li>
                                <li class="sidebar-item <?= $this->uri->segment(2) === 'pengguna' ? 'active' : ''; ?>">
                                    <a href="<?= base_url('survei/pengguna'); ?>" class='sidebar-link'>
                                        <i class="bi bi-grid"></i>
                                        <span>Survei Pengguna</span>
                                    </a>
                                </li>
                                <?php endif;?>
                                <?php if ((isset($this_user) && (getRole($this_user['level']) === 'dosen' || getRole($this_user['level']) === 'superadmin')) || !isset($this_user)): ?>
                                <li class="sidebar-title">Hasil Survei</li>
                                <li
                                    class="sidebar-item has-sub <?= $this->uri->segment(2) === 'mahasiswa' ?'active' :''?>">
                                    <a href="#" class='sidebar-link'>
                                        <i class="bi bi-grid"></i>
                                        <span>Mahasiswa</span>
                                    </a>
                                    <ul class="submenu <?= $this->uri->segment(2) === 'mahasiswa' ?'active' :''?>">
                                        <?php foreach($category_mahasiswa as $c) :?>
                                        <li
                                            class="submenu-item <?= $this->uri->segment(3) === $c['id'] ?'active' :''?>">
                                            <a
                                                href="<?= base_url('result/mahasiswa/'.$c['id']); ?>"><?= $c['name']; ?></a>
                                        </li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                                <li class="sidebar-item has-sub <?= $this->uri->segment(2) === 'dosen' ?'active' :''?>">
                                    <a href="#" class='sidebar-link'>
                                        <i class="bi bi-grid"></i>
                                        <span>Dosen</span>
                                    </a>
                                    <ul class="submenu <?= $this->uri->segment(2) === 'dosen' ?'active' :''?>">
                                        <?php foreach($category_dosen as $c) :?>
                                        <li class="submenu-item <?= $this->uri->segment(2) === 'dosen' ?'active' :''?>">
                                            <a href="<?= base_url('result/dosen/'.$c['id']); ?>"><?= $c['name']; ?></a>
                                        </li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                                <li
                                    class="sidebar-item has-sub <?= $this->uri->segment(2) === 'tendik' ?'active' :''?>">
                                    <a href="#" class='sidebar-link'>
                                        <i class="bi bi-grid"></i>
                                        <span>Tenaga Pendidik</span>
                                    </a>
                                    <ul class="submenu <?= $this->uri->segment(2) === 'tendik' ?'active' :''?>">
                                        <?php foreach($category_tendik as $c) :?>
                                        <li
                                            class="submenu-item <?= $this->uri->segment(2) === 'tendik' ?'active' :''?>">
                                            <a href="<?= base_url('result/tendik/'.$c['id']); ?>"><?= $c['name']; ?></a>
                                        </li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                                <li class="sidebar-item <?= $this->uri->segment(2) === 'alumni' ?'active' :''?>">
                                    <a href="<?= base_url('result/alumni'); ?>" class='sidebar-link'>
                                        <i class="bi bi-grid"></i>
                                        <span>Alumni</span>
                                    </a>
                                </li>
                                <li class="sidebar-item <?= $this->uri->segment(2) === 'mitra' ?'active' :''?>">
                                    <a href="<?= base_url('result/mitra'); ?>" class='sidebar-link'>
                                        <i class="bi bi-grid"></i>
                                        <span>Mitra</span>
                                    </a>
                                </li>
                                <li class="sidebar-item <?= $this->uri->segment(2) === 'pengguna' ?'active' :''?>">
                                    <a href="<?= base_url('result/pengguna'); ?>" class='sidebar-link'>
                                        <i class="bi bi-grid"></i>
                                        <span>Pengguna</span>
                                    </a>
                                </li>
                                <?php endif;?>

                                <?php  if (isset($this_user) && getRole($this_user['level']) === 'mahasiswa') :?>
                                <?php if (count($category_mahasiswa_avail) > 0): ?>
                                <li class="sidebar-title">Isi Survei</li>
                                <?php endif ?>
                                <?php foreach($category_mahasiswa_avail as $c) :?>
                                <li class="sidebar-item">
                                    <a href="<?= base_url('mahasiswa/survei/'.$c['id']); ?>"
                                        class='sidebar-link btn <?= in_array($c['name'], $category_mahasiswa_answered) ? 'disabled':  ''; ?>'>
                                        <i class="bi bi-question-octagon"></i>
                                        <span><?= $c['name']; ?></span>
                                    </a>
                                </li>
                                <?php endforeach ?>
                                <?php endif; ?>
                                <?php  if (isset($this_user) && getRole($this_user['level']) === 'tendik') :?>
                                <?php if (count($category_tendik_avail) > 0): ?>
                                <li class="sidebar-title">Isi Survei</li>
                                <?php endif ?>
                                <?php foreach($category_tendik_avail as $c) :?>
                                <li class="sidebar-item">
                                    <a href="<?= base_url('tendik/survei/'.$c['id']); ?>"
                                        class='sidebar-link btn <?= in_array($c['name'], $category_tendik_answered) ? 'disabled':  ''; ?>'>
                                        <i class="bi bi-question-octagon"></i>
                                        <span><?= $c['name']; ?></span>
                                    </a>
                                </li>
                                <?php endforeach ?>
                                <?php endif; ?>
                                <?php  if (isset($this_user)) :?>
                                <li class="sidebar-item">
                                    <a href="<?= base_url('logout'); ?>" class='sidebar-link'>
                                        <i class="bi bi-door-open"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
                    </div>
                </header>
                <?php endif ?>
                <?php if ( $this->session->flashdata('alertForm')): ?>
                <div class="alert alert-<?= $this->session->flashdata('alertType'); ?> alert-dismissible show fade"
                    role="alert">
                    <p class="text-center"><?= $this->session->flashdata('alertForm'); ?></p>
                </div>
                <?php endif ?>
                <?php endif ?>