<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products_paid".
 *
 * @property int $Products_id
 * @property int $Bills_id
 * @property int $quantity
 *
 * @property Bills $bills
 * @property Products $products
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
            [['Products_id', 'Bills_id', 'quantity'], 'required'],
            [['Products_id', 'Bills_id', 'quantity'], 'integer'],
            [['Products_id', 'Bills_id'], 'unique', 'targetAttribute' => ['Products_id', 'Bills_id']],
            [['Bills_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bill::className(), 'targetAttribute' => ['Bills_id' => 'id']],
            [['Products_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['Products_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Products_id' => 'Products ID',
            'Bills_id' => 'Bills ID',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Bills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasOne(Bill::className(), ['id' => 'Bills_id']);
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
