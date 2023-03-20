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
                    action="<?= $data_slug ? base_url('/manage-period/edit/'.$data_slug['id']) : base_url('/manage-period/create'); ?>"
                    method="POST">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">Nama Periode</label>
                            <small class="text-muted">ex: <i>Gasal 2022 - Monevjar Awal</i> </small>
                            <input type="text" class="form-control <?= form_error('name') ? 'is-invalid': ''; ?>"
                                name="name" id="name" placeholder="Nama Periode" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('name') ?  set_value('name') : $data_slug['name']) : set_value('name'); ?>"
                                <?= $is_edit? '' : 'disabled'; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="period_from">Dari tanggal</label>
                            <input type="date" class="form-control <?= form_error('period_from') ? 'is-invalid': ''; ?>"
                                name="period_from" id="period_from" placeholder="period_from" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('period_from') ?  set_value('period_from') :  gmdate("Y-m-d", $data_slug['period_from']+25200)) : set_value('period_from'); ?>"
                                <?= $is_edit? '' : 'disabled'; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('period_from'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="period_to">Sampai tanggal</label>
                            <input type="date" class="form-control <?= form_error('period_to') ? 'is-invalid': ''; ?>"
                                name="period_to" id="period_to" placeholder="period_to" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('period_to') ?  set_value('period_to') : gmdate("Y-m-d", $data_slug['period_to']+25200) ) : set_value('period_to'); ?>"
                                <?= $is_edit? '' : 'disabled'; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('period_to'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="category">Survei Kategori</label>
                            <fieldset>
                                <select class="form-select <?= form_error('category') ? 'is-invalid': ''; ?>"
                                    name="category" <?= $is_edit? '' : 'disabled'; ?>>
                                    <?php foreach($category as $c) : ?>
                                    <option value="<?= $c['id']; ?>"
                                        <?= $data_slug && ($data_slug['category'] === $c['id'])? 'selected' : ''; ?>>
                                        <?= $c['name']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </fieldset>
                            <div class="invalid-feedback">
                                <?= form_error('category'); ?>
                            </div>
                        </div>
                    </div>
                    <?php if($is_edit) :?>
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </section>
</div>