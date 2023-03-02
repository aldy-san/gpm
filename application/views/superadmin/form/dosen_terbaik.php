<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 mb-3">
                <h3>Dosen Terbaik</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <?php if($edit_url): ?>
            <div class="card-header">
                <a href="<?= base_url($edit_url); ?>" class="btn btn-warning">Edit Pertanyaan</a>
            </div>
            <?php endif; ?>
            <div class="card-body overflow-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-capitalize text-nowrap">Pertanyaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($survei_dosen as $sd): ?>
                        <td class="text-capitalize">
                            <?= $sd['name'] ?>
                        </td>
                        <?php endforeach; ?>
                        </tr>
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

        <!-- DOSENN -->
        <h3>Dosen</h3>
        <div class="card">
            <?php if($create_url): ?>
            <div class="card-header">
                <a href="<?= base_url($create_url); ?>" class="btn btn-success">Tambah Dosen</a>
            </div>
            <?php endif; ?>
            <div class="card-body overflow-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-capitalize text-nowrap">No.</th>
                            <th class="text-capitalize text-nowrap">Nama Dosen</th>
                            <th class="text-capitalize text-nowrap">Foto</th>
                            <?php if($detail_url || $edit_url || $delete_url): ?>
                            <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($survei as $index => $item): ?>
                        <tr>
                            <td class="text-capitalize">
                                <?= $index+1 ?>.
                            </td>
                            <td class="text-capitalize">
                                <?= $item['name'] ?>
                            </td>

                            <td class="text-capitalize">
                                <div class="avatar avatar-xl me-3">
                                    <img src="<?= base_url('assets/images/dosen/'.$item['image']) ?>"
                                        alt="<?= $item['image'] ?>">
                                </div>
                            </td>
                            <?php if($detail_url || $edit_url || $delete_url): ?>
                            <td>
                                <div class="d-flex">
                                    <?php if($detail_url): ?>
                                    <a href="<?= base_url($detail_url.$item['id']); ?>"
                                        class="ms-1 btn btn-info">Detail</a>
                                    <?php endif ?>
                                    <?php if($edit_url): ?>
                                    <a href="<?= base_url('survei/dosen-terbaik/edit-dosen/'.$item['id']); ?>"
                                        class="ms-1 btn btn-warning">Edit</a>
                                    <?php endif ?>
                                    <?php if($delete_url): ?>
                                    <button type="button" class="ms-1 btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        onclick="$('#form-delete input').attr('value','<?= $item['id']; ?>')">
                                        Delete
                                    </button>
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
                                <form id="form-delete" action="<?= base_url('survei/dosen-terbaik/delete'); ?>"
                                    method="POST">
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
