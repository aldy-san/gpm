<div class="page-heading">
    <h3>Hasil Survei</h3>
</div>
<div class="page-content">
    <?php if (count($period) > 0 || in_array($this->uri->segment(2),['alumni', 'mitra', 'pengguna'])): ?>
    <div class="d-flex justify-content-between align-items-end ">
        <div class="d-flex flex-column">
            <h5 id="total">Responden: . orang</h5>
            <?php if (!in_array($this->uri->segment(2),['alumni', 'mitra', 'pengguna'])): ?>
            <a href="<?= current_url().'/responden'; ?>" class="mb-2">Lihat responden</a>
            <?php endif; ?>
            <div class="custom-control custom-checkbox me-2">
                <input id="check-all" type="checkbox" class="form-check-input form-check-primary form-check-glow"
                    name="check-all" checked onclick="checkHandlerAll()">
                <label for="check all">Pilih semua</label>
            </div>
        </div>
        <div class="d-flex">
            <div class="form-group me-2 mb-0 mt-auto">
                <label for="question">Tanggal</label>
                <input class="form-control" name="dates" type="text">
            </div>
            <?php if (!in_array($this->uri->segment(2),['alumni', 'mitra', 'pengguna'])): ?>
            <div class="d-flex flex-column ms-auto me-2">
                <div class="btn-group dropdown ms-auto ">
                    <button type="button" class="btn btn-outline-info">Prodi</button>
                    <button id="prodi-title" type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <span class="sr-only">Semua</span>
                    </button>
                    <div class="dropdown-menu mt-2 shadow-sm">
                        <button class="dropdown-item"
                            onclick="executeGraphic(0,0,'-',true,'','','Semua', true)">Semua</button>
                        <?php foreach($prodi as $p): ?>
                        <button class="dropdown-item"
                            onclick="executeGraphic(<?= '0,0,\'-\''; ?>,true,<?= $p['id_jenjang'].',',$p['kode_prodi'].',\''.$p['nama_jenjang'].' '.$p['nama_prodi'].'\''; ?>)"><?= $p['nama_jenjang'].' '.$p['nama_prodi']; ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="btn-group dropdown mt-2">
                    <button type="button" class="btn btn-outline-primary">Periode</button>
                    <button id="period-title" type="button"
                        class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <span class="sr-only"></span>
                    </button>
                    <div class="dropdown-menu mt-2 shadow-sm">
                        <!--<button class="dropdown-item" onclick="executeGraphic(0,1,'tes',true)">tes</button>-->
                        <?php foreach($period as $p): ?>
                        <button class="dropdown-item"
                            onclick="executeGraphic(<?= $p['period_from'].','.$p['period_to'].',\''.$p['name'].'\''; ?>,true)"><?= $p['name']; ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="d-flex flex-column">
                <small id="loadExport" class="ms-2 mt-auto"></small>
                <button id="btn-export" onclick="exportHandler()"
                    class="btn btn-success d-flex align-items-center mt-auto">
                    <i class="bi bi-save me-2"></i>
                    <div class="spinner-border spinner-border-sm me-2 d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <b>Exports</b>
                </button>
            </div>

        </div>
    </div>
    <?php if (count($population) > 0): ?>
    <section class="row mt-3">
        <h4>Populasi Data</h4>
        <?php foreach ($population as $index=>$p): ?>
        <div id="result-population-<?= $index; ?>" class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header d-flex">
                    <div class="custom-control custom-checkbox me-2">
                        <input type="checkbox" class="form-check-input form-check-primary form-check-glow"
                            name="result-population-<?= $index; ?>" id="survei-activation" checked
                            onclick="checkHandler('dataPopulation','#result-population-<?= $index; ?>')">
                    </div>
                    <h4 class="text-capitalize"><?= $titles[$index]; ?></h4>
                </div>
                <div class="card-body">
                    <div id="chart-population-<?=$index; ?>"></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
    <?php endif; ?>
    <?php if (count($survei) > 0): ?>
    <section class="row mt-3">
        <h4>Survei Data</h4>
        <?php foreach ($survei as $index => $s): ?>
        <div id="result-<?= $index; ?>" class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header d-flex">
                    <div class="custom-control custom-checkbox me-2">
                        <input type="checkbox" class="form-check-input form-check-primary form-check-glow"
                            name="result-<?= $index; ?>" id="survei-activation" checked
                            onclick="checkHandler('dataSurvei','#result-<?= $index; ?>')">
                    </div>
                    <h4><?= $s['question']; ?> </h4>
                </div>
                <div class="card-body">
                    <?php if ($s['type'] !== 'description'): ?>
                    <div id="chart-<?=$s['id']; ?>"></div>
                    <div class="d-flex flex-column" style="color:white;">
                        <h6 class="<?= $s['type'] === 'selection' ? 'text-white': ''?>">
                            Rata-rata: <b id="avg-<?=$s['id']; ?>"></b>
                        </h6>
                        <h6 class="<?= $s['type'] === 'selection' ? 'text-white': ''?>">
                            Kesimpulan:
                            <b id="sum-<?=$s['id']; ?>"></b>
                        </h6>
                    </div>
                    <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-<?= $s['id']; ?>"></tbody>
                    </table>
                    <a href="<?= base_url('detail/'.$s['id']); ?>" class="d-block ms-auto text-end mb-2">Lihat
                        Lebih Lengkap</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
    <?php endif; ?>
    <?php else: ?>
    <div class="d-flex flex-column align-items-center w-full mt-4">
        <object data="<?= base_url('assets/svg/no-data.svg'); ?>" width="250" height="250"> </object>
        <h4 class="mt-4 text-center">Tidak Ada Periode</h4>
    </div>
    <?php endif; ?>

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
    executeGraphic(s, e, 'Kustom', true)
});
var selectedExport = {
    dataPopulation: [],
    dataSurvei: [],
};
var dataSurvei = <?= json_encode($survei); ?>;
var dataPopulation = <?= json_encode($population); ?>;
var dataLabels = <?= json_encode($labels); ?>;
var period = <?= json_encode($period); ?>;
var role = '<?= $this->uri->segment(2); ?>'
var id_category = '<?= $this->uri->segment(3); ?>'
var allExportData = []

