<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otchet_pay".
 *
 * @property integer $id
 * @property string $number
 * @property string $payer_name
 * @property double $sum
 * @property string $payer_id
 * @property string $payer_date
 * @property string $note
 * @property string $date_load
 * @property string $status
 * @property string $username
 * @property string $date
 * @property string $flag
 */
class OtchetPay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otchet_pay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['number', 'payer_name', 'payer_id', 'note', 'status', 'username', 'flag'], 'string'],
            [['sum'], 'number'],
            [['date', 'payer_date', 'date_load'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => '№',
            'payer_name' => 'Наименование',
            'sum' => 'Сумма',
            'payer_id' => '№ ПД',
            'payer_date' => 'Дата ПД',
            'note' => 'Примечание',
            'date_load' => 'Дата загрузки',
            'status' => 'Статус',
            'username' => 'Пользователь',
            'date' => 'Дата',
            'flag' => 'Метка',
        ];
    }
}
