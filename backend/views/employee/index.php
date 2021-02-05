<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Funcionários';
?>
<div class="employee-index container-fluid ml-5">
    
    <div class="row">
        <div class="col-4">
            <h1><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
        </div>
        <div class="col-8 text-right">
            <?= Html::a('Criar <i class="fa fa-plus ml-1"></i>', ['create'], ['class' => 'btn btn-outline-success mt-3']) ?>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <div class="containerr">
        <ul class="nav nav-pills mb-3 text-right justify-content-end" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-employees-active-tab" data-toggle="pill" href="#pills-employees-active" role="tab" aria-controls="pills-employees-active" aria-selected="true">Ativo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-employees-inactive-tab" data-toggle="pill" href="#pills-employees-inactive" role="tab" aria-controls="ppills-employees-inactive" aria-selected="false">Inativo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-employees-all-tab" data-toggle="pill" href="#pills-employees-all" role="tab" aria-controls="pills-employees-all" aria-selected="false">Todos</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active " id="pills-employees-active" role="tabpanel" aria-labelledby="pills-employees-active-tab">
                <div class="row">
                <?php
                if(empty($activeEmployees)){
                    echo "<h3 class='text-center w-100'>Não tem funionarios ativos atualmente</h3>";
                }
                foreach ($activeEmployees as $employee){
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
                                    <a href="<?=URL::to(["update","id"=>$employee->id])?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
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
            <div class="tab-pane fade" id="pills-employees-inactive" role="tabpanel" aria-labelledby="pills-employees-inactive-tab">
                <div class="row">
                    <?php
                    if(empty($inactiveEmployees)){
                        echo "<h3 class='text-center w-100'>Não tem funionarios inativos</h3>";
                    }
                    foreach ($inactiveEmployees as $employee){
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
                                        <a href="<?=URL::to(["active_employee","id"=>$employee->id])?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-check"></i></a>
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
            <div class="tab-pane fade" id="pills-employees-all" role="tabpanel" aria-labelledby="pills-employees-all-tab">
                <div class="row">
                    <?php
                    if(empty($allEmployees)){
                        echo "<h3 class='text-center w-100 h-100 align-middle'>Não tem funionarios</h3>";
                    }
                    foreach ($allEmployees as $employee){
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
                                        <a href="<?=URL::to(["update","id"=>$employee->id])?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
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
        </div>
    </div>


</div>