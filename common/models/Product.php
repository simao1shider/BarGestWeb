<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $profit_margin
 * @property int|null $category_id
 * @property int|null $iva_id
 *
 * @property Category $category
 * @property Iva $iva
 * @property ProductsPaid[] $productsPas
 * @property ProductsToBePaid[] $productsToBePas
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'profit_margin'], 'required'],
            [['price'], 'number'],
            [['profit_margin', 'category_id', 'iva_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['iva_id'], 'exist', 'skipOnError' => true, 'targetClass' => Iva::className(), 'targetAttribute' => ['iva_id' => 'id']],
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
            'category_id' => 'Category ID',
            'iva_id' => 'Iva ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Iva]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIva()
    {
        return $this->hasOne(Iva::className(), ['id' => 'iva_id']);
    }

    /**
     * Gets query for [[ProductsPas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsPas()
    {
        return $this->hasMany(ProductsPaid::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductsToBePas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsToBePas()
    {
        return $this->hasMany(ProductsToBePaid::className(), ['product_id' => 'id']);
    }
}
