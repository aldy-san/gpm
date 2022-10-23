<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= $title ?></h3>
                <p class="text-subtitle text-muted"><?= $desc?></p>
            </div>
        </div>
    </div>
    <section class="section mt-4">
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
                            <?php foreach ($column_table as $key => $col): ?>
                            <?php if(isset($column_alias)): ?>
                            <th class="text-capitalize text-nowrap"><?= $column_alias[$key]; ?></th>
                            <?php else : ?>
                            <th class="text-capitalize text-nowrap"><?= join(' ', explode('_', $col,)); ?></th>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if($detail_url || $edit_url || $delete_url): ?>
                            <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data_table as $item): ?>
                        <tr>
                            <?php foreach ($column_table as $col): ?>
                            <td class="text-capitalize"><?= $item[$col] ?></td>
                            <?php endforeach; ?>
                            <?php if($detail_url || $edit_url || $delete_url || isset($download_url)): ?>
                            <td>
                                <div class="d-flex">
                                    <?php if($detail_url): ?>
                                    <a href="<?= base_url($detail_url.$item['id']); ?>"
                                        class="ms-1 btn btn-info">Detail</a>
                                    <?php endif ?>
                                    <?php if($edit_url): ?>
                                    <a href="<?= base_url($edit_url.$item['id']); ?>"
                                        class="ms-1 btn btn-warning">Edit</a>
                                    <?php endif ?>
                                    <?php if($delete_url): ?>
                                    <button type="button" class="ms-1 btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        onclick="$('#form-delete input').attr('value','<?= $item['id']; ?>')">
                                        Delete
                                    </button>
                                    <?php if(isset($custom_url)): ?>
                                    <a href="<?= base_url($custom_url.$item['id']); ?>"
                                        class="ms-1 btn btn-success">Survei</a>
                                    <?php endif ?>
                                    <?php endif ?>
                                    <?php if(isset($download_url)): ?>
                                    <a href="<?= base_url($download_url.$item['files']); ?>"
                                        class="ms-1 btn btn-success">Lihat
                                        File</a>
                                    <?php endif ?>
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
    </section>
</div>