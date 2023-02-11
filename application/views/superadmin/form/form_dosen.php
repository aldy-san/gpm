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
            <div class="card-body w-75 mx-auto">
                <form
                    action="<?= $data_slug ? base_url('/survei/dosen-terbaik/edit-dosen/'.$data_slug['id']) : base_url('/survei/dosen-terbaik/create'); ?>"
                    method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="question">Nama</label>
                            <input type="text" class="form-control <?= form_error('name') ? 'is-invalid': ''; ?>"
                                name="name" id="name" placeholder="Nama Dosen" autocomplete="off"
                                value="<?= $data_slug ?  (set_value('name') ?  set_value('name') : $data_slug['name']) : set_value('name'); ?>"
                                <?= $is_edit ? '' : 'disabled'; ?>>
                            <div class="invalid-feedback">
                                <?= form_error('name'); ?>
                            </div>
                        </div>
                    </div>
                    <?php if($data_slug) :?>
                    <img src="<?= base_url('assets/images/dosen/'.$data_slug['image']) ?>" alt="" width="250">
                    <?php endif; ?>
                    <?php if($title !== 'Detail Dosen'): ?>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="image">Foto Dosen</label>
                            <input type="file" id="image" name="image" class="basic-filepond">
                        </div>
                    </div>
                    <?php if($is_edit) :?>
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <?php endif; ?>
                    <?php endif ?>
                </form>
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
    required: true,
    storeAsFile: true,
    acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
    allowFileSizeValidation: true,
    labelFileTypeNotAllowed: 'Jenis file tidak valid',
    fileValidateTypeLabelExpectedTypes: 'File harus bertipe PNG,JPG,JPEG}',
    maxFileSize: '3MB',
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
