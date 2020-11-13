<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $profit_margin
 * @property int $Categories_id
 * @property int $Iva_id
 *
 * @property Categories $categories
 * @property Iva $iva
 * @property ProductsPaid[] $productsPas
 * @property Bill[] $bills
 * @property ProductsToBePaid[] $productsToBePas
 * @property Request[] $requests
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'profit_margin', 'Categories_id', 'Iva_id'], 'required'],
            [['price'], 'number'],
            [['profit_margin', 'Categories_id', 'Iva_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['Categories_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['Categories_id' => 'id']],
            [['Iva_id'], 'exist', 'skipOnError' => true, 'targetClass' => Iva::className(), 'targetAttribute' => ['Iva_id' => 'id']],
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
            'price' => 'Price',
            'profit_margin' => 'Profit Margin',
            'Categories_id' => 'Categories ID',
            'Iva_id' => 'Iva ID',
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasOne(Category::className(), ['id' => 'Categories_id']);
    }

    /**
     * Gets query for [[Iva]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIva()
    {
        return $this->hasOne(Iva::className(), ['id' => 'Iva_id']);
    }

    /**
     * Gets query for [[ProductsPas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsPas()
    {
        return $this->hasMany(ProductsPaid::className(), ['Products_id' => 'id']);
    }

    /**
     * Gets query for [[Bills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bill::className(), ['id' => 'Bills_id'])->viaTable('products_paid', ['Products_id' => 'id']);
    }

    /**
     * Gets query for [[ProductsToBePas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsToBePas()
    {
        return $this->hasMany(ProductsToBePaid::className(), ['Products_id' => 'id']);
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['id' => 'Requests_id'])->viaTable('products_to_be_paid', ['Products_id' => 'id']);
    }
}