// state
var fromState = 0
var toState = 0
var nameState = "-"
dataPopulation.forEach((item, index) => {
    selectedExport.dataPopulation.push('#result-population-' + index);
})
dataSurvei.forEach((item, index) => {
    selectedExport.dataSurvei.push('#result-' + index);
})

function checkHandlerAll() {
    if (selectedExport.dataPopulation.length && selectedExport.dataSurvei.length) {
        selectedExport.dataPopulation = []
        selectedExport.dataSurvei = []
        $('input[name^="result-"]').prop('checked', false);
    } else {
        selectedExport.dataPopulation = []
        selectedExport.dataSurvei = []
        $('input[name^="result-"]').prop('checked', true);
        dataPopulation.forEach((item, index) => {
            selectedExport.dataPopulation.push('#result-population-' + index);
        })
        dataSurvei.forEach((item, index) => {
            selectedExport.dataSurvei.push('#result-' + index);
        })
    }
    checkExport()
}

function checkHandler(name, id) {
    if (selectedExport[name].includes(id)) {
        var index = selectedExport[name].indexOf(id);
        if (index !== -1) {
            selectedExport[name].splice(index, 1);
        }
    } else {
        selectedExport[name].push(id);
    }
    selectedExport[name].sort(function(x, y) {
        var xp = Number(x.split('-')[1]);
        var yp = Number(y.split('-')[1]);
        return xp == yp ? 0 : xp < yp ? -1 : 1
    })
    checkExport()
}

function checkExport() {
    if (!selectedExport.dataPopulation.length && !selectedExport.dataSurvei.length) {
        $('#btn-export').prop('disabled', true)
    } else {
        $('#btn-export').prop('disabled', false)
    }
}

