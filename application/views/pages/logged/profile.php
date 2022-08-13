<div class="page-heading">
    <h3>Profil Saya</h3>
</div>
<div class="page-content row">
    <section class="card p-2 col-9">
        <div class="row fs-5 align-items-center">
            <img class="col-3 rounded-circle p-5" src="<?= base_url('assets/images/faces/1.jpg'); ?>" alt="Face 1">
            <div class="row col-9">
                <div class="border-start border-2 row ">
                    <div class="col-3 text-end text-muted">Nama</div>
                    <span class="col-1 text-center">:</span>
                    <div class="col-8"><?= $this_user['username']; ?></div>
                    <div class="col-3 text-end text-muted">Role</div>
                    <span class="col-1 text-center">:</span>
                    <div class="col-8"><?= $this_user['role']; ?></div>
                    <div class="col-3 text-end text-muted">Email</div>
                    <span class="col-1 text-center">:</span>
                    <div class="col-8"><?= $this_user['email']; ?></div>
                </div>
            </div>
            <div class="col-3 px-3">
                <button class="btn btn-primary mb-4">Change Password</button>
            </div>
        </div>
    </section>
</div>