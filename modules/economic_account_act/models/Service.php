<?php

namespace app\modules\economic_account_act\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property int $account_id
 * @property string $name
 * @property string $measurement_unit
 * @property double $quantity
 * @property double $price
 *
 * @property Account $account
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [[ 'price'], 'number'],
            [['name'], 'string', 'max' => 50],
            [['measurement_unit'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'name' => 'Наименование',
            'measurement_unit' => 'Единица измерения',
            'price' => 'Цена',
        ];
    }


}
