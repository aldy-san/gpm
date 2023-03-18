<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 mb-3">
                <h3><?= $title ?></h3>
                <p class="text-subtitle text-muted"><?= $desc?></p>
            </div>
        </div>
    </div>
    <section class="section">
        <?php if(isset($activation)): ?>
        <div class="card col-2">
            <div class="p-3">
                <div class="form-check">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input form-check-primary form-check-glow"
                            name="customCheck" id="survei-activation"
                            <?= $is_survei_active['is_active'] ? 'checked': ''; ?>>
                        <label class="form-check-label" for="survei-activation">Aktivasi
                            Survei</label>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="card">
            <?php if($create_url): ?>
            <div class="card-header">
                <a href="<?= base_url($create_url); ?>" class="btn btn-success">Tambah item</a>
            </div>
            <?php endif; ?>
            <div class="card-body overflow-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php if($title === 'Kategori Survei' ) : ?>
                            <th class="text-capitalize">
                                No
                            </th>
                            <?php endif ?>
                            <?php foreach ($column_table as $key => $col): ?>
                            <?php if(isset($column_alias)): ?>
                            <?php if($title === 'Kategori Survei' ) : ?>
                            <th class="text-capitalize text-nowrap"><?= $column_alias[$key+1]; ?> </th>
                            <?php else : ?>
                            <th class="text-capitalize text-nowrap"><?= $column_alias[$key]; ?> </th>
                            <?php endif; ?>
                            <?php else : ?>
                            <th class="text-capitalize text-nowrap"><?= join(' ', explode('_', $col)); ?></th>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if($detail_url || $edit_url || $delete_url || isset($custom_url) || isset($download_url)): ?>
                            <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_table as $index => $item): ?>
                        <tr>
                            <?php if($title === 'Kategori Survei' ) : ?>
                            <td class="text-capitalize">
                                <?= $index+1 ?>
                            </td>
                            <?php endif ?>
                            <?php foreach ($column_table as $col): ?>
                            <?php if(isset($column_badge) && in_array($col, $column_badge)): ?>
                            <td class="text-capitalize">
                                <span
                                    class="<?= in_array($item[$col], ['submitted', 'Ya']) ? 'badge bg-success' : 'badge bg-danger'; ?>"><?= $item[$col] ?></span>
                            </td>
                            <?php else : ?>
                            <td class="text-capitalize">
                                <?= $item[$col] ?>
                            </td>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if($detail_url || $edit_url || $delete_url || isset($custom_url) || isset($download_url)): ?>
                            <td>
                                <div class="d-flex">
                                    <?php if($detail_url): ?>
                                    <a href="<?= base_url($detail_url.$item['id']); ?>"
                                        class="ms-1 btn btn-info">Detail</a>
                                    <?php endif; ?>
                                    <?php if($edit_url): ?>
                                    <a href="<?= base_url($edit_url.$item['id']); ?>"
                                        class="ms-1 btn btn-warning">Edit</a>
                                    <?php endif; ?>
                                    <?php if($delete_url): ?>
                                    <button type="button" class="ms-1 btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        onclick="$('#form-delete input').attr('value','<?= $item['id']; ?>')">
                                        Delete
                                    </button>
                                    <?php endif; ?>
                                    <?php if(isset($custom_url)): ?>
                                    <a href="<?= base_url($custom_url.$item['id']); ?>"
                                        class="ms-1 btn btn-success"><?= $custom_url_name; ?></a>
                                    <?php endif; ?>
                                    <?php if(isset($download_url)): ?>
                                    <a href="<?= base_url($download_url.$item['files']); ?>"
                                        class="ms-1 btn btn-success">Lihat
                                        File</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <?php endif ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links(); ?>
                <!--Basic Modal -->
                <div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog"
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
                                    Apakah anda yakin ingin menghapus data?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <form id="form-delete" action="<?= base_url($delete_url); ?>" method="POST">
                                    <input type="hidden" name="id" value="">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($title === 'Kategori Survei'): ?>
        <h3>Survei Lainnya</h3>
        <div class="card">
            <div class="card-body overflow-auto">
                <table class="table table-striped">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Survei</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. </td>
                                <td>Dosen Terbaik</td>
                                <td>
                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                class="form-check-input form-check-primary form-check-glow"
                                                name="customCheck" id="survei-activation-dosen"
                                                <?= $is_survei_dosen_active['is_active'] ? 'checked': ''; ?>>
                                            <label class="form-check-label" for="survei-activation-dosen">Aktivasi
                                                Survei</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </table>
            </div>
        </div>
        <?php endif ?>
    </section>
</div>
<script type="text/javascript" src="<?= base_url('assets/vendors/toastify/toastify.js'); ?>"></script>
<script type="text/javascript">
document.getElementById('survei-activation').addEventListener('click', (e) => {
    console.log(e.target.checked)
    const val = e.target.checked ? 1 : 0
    $.post('<?=base_url('api/updateSurveiActivation/')?>', {
            name: '<?= $activation; ?>',
            value: val
        }, () => {
            Toastify({
                text: "Aktivasi survei berhasil diganti",
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
</script>
<script type="text/javascript">
document.getElementById('survei-activation-dosen').addEventListener('click', (e) => {
    console.log(e.target.checked)
    const val = e.target.checked ? 1 : 0
    $.post('<?=base_url('api/updateSurveiActivation/')?>', {
            name: 'dosen',
            value: val
        }, () => {
            Toastify({
                text: "Aktivasi survei berhasil diganti",
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
</script>