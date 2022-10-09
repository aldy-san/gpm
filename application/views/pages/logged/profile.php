<div class="page-heading">
    <h1>Profil Saya</h1>
</div>
<div class="page-content row">
    <section class="p-2 col-12">
        <div class="row fs-5 ">
            <div class="col-3">
                <div class="card">
                    <img class=" rounded-circle p-5"
                        src="<?= base_url('assets/images/faces/'.$this_user['jenis_kelamin'].'.jpg'); ?>" alt="Face 1">
                </div>
            </div>
            <div class="col-9">
                <div class="card p-5">
                    <div class="row">
                        <h2><?= $this_user['nama_lengkap']; ?></h2>
                        <span class="text-capitalize"><?= getRole($this_user['level']); ?></span>
                    </div>
                    <div class="row mt-4 fs-6">
                        <h5>Data</h5>
                        <div class="row">
                            <span> <span class="text-muted">Email:</span> <?= $this_user['email']; ?></span>
                        </div>
                        <div class="row">
                            <span> <span class="text-muted">NIM:</span> <?= $this_user['username']; ?></span>
                        </div>
                        <div class="row">
                            <span> <span class="text-muted">Tahun Masuk:</span> <?= $this_user['tahun_masuk']; ?></span>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-3">
                            <a class="btn btn-primary" href="<?= base_url('/change-password'); ?>">Ubah Kata Sandi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>