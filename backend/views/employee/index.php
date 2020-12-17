<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Funcionários';
?>
<div class="employee-index container-fluid ml-5">
    <h1><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <p class="text-right">
        <?= Html::a('Criar <i class="fa fa-plus ml-1"></i>', ['create'], ['class' => 'btn btn-outline-success']) ?>
    </p>

    <div class="containerr row">
        <?php
        if(empty($employees)){
            echo "<h3>Não tem funionarios ativos atualmente</h3>";
        }
        foreach ($employees as $employee){
            ?>
            <div class="col-md-3">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h4><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top mr-2', 'style' => 'width: 40px']) ?><span class="mt-2"><?=$employee->name?></span></h4>
                        <p class="text-dark m-0">Email: <span class="card-text text-secondary"><?=$employee->email?></span></p>
                        <p class="text-dark m-0">Telemóvel: <span class="card-text text-secondary"><?=$employee->phone?></span></p>
                        <p class="text-dark m-0">Data de nascimento: <span class="card-text text-secondary"><?=$employee->birthDate?></span></p>
                        <p class="text-dark m-0">Tipo: <span class="card-text text-secondary"><?php
                                $userAssigned=Yii::$app->authManager->getAssignments($employee->user_id);
                                foreach($userAssigned as $userAssign){
                                    echo $userAssign->roleName;
                                    break;
                                }
                                ?></span></p>
                        <div class="btn-group float-right mt-1">
                            <a href=<?=URL::to(["update","id"=>$employee->id])?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                            <a href="<?=URL::to(["view","id"=>$employee->id])?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        
    </div>


</div>