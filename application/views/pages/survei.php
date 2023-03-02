<nav class="navbar navbar-light">
    <div class="container d-block">
        <a href="<?= base_url('dashboard'); ?>"><i class="bi bi-chevron-left"></i></a>
        <!-- <a class="navbar-brand ms-4" href="index.html">
            <img src="<?= base_url('assets/images/logo/logo.png'); ?>">
        </a> -->
    </div>
</nav>

<div class=" container">
    <div class="row survei mb-5">
        <div class="col col-lg-8 mx-auto">
            <?php if ($this->session->flashdata('alertForm')): ?>
            <div class="alert alert-danger" role="alert">
                <p class="text-center"><?= $this->session->flashdata('alertForm'); ?></p>
            </div>
            <?php endif ?>
            <div class="page-heading text-center">
                <h2 class="text-capitalize"><?= $notLogged ? $this->uri->segment(1) : $category['name']; ?></h2>
            </div>
            <div class="page-content">
                <section class="bootstrap-select">
                    <form
                        action="<?= base_url($this->uri->segment(1).'/survei/'.(!$notLogged ? $this->uri->segment(3) : '')) ?>"
                        method="POST">
                        <?php
                            foreach($survei as $loop => $value) :
                        ?>
                        <div class="row my-3" data-aos="fade-up" data-aos-duration="1500">
                            <div class="col-12 p-4">
                                <?= form_error('answer'.$value['id'],'<small class="text-danger">','</small>'); ?>
                                <h4 class="mb-4"> <?= $value['question'] ?></h4>
                                <?php
                                    if($value['type'] === 'selection'):
                                        foreach(explode(';',$value['selections']) as $key => $option) :
                                ?>
                                <div class="ms-2 my-2 form-check">
                                    <input class="form-check-input" type="radio" name="answer<?= $value['id'] ?>"
                                        id="answer-<?= $value['id'] ?>-option-<?= $key+1 ?>" value="<?= $option ?>">
                                    <label class="form-check-label text-dark"
                                        for="answer-<?= $value['id'] ?>-option-<?= $key+1 ?>">
                                        <h5><?= $option ?></h5>
                                    </label>
                                </div>
                                <?php
                                        endforeach;
                                    elseif($value['type'] === 'bar') :
                                ?>

                                <div class="col-md-12 d-flex justify-content-between">
                                    <label for="range<?= $bar ?>"
                                        class="form-label text-capitalize"><?= $value['bar_from'] ?></label>
                                    <input type="number" style="margin-left: 2rem !important;"
                                        class="text-center border-0" id="input-range<?= $bar ?>" max="100" value="50">
                                    <label for="range<?= $bar ?>"
                                        class="form-label text-capitalize"><?= $value['bar_to'] ?></label>
                                </div>
                                <div class="col-md-12 ">
                                    <input type="range" class="form-range" min="0" max="<?= $value['bar_length'] ?>"
                                        id="range<?= $bar ?>" name="answer<?= $value['id'] ?>">
                                </div>

                                <?php
                                    $bar++;
                                    elseif($value['type'] === 'description') :
                                ?>
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                        name="answer<?= $value['id'] ?>"
                                        rows="5"><?= set_value('answer'.$value['id']) ?></textarea>
                                    <label>Berikan Jawaban Anda</label>
                                </div>

                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <button class=" btn btn-primary m-auto">Kirim</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
AOS.init({
    once: true,
});
</script>

<script>
for (let x = 1; x <= <?= $bar_count ?>; x++) {
    let slider = document.getElementById("input-range" + x);
    let range = document.getElementById("range" + x);

    slider.oninput = function() {
        range.value = this.value;
    }
    range.oninput = function() {
        slider.value = this.value;
    }
}
</script>