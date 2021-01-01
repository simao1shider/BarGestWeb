<?php

namespace common\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $dateTime
 * @property int $status
 * @property int|null $account_id
 * @property int|null $employee_id
 *
 * @property ProductsPaid[] $productsPas
 * @property Product[] $products
 * @property ProductsToBePaid[] $productsToBePas
 * @property Product[] $products0
 * @property Account $account
 * @property Employee $employee
 */
class Request extends \yii\db\ActiveRecord
{
    const STATUS_REQUEST = 0;
    const STATUS_COOKING = 1;
    const STATUS_READY = 2;
    const STATUS_DELIVERED = 3;
    const STATUS_PAYED = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dateTime', 'status'], 'required'],
            [['dateTime'], 'safe'],
            [['dateTime'], 'date','format'=>'yyyy-M-d H:m:s'],
            [['account_id', 'employee_id'], 'integer'],
            [['account_id', 'employee_id'], 'required'],
            ['status','integer','min'=>0,'max'=>4],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
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
            'account_id' => 'Account ID',
            'employee_id' => 'Employee ID',
        ];
    }

    /**
     * Gets query for [[ProductsPas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsPas()
    {
        return $this->hasMany(ProductsPaid::className(), ['request_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('products_paid', ['request_id' => 'id']);
    }

    /**
     * Gets query for [[ProductsToBePas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductsToBePas()
    {
        return $this->hasMany(ProductsToBePaid::className(), ['request_id' => 'id']);
    }

    /**
     * Gets query for [[Products0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts0()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('products_to_be_paid', ['request_id' => 'id']);
    }

    /**
     * Gets query for [[Account]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    //* Função que faz o publish com um canal e mensagem à escolha
    public function FazPublish($canal, $msg)
    {
        $server = '127.0.0.1';
        $port = 1883;
        $username = "";
        $password = "";
        $client_id = uniqid();
        $mqtt= new phpMQTT($server, $port, $client_id);
        try {
            if ($mqtt->connect(true)) {
                $mqtt->publish($canal, $msg, 1);
                $mqtt->disconnect();
                $mqtt->close();
            } else {
                file_put_contents("debug.output", "Time out!");
            }
        }catch (\Exception $X)
        {}
    }

    //* Após guardar 
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $id = $this->id;
        $dateTime = $this->dateTime;
        $status = $this->status;
        $productsPas = $this->productsPas;

        $request = new Request();
        $request->id = $id;
        $request->dateTime = $dateTime;
        $request->status = $status;
        $request->productsPas = $productsPas;

        //TODO Enviar para um empregado especifico
        $requestInJSON = Json::encode($request);
        if ($insert) {
            $this->FazPublish("INSERT_Request", $requestInJSON);
        }else{
            $this->FazPublish("UPDATE_Request", $requestInJSON);
        }
    }
}
