<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "iva".
 *
 * @property int $id
 * @property int $rate
 * @property boolean $status
 *
 * @property Product[] $products
 */
class Iva extends \yii\db\ActiveRecord
{
    const ACTIVE = true;
    const INACTIVE = false;

    public static function tableName()
    {
        return 'iva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rate','status'],'required'],
            ['rate', 'unique'],
            ['rate', 'integer'],
            ['status','boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rate' => 'Percentagem',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['iva_id' => 'id']);
    }
}
