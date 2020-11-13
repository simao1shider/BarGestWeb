<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accounts".
 *
 * @property int $id
 * @property string|null $name
 * @property string $dateTime
 * @property int $status
 * @property float $total
 * @property int $Tables_id
 * @property int $Employees_id
 * @property int $Cashiers_id
 *
 * @property Cashiers $cashiers
 * @property Employees $employees
 * @property Tables $tables
 * @property Requests[] $requests
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dateTime', 'status', 'total', 'Tables_id', 'Employees_id', 'Cashiers_id'], 'required'],
            [['dateTime'], 'safe'],
            [['status', 'Tables_id', 'Employees_id', 'Cashiers_id'], 'integer'],
            [['total'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['Cashiers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cashiers::className(), 'targetAttribute' => ['Cashiers_id' => 'id']],
            [['Employees_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['Employees_id' => 'id']],
            [['Tables_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tables::className(), 'targetAttribute' => ['Tables_id' => 'id']],
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
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['Accounts_id' => 'id']);
    }
}
