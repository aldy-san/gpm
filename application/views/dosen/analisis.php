<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Analisis - <span class="text-capitalize"><?= $this->uri->segment(4); ?></span></h3>
                <div class="d-flex flex-column">
                    <h6>Survei - <?= $period['name']; ?></h6>
                    <h6><?= gmdate("d F Y", $period['period_from']+25200) ?> -
                        <?= gmdate("d F Y", $period['period_to']+25200) ?></h6>
                </div>
            </div>
        </div>
    </div>
    <section class="section mt-4">
        <div class="d-flex mb-4">
            <?php foreach ($list_type as $item): ?>
            <div class="me-2">
                <a href="<?= base_url('/analisis-periode/analisis/'.$this->uri->segment(3).'/'.$item); ?>"
                    class="btn text-capitalize <?= $item === $this->uri->segment(4) ? 'btn-primary' : 'btn-secondary'; ?>"><?= $item; ?></a>
            </div>
            <?php endforeach; ?>
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
                            <?php elseif($item['status'] === 'revised'): ?>
                            <span class="text-capitalize badge bg-danger"> <?= $item['status']; ?></span>
                            <?php endif;?>
                        </td>
                        <td><?= gmdate("d F Y", $item['updated_at']+25200); ?></td>
                        <td>
                            <?php if($item['status'] === 'submitted'): ?>
                            <button type="button" class="ms-1 btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                onclick="openEdit('<?= $item['id']; ?>', '<?= $item['description']; ?>')">
                                Revisi
                            </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex flex-column col-12">
                <ul class="ms-0 ps-3">
                    <li>
                        <p>Jika <b>semua komponen analisis</b> sudah diisi dan siap untuk benar, silahkan klik tombol
                            dibawah
                            untuk melakukan validasi. </p>
                    </li>
                </ul>
                <?php if($period['status'] === 'revised'): ?>
                <small class="text-danger mb-2  ">*Masih ada komponen yang perlu direvisi, lakukan validasi jika revisi
                    sudah
                    selesai atau benar</small>
                <?php endif; ?>
                <button class="btn btn-success me-auto d-flex align-items-center"
                    <?= $check_status !== 'accepted' ? '' : 'disabled' ?> data-bs-toggle="modal"
                    data-bs-target="#validasiModal">
                    <i class="bi bi-check-square me-2"></i>
                    <span class="mb-0 mt-1">VALIDASI KOMPONEN ANALISIS</span>
                </button>

            </div>
        </div>
        <div class="modal fade text-left" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Revisi Data</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="form-edit"
                        action="<?= base_url('/analisis-periode/analisis/edit/'.$this->uri->segment(3).'/'.$this->uri->segment(4)); ?>"
                        method="POST">
                        <input id="input-id" type="hidden" name="id" value="">
                        <input type="hidden" name="status" value="revised">
                        <input type="hidden" name="type" value="<?= $this->uri->segment(4); ?>">
                        <div class="modal-body">
                            <div class="row">
                                <p>Apakah anda yakin merevisi data ini?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-primary">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade text-left" id="validasiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Validasi Data</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin memvalidasi semua data analisis ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <form id="form"
                            action="<?= base_url('/analisis-periode/analisis/edit/'.$this->uri->segment(3).'/'.$this->uri->segment(4)); ?>"
                            method="POST">
                            <input type="hidden" name="status" value="accepted">
                            <input type="hidden" name="type" value="<?= $this->uri->segment(4); ?>">
                            <button class="btn btn-primary me-auto d-flex align-items-center">
                                <span class="mb-0 mt-1">Yes</span>
                            </button>
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