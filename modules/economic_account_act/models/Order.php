<?php

namespace app\modules\economic_account_act\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property double $quantity
 * @property int $account_id
 * @property int $service_id
 *
 * @property Account $account
 * @property Service $service
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity'], 'number'],
            [['account_id', 'service_id'], 'required'],
            [['account_id', 'service_id'], 'integer'],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер заказа',
            'quantity' => 'Количество',
            'account_id' => 'Счет',
            'service_id' => 'Услуга',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }

}
