<?php if ($withSidebar): ?>
</div>
<?php endif ?>
</main>
<script src="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<script src="<?= base_url('assets/vendors/apexcharts/apexcharts.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/ui-apexchart.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/dashboard.js') ?>"></script>

<script src="<?= base_url('assets/js/custom.js') ?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>
<script>
var radialGradientOptions = {
    series: [<?= $this_user['id']; ?>],
    chart: {
        height: 370,
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
var radialGradient = new ApexCharts(
    document.querySelector("#tes"),
    radialGradientOptions
);
radialGradient.render();
</script>
<script>
var barOptions = {
    series: [{
            name: "S1 Teknik Informatika",
            data: [44, 55, 57, 44],
        },
        {
            name: "S1 Teknik Elektro",
            data: [76, 85, 101, 66],
        },
        {
            name: "Free Cash Flow",
            data: [35, 41, 36, 70],
        },
    ],
    chart: {
        type: "bar",
        height: 335,
    },
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
        categories: ["Q1", "Q2", 'Q3', 'Q4'],
    },
    yaxis: {
        title: {
            text: "$ (thousands)",
        },
    },
    fill: {
        opacity: 1,
    },
    tooltip: {
        y: {
            formatter: function(val) {
                return "$ " + val + " thousands";
            },
        },
    },
};
var bar = new ApexCharts(document.querySelector("#tes-bar"), barOptions);
bar.render();
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>