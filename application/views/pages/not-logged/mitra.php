<form class="d-flex justify-content-center align-items-center auth-form">
    <div class="col-11 col-md-8 col-lg-6 rounded-2 border p-4 bg-white">
        <h4 class="text-center mb-4">Identitas Mitra</h4>
        <div class="row">
            <div class="mb-3 col-12 col-md-6">
                <label for="jabatan" class="form-label">Jabatan Pengisi</label>
                <input type="text" class="form-control <?= form_error('jabatan') ? 'is-invalid': ''; ?>" name="jabatan"
                    id="jabatan" placeholder="Jabatan" autocomplete="off" value="<?= set_value('jabatan'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('jabatan'); ?>
                </div>
            </div>
            <div class="mb-3 col-12 col-md-6">
                <label for="name" class="form-label">Nama Instansi</label>
                <input type="text" class="form-control <?= form_error('name') ? 'is-invalid': ''; ?>" name="name"
                    id="name" placeholder="nama" autocomplete="off" value="<?= set_value('name'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('name'); ?>
                </div>
            </div>
            <div class="mb-3 col-12 col-md-6">
                <label for="telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control <?= form_error('telepon') ? 'is-invalid': ''; ?>" name="telepon"
                    id="telepon" placeholder="08xxxxxxxxxxx" autocomplete="off" value="<?= set_value('telepon'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('telepon'); ?>
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