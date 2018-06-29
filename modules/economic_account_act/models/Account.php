<?php

namespace app\modules\economic_account_act\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property string $name
 * @property int $seller_id
 * @property int $buyer_id
 * @property string $measurement_unit
 * @property double $quantity
 * @property double $price
 *
 * @property Subject $buyer
 * @property Subject $seller
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'seller_id', 'buyer_id'], 'required'],
            [['seller_id', 'buyer_id'], 'integer'],
            [['quantity', 'price'], 'number'],
            [['name'], 'string', 'max' => 50],
            [['measurement_unit'], 'string', 'max' => 12],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['buyer_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['seller_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Полное имя агента',
            'seller_id' => 'Продавец',
            'buyer_id' => 'Покупатель',
            'measurement_unit' => 'Ед. изм',
            'quantity' => 'Кол-во',
            'price' => 'Цена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyer()
    {
        return $this->hasOne(Subject::className(), ['id' => 'buyer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(Subject::className(), ['id' => 'seller_id']);
    }
}
