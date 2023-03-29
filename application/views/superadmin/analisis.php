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
                <div class="d-flex flex-column">
                    <h6>Survei - <?= $period['name']; ?></h6>
                    <h6><?= gmdate("d F Y", $period['period_from']+25200) ?> -
                        <?= gmdate("d F Y", $period['period_to']+25200) ?></h6>
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
                        <th>Catatan</th>
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
                        <td><?= $item['note']; ?></td>
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
const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
    'Oktober', 'November', 'Desember'
]

function openEdit(id, val) {
    $('#form-edit #input-id').attr('value', id);
    $('#form-edit textarea').val(val);
}

function getPdf() {
    $.get('<?= base_url('api/getDataAnalisis/'.$this->uri->segment(3)); ?>', (res) => {
        var data = JSON.parse(res)

        var date = new Date()
        var date = parseDate(date)
        // INIT PDF
        const {
            jsPDF
        } = window.jspdf

        const doc = new jsPDF({
            orientation: "l", //set orientation
            unit: "pt", //set unit for document
            format: "a4" //set document standard
        });
        doc.setFont("Times New Roman");

        var margin = 0.2
        const verticalOffset = margin;
        // END INIT PDF
        // INFORMATION TABLE
        // I. PENDAHALUAN
        doc.autoTable(generateDataKey(['0', '1']), [
            ['Jurusan', 'Teknik Elektro dan Informatika'],
            ['Nama Ketua Jurusan', '<?= $kadep['nama_lengkap']; ?>'],
            ['Tanggal Audit', date],
            ['Auditor', 'Muhammad Afnan Habibi, S.T., M.T., M.Eng']
        ], {
            ...defaultOptions(),
            headStyles: {
                lineColor: 255,
                textColor: 255,
                lineWidth: 1,
            },
            margin: {
                top: 55
            },
            didDrawPage: function(data) {
                doc.text("I. PENDAHULUAN", 40, 60);
            }
        })
        // II. TUJUAN AUDIT
        doc.autoTable(generateDataKey(['0', '1']), [
            ['1', 'Mengetahui kesesuaian atau ketidaksesuaian dalam pelaksanaan standar departemen.'],
            ['2', 'Mengevaluasi efektifitas penerapan sistem yang diimplementasikan dalam departemen.'],
            ['3',
                'Mengidentifikasi peluang perbaikan untuk meningkatkan kinerja sivitas akademik departemen.'
            ],
        ], {
            ...defaultOptions(),
            headStyles: {
                lineColor: 255,
                textColor: 255,
                lineWidth: 1,
            },
            margin: {
                top: 55
            },
            didDrawPage: function(data) {
                doc.text("II. TUJUAN AUDIT", 40, 190);
            }
        })
        // III. JADWAL AUDIT
        const from_date = new Date(<?= $period['period_from']; ?>)
        const to_date = new Date(<?= $period['period_to']; ?>)
        doc.autoTable(generateDataKey(['0', '1']), [
            ['Waktu', 'Kegiatan Audit'],
            [`${parseDate(from_date * 1000)} - ${parseDate(to_date * 1000)}`,
                'AUDIT MUTU INTERNAL JURUSAN TEKNIK ELEKTRO DAN INFORMATIKA'
            ]
        ], {
            ...defaultOptions(),
            headStyles: {
                lineColor: 255,
                textColor: 255,
                lineWidth: 1,
            },
            margin: {
                top: 55
            },
            didDrawPage: function(data) {
                doc.text("III. JADWAL AUDIT", 40, 295);
            }
        })
        doc.addPage()

        // DATA TABLE
        const swotTable = generateTable(['keunggulan', 'kelemahan', 'ancaman', 'peluang'], data)
        const noteTable = generateTable(['temuan', 'strategi'], data)
        doc.autoTable(swotTable.columns, swotTable.rows, {
            ...swotTable.options,
            didDrawPage: function(data) {
                doc.text("IV. ANALISIS SWOT", 40, 60);
            }
        })
        doc.addPage()
        doc.autoTable(noteTable.columns, noteTable.rows, {
            ...noteTable.options,
            didDrawPage: function(data) {
                doc.text("V. CATATAN GPM", 40, 60);
            }
        })
        // END TABLE
        doc.addPage()
        // VI. BERITA ACARA
        doc.autoTable(generateDataKey(['0']), [
            [
                `Pada tanggal ${date} telah dilaksanakan audit mutu Gugus Penjamin Mutu (GPM) oleh tim auditor unit GPM di Jurusan Teknik Elektro dan Informatika Fakultas Teknik Universitas Negeri Malang`
            ],
            [
                'Berita acara ini di diketahui oleh Ketua Jurusan Jurusan Teknik Elektro dan Informatika setelah divalidasi dan disetujui.'
            ],
        ], {
            ...defaultOptions(),
            headStyles: {
                lineColor: 255,
                textColor: 255,
                lineWidth: 1,
            },
            styles: {
                lineColor: 255,
                fontSize: 13,
            },
            margin: {
                top: 55
            },
            didDrawPage: function(data) {
                doc.text("VI. BERITA ACARA", 40, 60);
            }
        })
        doc.autoTable(generateDataKey(['0', '1']), [
            ['Nama Ketua Jurusan', '<?= $kadep['nama_lengkap']; ?>'],
            ['Tanggal Audit', date],
            ['Status', 'Disetujui'],
        ], {
            ...defaultOptions(),
            headStyles: {
                lineColor: 255,
                textColor: 255,
                lineWidth: 1,
            },
            styles: {
                lineWidth: 1.5,
                lineColor: 0,
                fontStyle: 'bold',
            },
            margin: {
                top: 0
            }
        })
        doc.save(`<?= $period['name']; ?>.pdf`);
    })
}

function parseDate(date) {
    const temp = new Date(date)
    return `${temp.getDate()} ${months[temp.getMonth()]} ${temp.getFullYear()}`
}

function generateDataKey(cols) {
    const columns = []
    cols.forEach(item => {
        columns.push({
            title: item[0].toUpperCase() + item.substring(1),
            dataKey: item
        })
    });
    return columns
}

function generateTable(cols, data) {
    var columns = []
    const rows = []
    var check_no = 0
    columns = generateDataKey(cols)
    cols.forEach(type => {
        var check_no = 0
        data.forEach((item, i) => {
            if (check_no >= rows.length) {
                var temp = {}
                cols.forEach(tempType => {
                    temp[tempType] = ''
                });
                rows.push(temp)
            }
            if (item.type === type) {
                rows[check_no][item.type] = item.description
                check_no++
            }
        });
    });
    return {
        columns: columns,
        rows: rows,
        options: defaultOptions()
    }
}
//doc.save(`tes.pdf`);
function defaultOptions() {
    return {
        theme: 'plain',
        styles: {
            lineColor: 51,
            lineWidth: 1,
        },
        headStyles: {
            lineColor: 51,
            lineWidth: 1,
            fontStyle: 'bold',
            fillColor: 230,
            textColor: 51,
        },
        margin: {
            top: 75
        }
    }
}
</script>