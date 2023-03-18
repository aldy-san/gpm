<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Analisis - <span class="text-capitalize"><?= $this->uri->segment(4); ?></span></h3>
            </div>
        </div>
    </div>
    <section class="section mt-4">
        <div class="card p-4">
            <h4>Hasil Survei</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jawaban</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_info as $index => $item): ?>
                    <tr>
                        <td><?= $index+1; ?></td>
                        <td><?= $item['nama_lengkap']; ?></td>
                        <td><?= $item['answer']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if(count($data_info) > 0): ?>
            <a href="<?= base_url('detail/'.$data_info[0]['id']); ?>" class="d-block ms-auto text-end mb-2">Lihat
                Lebih Lengkap</a>
            <?php endif; ?>
        </div>
        <div class="d-flex mb-4">
            <?php foreach ($list_type as $item): ?>
            <div class="me-2">
                <a href="<?= base_url('/manage-period/analisis/'.$this->uri->segment(3).'/'.$item); ?>"
                    class="btn text-capitalize <?= $item === $this->uri->segment(4) ? 'btn-primary' : 'btn-secondary'; ?>"><?= $item; ?></a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4>Data Analisis
                        <?php if($check_status === 'accepted'): ?>
                        <span class="badge bg-success ms-3">Telah Disetujui</span>
                        <?php elseif($check_status === 'submitted'): ?>
                        <span class="badge bg-warning ms-3">Sedang Diajukan</span>
                        <?php elseif($check_status === 'revised'): ?>
                        <span class="badge bg-danger ms-3">Harus Direvisi</span>
                        <?php endif; ?>
                    </h4>
                    <?php if($check_status === 'accepted'): ?>
                    <button class="btn btn-primary d-flex" onclick="getPdf()">
                        <i class="bi bi-download me-3 my-auto"></i>
                        <span class="mt-1">
                            Export Data Analisis
                        </span>
                    </button>
                    <?php endif; ?>
                </div>
                <?php if($check_status === 'draft' || $check_status === 'revised'): ?>
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
                <?php endif; ?>
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
                            <?php elseif($item['status'] === 'revised'): ?>
                            <span class="text-capitalize badge bg-danger"> <?= $item['status']; ?></span>
                            <?php endif;?>
                        </td>
                        <td><?= gmdate("d F Y", $item['updated_at']); ?></td>
                        <td>
                            <?php if($item['status'] === 'draft' || $item['status'] === 'revised' ): ?>
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
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex flex-column col-12 mt-4">
                <ul class="ms-0 ps-3">
                    <li>
                        <p>Jika <b>semua komponen analisis</b> sudah diisi dan siap untuk diajukan, silahkan klik tombol
                            dibawah
                            untuk pengajuan pengesahan. </p>
                    </li>
                    <li>
                        <p>Analisis yang sudah diajukan tidak dapat diubah/ditambahkan/dihapus</p>
                    </li>
                </ul>
                <button class="btn btn-success me-auto d-flex align-items-center"
                    <?= $check_status === 'draft' || $check_status === 'revised' ? '' : 'disabled' ?>
                    data-bs-toggle="modal" data-bs-target="#validasiModal">
                    <i class="bi bi-check-square me-2"></i>
                    <span class="mb-0 mt-1">AJUKAN PENGESAHAN</span>
                </button>

            </div>
        </div>
        <div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
            aria-hidden="true">
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
                            <input type="hidden" name="status" value="submitted">
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
                        <form
                            action="<?= base_url('/manage-period/analisis/edit/'.$this->uri->segment(3).'/'.$this->uri->segment(4)); ?>"
                            method="POST">
                            <input id="input-id" type="hidden" name="id" value="">
                            <input type="hidden" name="status" value="submitted">
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

function getPdf() {
    const {
        jsPDF
    } = window.jspdf
    const pdf = new jsPDF({
        unit: 'mm',
        format: 'a4',
        putOnlyUsedFonts: true,
        floatPrecision: 16
    });
    pdf.setFont("Times New Roman");
    pdf.setFontSize(20);
    pdf.text("I. Pendahuluan", 25, 25);
    pdf.setFontSize(16);
    pdf.save("a4.pdf");
}
</script>