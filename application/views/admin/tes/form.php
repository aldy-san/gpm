<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Create Test</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <!--<div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>-->
        </div>
    </div>
    <section class="section mt-4">
        <div class="card">
            <!--<div class="card-header">
                <a href="<?= base_url('/tes/create'); ?>" class="btn btn-success">Add item</a>
            </div>-->
            <div class="card-body">
                <form action="<?= $user ? base_url('/tes/edit/'.$this->uri->segment(3)) : base_url('/tes/create'); ?>"
                    method="POST">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control <?= form_error('email') ? 'is-invalid': ''; ?>"
                                name="email" id="email" placeholder="email@mail.com"
                                value="<?= $user ?  (set_value('email') ?  set_value('email') : $user['email']) : set_value('email'); ?>">
                            <div class="invalid-feedback">
                                <?= form_error('email'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="username">Username</label>
                            <input type="text" id="username"
                                class="form-control <?= form_error('username') ? 'is-invalid': ''; ?>" name="username"
                                placeholder="username"
                                value="<?= $user ?  (set_value('username') ?  set_value('username') : $user['username']) : set_value('username'); ?>">
                            <div class="invalid-feedback">
                                <?= form_error('username'); ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary ">Save</button>
                </form>
            </div>
        </div>
    </section>
</div>