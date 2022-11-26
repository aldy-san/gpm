<form action="<?= base_url('pengguna'); ?>" method="POST"
    class="row justify-content-center align-items-center auth-form">
    <div class="col-11 col-md-8 col-lg-6 rounded-2 border p-4 bg-white">
        <h4 class="text-center mb-4">Identitas Pengguna</h4>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="position" class="form-label">Jabatan Pengisi</label>
                <input type="text" class="form-control <?= form_error('position') ? 'is-invalid': ''; ?>"
                    name="position" id="position" placeholder="Jabatan Pengisi" autocomplete="off"
                    value="<?= set_value('position'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('position'); ?>
                </div>
            </div>
            <div class="mb-3 col-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control <?= form_error('email') ? 'is-invalid': ''; ?>" name="email"
                    id="email" placeholder="email@gmail.com" autocomplete="off" value="<?= set_value('email'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('email'); ?>
                </div>
            </div>
            <div class="mb-3 col-6">
                <label for="agency" class="form-label">Nama Instansi</label>
                <input type="text" class="form-control <?= form_error('agency') ? 'is-invalid': ''; ?>" name="agency"
                    id="agency" placeholder="Nama Instansi" autocomplete="off" value="<?= set_value('agency'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('agency'); ?>
                </div>
            </div>
            <div class="form-group mb-3 col-12 col-md-6">
                <label for="scale" class="mb-2">Skala Operasional</label>
                <fieldset>
                    <select class="form-select" name="scale">
                        <option value="Internasional">Internasional</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Swasta">Swasta</option>
                        <option value="BUMN">BUMN</option>
                        <option value="Negeri">Negeri</option>
                        <option value="Milik Sendiri">Milik Sendiri</option>
                    </select>
                </fieldset>
            </div>
            <div class="mb-3 col-6">
                <label for="employee" class="form-label">Jumlah Pegawai</label>
                <input type="number" class="form-control <?= form_error('employee') ? 'is-invalid': ''; ?>"
                    name="employee" id="employee" placeholder="Jumlah Pegawai" autocomplete="off"
                    value="<?= set_value('employee'); ?>" min="1">
                <div class="invalid-feedback">
                    <?= form_error('employee'); ?>
                </div>
            </div>
            <div class="mb-3 col-6">
                <label for="total_graduates" class="form-label">Jumlah Total Lulusan UM</label>
                <input type="number" class="form-control <?= form_error('total_graduates') ? 'is-invalid': ''; ?>"
                    name="total_graduates" id="total_graduates" placeholder="Jumlah Total Lulusan UM" autocomplete="off"
                    value="<?= set_value('total_graduates'); ?>" min="1">
                <div class="invalid-feedback">
                    <?= form_error('total_graduates'); ?>
                </div>
            </div>
            <div class="form-group mb-3 col-12 col-md-6">
                <label for="year_since" class="mb-2">Tahun Berdiri</label>
                <select class="form-select" name="year_since" aria-label="Default select example" onfocus="this.size=4;"
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