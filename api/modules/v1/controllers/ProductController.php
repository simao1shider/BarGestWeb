<?php

namespace api\modules\v1\controllers;

use common\models\Product;
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

    public function actionGetall(){
        return Product::find()
            ->where(["status"=>Product::STATUS_ACTIVE])
            ->all();
    }

    public function actionGet_porducts_by_category($id){
        return Product::find()
            ->where(["category_id"=>$id, "status"=>Product::STATUS_ACTIVE])
            ->all();
    }
}
