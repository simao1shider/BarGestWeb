<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bills".
 *
 * @property int $id
 * @property int $Tables_id
 * @property string $dateTime
 * @property float $total
 * @property int $status
 *
 * @property Tables $tables
 * @property ProductsPaid[] $productsPas
 * @property Product[] $products
 */
class Bill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Tables_id', 'dateTime', 'total', 'status'], 'required'],
            [['Tables_id', 'status'], 'integer'],
            [['dateTime'], 'safe'],
            [['total'], 'number'],
            [['Tables_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tables::className(), 'targetAttribute' => ['Tables_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Tables_id' => 'Tables ID',
            'dateTime' => 'Date Time',
            'total' => 'Total',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Tables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTables()
    {
        return $this->hasOne(Table::className(), ['id' => 'Tables_id']);
    }

    /**
     * Gets query for [[ProductsPas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsPas()
    {
        return $this->hasMany(ProductsPaid::className(), ['Bills_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'Products_id'])->viaTable('products_paid', ['Bills_id' => 'id']);
    }
}
