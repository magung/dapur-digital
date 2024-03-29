@php
    $title = 'Dashboard';
@endphp
@include('template.header')


{{-- Content area... --}}
<div class="container mt-5">
    <h3 class="display-5">
        Welcome {{ auth()->user()->name }}
    </h3>
</div>

<div class="row my-2">
    <div class="col-md-6 py-1">
        <div class="card">
            <div class="card-body">
                <canvas id="chLine"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 py-1">
        <div class="card">
            <div class="card-body">
                <canvas id="chDonut1"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-12 py-1">
        <div class="card">
            <div class="card-body">
                <canvas id="chBar"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row py-2">
    {{-- <div class="col-md-4 py-1">
        <div class="card">
            <div class="card-body">
                <canvas id="chDonut1"></canvas>
            </div>
        </div>
    </div> --}}
    {{-- <div class="col-md-4 py-1">
        <div class="card">
            <div class="card-body">
                <canvas id="chDonut2"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 py-1">
        <div class="card">
            <div class="card-body">
                <canvas id="chDonut3"></canvas>
            </div>
        </div>
    </div> --}}
</div>

@include('template.footer')
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script>
    // chart colors
    var colors = ['#007bff', '#28a745', '#333333', '#c3e6cb', '#dc3545', '#6c757d'];

    /* large line chart */
    var chLine = document.getElementById("chLine");
    var chartData = {
        labels: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
        datasets: [{
                data: [{{$minggu}}, {{$senin}}, {{$selasa}}, {{$rabu}}, {{$kamis}}, {{$jumat}}, {{$sabtu}}],
                backgroundColor: 'transparent',
                borderColor: colors[0],
                borderWidth: 4,
                pointBackgroundColor: colors[0]
            }
            //   {
            //     data: [639, 465, 493, 478, 589, 632, 674],
            //     backgroundColor: colors[3],
            //     borderColor: colors[1],
            //     borderWidth: 4,
            //     pointBackgroundColor: colors[1]
            //   }
        ]
    };
    if (chLine) {
        new Chart(chLine, {
            type: 'line',
            data: chartData,
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: false
                },
                responsive: true
            }
        });
    }

    /* large pie/donut chart */
    var chPie = document.getElementById("chPie");
    if (chPie) {
        new Chart(chPie, {
            type: 'pie',
            data: {
                labels: ['Desktop', 'Phone', 'Tablet', 'Unknown'],
                datasets: [{
                    backgroundColor: [colors[1], colors[0], colors[2], colors[5]],
                    borderWidth: 0,
                    data: [50, 40, 15, 5]
                }]
            },
            plugins: [{
                beforeDraw: function(chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;
                    ctx.restore();
                    var fontSize = (height / 70).toFixed(2);
                    ctx.font = fontSize + "em sans-serif";
                    ctx.textBaseline = "middle";
                    var text = chart.config.data.datasets[0].data[0] + "%",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;
                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }],
            options: {
                layout: {
                    padding: 0
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80
            }
        });
    }

    /* bar chart */
    var chBar = document.getElementById("chBar");
    if (chBar) {
        new Chart(chBar, {
            type: 'bar',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                datasets: [{
                        data: [{{$januari}}, {{$februari}}, {{$maret}}, {{$april}}, {{$mei}}, {{$juni}}, {{$juli}}, {{$agustus}}, {{$sebtember}}, {{$oktober}}, {{$november}}, {{$desember}}],
                        backgroundColor: colors[0]
                    }
                ]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        barPercentage: 0.4,
                        categoryPercentage: 0.5
                    }]
                }
            }
        });
    }

    /* 3 donut charts */
    var donutOptions = {
        cutoutPercentage: 85,
        legend: {
            position: 'bottom',
            padding: 5,
            labels: {
                pointStyle: 'circle',
                usePointStyle: true
            }
        }
    };

    // donut 1
    var chDonutData1 = {
        labels: ['Pending', 'Selesai', 'Menunggu Konfirmasi', 'Diproses', 'Batal / Reject', 'Approved', 'Dikirim'],
        datasets: [{
            backgroundColor: colors.slice(0, 7),
            borderWidth: 0,
            data: [{{$pending}}, {{$selesai}}, {{$menunggu_konfirmasi}}, {{$diproses}}, {{$batal}}, {{$approved}}, {{$dikirim}}]
        }]
    };

    var chDonut1 = document.getElementById("chDonut1");
    if (chDonut1) {
        new Chart(chDonut1, {
            type: 'pie',
            data: chDonutData1,
            options: donutOptions
        });
    }

    // donut 2
    var chDonutData2 = {
        labels: ['Wips', 'Pops', 'Dags'],
        datasets: [{
            backgroundColor: colors.slice(0, 3),
            borderWidth: 0,
            data: [40, 45, 30]
        }]
    };
    var chDonut2 = document.getElementById("chDonut2");
    if (chDonut2) {
        new Chart(chDonut2, {
            type: 'pie',
            data: chDonutData2,
            options: donutOptions
        });
    }

    // donut 3
    var chDonutData3 = {
        labels: ['Angular', 'React', 'Other'],
        datasets: [{
            backgroundColor: colors.slice(0, 3),
            borderWidth: 0,
            data: [21, 45, 55, 33]
        }]
    };
    var chDonut3 = document.getElementById("chDonut3");
    if (chDonut3) {
        new Chart(chDonut3, {
            type: 'pie',
            data: chDonutData3,
            options: donutOptions
        });
    }

    /* 3 line charts */
    var lineOptions = {
        legend: {
            display: false
        },
        tooltips: {
            interest: false,
            bodyFontSize: 11,
            titleFontSize: 11
        },
        scales: {
            xAxes: [{
                ticks: {
                    display: false
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                }
            }],
            yAxes: [{
                display: false
            }]
        },
        layout: {
            padding: {
                left: 6,
                right: 6,
                top: 4,
                bottom: 6
            }
        }
    };

    var chLine1 = document.getElementById("chLine1");
    if (chLine1) {
        new Chart(chLine1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    backgroundColor: '#ffffff',
                    borderColor: '#ffffff',
                    data: [10, 11, 4, 11, 4],
                    fill: false
                }]
            },
            options: lineOptions
        });
    }
    var chLine2 = document.getElementById("chLine2");
    if (chLine2) {
        new Chart(chLine2, {
            type: 'line',
            data: {
                labels: ['A', 'B', 'C', 'D', 'E'],
                datasets: [{
                    backgroundColor: '#ffffff',
                    borderColor: '#ffffff',
                    data: [4, 5, 7, 13, 12],
                    fill: false
                }]
            },
            options: lineOptions
        });
    }

    var chLine3 = document.getElementById("chLine3");
    if (chLine3) {
        new Chart(chLine3, {
            type: 'line',
            data: {
                labels: ['Pos', 'Neg', 'Nue', 'Other', 'Unknown'],
                datasets: [{
                    backgroundColor: '#ffffff',
                    borderColor: '#ffffff',
                    data: [13, 15, 10, 9, 14],
                    fill: false
                }]
            },
            options: lineOptions
        });
    }
</script>
@include('template.end')
