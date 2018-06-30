<?php

namespace app\modules\economic_account_act\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property string $full_name
 * @property string $address
 * @property string $inn
 * @property string $kipp
 * @property string $current_account
 * @property string $correspondent_account
 * @property int $rcbic
 * @property string $bank
 *
 * @property Account[] $accounts
 * @property Account[] $accounts0
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'address', 'current_account', 'correspondent_account'], 'required'],
            [['rcbic'], 'integer'],
            [['full_name', 'bank'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 100],
            [['inn', 'kipp'], 'string', 'max' => 12],
            [['current_account', 'correspondent_account'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'full_name' => 'Полное имя',
            'address' => 'Адрес',
            'inn' => 'ИНН',
            'kipp' => 'КПП',
            'current_account' => 'Расчетный счет',
            'correspondent_account' => 'Кор. счет',
            'rcbic' => 'БИК',
            'bank' => 'Банк',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['buyer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts0()
    {
        return $this->hasMany(Account::className(), ['seller_id' => 'id']);
    }
}
