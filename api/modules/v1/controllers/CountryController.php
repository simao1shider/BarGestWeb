<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

class CountryController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actionTeste(){
        return array("teste");
    }
}




