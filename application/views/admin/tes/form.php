<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= $title; ?></h3>
            </div>
        </div>
    </div>
    <section class="section mt-4">
        <div class="card">
            <div class="card-body">
                <form action="<?= $user ? base_url('/tes/edit/'.$this->uri->segment(3)) : base_url('/tes/create'); ?>"
                    method="POST">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control <?= form_error('email') ? 'is-invalid': ''; ?>"
                                name="email" id="email" placeholder="email@mail.com" autocomplete="off"
                                value="<?= $user ?  (set_value('email') ?  set_value('email') : $user['email']) : set_value('email'); ?>"
                                <?= $title === 'Detail Test'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('email'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="username">Username</label>
                            <input type="text" id="username"
                                class="form-control <?= form_error('username') ? 'is-invalid': ''; ?>" name="username"
                                placeholder="username" autocomplete="off"
                                value="<?= $user ?  (set_value('username') ?  set_value('username') : $user['username']) : set_value('username'); ?>"
                                <?= $title === 'Detail Test'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('username'); ?>
                            </div>
                        </div>
                    </div>
                    <?php if($title !== 'Detail Test') :?>
                    <button type="submit" class="btn btn-primary ">Save</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </section>
</div>