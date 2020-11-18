<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property string $name
 * @property string $dateTime
 * @property int $status
 * @property int $total
 * @property int $table_id
 * @property int $cashier_id
 *
 * @property Table $table
 * @property Cashier $cashier
 * @property Request[] $requests
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'dateTime', 'status', 'total'], 'required'],
            [['dateTime'], 'safe'],
            [['status', 'total', 'table_id', 'cashier_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['table_id'], 'exist', 'skipOnError' => true, 'targetClass' => Table::className(), 'targetAttribute' => ['table_id' => 'id']],
            [['cashier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cashier::className(), 'targetAttribute' => ['cashier_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome da conta',
            'dateTime' => 'Date Time',
            'status' => 'Status',
            'total' => 'Total',
            'table_id' => 'Table ID',
            'cashier_id' => 'Cashier ID',
        ];
    }

    /**
     * Gets query for [[Table]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTable()
    {
        return $this->hasOne(Table::className(), ['id' => 'table_id']);
    }

    /**
     * Gets query for [[Cashier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCashier()
    {
        return $this->hasOne(Cashier::className(), ['id' => 'cashier_id']);
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['account_id' => 'id']);
    }
}
