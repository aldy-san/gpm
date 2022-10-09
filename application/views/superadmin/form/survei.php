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
                    action="<?= $data_slug ? base_url('/survei/'.$slug.($sub_slug ? '-'.$sub_slug : '').'/edit/'.$this->uri->segment(4)) : base_url('/survei/'.$slug.($sub_slug ? '-'.$sub_slug : '').'/create'); ?>"
                    method="POST">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="question">question</label>
                            <input type="text" class="form-control <?= form_error('question') ? 'is-invalid': ''; ?>"
                                name="question" id="question" placeholder="question" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('question') ?  set_value('question') : $data_slug['question']) : set_value('question'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('question'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for=" type">Type</label>
                            <fieldset>
                                <select class="form-select" name="type"
                                    <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                                    <option value="bar"
                                        <?= $data_slug && ($data_slug['type'] === 'bar')? 'selected' : ''; ?>>Bar
                                    </option>
                                    <option value="selection"
                                        <?= $data_slug && ($data_slug['type'] === 'selection')? 'selected' : ''; ?>>
                                        Selection</option>
                                    <option value="description"
                                        <?= $data_slug && ($data_slug['type'] === 'description')? 'selected' : ''; ?>>
                                        Description</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-group col-6">
                            <label for="chart">Chart</label>
                            <fieldset>
                                <select class="form-select" name="chart"
                                    <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                                    <option value="bar"
                                        <?= $data_slug && ($data_slug['chart'] === 'bar')? 'selected' : ''; ?>>Bar
                                    </option>
                                    <option value="pie"
                                        <?= $data_slug && ($data_slug['chart'] === 'pie')? 'selected' : ''; ?>>
                                        Pie</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-group col-12">
                            <label for="selections">selections</label>
                            <small class="text-muted">split with comma. ex: <i>cool,excellent,yoma</i> </small>
                            <input type="text" class="form-control <?= form_error('selections') ? 'is-invalid': ''; ?>"
                                name="selections" id="selections" placeholder="selections" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('selections') ?  set_value('selections') : $data_slug['selections']) : set_value('selections'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('selections'); ?>
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label for="bar_from">bar from</label>
                            <input type="text" class="form-control <?= form_error('bar_from') ? 'is-invalid': ''; ?>"
                                name="bar_from" id="bar_from" placeholder="bar_from" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('bar_from') ?  set_value('bar_from') : $data_slug['bar_from']) : set_value('bar_from'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('bar_from'); ?>
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label for="bar_to">bar to</label>
                            <input type="text" class="form-control <?= form_error('bar_to') ? 'is-invalid': ''; ?>"
                                name="bar_to" id="bar_to" placeholder="bar_to" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('bar_to') ?  set_value('bar_to') : $data_slug['bar_to']) : set_value('bar_to'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('bar_to'); ?>
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label for="bar_length">bar length</label>
                            <input type="text" class="form-control <?= form_error('bar_length') ? 'is-invalid': ''; ?>"
                                name="bar_length" id="bar_length" placeholder="bar_length" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('bar_length') ?  set_value('bar_length') : $data_slug['bar_length']) : set_value('bar_length'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('bar_length'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="category">Kategori</label>
                            <fieldset>
                                <select class="form-select <?= form_error('category') ? 'is-invalid': ''; ?>"
                                    name="category" <?= $title === 'Detail Survei Mahasiswa' ? 'disabled' : ''; ?>>
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
                    <?php if($title !== 'Detail Survei Mahasiswa') :?>
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </section>
</div>