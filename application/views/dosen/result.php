<div class="page-heading">
    <h3>Hasil Survei</h3>
</div>
<div class="page-content">
    <div class="d-flex justify-content-end">
        <div class="btn-group dropdown me-2">
            <button type="button" class="btn btn-outline-primary">Periode</button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                <span class="sr-only">GASAL 2021/2022 - 3</span>
            </button>
            <div class="dropdown-menu mt-2 shadow-sm">
                <a class="dropdown-item" href="#">Option 1</a>
                <a class="dropdown-item active" href="#">Option 2</a>
                <a class="dropdown-item" href="#">Option 3</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </div>
        <button class="btn btn-success d-flex align-items-center">
            <i class="bi bi-save me-2"></i>
            <b>Export</b>
        </button>
    </div>
    <section class="row mt-3">
        <?php foreach ($survei as $s): ?>
        <div id="result-<?= $s['id']; ?>" class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4><?= $s['question']; ?></h4>
                </div>
                <div class="card-body">
                    <div id="chart-<?=$s['id']; ?>"></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
</div>
<script type="text/javascript">
var dataSurvei = []
var dataChart = []
$.get('<?=base_url('api/getDataSurvei/mahasiswa')?>', function(res) {
    var dataSurvei = JSON.parse(res);
    dataSurvei.forEach(function(item) {
        console.log(item);
        $.get('<?=base_url('api/getChartDataByIdSurvei/')?>' + item.id, function(res2) {
            var temp = JSON.parse(res2)
            const sum = temp.reduce((accumulator, object) => {
                return accumulator + object.total;
            }, 0);
            if (temp.length > 0) {
                var options = {
                    series: temp.map(item => {
                        return (item.total / sum) * 100
                    }),
                    chart: {
                        width: 380,
                        type: "pie",
                    },
                    labels: temp.map(item => item.answer),
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: "bottom",
                            },
                        },
                    }, ],
                };
                var pie = new ApexCharts(document.querySelector("#chart-" + item.id), options);
                pie.render();
            }
        });
    })
    console.log(dataChart)
});
</script>