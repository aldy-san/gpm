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
                            <label for="question">Pertanyaan</label>
                            <input type="text" class="form-control <?= form_error('question') ? 'is-invalid': ''; ?>"
                                name="question" id="question" placeholder="Pertanyaan" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('question') ?  set_value('question') : $data_slug['question']) : set_value('question'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('question'); ?>
                            </div>
                        </div>
                        <!--<div class="form-group col-6">
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
                        </div>-->
                        <div class="form-group col-2">
                            <label for="type">Tipe</label>
                            <fieldset>
                                <select id="form-type" class="form-select" name="type"
                                    <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                                    <option value="bar"
                                        <?= $data_slug && ($data_slug['type'] === 'bar') ? 'selected' : ''; ?>>Bar
                                    </option>
                                    <option value="selection"
                                        <?= $data_slug && ($data_slug['type'] === 'selection') ? 'selected' : ''; ?>>
                                        Selection</option>
                                    <option value="description"
                                        <?= $data_slug && ($data_slug['type'] === 'description') ? 'selected' : ''; ?>>
                                        Description</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-group col-2">
                            <label for="chart">Grafik</label>
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
                        <div class="form-group col-8 selection-type">
                            <label for="selections">Pilihan</label>
                            <small class="text-muted">Pisahkan dengan koma. cth: <i>cool,excellent,yoma</i> </small>
                            <input type="text" class="form-control <?= form_error('selections') ? 'is-invalid': ''; ?>"
                                name="selections" id="selections" placeholder="Pilihan" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('selections') ?  set_value('selections') : $data_slug['selections']) : set_value('selections'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('selections'); ?>
                            </div>
                        </div>
                        <div class="form-group col-4 bar-type">
                            <label for="bar_from">Bar From</label>
                            <input type="text" class="form-control <?= form_error('bar_from') ? 'is-invalid': ''; ?>"
                                name="bar_from" id="bar_from" placeholder="Bar From" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('bar_from') ?  set_value('bar_from') : $data_slug['bar_from']) : set_value('bar_from'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('bar_from'); ?>
                            </div>
                        </div>
                        <div class="form-group col-4 bar-type">
                            <label for="bar_to">Bar To</label>
                            <input type="text" class="form-control <?= form_error('bar_to') ? 'is-invalid': ''; ?>"
                                name="bar_to" id="bar_to" placeholder="Bar To" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('bar_to') ?  set_value('bar_to') : $data_slug['bar_to']) : set_value('bar_to'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('bar_to'); ?>
                            </div>
                        </div>
                        <!--<div class="form-group col-4">
                            <label for="bar_length">Bar Length</label>
                            <input type="text" class="form-control <?= form_error('bar_length') ? 'is-invalid': ''; ?>"
                                name="bar_length" id="bar_length" placeholder="Bar Length" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('bar_length') ?  set_value('bar_length') : $data_slug['bar_length']) : set_value('bar_length'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('bar_length'); ?>
                            </div>
                        </div>-->
                    </div>
                    <?php if($title !== 'Detail Survei Mahasiswa') :?>
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
//function changeType(val) {
//    console.log(val)
//    if (val === 'bar') {
//        $('.bar-type').show();
//        $('.selection-type').hide();
//    } else if (val === 'selection') {
//        $('.bar-type').hide();
//        $('.selection-type').show();
//    } else {
//        $('.selection-type').hide();
//        $('.bar-type').hide();
//    }
//}
//$('#form-type').on('change', function() {
//    changeType(this.value)
//});
//changeType(
//    '<?= $data_slug ?  (set_value('selections') ?  set_value('selections') : $data_slug['selections']) : set_value('selections'); ?>'
//)
//
</script>