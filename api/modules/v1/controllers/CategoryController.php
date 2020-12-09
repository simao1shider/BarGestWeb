<?php

namespace api\modules\v1\controllers;

use common\models\Category;
use yii\rest\ActiveController;
use yii\web\Response;

class CategoryController extends ActiveController
{
    public $modelClass = 'common\models\Category';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [

            'class' => 'yii\filters\ContentNegotiator',

            'formats' => [

                'application/json' => Response::FORMAT_JSON,

            ]
        ];
        return $behaviors;
    }

    public function actionCategory()
    {
        return Category::findAll(["status"=>Category::STATUS_ACTIVE]);
    }
}
