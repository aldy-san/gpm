<div class="page-heading">
    <h3>Beranda</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="card">
            <h4 class="ps-4 pt-4">Tampilkan Grafik</h4>
            <div class="card-body overflow-auto">
                <?php foreach ($population_graph as $key => $graph): ?>
                <h5 class="mb-3 text-capitalize">Grafik <?= $key; ?></h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Data Grafik</th>
                            <th>Tampilkan Grafik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($graph as $key => $m): ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $m['title']; ?></td>
                            <td>
                                <div class="form-check">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="graph-input form-check-input form-check-primary form-check-glow"
                                            name="customCheck" id="<?= $m['id']; ?>"
                                            <?= $m['is_active'] ? 'checked': ''; ?>>
                                        <label class="form-check-label" for="<?= $m['id']; ?>">Tampilkan
                                            Grafik</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endforeach; ?>
            </div>
    </section>
</div>

<script type="text/javascript" src="<?= base_url('assets/vendors/toastify/toastify.js'); ?>"></script>
<script>
document.querySelectorAll('.graph-input').forEach(item => {
    item.addEventListener('click', (e) => {
        console.log(e.target.checked)
        const val = e.target.checked ? 1 : 0
        $.post('<?=base_url('api/updateSettings/')?>', {
                id: e.target.id,
                value: val
            }, () => {
                Toastify({
                    text: "Pengaturan Berhasil Diperbarui",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#4fbe87",
                }).showToast();
            })
            .catch((err) => {
                Toastify({
                    text: err,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#e74c3c",
                }).showToast();
            })

    })
});
</script>