<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<div class="site-index container-fluid ml-5">

    <div class="jumbotron">
        <h1>Bargest</h1>

        <p class="lead">O seu programa de gestão de pedidos!</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md-4 pr-2">
                <h2>Lucro por mês</h2>
                <canvas id="canvas"></canvas>
                <!--<p><a class="btn btn-default" href="#">Vai ter aqui um gráfico</a></p>-->
            </div>
            <div class="col-md-4 pr-2">
                <h2>Valor de Vendas por Mês</h2>
                <canvas id="canvas2"></canvas>
                <!--<p><a class="btn btn-default" href="#">Vai ter aqui um gráfico</a></p>-->
            </div>
            <div class="col-md-4 pr-2">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="#">Vai ter aqui um gráfico</a></p>
            </div>
        </div>

        <!--<div class="alert alert-danger alert-dismissible alert-message fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>-->

    </div>

    <script>
        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };
        var config = {
            type: 'line',
            data: {
                labels: [
                    "Jan",
                    "Fev",
                    "Mar",
                    "Abr",
                    "Mai",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Set",
                    "Out",
                    "Nov",
                    "Dez",
                ],
                datasets: [{
                    label: 'Lucro de <?= date("Y") ?>',
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [
                        <?php
                        foreach ($profitthisYear as $productPaid) {
                            echo ("'" . $productPaid->quantity . "',");
                        }
                        ?>
                    ],
                }, {
                    label: 'Lucro de <?= date("Y") - 1 ?>',
                    backgroundColor: window.chartColors.grey,
                    borderColor: window.chartColors.grey,
                    data: [
                        <?php
                        foreach ($profitlastYear as $productPaid) {
                            echo ("'" . $productPaid->quantity . "',");
                        }
                        ?>
                    ],
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Meses'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Lucro'
                        }
                    }]
                }
            }
        };

        var config2 = {
            type: 'line',
            data: {
                labels: [
                    "Jan",
                    "Fev",
                    "Mar",
                    "Abr",
                    "Mai",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Set",
                    "Out",
                    "Nov",
                    "Dez",
                ],
                datasets: [{
                    label: 'Lucro de <?= date("Y") ?>',
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [
                        <?php
                        foreach ($sellsthisYear as $productPaid) {
                            echo ("'" . $productPaid->quantity . "',");
                        }
                        ?>
                    ],
                }, {
                    label: 'Lucro de <?= date("Y") - 1 ?>',
                    backgroundColor: window.chartColors.grey,
                    borderColor: window.chartColors.grey,
                    data: [
                        <?php
                        foreach ($sellslastYear as $productPaid) {
                            echo ("'" . $productPaid->quantity . "',");
                        }
                        ?>
                    ],
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Meses'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Lucro'
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            var ctx2 = document.getElementById('canvas2').getContext('2d');

            window.myLine = new Chart(ctx, config);
            window.myLine = new Chart(ctx2, config2);
        };
    </script>
</div>