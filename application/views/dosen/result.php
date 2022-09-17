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
                <?php foreach($period as $p): ?>
                <a class="dropdown-item" href="#"><?= $p['name']; ?></a>
                <?php endforeach; ?>
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
var dataLabels = <?= json_encode($labels); ?>;

async function getTable(label) {
    await $.get('<?=base_url('api/getTable/')?>' + label, (res2) => {
        var temp2 = JSON.parse(res2)
        console.log('>', temp2.map(item => item['nama_' + label]))
        return temp2.map(item => item['nama_' + label])
    })
}
dataPopulation.forEach((item, index) => {
    $.get('<?=base_url('api/getChartDataByGroupBy/')?>' + item, async (res) => {
        var temp = JSON.parse(res)
        temp.shift()
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
        //console.log(temp)
        var labels = temp.map(item => item.grouped)
        var totals = []
        $.get('<?=base_url('api/getTable/')?>' + dataLabels[index], (res2) => {
            var temp2 = JSON.parse(res2)
            temp2.forEach(item2 => {
                //console.log('item', item2)
                //console.log('temp', item2[Object.keys(
                //    item2)[0]])
                let check = temp.filter(item3 => {
                    return item3.grouped === item2[Object.keys(item2)[0]]
                })
                console.log(check)
                if (check.length > 0) {
                    totals.push(check[0].total)
                } else {
                    totals.push(0)
                }
            })
            console.log(totals)
            labels = temp2.map(item => item['nama_' + dataLabels[index]])
        }).catch(err => {
            //console.log('no table')
        }).always(() => {
            if (temp.length > 0) {
                options = {
                    series: temp.map(item => Number(item.total)),
                    chart: {
                        height: 250,
                        type: "pie",
                    },
                    colors: ['#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#f1c40f',
                        '#e67e22', '#bdc3c7', '#e74c3c', '#34495e'
                    ],
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
                };
            }
            var chart = new ApexCharts(document.querySelector("#chart-population-" + index),
                options);
            chart.render();
        })
        //if (dataLabels[index]) {
        //    await getTable(dataLabels[index]).then(res2 => {
        //        console.log(res2)
        //    })
        //}

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

})

async function exportHandler() {
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
    dataPopulation.forEach((item, index) => {
        promises.push(html2canvas($('#result-population-' + index)[0]))
    })
    dataSurvei.forEach((item, index) => {
        promises.push(html2canvas($('#result-' + item.id)[0]))
    })
    console.log(promises)
    await Promise.all(promises).then(res => {
            let idx = 0
            dataPopulation.concat(dataSurvei).forEach((item, index) => {
                var imgData = res[index].toDataURL('image-' + item.id + '/png');
                var width = pdf.internal.pageSize.getWidth();
                var height = pdf.internal.pageSize.getHeight();
                var x = 0,
                    y = 0;
                if ((idx + 1) % 4 === 2) {
                    x = width / 2
                } else if ((idx + 1) % 4 === 3) {
                    y = height / 2
                } else if ((idx + 1) % 4 === 0) {
                    x = width / 2
                    y = height / 2
                }
                if ((((idx + 1) % 4 === 1) && (idx !== 0)) || index === dataPopulation.length) {
                    pdf.addPage()
                }
                idx += 1;
                if (index + 1 === dataPopulation.length) {
                    console.log(index)
                    idx = 0
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