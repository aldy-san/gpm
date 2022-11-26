<form action="<?=base_url('login')?>" method="POST" class="row justify-content-center align-items-center auth-form">
    <div class="row col-11 col-md-8 col-lg-6 col-xl-4 rounded-2 border p-4 bg-white">
        <h2 class="text-center">LOGIN</h2>
        <small class="text-center text-muted mb-2">Login jika anda dosen, mahasiswa, atau tenaga pendidikan</small>
        <?php if ($this->session->flashdata('alertForm')): ?>
        <div class="alert alert-<?= $this->session->flashdata('alertType') ? $this->session->flashdata('alertType') : 'danger'; ?>"
            role="alert">
            <p class="text-center"><?= $this->session->flashdata('alertForm'); ?></p>
        </div>
        <?php endif ?>
        <div class="mb-3 col-12">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control <?= form_error('username') ? 'is-invalid': ''; ?>" name="username"
                id="username" placeholder="NIM / NIP / NITK" autocomplete="off" value="<?= set_value('username'); ?>">
            <div class="invalid-feedback">
                <?= form_error('username'); ?>
            </div>
        </div>
        <div class="mb-3 col-12">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control <?= form_error('password') ? 'is-invalid': ''; ?>"
                name="password" id="Password" placeholder="password">
            <div class="invalid-feedback">
                <?= form_error('password'); ?>
            </div>
        </div>
        <div class="mb-3 col-12 row ">
            <div class="col-6 d-flex justify-content-center">
                <div class=""><?= $captcha['image'] ?></div>
            </div>
            <div class="col-6">
                <input type="text" class="form-control" name="captcha" id="captcha" placeholder="captcha">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mx-auto col-8">Login</button>
        <small class="text-center text-muted my-3">Tanpa login jika anda alumni, mitra, atau pengguna</small>
        <div class="d-flex justify-content-center">
            <?php foreach($survei_not_logged as $key => $survei): ?>
            <a href="<?= base_url($survei['name']); ?>"
                class="text-capitalize btn btn-<?= $survei_not_logged_color[$key]; ?> mx-2 "
                style="flex: 1 1 0;"><?= $survei['name']; ?></a>
            <?php endforeach ?>
        </div>
    </div>
</form>