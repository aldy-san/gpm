<form class="row justify-content-center align-items-center auth-form">
    <div class="col-11 col-md-8 col-lg-6 rounded-2 border p-4 bg-white">
        <h4 class="text-center mb-4">Identitas Alumni</h4>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control <?= form_error('name') ? 'is-invalid': ''; ?>" name="name"
                    id="name" placeholder="nama" autocomplete="off" value="<?= set_value('name'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('name'); ?>
                </div>
            </div>
            <div class="mb-3 col-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control <?= form_error('email') ? 'is-invalid': ''; ?>" name="email"
                    id="email" placeholder="nama@example.com" autocomplete="off" value="<?= set_value('email'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('email'); ?>
                </div>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="chart">Program Studi</label>
                <fieldset>
                    <select class="form-select" name="chart">
                        <option value="bar">
                            Bar
                        </option>
                        <option value="pie">
                            Pie</option>
                    </select>
                </fieldset>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="chart" class="mb-2">Aktifitas Setelah Lulus</label>
                <fieldset>
                    <select class="form-select" name="chart">
                        <option value="bar">
                            Bar
                        </option>
                        <option value="pie">
                            Pie</option>
                    </select>
                </fieldset>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="chart" class="mb-2">Tahun Masuk</label>
                <fieldset>
                    <select class="form-select" name="chart">
                        <option value="bar">
                            Bar
                        </option>
                        <option value="pie">
                            Pie</option>
                    </select>
                </fieldset>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="chart" class="mb-2">Tahun Lulus</label>
                <fieldset>
                    <select class="form-select" name="chart">
                        <option value="bar">
                            Bar
                        </option>
                        <option value="pie">
                            Pie</option>
                    </select>
                </fieldset>
            </div>
        </div>
        <button class="btn btn-primary">Mulai Isi Angket</button>
    </div>
</form>