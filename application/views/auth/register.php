<form action="<?=base_url('register')?>" method="POST" class="row justify-content-center align-items-center auth-form">
    <h2 class="text-center">REGISTER</h2>
    <div class="row col-11 col-md-8 col-lg-6 col-xl-4 rounded-2 border p-4 bg-light">
        <?php if ($this->session->flashdata('alertForm')): ?>
        <div class="alert alert-danger" role="alert">
            <p class="text-center"><?= $this->session->flashdata('alertForm'); ?></p>
        </div>
        <?php endif ?>
        <div class="mb-3 col-12">
            <label for="email" class="form-label">email</label>
            <input type="text" class="form-control <?= form_error('email') ? 'is-invalid': ''; ?>" name="email"
                id="email" placeholder="name@example.com" autocomplete="off" value="<?= set_value('email'); ?>">
            <div class="invalid-feedback">
                <?= form_error('email'); ?>
            </div>
        </div>
        <div class="mb-3 col-12">
            <label for="username" class="form-label">username</label>
            <input type="text" class="form-control <?= form_error('username') ? 'is-invalid': ''; ?>" name="username"
                id="username" placeholder="name@example.com" autocomplete="off" value="<?= set_value('username'); ?>">
            <div class="invalid-feedback">
                <?= form_error('username'); ?>
            </div>
        </div>
        <div class="mb-3 col-12">
            <label for="password" class="form-label">password</label>
            <input type="password" class="form-control <?= form_error('password') ? 'is-invalid': ''; ?>"
                name="password" id="password" placeholder="password">
            <div class="invalid-feedback">
                <?= form_error('password'); ?>
            </div>
        </div>
        <div class="mb-3 col-12">
            <label for="confirm-password" class="form-label">confirm password</label>
            <input type="password" class="form-control <?= form_error('confirm-password') ? 'is-invalid': ''; ?>"
                name="confirm-password" id="confirm-password" placeholder="confirm password">
            <div class="invalid-feedback">
                <?= form_error('confirm-password'); ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mx-auto col-8">Register</button>
    </div>
</form>