function executeGraphic(from, to, name, isUpdate = false, jenjang = false, prodi = false, jp = false, allProdi =
    false) {
    if (!jenjang && !prodi) {
        if (!allProdi) {
            fromState = from
            toState = to
            nameState = name
        }
        $("#prodi-title > span").text("Semua")
    } else {
        $("#prodi-title > span").text(jp)
    }
    let filter = (fromState) ? '?from=' + fromState : ''
    filter += (toState) ? '&to=' + toState : ''
    filter += '&role=<?= $this->uri->segment(2); ?>'
    filter += (jenjang) ? '&jenjang=' + jenjang : ''
    filter += (prodi) ? '&prodi=' + prodi : ''
    $.get('<?=base_url('api/getTotalData/')?>' + id_category + filter, (res) => {
        var temp = JSON.parse(res)
        $("#total").text(`Responden: ${temp[0].total} orang`)
    })
    $("#period-title > span").text(nameState)
    // console.log(id_category)
    dataPopulation.forEach((item, index) => {
        $.get('<?=base_url('api/getChartDataByGroupBy/')?>' + item + (id_category ? `/${id_category}` : '') +
            filter, async (
                res) => {
                var temp = JSON.parse(res)
                //console.log('===', temp)
                //temp.shift()
                var options = {
                    series: [1],
                    labels: ['No Data'],
                    colors: ['#000'],
                    chart: {
                        height: 200,
                        type: "pie",
                    },
                    stroke: {
                        width: 0
                    },
                    dataLabels: {
                        enable: false
                    }
                };
                var labels = temp.map(item => item.grouped ? item.grouped : 'No Data')
                var totals = []
                $.get('<?=base_url('api/getTable/')?>' + dataLabels[index], (res2) => {
                    var temp2 = JSON.parse(res2)
                    temp2 = temp2.filter(item2 => item2.kode_prodi !== '1')
                    temp2.forEach(item2 => {
                        //console.log(item2.kode_prodi)
                        let check = temp.filter(item3 => {
                            return item3.grouped === item2[Object.keys(item2)[
                                0]]
                        })
                        if (check.length > 0) {
                            totals.push(check[0].total)
                        } else {
                            totals.push(0)
                        }
                    })
                    labels = temp2.map(item => item['nama_' + dataLabels[index]])
                    //console.log(temp)
                    //console.log(totals)
                }).catch(err => {
                    //console.log('no table')
                }).always(() => {
                    if (temp.length > 0) {
                        options = {
                            series: totals.length > 0 ? totals.map(item => Number(item)) :
                                temp.map(item => Number(item.total)),
                            chart: {
                                height: 200,
                                type: "pie",
                            },
                            colors: ['#1abc9c', '#3498db', '#2ecc71', '#9b59b6', '#f1c40f',
                                '#e67e22', '#bdc3c7', '#e74c3c', '#34495e'
                            ],
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
                        };
                    }
                    options.chart.id = "chart-population-" + index
                    if (isUpdate) {
                        //console.log('update', options, temp)
                        ApexCharts.exec("chart-population-" + index, 'updateOptions', options,
                            false, true);
                    } else {
                        var el = document.querySelector("#chart-population-" + index)
                        var chart = new ApexCharts(el, options);
                        chart.render();
                    }
                })
            })
    })
    dataSurvei.forEach((item) => {
        // manipulate data to chart
        if (item.type !== 'description') {
            $.get('<?=base_url('api/getChartDataByIdSurvei/')?>' + item.id + filter, (
                res2) => {
                var temp = JSON.parse(res2)
                var sum = 0
                var total = 0
                let selections = item.selections.split(';')
                if (item.type === 'bar') {
                    // selections = ['0-20', '21-40', '61-80', '81-100', '41-60']
                    selections = ['0-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71-80',
                        '81-90', '91-100'
                    ]
                }
                let series = selections.map(selection => {
                    var obj = temp.find(item2 => item2.answer === selection)
                    sum += Number(obj?.sum || 0)
                    total += Number(obj?.total || 0)
                    return Number(obj?.total) || 0
                })
                //console.log('avg:', sum / total)
                //console.log(sum, total)
                var avg = (sum / total).toFixed(1)
                var summary = ''
                //console.log(temp)
                if (temp.length) {
                    $(`#avg-${item.id}`).text(avg)
                    if (avg >= 0 && avg < 25) {
                        summary = 'Tidak ' + temp[0].klasifikasi
                    } else if (avg >= 25 && avg < 50) {
                        summary = 'Kurang ' + temp[0].klasifikasi
                    } else if (avg >= 50 && avg < 75) {
                        summary = '' + temp[0].klasifikasi
                    } else {
                        summary = 'Sangat ' + temp[0].klasifikasi
                    }
                } else {
                    summary = 'Belum ada data'
                    $(`#avg-${item.id}`).text('Belum ada data')
                }
                $(`#sum-${item.id}`).text(summary)
                var options = {
                    series: [1],
                    labels: ['No Data'],
                    colors: ['#000'],
                    chart: {
                        height: 200,
                        type: "pie",
                    },
                    stroke: {
                        width: 0
                    },
                };
                //console.log(temp.length, series)
                if (temp.length > 0) {
                    if (item.chart === 'pie') {
                        options = {
                            series: series,
                            chart: {
                                height: 200,
                                type: "pie",
                            },
                            colors: ['#1abc9c', '#3498db', '#2ecc71', '#9b59b6', '#f1c40f',
                                '#e67e22', '#bdc3c7', '#e74c3c', '#34495e'
                            ],
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
                                height: 188,
                                type: 'bar'
                            },
                            colors: undefined,
                            series: [{
                                data: barSeries
                            }],
                            labels: selections
                        }
                    }
                }
                options.chart.id = "chart-" + item.id
                if (isUpdate) {
                    //console.log(options)
                    ApexCharts.exec("chart-" + item.id, 'updateOptions', options,
                        false, true);
                } else {
                    var el = document.querySelector("#chart-" + item.id)
                    var chart = new ApexCharts(el, options);
                    chart.render();
                }
            });
        } else {
            $.get('<?=base_url('api/getListDataByIdSurvei/')?>' + item.id + filter, (res2) => {
                var temp = JSON.parse(res2);
                var inner = ''
                //console.log(temp)
                temp.forEach(item2 => {
                    inner += '<tr>'
                    inner += '<td>' + item2.answer + '</td>'
                    inner += '</tr>'
                })
                $('#tbody-' + item.id).html("")
                $('#tbody-' + item.id).html(inner)
            })
        }
    })
}

