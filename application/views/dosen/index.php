<div class="page-heading">
    <h3>Beranda</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Capaian Pembelajaran</h4>
                </div>
                <div class="card-body">
                    <div id="gauge"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Capaian Pembelajaran Program Studi <small class="text-muted">/periode</small></h4>
                </div>
                <div class="card-body">
                    <div id="bar"></div>
                </div>
            </div>
        </div>
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
                    yearS: item.year + ' - ' + ((item.quarter == '1' || item.quarter == '2') ? 'Gasal' :
                        'Genap')
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
            console.log(groupedYearS)
            series = prodi.map(p => {
                const tempData = []
                Object.keys(groupedYearS).map(item => {
                    const ps = groupedYearS[item].find(g => g.kode_prodi === p.kode_prodi && g
                        .jenjang === p.id_jenjang)
                    console.log(ps)
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
            console.log(series)
            var barOptions = {
                series: series,
                chart: {
                    type: "bar",
                    height: 350,
                },
                colors: ['#1abc9c', '#3498db', '#2ecc71', '#9b59b6', '#f1c40f',
                    '#e67e22', '#bdc3c7', '#e74c3c', '#34495e'
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
            console.log(data, prodi)
        })
}
generateGauge()
generateMonev()
</script>