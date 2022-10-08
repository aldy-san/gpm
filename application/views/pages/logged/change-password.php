<div class="page-heading">
    <h1>Ubah Kata Sandi</h1>
</div>
<div class="page-content row">
    <section class="p-2 col-12">
        <div class="row fs-5">
            <div class="col-7">
                <form action="<?= base_url('change-password'); ?>" method="POST" class="card p-5">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="old_password">Kata Sandi Lama</label>
                            <input type="password"
                                class="form-control <?= form_error('old_password') ? 'is-invalid': ''; ?>"
                                name="old_password" id="old_password" placeholder="Kata Sandi Lama" autocomplete="off"
                                value="<?= set_value('old_password')?>">
                            <div class="invalid-feedback">
                                <?= form_error('old_password'); ?>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="password">Kata Sandi Baru</label>
                            <input type="password"
                                class="form-control <?= form_error('password') ? 'is-invalid': ''; ?>" name="password"
                                id="password" placeholder="Kata Sandi Baru" autocomplete="off"
                                value="<?= set_value('password')?>">
                            <div class="invalid-feedback">
                                <?= form_error('password'); ?>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="confirm_password">Konfirmasi Kata Sandi</label>
                            <input type="password"
                                class="form-control <?= form_error('confirm_password') ? 'is-invalid': ''; ?>"
                                name="confirm_password" id="confirm_password" placeholder="Konfirmasi Kata Sandi"
                                autocomplete="off" value="<?= set_value('confirm_password')?>">
                            <div class="invalid-feedback">
                                <?= form_error('confirm_password'); ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary col-3">Simpan</button>
                </form>
            </div>
        </div>
    </section>
</div>