<?php


namespace common\models;


use Yii;
use yii\rbac\Item;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        //TODO:Check access
        return isset($params['post']) ? $params['post']->createdBy == $user : false;
    }
}




