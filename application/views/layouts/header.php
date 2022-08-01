<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?> ">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url(); ?>">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!--<ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url('login'); ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="<?= base_url('register'); ?>">Register</a>
                        </li>
                    </ul>-->
                </div>
                <div class="d-flex" role="search">
                    <a class="btn btn-primary me-2" aria-current="page" href="<?= base_url('login'); ?>">Login</a>
                    <a class="btn btn-outline-primary " aria-current="page"
                        href="<?= base_url('register'); ?>">Register</a>
                </div>
            </div>
        </nav>

        <main class="container">
            <?php if ($this->session->flashdata('alert')): ?>
            <div class="alert alert-success " role="alert">
                <p class="text-center"><?= $this->session->flashdata('alert'); ?></p>
            </div>
            <?php endif ?>