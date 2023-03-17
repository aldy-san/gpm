<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Analisis</h3>
            </div>
        </div>
    </div>
    <section class="section mt-4">
        <div class="card">
            <div class="card-body">
                <form
                    action="<?= base_url('/manage-period/analisis/'.$this->uri->segment(3).'/'.$this->uri->segment(4)); ?>"
                    method="POST">
                    <div class="row">
                        <div class="form-group col-12">
                            <label class="mb-2" for="name">Analisis</label>
                            <textarea class="form-control" name="description" rows="5"
                                placeholder="Masukkan analisis..." style='resize:none'></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
        <div class="card p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="text-capitalize"><?= $this->uri->segment(4) ?></th>
                        <th>Status</th>
                        <th>Terakhir Diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_table as $index => $item): ?>
                    <tr>
                        <td><?= $index+1; ?></td>
                        <td><?= $item['description']; ?></td>
                        <td>
                            <?php if($item['status'] === 'draft'): ?>
                            <span class="text-capitalize badge bg-secondary"> <?= $item['status']; ?></span>
                            <?php elseif($item['status'] === 'accepted'): ?>
                            <span class="text-capitalize badge bg-success"> <?= $item['status']; ?></span>
                            <?php elseif($item['status'] === 'submitted'): ?>
                            <span class="text-capitalize badge bg-warning"> <?= $item['status']; ?></span>
                            <?php elseif($item['status'] === 'cancelled'): ?>
                            <span class="text-capitalize badge bg-danger"> <?= $item['status']; ?></span>
                            <?php endif;?>
                        </td>
                        <td><?= gmdate("d F Y", $item['updated_at']); ?></td>
                        <td>
                            <button type="button" class="ms-1 btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                onclick="openEdit('<?= $item['id']; ?>', '<?= $item['description']; ?>')">
                                Edit
                            </button>
                            <button type="button" class="ms-1 btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                onclick="$('#form-delete #input-id').attr('value','<?= $item['id']; ?>')">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Hapus Data</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
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
                            <form id="form-delete"
                                action="<?= base_url('manage-period/analisis/delete/'.$this->uri->segment(3)); ?>"
                                method="POST">
                                <input id="input-id" type="hidden" name="id" value="">
                                <input type="hidden" name="type" value="<?= $this->uri->segment(4); ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade text-left" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Edit Data</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form id="form-edit"
                            action="<?= base_url('/manage-period/analisis/edit/'.$this->uri->segment(3).'/'.$this->uri->segment(4)); ?>"
                            method="POST">
                            <input id="input-id" type="hidden" name="id" value="">
                            <input type="hidden" name="type" value="<?= $this->uri->segment(4); ?>">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label class="mb-2" for="name">Analisis</label>
                                        <textarea class="form-control" name="description" rows="5"
                                            placeholder="Masukkan analisis..." style='resize:none'></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
function openEdit(id, val) {
    $('#form-edit #input-id').attr('value', id);
    $('#form-edit textarea').val(val);
}
</script>