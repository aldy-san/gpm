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
            <div class="card-header">
                <a href="<?= base_url($create_url); ?>" class="btn btn-success">Add item</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php foreach ($column_table as $col): ?>
                            <th class="text-capitalize"><?= $col; ?></th>
                            <?php endforeach; ?>
                            <?php if($detail_url || $edit_url || $delete_url): ?>
                            <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $u): ?>
                        <tr>
                            <?php foreach ($column_table as $col): ?>
                            <td><?= $u[$col] ?></td>
                            <?php endforeach; ?>
                            <?php if($detail_url || $edit_url || $delete_url): ?>
                            <td>
                                <?php if($detail_url): ?>
                                <a href="<?= base_url($detail_url.$u['id']); ?>" class="btn btn-info">Detail</a>
                                <?php endif ?>
                                <?php if($edit_url): ?>
                                <a href="<?= base_url($edit_url.$u['id']); ?>" class="btn btn-warning">Edit</a>
                                <?php endif ?>
                                <?php if($delete_url): ?>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    onclick="$('#form-delete input').attr('value','<?= $u['id']; ?>')">
                                    Delete
                                </button>
                                <?php endif ?>
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