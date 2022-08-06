<?php if ($withSidebar): ?>
</div>
<?php endif ?>
</main>
<script src="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<script src="<?= base_url('assets/vendors/apexcharts/apexcharts.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/ui-apexchart.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/dashboard.js') ?>"></script>

<script src="<?= base_url('assets/js/main.js') ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url('assets/js/custom.js') ?>" type="text/javascript"></script>
<script>
function tes2() {
    html2canvas($('.page-content')[0]).then(function(canvas) {
        var imgData = canvas.toDataURL('image/png');
        const {
            jsPDF
        } = window.jspdf
        const pdf = new jsPDF({
            orientation: "landscape",
            unit: 'mm',
            format: 'a4',
            putOnlyUsedFonts: true,
            floatPrecision: 16
        });
        var width = pdf.internal.pageSize.getWidth();
        var height = pdf.internal.pageSize.getHeight();
        console.log(width, height)
        pdf.text('LAPORAN HASIL SURVEI', width / 2, 50);
        pdf.addImage(imgData, 'PNG', 5, 50, width - 10, height - 100);
        pdf.save('sample-file.pdf');
    });
}

function tes() {
    const {
        jsPDF
    } = window.jspdf
    const pdf = new jsPDF({
        orientation: "landscape"
    });
    var dataURL = radialGradient.dataURI().then(({
        imgURI,
        blob
    }) => {
        pdf.addImage(imgURI, 'PNG', 0, 0);
    })
    var save = dataURL.then(() => {
        bar.dataURI().then(({
            imgURI,
            blob
        }) => {
            pdf.addImage(imgURI, 'PNG', 100, 100);
            pdf.save('yosh.pdf');
        })
    })
}
</script>


<script>
// Default export is a4 paper, portrait, using millimeters for units
</script>
</body>

</html>