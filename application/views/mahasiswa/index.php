<div class="page-heading">
    <h2>Beranda</h2>
</div>
<div class="page-content">
    <section class="row">
        <h4 class="col-12 mb-3">Silahkan Pilih Menu Survei</h4>
        <?php if($is_survei_dosen_active['is_active']): ?>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header ">
                    <h5>Survei Dosen & Tendik Terbaik</h5>
                </div>
                <div class="card-body">

                    <?php if(!$check_survei_dosen_answer): ?>
                    <a href="<?= base_url('mahasiswa/survei_dosen'); ?>" class="btn btn-primary ">Mulai
                        Mengisi Survei</a>
                    <?php else: ?>
                    <a href="#" class="btn btn-success disabled">Mulai
                        Mengisi Survei</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if (count($category_mahasiswa_avail) > 0): ?>
        <?php foreach ($category_mahasiswa_avail as $category): ?>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header ">
                    <h5><?= $category['name']; ?></h5>
                </div>
                <div class="card-body">
                    <?php if(!in_array($category['name'], $category_mahasiswa_answered)): ?>
                    <a href="<?= base_url('mahasiswa/survei/'.$category['id']); ?>" class="btn btn-primary">Mulai
                        Mengisi Survei</a>
                    <?php else: ?>
                    <a href="<?= base_url('mahasiswa/survei/'.$category['id']); ?>"
                        class="btn btn-success disabled">Anda telah mengisi survei</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php if ((count($category_mahasiswa_avail) == 0) && !$is_survei_dosen_active['is_active']): ?>
        <div class="d-flex flex-column align-items-center w-full mt-4">
            <object data="<?= base_url('assets/svg/no-data.svg'); ?>" width="250" height="250"> </object>
            <h4 class="mt-4 text-center">Tidak Ada Survei</h4>
        </div>
        <?php endif; ?>
    </section>
</div>