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
$.get('<?=base_url('api/getDataSurvei/'.$this->uri->segment(3))?>', (res) => {
    var dataSurvei = JSON.parse(res);
    dataSurvei.forEach((item) => {
        $.get('<?=base_url('api/getChartDataByIdSurvei/')?>' + item.id, (res2) => {
            var temp = JSON.parse(res2)
            let selections = item.selections.split(',')
            let series = selections.map(selection => {
                var obj = temp.find(item2 => item2.answer === selection)
                return Number(obj?.total) || 0
            })
            var options = {
                series: [1],
                labels: ['No Data'],
                colors: ['#f0f0f0'],
                chart: {
                    width: 350,
                    type: "pie",
                },
                stroke: {
                    width: 0
                },
                dataLabels: {
                    enable: false
                }
            };
            if (temp.length > 0) {
                if (item.chart === 'pie') {
                    options = {
                        series: series,
                        chart: {
                            height: 350,
                            type: "pie",
                        },
                        labels: selections,
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
                } else if (item.chart === 'bar') {
                    let barSeries = selections.map(selection => {
                        var obj = temp.find(item2 => item2.answer === selection)
                        if (obj) {
                            return {
                                x: selection,
                                y: obj.total
                            }
                        } else {
                            return {
                                x: selection,
                                y: 0
                            }
                        }
                    })
                    options = {
                        chart: {
                            height: 338,
                            type: 'bar'
                        },
                        series: [{
                            data: barSeries
                        }]
                    }
                }
            }
            console.log(item.type)
            var chart = new ApexCharts(document.querySelector("#chart-" + item.id),
                options);
            chart.render();
        });
    })
    console.log(dataChart)
});
</script>