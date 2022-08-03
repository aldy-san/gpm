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

        <link rel="stylesheet" href="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/app.css'); ?>">
        <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.svg'); ?>" type="image/x-icon">
        <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?> ">
    </head>

    <body>
        <?php if ($withNavbar): ?>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url(); ?>">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="<?= base_url('dashboard'); ?>">Dashboard</a>
                        </li>
                    </ul>
                </div>
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
                        <div class="d-flex justify-content-between">
                            <div class="logo">
                                <a href="index.html"><img src="<?= base_url('assets/images/logo/logo.png'); ?>"
                                        alt="Logo" srcset=""></a>
                            </div>
                            <div class="toggler">
                                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-menu">
                        <ul class="menu">
                            <li class="sidebar-title">Menu</li>

                            <li class="sidebar-item <?= $this->uri->segment(1) === 'dashboard' ? 'active' : ''; ?> ">
                                <a href="<?= base_url('dashboard'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item <?= $this->uri->segment(1) === 'tes' ? 'active' : ''; ?>">
                                <a href="<?= base_url('tes'); ?>" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>tes</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="<?= base_url('logout'); ?>" class='sidebar-link'>
                                    <i class="bi bi-door-open-fill"></i>
                                    <span>Logout</span>
                                </a>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-stack"></i>
                                    <span>Components</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="component-alert.html">Alert</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-badge.html">Badge</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-breadcrumb.html">Breadcrumb</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-button.html">Button</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-card.html">Card</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-carousel.html">Carousel</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-dropdown.html">Dropdown</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-list-group.html">List Group</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-modal.html">Modal</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-navs.html">Navs</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-pagination.html">Pagination</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-progress.html">Progress</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-spinner.html">Spinner</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="component-tooltip.html">Tooltip</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-collection-fill"></i>
                                    <span>Extra Components</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="extra-component-avatar.html">Avatar</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="extra-component-sweetalert.html">Sweet Alert</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="extra-component-toastify.html">Toastify</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="extra-component-rating.html">Rating</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="extra-component-divider.html">Divider</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-grid-1x2-fill"></i>
                                    <span>Layouts</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="layout-default.html">Default Layout</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="layout-vertical-1-column.html">1 Column</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="layout-vertical-navbar.html">Vertical with Navbar</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="layout-horizontal.html">Horizontal Menu</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-title">Forms &amp; Tables</li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-hexagon-fill"></i>
                                    <span>Form Elements</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="form-element-input.html">Input</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-element-input-group.html">Input Group</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-element-select.html">Select</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-element-radio.html">Radio</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-element-checkbox.html">Checkbox</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-element-textarea.html">Textarea</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="form-layout.html" class='sidebar-link'>
                                    <i class="bi bi-file-earmark-medical-fill"></i>
                                    <span>Form Layout</span>
                                </a>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-pen-fill"></i>
                                    <span>Form Editor</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="form-editor-quill.html">Quill</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-editor-ckeditor.html">CKEditor</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-editor-summernote.html">Summernote</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="form-editor-tinymce.html">TinyMCE</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="table.html" class='sidebar-link'>
                                    <i class="bi bi-grid-1x2-fill"></i>
                                    <span>Table</span>
                                </a>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="table-datatable.html" class='sidebar-link'>
                                    <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                    <span>Datatable</span>
                                </a>
                            </li>

                            <li class="sidebar-title">Extra UI</li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-pentagon-fill"></i>
                                    <span>Widgets</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="ui-widgets-chatbox.html">Chatbox</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="ui-widgets-pricing.html">Pricing</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="ui-widgets-todolist.html">To-do List</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-egg-fill"></i>
                                    <span>Icons</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="ui-icons-bootstrap-icons.html">Bootstrap Icons </a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="ui-icons-fontawesome.html">Fontawesome</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="ui-icons-dripicons.html">Dripicons</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-bar-chart-fill"></i>
                                    <span>Charts</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="ui-chart-chartjs.html">ChartJS</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="ui-chart-apexcharts.html">Apexcharts</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="ui-file-uploader.html" class='sidebar-link'>
                                    <i class="bi bi-cloud-arrow-up-fill"></i>
                                    <span>File Uploader</span>
                                </a>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-map-fill"></i>
                                    <span>Maps</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="ui-map-google-map.html">Google Map</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="ui-map-jsvectormap.html">JS Vector Map</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-title">Pages</li>

                            <li class="sidebar-item  ">
                                <a href="application-email.html" class='sidebar-link'>
                                    <i class="bi bi-envelope-fill"></i>
                                    <span>Email Application</span>
                                </a>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="application-chat.html" class='sidebar-link'>
                                    <i class="bi bi-chat-dots-fill"></i>
                                    <span>Chat Application</span>
                                </a>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="application-gallery.html" class='sidebar-link'>
                                    <i class="bi bi-image-fill"></i>
                                    <span>Photo Gallery</span>
                                </a>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="application-checkout.html" class='sidebar-link'>
                                    <i class="bi bi-basket-fill"></i>
                                    <span>Checkout Page</span>
                                </a>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-person-badge-fill"></i>
                                    <span>Authentication</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="auth-login.html">Login</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="auth-register.html">Register</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="auth-forgot-password.html">Forgot Password</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-x-octagon-fill"></i>
                                    <span>Errors</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="error-403.html">403</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="error-404.html">404</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="error-500.html">500</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-title">Raise Support</li>

                            <li class="sidebar-item  ">
                                <a href="https://zuramai.github.io/mazer/docs" class='sidebar-link'>
                                    <i class="bi bi-life-preserver"></i>
                                    <span>Documentation</span>
                                </a>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="https://github.com/zuramai/mazer/blob/main/CONTRIBUTING.md"
                                    class='sidebar-link'>
                                    <i class="bi bi-puzzle"></i>
                                    <span>Contribute</span>
                                </a>
                            </li>

                            <li class="sidebar-item  ">
                                <a href="https://github.com/zuramai/mazer#donate" class='sidebar-link'>
                                    <i class="bi bi-cash"></i>
                                    <span>Donate</span>
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
                <?php endif ?>