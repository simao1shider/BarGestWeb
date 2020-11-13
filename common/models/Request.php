<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property int $id
 * @property string $dateTime
 * @property int $status
 * @property int $Accounts_id
 *
 * @property ProductsToBePaid[] $productsToBePas
 * @property Product[] $products
 * @property Account $accounts
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dateTime', 'status', 'Accounts_id'], 'required'],
            [['dateTime'], 'safe'],
            [['status', 'Accounts_id'], 'integer'],
            [['Accounts_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['Accounts_id' => 'id']],
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
            'Accounts_id' => 'Accounts ID',
        ];
    }

    /**
     * Gets query for [[ProductsToBePas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsToBePas()
    {
        return $this->hasMany(ProductsToBePaid::className(), ['Requests_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'Products_id'])->viaTable('products_to_be_paid', ['Requests_id' => 'id']);
    }

    /**
     * Gets query for [[Accounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasOne(Account::className(), ['id' => 'Accounts_id']);
    }
}
