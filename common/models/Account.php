<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property string $name
 * @property string $dateTime
 * @property int $nif
 * @property int $status
 * @property int $total
 * @property int|null $table_id
 * @property int|null $cashier_id
 *
 * @property Table $table
 * @property Cashier $cashier
 * @property Request[] $requests
 */
class Account extends \yii\db\ActiveRecord
{
    const PAID = true;
    const TOPAY = false;
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
            [['name', 'dateTime', 'nif', 'status', 'total'], 'required'],
            [['dateTime'], 'safe'],
            [['dateTime'], 'date','format'=>'yyyy-M-d H:m:s'],
            [['nif', 'table_id', 'cashier_id'], 'integer'],
            ['status','boolean'],
            ['total','number', 'min'=>0],
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
            'name' => 'Name',
            'dateTime' => 'Date Time',
            'nif' => 'Nif',
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

    public static function validateNIF($nif)
    {
        $nif = trim($nif);
        $nif_split = str_split($nif);
        $nif_primeiros_digito = array(1, 2, 3, 5, 6, 7, 8, 9);
        if (is_numeric($nif) && strlen($nif) == 9 && in_array($nif_split[0], $nif_primeiros_digito)) {
            $check_digit = 0;
            for ($i = 0; $i < 8; $i++) {
                $check_digit += $nif_split[$i] * (10 - $i - 1);
            }
            $check_digit = 11 - ($check_digit % 11);
            $check_digit = $check_digit >= 10 ? 0 : $check_digit;
            if ($check_digit == $nif_split[8]) {
                return true;
            }
        }
        return false;
    }
}
