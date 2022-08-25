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
                <form
                    action="<?= $data_slug ? base_url('/manage-category/edit/'.$data_slug['id']) : base_url('/manage-category/create'); ?>"
                    method="POST">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name">Nama Kategori</label>
                            <small class="text-muted">ex: <i>Survei Kepuasan Mahasiswa</i> </small>
                            <input type="text" class="form-control <?= form_error('name') ? 'is-invalid': ''; ?>"
                                name="name" id="name" placeholder="Nama Kategori" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('name') ?  set_value('name') : $data_slug['name']) : set_value('name'); ?>"
                                <?= $is_edit? '' : 'disabled'; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="role">Untuk User</label>
                            <fieldset>
                                <select class="form-select <?= form_error('role') ? 'is-invalid': ''; ?>" name="role"
                                    <?= $is_edit? '' : 'disabled'; ?>>
                                    <option value="mahasiswa"
                                        <?= $data_slug && ($data_slug['role'] === 'mahasiswa')? 'selected' : ''; ?>>
                                        Mahasiswa
                                    </option>
                                    <option value="dosen"
                                        <?= $data_slug && ($data_slug['role'] === 'dosen')? 'selected' : ''; ?>>
                                        Dosen
                                    </option>
                                </select>
                            </fieldset>
                            <div class="invalid-feedback">
                                <?= form_error('role'); ?>
                            </div>
                        </div>
                    </div>
                    <?php if($is_edit) :?>
                    <button type="submit" class="btn btn-primary ">Save</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </section>
</div>