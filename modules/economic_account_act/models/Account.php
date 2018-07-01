<?php

namespace app\modules\economic_account_act\models;

use Yii;
use app\modules\economic_account_act\models\Order;
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
 * @property date $date1
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

            [['seller_id', 'buyer_id'], 'required'],
            [['seller_id', 'buyer_id'], 'integer'],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['buyer_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['seller_id' => 'id']],
			[['date1'], 'date', 'format' => 'd-m-yy'],
			[['services'], 'string', 'max' => 50],
			
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер счета',
            'seller_id' => 'Продавец',
            'buyer_id' => 'Покупатель',
			'date1' => 'Дата',
			'services' => 'Услуги'
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
