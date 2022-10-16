<div class="page-heading">
    <h3>Beranda</h3>
</div>
<div class="page-content">
    <section class="row">
        <?php if (count($category_tendik) > 0): ?>
        <h5>Silahkan Pilih Menu Survei</h1>
            <?php foreach ($category_tendik as $category): ?>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4><?= $category['name']; ?></h4>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url('tendik/survei/'.$category['id']); ?>" class="btn btn-primary">Mulai
                            Mengisi Survei</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="d-flex flex-column align-items-center w-full mt-4">
                <object data="<?= base_url('assets/svg/no-data.svg'); ?>" width="250" height="250"> </object>
                <h4 class="mt-4 text-center">Tidak Ada Survei</h4>
            </div>
            <?php endif; ?>
    </section>
</div>