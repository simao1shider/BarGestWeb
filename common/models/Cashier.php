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
    /**
     * {@inheritdoc}
     */
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
            [['status'], 'integer'],
            [['total'], 'number'],
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
