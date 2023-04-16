<div class="page-heading">
    <h3>Hasil Survei</h3>
</div>
<div class="page-content">
    <div class="d-flex justify-content-between align-items-end ">
        <div class="d-flex flex-column">
            <h5 id="total">Responden: . orang</h5>
        </div>
        <div class="d-flex">
            <div class="form-group me-2 mb-0">
                <label for="question">Tanggal</label>
                <input class="form-control" name="dates" type="text">
            </div>
            <!--<button id="btn-export" onclick="exportHandler()" class="btn btn-success d-flex align-items-center">
                <i class="bi bi-save me-2"></i>
                <div class="spinner-border spinner-border-sm me-2 d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <b>Exports</b>
            </button>-->
        </div>
    </div>
    <section class="row mt-3">
        <h4>Hasil Survei Dosen Terbaik</h4>
        <div id="result-dosen" class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <!--<h4 class="text-capitalize"><?= $titles[$index]; ?></h4>-->
                </div>
                <div class="card-body">
                    <div id="chart-dosen"></div>
                </div>
            </div>
        </div>
        <h4>Hasil Survei Tendik Terbaik</h4>
        <div id="result-tendik" class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <!--<h4 class="text-capitalize"><?= $titles[$index]; ?></h4>-->
                </div>
                <div class="card-body">
                    <div id="chart-tendik"></div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
$('input[name="dates"]').daterangepicker({
    locale: {
        format: 'D MMM, YYYY'
    }
}, (start, end, label) => {
    const s = new Date(start).getTime() / 1000
    const e = new Date(end).getTime() / 1000
    executeGraphic(s, e, true)
    console.log('hai')
});
var list_dosen = <?= json_encode($list_dosen); ?>;
var list_tendik = <?= json_encode($list_tendik); ?>;

function executeGraphic(from, to, isUpdate = false) {
    let filter = (from) ? '?from=' + from : ''
    filter += (to) ? '&to=' + to : ''
    $.get('<?=base_url('api/getTotalDataDosen/')?>' + filter, (res) => {
        var temp = JSON.parse(res)
        if (temp.length) {
            $("#total").text(`Responden: ${temp[0].total} orang`)
        } else {
            $("#total").text(`Responden: 0 orang`)
        }
    })
    $.get('<?=base_url('api/getDataDosen/')?>' + filter, (res) => {
        var temp = JSON.parse(res)
        console.log(temp)
        var options = {
            series: [1],
            labels: ['No Data'],
            colors: ['#000'],
            chart: {
                height: 500,
                type: "pie",
            },
            stroke: {
                width: 0
            },
            dataLabels: {
                enable: false
            }
        };
        options.chart.id = "chart-dosen"
        var labels = list_dosen.map(item => item.nama_lengkap)
        var colors = []
        var series = []
        for (let i = 0; i < list_dosen.length; i++) {
            colors.push('#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0'))
            series.push(0)
        }
        temp.forEach(item => {
            const find = list_dosen.find(dosen => dosen.username === item.id_dosen)
            const index = list_dosen.indexOf(find)
            series[index]++;
        });
        if (temp.length > 0) {
            options = {
                series: series,
                chart: {
                    height: 500,
                    type: "pie",
                },
                colors: colors,
                stroke: {
                    width: 2
                },
                labels: labels,
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
                toolbar: {
                    show: true,
                },
            };
        }
        console.log(options)
        options.chart.id = "chart-dosen"
        if (isUpdate) {
            //console.log('update', options, temp)
            console.log('hai')
            ApexCharts.exec("chart-dosen", 'updateOptions', options,
                false, true);
        } else {
            var el = document.querySelector("#chart-dosen")
            var chart = new ApexCharts(el, options);
            chart.render();
        }
    })
    $.get('<?=base_url('api/getDataTendik/')?>' + filter, (res) => {
        var temp = JSON.parse(res)
        console.log(temp)
        var options = {
            series: [1],
            labels: ['No Data'],
            colors: ['#000'],
            chart: {
                height: 500,
                type: "pie",
            },
            stroke: {
                width: 0
            },
            dataLabels: {
                enable: false
            }
        };
        options.chart.id = "chart-tendik"
        var labels = list_tendik.map(item => item.nama_lengkap)
        var colors = []
        var series = []
        for (let i = 0; i < list_tendik.length; i++) {
            colors.push('#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0'))
            series.push(0)
        }
        temp.forEach(item => {
            const find = list_tendik.find(tendik => tendik.username === item.id_tendik)
            const index = list_tendik.indexOf(find)
            series[index]++;
        });
        if (temp.length > 0) {
            options = {
                series: series,
                chart: {
                    height: 500,
                    type: "pie",
                },
                colors: colors,
                stroke: {
                    width: 2
                },
                labels: labels,
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
                toolbar: {
                    show: true,
                },
            };
        }
        console.log(options)
        options.chart.id = "chart-tendik"
        if (isUpdate) {
            //console.log('update', options, temp)
            console.log('hai')
            ApexCharts.exec("chart-tendik", 'updateOptions', options,
                false, true);
        } else {
            var el = document.querySelector("#chart-tendik")
            var chart = new ApexCharts(el, options);
            chart.render();
        }
    })
}
executeGraphic();
</script>