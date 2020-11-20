<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products_paid".
 *
 * @property int $quantity
 * @property int $request_id
 * @property int $product_id
 *
 * @property Product $product
 * @property Request $request
 */
class ProductsPaid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_paid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity', 'request_id', 'product_id'], 'required'],
            [['quantity', 'request_id', 'product_id'], 'integer'],
            [['request_id', 'product_id'], 'unique', 'targetAttribute' => ['request_id', 'product_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'quantity' => 'Quantity',
            'request_id' => 'Request ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }
}