function getDataUri(selected, index = 0) {
    if (index > selected.length - 1) {
        return
    }
    html2canvas($(selected[index])[0]).then(res => {
        allExportData.push(res.toDataURL('image-' + index + '/png'))
        getDataUri(selected, index + 1)
    }).finally(() => {
        $('#loadExport').text(`${index+1}/${selected.length}`)
        if (index > selected.length - 2) {
            $('#loadExport').text(``)
            getPdf()
            return
        }
    })
}

function getPdf() {
    //console.log(allExportData)
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
    let idx = 0
    allExportData.forEach((item, index) => {
        var imgData = item;
        var height = pdf.internal.pageSize.getHeight();
        var width = pdf.internal.pageSize.getWidth();
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
        if ((((idx + 1) % 4 === 1) && (idx !== 0)) || index === selectedExport.dataPopulation
            .length) {
            pdf.addPage()
        }
        idx += 1;
        if (index + 1 === selectedExport.dataPopulation.length) {
            idx = 0
        }
        pdf.addImage(imgData, 'PNG', x, y, 155, 90);
    })
    pdf.save('Hasil Survei.pdf')
    $('#btn-export .bi-save').toggleClass('d-none')
    $('#btn-export .spinner-border').toggleClass('d-none')
}
async function exportHandler() {
    $('#btn-export .bi-save').toggleClass('d-none')
    $('#btn-export .spinner-border').toggleClass('d-none')

    allExportData = []

    getDataUri(selectedExport.dataPopulation.concat(selectedExport.dataSurvei))
}
//executeGraphic('0', '1', 'tes')
//console.log(period[0])
const noPeriod = ['mitra', 'alumni', 'pengguna']
if (noPeriod.includes(role)) {
    executeGraphic(1, null, role)
} else {
    executeGraphic(period[0]['period_from'], period[0]['period_to'], period[0]['name'])
}
</script>