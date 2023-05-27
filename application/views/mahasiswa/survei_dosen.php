<nav class="navbar navbar-light">
    <div class="container d-block">
        <a href="<?= base_url('dashboard'); ?>"><i class="bi bi-chevron-left"></i></a>
        <!-- <a class="navbar-brand ms-4" href="index.html">
            <img src="<?= base_url('assets/images/logo/logo.png'); ?>">
        </a> -->
    </div>
</nav>

<div class=" container">
    <div class="row survei mb-5">
        <div class="col col-lg-8 mx-auto">
            <?php if ($this->session->flashdata('alertForm')): ?>
            <div class="alert alert-danger" role="alert">
                <p class="text-center"><?= $this->session->flashdata('alertForm'); ?></p>
            </div>
            <?php endif ?>
            <div class="page-heading text-center">
                <h2 class="text-capitalize">Survei Dosen & Tendik Terbaik</h2>
            </div>
            <div class="page-content">
                <section class="bootstrap-select">
                    <form action="<?= base_url('/mahasiswa/survei_dosen') ?>" method="POST">
                        <h3>Pilih Dosen</h3>
                        <?php foreach ($list_dosen as $value) :?>
                        <div class="card row my-3 p-5" data-aos="fade-up" data-aos-duration="1500">
                            <div class="ms-2 my-2 form-check">
                                <input class="form-check-input" type="radio" name="answer"
                                    id="dosen-<?=  $value['username']; ?>" value="<?= $value['username'];; ?>">
                                <label class="form-check-label text-dark" for="dosen-<?=  $value['username']; ?>">
                                    <h5><?= $value['nama_lengkap']; ?></h5>
                                </label>
                            </div>
                            <div class="d-flex flex-column">
                                <img src="<?= base_url('assets/images/dosen/'.$value['username'].'.jpg'); ?>"
                                    width="200" alt="">
                                <img src="<?= base_url('assets/images/dosen/'.$value['username'].'.png'); ?>"
                                    width="200" alt="">
                                <img src="<?= base_url('assets/images/dosen/'.$value['username'].'.jpeg'); ?>"
                                    width="200" alt="">
                            </div>
                        </div>
                        <?php endforeach ?>
                        <h3 class="mt-5">Pilih Tendik</h3>
                        <?php foreach ($list_tendik as $value) :?>
                        <div class="card row my-3 p-5" data-aos="fade-up" data-aos-duration="1500">
                            <div class="ms-2 my-2 form-check">
                                <input class="form-check-input" type="radio" name="answer2"
                                    id="tendik-<?=  $value['username']; ?>" value="<?= $value['username'];; ?>">
                                <label class="form-check-label text-dark" for="tendik-<?=  $value['username']; ?>">
                                    <h5><?= $value['nama_lengkap']; ?></h5>
                                </label>
                            </div>
                            <div class="d-flex flex-column">
                                <img src="<?= base_url('assets/images/dosen/'.$value['username'].'.jpg'); ?>"
                                    width="200" alt="">
                                <img src="<?= base_url('assets/images/dosen/'.$value['username'].'.png'); ?>"
                                    width="200" alt="">
                                <img src="<?= base_url('assets/images/dosen/'.$value['username'].'.jpeg'); ?>"
                                    width="200" alt="">
                            </div>
                        </div>
                        <?php endforeach ?>
                        <button type="button" class="btn btn-primary m-auto" data-bs-toggle="modal"
                            data-bs-target="#confirmModal">
                            Kirim
                        </button>
                        <div class="modal fade text-left" id="confirmModal" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Hapus Data</h5>
                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Apakah anda yakin ingin dengan jawaban anda?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
AOS.init({
    once: true,
});
</script>

<script>
for (let x = 1; x <= <?= $bar_count ?>; x++) {
    let slider = document.getElementById("input-range" + x);
    let range = document.getElementById("range" + x);

    slider.oninput = function() {
        range.value = this.value;
    }
    range.oninput = function() {
        slider.value = this.value;
    }
}
</script>