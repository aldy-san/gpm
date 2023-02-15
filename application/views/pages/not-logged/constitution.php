<main>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="d-flex flex-column col-10">
                <h2>Daftar Peraturan</h2>
                <ol class="mt-4">
                    <?php  foreach ($peraturan as $p): ?>

                    <li>
                        <a href="<?= $p['type'] == 'url' ? $p['url'] : base_url('/sertifikat/'.$p['files']); ?>"
                            target="_blank"><?=$p['name'];?></a>
                    </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
</main>