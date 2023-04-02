<div class="page-heading">
    <h3>Beranda</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-4">
            <div class="card" style="height:100%;">
                <div class="card-header">
                    <h3>Capaian Pembelajaran</h3>
                </div>
                <div class="card-body">
                    <div id="gauge"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card" style="height:100%">
                <div class="card-header">
                    <h3>Capaian Pembelajaran Program Studi <small class="text-muted">/periode</small></h3>
                </div>
                <div class="card-body">
                    <div id="bar"></div>
                </div>
            </div>
        </div>
        <?php foreach ($category as $key => $value) : ?>
        <div class="col-12 col-lg-6 p-4 pb-0">
            <div class="card" style="height:100%">
                <div class="card-header">
                    <h4><?= $value['name']; ?></h4>
                    <h6 class="text-capitalize">Survei <?= $value['role']; ?></h6>
                </div>
                <div class="card-body">
                    <div id="category-<?= $value['id']; ?>"></div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </section>
</div>
<script src="<?= base_url('assets/vendors/apexcharts/apexcharts.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/ui-apexchart.js') ?>"></script>
<script type="text/javascript">
function generateGauge() {
    $.get('<?=base_url('api/getMonev/')?>', (res) => {
        var percent = JSON.parse(res)
        var gaugeOptions = {
            series: [percent[0].avg],
            chart: {
                height: 350,
                type: "radialBar",
                toolbar: {
                    show: true,
                },
            },
            plotOptions: {
                radialBar: {
                    startAngle: -180,
                    endAngle: 180,
                    hollow: {
                        margin: 0,
                        size: "70%",
                        background: "#fff",
                        image: undefined,
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: "front",
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 0,
                            blur: 4,
                            opacity: 0.24,
                        },
                    },
                    track: {
                        background: "#fff",
                        strokeWidth: "67%",
                        margin: 0, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: -3,
                            left: 0,
                            blur: 4,
                            opacity: 0.35,
                        },
                    },

                    dataLabels: {
                        show: true,
                        name: {
                            offsetY: -10,
                            show: true,
                            color: "#888",
                            fontSize: "17px",
                        },
                        value: {
                            formatter: function(val) {
                                return parseInt(val);
                            },
                            color: "#111",
                            fontSize: "36px",
                            show: true,
                        },
                    },
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    shadeIntensity: 0.5,
                    gradientToColors: ["#ABE5A1"],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100],
                },
            },
            stroke: {
                lineCap: "round",
            },
            labels: ["Percent"],
        };
        var gauge = new ApexCharts(document.querySelector("#gauge"), gaugeOptions);
        gauge.render();
    })
}

async function generateMonev() {
    await Promise.all([
            $.get('<?=base_url('api/getMonevProdiPerPeriod')?>'),
            $.get('<?=base_url('api/getProdi')?>')
        ])
        .then(res => {
            const data = JSON.parse(res[0])
            const prodi = JSON.parse(res[1])
            //const from = new Date('01-06-2022')
            let series = data.map(item => {
                return {
                    ...item,
                    yearS: item.year + ' - ' + ((item.quarter == '1' || item.quarter == '2') ? 'Genap' :
                        'Gasal')
                }
            })
            const groupedYearS = series.reduce((group, item) => {
                const {
                    yearS
                } = item;
                group[yearS] = group[yearS] ?? [];
                group[yearS].push(item);
                return group;
            }, {})
            //console.log(groupedYearS)
            const ValidProdi = ['D4 Teknologi Rekayasa Sistem Elektronika',
                'D4 Teknologi Rekayasa Pembangkit Energi', 'S1 Pendidikan Teknik Elektro',
                'S1 Teknik Elektro', 'S1 Pendidikan Teknik Informatika', 'S1 Teknik Informatika',
                'S2 Teknik Elektro', 'S3 Teknik Elektro dan Informatika'
            ] // Update Disini bila ada Prodi baru yang tidak muncul
            //console.log(prodi)
            series = prodi.filter(item => ValidProdi.includes(item.nama_jenjang + ' ' + item.nama_prodi)).map(
                p => {
                    const tempData = []
                    Object.keys(groupedYearS).map(item => {
                        const ps = groupedYearS[item].find(g => g.kode_prodi === p.kode_prodi && g
                            .jenjang === p.id_jenjang)
                        //console.log(ps)
                        if (ps) {
                            tempData.push(Number(ps.avg).toFixed(0))
                        } else {
                            tempData.push(0)
                        }
                    })
                    return {
                        name: p.nama_jenjang + ' ' + p.nama_prodi,
                        data: tempData
                    }
                })
            //console.log(groupedYearS)
            var barOptions = {
                series: series,
                chart: {
                    type: "bar",
                    height: 350,
                },
                colors: ['#1abc9c', '#3498db', '#2ecc71', '#9b59b6', '#f1c40f',
                    '#e67e22', '#bdc3c7', '#e74c3c', '#34495e', '#C51D34', '#4E3B31', '#CFD3CD',
                    '#256D7B', '#A12312'
                ],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "55%",
                        endingShape: "rounded",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                xaxis: {
                    categories: Object.keys(groupedYearS),
                },
                yaxis: {
                    title: {
                        text: "% (percent)",
                    },
                },
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + "%";
                        },
                    },
                },
            };
            var bar = new ApexCharts(document.querySelector("#bar"), barOptions);
            bar.render()
            //console.log(data, prodi)
        })
}
var categories = <?= json_encode($category); ?>;

function generateCategory() {
    var lineOptions = {}
    categories.forEach(item => {
        $.get('<?=base_url('api/getMonevPerPeriod?category=')?>' + item.id, (res) => {
            var periods = JSON.parse(res)
            console.log(periods.map(period => period.avg))
            lineOptions = {
                chart: {
                    type: "line",
                },
                series: [{
                    name: "Capaian",
                    data: ['0'].concat(periods.map(period => Number(period.avg).toFixed(
                        0))),
                }, ],
                xaxis: {
                    categories: [''].concat(periods.map(period => period.name.substr(0, 10))),
                },
            };
            var line = new ApexCharts(document.querySelector("#category-" + item.id), lineOptions);
            line.render();
        }).always(() => {})
    });
}
generateGauge()
generateMonev()
generateCategory()
</script>