<?php


namespace frontend\models;


use yii\base\Model;

class RequestForm extends Model
{
    public $tableNumber;

    public function rules()
    {
        return [

            [['tableNumber'], 'required'],
            [['tableNumber'], 'integer'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tableNumber' => 'Numero da Mesa',
        ];
    }
}