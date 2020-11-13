<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int|null $phone
 * @property string|null $birthDate
 * @property float|null $salary
 *
 * @property Accounts[] $accounts
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['phone'], 'integer'],
            [['birthDate'], 'safe'],
            [['salary'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['phone'], 'unique'],
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
            'email' => 'Email',
            'phone' => 'Phone',
            'birthDate' => 'Birth Date',
            'salary' => 'Salary',
        ];
    }

    /**
     * Gets query for [[Accounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['Employees_id' => 'id']);
    }
}
