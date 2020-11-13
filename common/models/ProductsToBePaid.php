<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products_to_be_paid".
 *
 * @property int $Requests_id
 * @property int $Products_id
 * @property int $quantity
 *
 * @property Requests $requests
 * @property Products $products
 */
class ProductsToBePaid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_to_be_paid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Requests_id', 'Products_id', 'quantity'], 'required'],
            [['Requests_id', 'Products_id', 'quantity'], 'integer'],
            [['Requests_id', 'Products_id'], 'unique', 'targetAttribute' => ['Requests_id', 'Products_id']],
            [['Requests_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['Requests_id' => 'id']],
            [['Products_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['Products_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Requests_id' => 'Requests ID',
            'Products_id' => 'Products ID',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasOne(Request::className(), ['id' => 'Requests_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Product::className(), ['id' => 'Products_id']);
    }
}
