<?php


namespace frontend\models;


use yii\bootstrap\Modal;

class RequestForm extends Modal
{
    public $Table_id;
    public $Bill_id;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['Table_id', 'Bill_id'], 'required'],
            // email has to be a valid email address
            [['Table_id', 'Bill_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Table_id' => 'Mesa Id',
            'Bill_id' => 'Conta Id',
        ];
    }
}