<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "table".
 *
 * @property int $id
 * @property int $number
 * @property int $status
 *
 * @property Account[] $accounts
 */
class Table extends \yii\db\ActiveRecord
{
    const STATUS_FREE=false;
    const STATUS_BUSY=true;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'status'], 'required'],
            ['number', 'integer'],
            ["status","boolean"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Accounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['table_id' => 'id']);
    }

    public function getTotal($id){
        $table=ProductsToBePaid::find()
            ->select("quantity,price")
            ->innerJoin("product","product_id=product.id")
            ->innerJoin("request","request_id=request.id")
            ->innerJoin("account","account_id=account.id")
            ->innerJoin("table","table_id=table.id")
            ->where(["table_id"=>$id,"account.status"=> 3])
            ->asArray()
            ->all();
        $total=0;
        foreach ($table as $item){
            $total+=$item["quantity"]*$item["price"];
        }
        return $total;

    }
}
