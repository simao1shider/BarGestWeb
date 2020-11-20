<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "table".
 *
 * @property int $id
 * @property int $number
 * @property int $status
 *
 * @property Account[] $accounts
 */
class Table extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'status'], 'required'],
            ['number', 'integer'],
            ["status","boolean"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Accounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['table_id' => 'id']);
    }
}
