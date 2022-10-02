<form action="<?= base_url('mitra'); ?>" method="POST"
    class="d-flex justify-content-center align-items-center auth-form">
    <div class="col-11 col-md-8 col-lg-6 rounded-2 border p-4 bg-white">
        <h4 class="text-center mb-4">Identitas Mitra</h4>
        <div class="row">
            <div class="mb-3 col-12 col-md-6">
                <label for="position" class="form-label">Jabatan Pengisi</label>
                <input type="text" class="form-control <?= form_error('position') ? 'is-invalid': ''; ?>"
                    name="position" id="position" placeholder="Jabatan Pengisi" autocomplete="off"
                    value="<?= set_value('position'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('position'); ?>
                </div>
            </div>
            <div class="mb-3 col-12 col-md-6">
                <label for="agency" class="form-label">Nama Instansi</label>
                <input type="text" class="form-control <?= form_error('agency') ? 'is-invalid': ''; ?>" name="agency"
                    id="agency" placeholder="Nama Instansi" autocomplete="off" value="<?= set_value('agency'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('agency'); ?>
                </div>
            </div>
            <div class="mb-3 col-12 col-md-6">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control <?= form_error('phone') ? 'is-invalid': ''; ?>" name="phone"
                    id="phone" placeholder="08xxxxxxxxxxx" autocomplete="off" value="<?= set_value('phone'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('phone'); ?>
                </div>
            </div>
            <div class="form-group mb-3 col-12 col-md-6">
                <label for="chart" class="mb-2">Skala Operasional</label>
                <fieldset>
                    <select class="form-select" name="chart">
                        <option value="">Internasional</option>
                        <option value="">Nasional</option>
                        <option value="">Swasta</option>
                        <option value="">BUMN</option>
                        <option value="">Negeri</option>
                        <option value="">Milik Sendiri</option>
                    </select>
                </fieldset>
            </div>
            <div class="form-group mb-3 col-12 col-md-6">
                <label for="" class="mb-2">Tahun Berdiri</label>
                <select class="form-select" aria-label="Default select example" onfocus="this.size=4;"
                    onblur="this.size=1;" onchange="this.size=1; this.blur();">
                    <?php for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                    <option value=" <?=$year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group mb-3 col-12 col-md-6">
                <label for="" class="mb-2">Tahun Kerjasama</label>
                <select class="form-select" aria-label="Default select example" onfocus="this.size=4;"
                    onblur="this.size=1;" onchange="this.size=1; this.blur();">
                    <?php for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                    <option value=" <?=$year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <button class="btn btn-primary">Mulai Isi Angket</button>
    </div>
</form>