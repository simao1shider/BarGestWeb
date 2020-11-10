<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cashiers".
 *
 * @property int $id
 * @property string|null $date
 * @property int|null $status
 * @property float|null $total
 * @property string|null $Cashierscol
 *
 * @property Bills[] $bills
 */
class Cashier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cashiers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['status'], 'integer'],
            [['total'], 'number'],
            [['Cashierscol'], 'string', 'max' => 45],
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
            'Cashierscol' => 'Cashierscol',
        ];
    }

    /**
     * Gets query for [[Bills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bill::className(), ['Cashiers_id' => 'id']);
    }
}
