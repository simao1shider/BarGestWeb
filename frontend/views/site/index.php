<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index container-fluid ml-5">

    <div class="jumbotron">
        <h1>Bargest</h1>

        <p class="lead">O seu programa de gestão de pedidos!</p>

    </div>

    <div class="body-content">

        <div class="row text-center">
            <div class="col-md-1"></div>
            <div class="card col-md-3 mr-3 mb-3">
                <a href="#">
                    <div class="card-body mt-3">
                        <h5 class="card-title">
                            <?= Html::img('@web/img/Icons/Color/calendar.png', ['class' => 'align-top mt-1', 'style' => 'width: 55px']) ?>
                            <span class="mt-3 ml-2">
                                <h2 id="date"></h2>
                            </span>
                        </h5>
                        <h5 class="card-title">
                            <?= Html::img('@web/img/Icons/Color/clock.png', ['class' => 'align-top mt-1', 'style' => 'width: 55px']) ?>
                            <span class="mt-3 ml-2">
                                <h2 id="clock"></h2>
                            </span>
                        </h5>
                    </div>
                </a>
            </div>
            <div class="card col-md-3 mr-3 mb-3">
                <a href="#">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= Html::img('@web/img/Icons/Color/receipt.png', ['class' => 'align-top mt-1', 'style' => 'width: 55px']) ?><br>
                            <span class="mt-2 ml-2 h4">Caixa do Dia</span>
                        </h5>
                        <p class="card-text">Caixa aberta no dia: 25-23-2000</p>
                        <!--<blockquote class="blockquote mb-0">
                            <footer class="blockquote-footer">Caixa aberta no dia: <cite title="Source Title">25-23-2000</cite></footer>
                        </blockquote>-->
                    </div>
                </a>
            </div>
            <div class="card col-md-3 mr-3 mb-3">
                <a href="../../../backend/web/site/login">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= Html::img('@web/img/Icons/Color/locked.png', ['class' => 'align-top', 'style' => 'width: 55px']) ?><br>
                            <span class="mt-2 ml-2 h4"> Sistema Administrativo</span>
                        </h5>
                        <p class="card-text">Sistema que faz a gestão de todos os dados da Aplicação</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    var time = {};

    (function() {
        var clock = document.getElementById('clock');
        var date = document.getElementById('date');

        (function tick() {
            var minutes, d = new Date();
            time.weekday = d.getDay();
            time.day = d.getDate();
            time.month = d.getMonth() + 1; //JS says jan = 0
            time.year = d.getFullYear();
            time.minutes = d.getMinutes();
            time.hours = d.getHours() + 1; //eastern time zone
            time.seconds = d.getSeconds();
            time.ms = d.getMilliseconds();

            minutes = (time.minutes < 10 ? '0' + time.minutes : time.minutes);

            clock.innerHTML = time.hours + ':' + minutes;
            date.innerHTML = (time.month < 10 ? '0' + time.month : time.month) + '-' + (time.day < 10 ? '0' + time.day : time.day) + '-' + (time.year < 10 ? '0' + time.year : time.year);

            window.setTimeout(tick, 1000);
        }()); // Note the parens here, we invoke these functions right away
    }()); // This one keeps clock away from the global scope
</script>