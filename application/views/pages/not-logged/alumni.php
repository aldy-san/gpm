<form action="<?= base_url('alumni'); ?>" method="POST"
    class="d-flex justify-content-center align-items-center auth-form">
    <div class="col-11 col-md-8 col-lg-6 rounded-2 border p-4 bg-white">
        <h4 class="text-center mb-4">Identitas Alumni</h4>
        <div class="row">
            <div class="mb-3 col-12 col-md-6">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control <?= form_error('name') ? 'is-invalid': ''; ?>" name="name"
                    id="name" placeholder="nama" autocomplete="off" value="<?= set_value('name'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('name'); ?>
                </div>
            </div>
            <div class="mb-3 col-12 col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control <?= form_error('email') ? 'is-invalid': ''; ?>" name="email"
                    id="email" placeholder="email@gmail.com" autocomplete="off" value="<?= set_value('email'); ?>">
                <div class="invalid-feedback">
                    <?= form_error('email'); ?>
                </div>
            </div>
            <div class="form-group mb-3 col-12 col-md-6 <?= form_error('prodi') ? 'is-invalid': ''; ?>">
                <label for="prodi" class="mb-2">Program Studi</label>
                <fieldset>
                    <select class="form-select " name="prodi">
                        <option value="D3 Elektronika"> D3 Elektronika </option>
                        <option value="D3 Elektro"> D3 Elektro</option>
                        <option value="S1 Teknik Informatika"> S1 Teknik Informatika</option>
                        <option value="S1 Teknik Elektro"> S1 Teknik Elektro</option>
                        <option value="S1 Pendidikan Teknik Informatika"> S1 Pendidikan Teknik Informatika</option>
                        <option value="S1 Pendidikan Teknik Elektro"> S1 Pendidikan Teknik Elektro</option>
                        <option value="S2 Teknik Elektro"> S2 Teknik Elektro</option>
                    </select>
                </fieldset>
                <div class="invalid-feedback">
                    <?= form_error('prodi'); ?>
                </div>
            </div>
            <div class="form-group mb-3 col-12 col-md-6 <?= form_error('activity') ? 'is-invalid': ''; ?>">
                <label class="mb-2" for="activity">Aktifitas Setelah Lulus</label>
                <fieldset>
                    <select class="form-select" name="activity">
                        <option value="Bekerja"> Bekerja </option>
                        <option value="Wirausaha"> Wirausaha </option>
                        <option value="Studi Lanjut"> Studi Lanjut </option>
                        <option value="Belum Ketiganya"> Belum Ketiganya </option>
                    </select>
                </fieldset>
                <div class="invalid-feedback">
                    <?= form_error('activity'); ?>
                </div>
            </div>
            <div class="form-group mb-3 col-12 col-md-6 <?= form_error('year_from') ? 'is-invalid': ''; ?>">
                <label for="year_from" class="mb-2">Tahun Masuk</label>
                <select name="year_from" class="form-select" aria-label="Default select example" onfocus="this.size=4;"
                    onblur="this.size=1;" onchange="this.size=1; this.blur();">
                    <?php for ($year = (int)date('Y') - 3; 1900 <= $year; $year--): ?>
                    <option value=" <?=$year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                </select>
                <div class="invalid-feedback">
                    <?= form_error('activity'); ?>
                </div>
            </div>
            <div class="form-group mb-3 col-12 col-md-6 <?= form_error('year_to') ? 'is-invalid': ''; ?>">
                <label for="year_to" class="mb-2">Tahun Lulus</label>
                <select name="year_to" class="form-select" aria-label="Default select example" onfocus="this.size=4;"
                    onblur="this.size=1;" onchange="this.size=1; this.blur();">
                    <?php for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                    <option value=" <?=$year;?>"><?=$year;?></option>
                    <?php endfor; ?>
                </select>
                <div class="invalid-feedback">
                    <?= form_error('activity'); ?>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">Mulai Isi Angket</button>
    </div>
</form>