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
                        <button class=" btn btn-primary m-auto">Kirim</button>
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