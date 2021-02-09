<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cashier".
 *
 * @property int $id
 * @property string $date
 * @property int $status
 * @property float $total
 *
 * @property Account[] $accounts
 */
class Cashier extends \yii\db\ActiveRecord
{
    const OPEN = true;
    const CLOSE = false;

    public static function tableName()
    {
        return 'cashier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'status', 'total'], 'required'],
            [['date'], 'safe'],
            [['date'], 'date','format'=>'yyyy-M-d'],
            [['date'], 'unique'],
            [['status'], 'boolean'],
            [['total'], 'number', 'min'=>0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'status' => 'Status',
            'total' => 'Total',
        ];
    }

    /**
     * Gets query for [[Accounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['cashier_id' => 'id']);
    }
}
