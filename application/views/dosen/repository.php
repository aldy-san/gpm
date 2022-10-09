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
                    action="<?= $data_slug ? base_url('/dosen/repository/edit/'.$data_slug['id']) : base_url('/dosen/repository/create'); ?>"
                    method="POST">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="name">Nama Sertifikat</label>
                            <input type="text" class="form-control <?= form_error('name') ? 'is-invalid': ''; ?>"
                                name="name" id="name" placeholder="Nama Sertifikat" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('name') ?  set_value('name') : $data_slug['name']) : set_value('name'); ?>"
                                <?= $is_edit? '' : 'disabled'; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="institution">Nama Lembaga Pemberi Sertifikat</label>
                            <input type="text" class="form-control <?= form_error('institution') ? 'is-invalid': ''; ?>"
                                name="institution" id="institution" placeholder="Nama Lembaga" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('institution') ?  set_value('institution') : $data_slug['institution']) : set_value('institution'); ?>"
                                <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>
                                <?= $is_edit ? '' : 'disabled'; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('institution'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="date">Tanggal Kegiatan</label>
                            <input type="date" class="form-control <?= form_error('date') ? 'is-invalid': ''; ?>"
                                name="date" id="date" placeholder="date" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('date') ?  set_value('date') :  gmdate("Y-m-d", $data_slug['date'])) : set_value('date'); ?>"
                                <?= $is_edit? '' : 'disabled'; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('date'); ?>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="category">Kategori</label>
                            <fieldset>
                                <select class="form-select <?= form_error('category') ? 'is-invalid': ''; ?>"
                                    name="category" <?= $is_edit? '' : 'disabled'; ?>>

                                    <option value="Lokal">Lokal</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
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