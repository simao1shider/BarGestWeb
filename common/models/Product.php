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
 * @property boolean $status
 * @property int $category_id
 * @property int $iva_id
 *
 * @property Category $category
 * @property Iva $iva
 * @property ProductsPaid[] $productsPas
 * @property Request[] $requests
 * @property ProductsToBePaid[] $productsToBePas
 * @property Request[] $requests0
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = true;
    const STATUS_DELETED = false;
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
            [['name', 'price', 'base_price', 'profit_margin', 'category_id', 'iva_id','status'], 'required'],
            [['price', 'base_price'], 'number'],
            [['status'], 'boolean'],
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
            'name' => 'Nome',
            'price' => 'Preço',
            'base_price' => 'Preço Base',
            'profit_margin' => 'Margem de Lucro',
            'category_id' => 'Categoria',
            'iva_id' => 'Iva',
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
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['id' => 'request_id'])->viaTable('products_paid', ['product_id' => 'id']);
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

    /**
     * Gets query for [[Requests0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests0()
    {
        return $this->hasMany(Request::className(), ['id' => 'request_id'])->viaTable('products_to_be_paid', ['product_id' => 'id']);
    }

    public function calculateProductPrice($price, $profit_margin){
        $iva = Iva::find($this->iva_id)->one();
  
        $price += $price * ($iva->rate * 0.01);
        $price += $price * ($profit_margin * 0.01);

        return $price;
    }

    public function recover(){
        $category = $this->category;
        $category->status=Category::STATUS_ACTIVE;
        if($category->save()){
            $this->status=Product::STATUS_ACTIVE;
            $this->save();
        }
    }
}
