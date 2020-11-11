<?php

use yii\helpers\Html;

$this->title = 'Autenticação';

$this->registerCssFile("/css/login.css");
?>

<form class="form-signin">
    <div class="text-center">
        <?= Html::img('@web/img/cocktail.png', ['class' => 'mb-4']) ?>
        <h1 class="h2 mb-3 font-weight-normal">BarGest<span style="color: #F50057;">Web</span></h1>
        <h1 class="h5 mb-3 font-weight-normal">Sistema de Autenticação</h1>
    </div>

    <label for="inputEmail" class="sr-only">Email</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-primary float-right" type="submit">Entrar</button>
</form>