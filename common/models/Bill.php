<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bills".
 *
 * @property int $id
 * @property string|null $dateTime
 * @property int|null $status
 * @property float|null $total
 * @property int $Tables_id
 * @property int $Employees_id
 * @property int $Cashiers_id
 *
 * @property Cashier $cashiers
 * @property Employee $employees
 * @property Table $tables
 * @property Order[] $orders
 */
class Bill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dateTime'], 'safe'],
            [['status', 'Tables_id', 'Employees_id', 'Cashiers_id'], 'integer'],
            [['total'], 'number'],
            [['Tables_id', 'Employees_id', 'Cashiers_id'], 'required'],
            [['Cashiers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cashier::className(), 'targetAttribute' => ['Cashiers_id' => 'id']],
            [['Employees_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['Employees_id' => 'id']],
            [['Tables_id'], 'exist', 'skipOnError' => true, 'targetClass' => Table::className(), 'targetAttribute' => ['Tables_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dateTime' => 'Date Time',
            'status' => 'Status',
            'total' => 'Total',
            'Tables_id' => 'Tables ID',
            'Employees_id' => 'Employees ID',
            'Cashiers_id' => 'Cashiers ID',
        ];
    }

    /**
     * Gets query for [[Cashiers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCashiers()
    {
        return $this->hasOne(Cashier::className(), ['id' => 'Cashiers_id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasOne(Employee::className(), ['id' => 'Employees_id']);
    }

    /**
     * Gets query for [[Tables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTables()
    {
        return $this->hasOne(Table::className(), ['id' => 'Tables_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['Bills_id' => 'id']);
    }
}
