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
        <button id="btn-export" onclick="exportHandler()" class="btn btn-success d-flex align-items-center">
            <i class="bi bi-save me-2"></i>
            <div class="spinner-border spinner-border-sm me-2 d-none" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <b>Export</b>
        </button>
    </div>
    <section class="row mt-3">
        <h4>Populasi Data</h4>
        <?php foreach ($population as $index=>$p): ?>
        <div id="result-population-<?= $index; ?>" class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4><?= $p; ?></h4>
                </div>
                <div class="card-body">
                    <div id="chart-population-<?=$index; ?>"></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
    <section class="row mt-3">
        <h4>Survei Data</h4>
        <?php foreach ($survei as $s): ?>
        <div id="result-<?= $s['id']; ?>" class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4><?= $s['question']; ?></h4>
                </div>
                <div class="card-body">
                    <?php if ($s['type'] !== 'description'): ?>
                    <div id="chart-<?=$s['id']; ?>"></div>
                    <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-<?= $s['id']; ?>"></tbody>
                    </table>
                    <a href="<?= base_url('dosen/detail/'.$s['id']); ?>" class="d-block ms-auto text-end mb-2">Lihat
                        Lebih Lengkap</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
</div>
<script type="text/javascript">
var dataSurvei = <?= json_encode($survei); ?>;
var dataPopulation = <?= json_encode($population); ?>;

dataPopulation.forEach((item, index) => {
    $.get('<?=base_url('api/getChartDataByGroupBy/')?>' + item, (res) => {
        var temp = JSON.parse(res)
        console.log(temp);
        var options = {
            series: [1],
            labels: ['No Data'],
            colors: ['#f3f3f3'],
            chart: {
                height: 250,
                type: "pie",
            },
            stroke: {
                width: 0
            },
            dataLabels: {
                enable: false
            }
        };
        console.log(temp.map(item => item.total))
        console.log(temp.map(item => item.grouped))
        if (temp.length > 0) {
            options = {
                series: temp.map(item => Number(item.total)),
                chart: {
                    height: 250,
                    type: "pie",
                },
                labels: temp.map(item => item.grouped),
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
        }
        var chart = new ApexCharts(document.querySelector("#chart-population-" + index),
            options);
        chart.render();
    })
})
dataSurvei.forEach((item) => {
    // manipulate data to chart
    if (item.type !== 'description') {
        $.get('<?=base_url('api/getChartDataByIdSurvei/')?>' + item.id, (res2) => {
            var temp = JSON.parse(res2)
            let selections = item.selections.split(',')
            if (item.type === 'bar') {
                selections = ['0-20', '21-40', '41-60', '61-80', '81-100']
            }
            let series = selections.map(selection => {
                var obj = temp.find(item2 => item2.answer === selection)
                return Number(obj?.total) || 0
            })
            var options = {
                series: [1],
                labels: ['No Data'],
                colors: ['#f3f3f3'],
                chart: {
                    height: 250,
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
                            height: 250,
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
                            height: 238,
                            type: 'bar'
                        },
                        series: [{
                            data: barSeries
                        }]
                    }
                }
            }
            var chart = new ApexCharts(document.querySelector("#chart-" + item.id),
                options);
            chart.render();
        });
    } else {
        $.get('<?=base_url('api/getListDataByIdSurvei/')?>' + item.id, (res2) => {
            var temp = JSON.parse(res2);
            var inner = ''
            temp.forEach(item2 => {
                inner += '<tr>'
                inner += '<td>' + item2.username + '</td>'
                inner += '<td>' + item2.answer + '</td>'
                inner += '</tr>'
            })
            $('#tbody-' + item.id).html(inner)
        })
    }

    // add to js pdf

})

async function exportHandler() {
    console.log('hai')
    $('#btn-export .bi-save').toggleClass('d-none')
    $('#btn-export .spinner-border').toggleClass('d-none')
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
    const promises = []
    dataSurvei.forEach((item, index) => {
        promises.push(html2canvas($('#result-' + item.id)[0]))
    })
    await Promise.all(promises).then(res => {
            dataSurvei.forEach((item, index) => {
                var imgData = res[index].toDataURL('image-' + item.id + '/png');
                var width = pdf.internal.pageSize.getWidth();
                var height = pdf.internal.pageSize.getHeight();
                console.log(width, height)
                var x = 0,
                    y = 0;
                if ((index + 1) % 4 === 2) {
                    x = width / 2
                } else if ((index + 1) % 4 === 3) {
                    y = height / 2
                } else if ((index + 1) % 4 === 0) {
                    x = width / 2
                    y = height / 2
                }
                if (((index + 1) % 4 === 1) && (index !== 0)) {
                    pdf.addPage()
                }
                console.log('==>', item, x, y)
                pdf.addImage(imgData, 'PNG', x, y, width / 2, height / 2);
            })
        })
        .finally(() => {
            pdf.save('test.pdf')
            $('#btn-export .bi-save').toggleClass('d-none')
            $('#btn-export .spinner-border').toggleClass('d-none')
        })
}
</script>