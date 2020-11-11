<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property int $id
 * @property string|null $dateTime
 * @property int|null $status
 * @property int $Bills_id
 *
 * @property Bills $bills
 * @property RequestsProducts[] $requestsProducts
 * @property Products[] $products
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
            [['dateTime'], 'safe'],
            [['status', 'Bills_id'], 'integer'],
            [['Bills_id'], 'required'],
            [['Bills_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bill::className(), 'targetAttribute' => ['Bills_id' => 'id']],
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
            'Bills_id' => 'Bills ID',
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
     * Gets query for [[RequestsProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestsProducts()
    {
        return $this->hasMany(RequestProduct::className(), ['Requests_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'Products_id'])->viaTable('requests_products', ['Requests_id' => 'id']);
    }
}
