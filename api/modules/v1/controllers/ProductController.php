<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class ProductController extends ActiveController
{
    public $modelClass = 'common\models\Product';

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
}
