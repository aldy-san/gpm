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
                <form action="<?= base_url('/manage-period/analisis/'.$this->uri->segment(3)); ?>" method="POST">
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
    </section>
</div>