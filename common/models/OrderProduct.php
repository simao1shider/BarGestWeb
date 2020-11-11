<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders_products".
 *
 * @property int $Orders_id
 * @property int $Products_id
 * @property int|null $quantity
 *
 * @property Orders $orders
 * @property Products $products
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Orders_id', 'Products_id'], 'required'],
            [['Orders_id', 'Products_id', 'quantity'], 'integer'],
            [['Orders_id', 'Products_id'], 'unique', 'targetAttribute' => ['Orders_id', 'Products_id']],
            [['Orders_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['Orders_id' => 'id']],
            [['Products_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['Products_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Orders_id' => 'Orders ID',
            'Products_id' => 'Products ID',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasOne(Order::className(), ['id' => 'Orders_id']);
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
