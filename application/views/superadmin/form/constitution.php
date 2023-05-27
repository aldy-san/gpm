<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= $title; ?></h3>
            </div>
        </div>
    </div>
    <section class="section mt-4">
        <div class="card">
            <div class="card-body">
                <?= form_open_multipart($data_slug ? base_url('manage-constitution/edit/'.$data_slug['id']) : base_url('manage-constitution/create'),array('onkeydown' => "return event.key != 'Enter';")) ?>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="name">Nama Dokumen</label>
                        <input type="text" class="form-control <?= form_error('name') ? 'is-invalid': ''; ?>"
                            name="name" id="name" placeholder="Nama Dokumen" autocomplete="off"
                            value="<?= $data_slug ?  (set_value('name') ?  set_value('name') : $data_slug['name']) : set_value('name'); ?>"
                            <?= $is_edit? '' : 'disabled'; ?>>
                        <div class="invalid-feedback">
                            <?= form_error('name'); ?>
                        </div>
                    </div>
                    <div class="form-group col-2">
                        <label for="type">Tipe</label>
                        <fieldset>
                            <select class="form-select <?= form_error('type') ? 'is-invalid': ''; ?>" name="type"
                                <?= $is_edit? '' : 'disabled'; ?>>

                                <option value="url">URL</option>
                                <option value="file">Upload File</option>
                            </select>
                        </fieldset>
                        <div class="invalid-feedback">
                            <?= form_error('type'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="url">Link URL</label>
                        <input type="text" class="form-control <?= form_error('url') ? 'is-invalid': ''; ?>" name="url"
                            id="url" placeholder="Link URL" autocomplete="off"
                            value="<?= $data_slug ?  (set_value('url') ?  set_value('url') : $data_slug['url']) : set_value('url'); ?>"
                            <?= $title === 'Detail Survei Mahasiswa'? 'disabled' : ''; ?>
                            <?= $is_edit ? '' : 'disabled'; ?>>
                        <div class="invalid-feedback">
                            <?= form_error('url'); ?>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="sertifikat">File</label>
                        <input id="sertifikat" type="file" name="sertifikat" class="basic-filepond"
                            <?= $is_edit ? '' : 'disabled'; ?>>
                    </div>
                </div>
                <?php if($is_edit) :?>
                <button type="button" class="ms-1 btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#confirmModal">
                    Simpan
                </button>
                <div class="modal fade text-left" id="confirmModal" tabindex="-1" role="dialog"
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
                                    Apakah anda yakin ingin menyimpan data?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($data_slug && $data_slug['files']) :?>
                <a href="<?= base_url('/sertifikat/'.$data_slug['files']); ?>" class="ms-1 btn btn-success">Lihat
                    File Saat Ini</a>
                <?php endif; ?>
                <?= form_close(); ?>
            </div>
        </div>
    </section>
</div>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
FilePond.registerPlugin(
    // validates the size of the file...
    FilePondPluginFileValidateSize,
    // validates the file type...
    FilePondPluginFileValidateType,
);
// Filepond: Basic
const pond = FilePond.create(document.querySelector('.basic-filepond'), {
    allowFileEncode: false,
    required: false,
    storeAsFile: true,
    acceptedFileTypes: ['application/pdf'],
    allowFileSizeValidation: true,
    labelFileTypeNotAllowed: 'Jenis file tidak valid',
    fileValidateTypeLabelExpectedTypes: 'File harus bertipe PDF}',
    maxFileSize: '10MB',
    labelMaxFileSizeExceeded: 'Ukuran file berlalu besar',
    labelMaxFileSize: 'Ukuran File Maksimal {filesize}',
    fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
        resolve(type);
    })
});

$('.basic-filepond').on('FilePond:addfile', function(e) {
    console.log(pond.getFile().filename)
});
</script>