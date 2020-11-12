<?php


namespace common\models;


class RequestProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Product_id', 'Request_id','quantity'], 'integer'],
            [['Product_id','Request_id'], 'required'],
            [['Product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['Product_id' => 'id']],
            [['Request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['Request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Request_id' => 'Request Id',
            'Product_id' => 'Product Id',
            'quantity' => 'Quantity',
        ];
    }
}