<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "foreigners_agro".
 *
 * @property int $id
 * @property string $kn
 * @property string $address
 * @property string $category
 * @property string $permit_use
 * @property string $num_reg
 * @property string $date
 * @property string $date_reg
 * @property string $date_term_right
 * @property string $fio
 * @property string $citizenship
 * @property string $notice_ogv_oms
 * @property string $notice_prosecutor
 * @property string $sent_claims_ogv
 * @property string|null $notice_interior_portal
 */
class ForeignersAgro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'foreigners_agro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kn', 'address', 'category', 'permit_use', 'num_reg', 'date_reg', 'fio', 'citizenship'], 'required'],
            [['date_reg', 'date_term_right', 'date'], 'safe'],
            [['kn', 'category', 'num_reg', 'citizenship'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 8000],
            [['fio'], 'string', 'max' => 100],
            [['permit_use'], 'string', 'max' => 200],
            [['sent_claims_ogv'], 'string', 'max' => 3000],
            [['notice_ogv_oms', 'notice_prosecutor', 'notice_interior_portal'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kn' => 'КН',
            'address' => 'Адрес',
            'category' => 'Категория',
            'permit_use' => 'ВРИ',
            'num_reg' => '№ рег.',
            'date' => 'Дата внес.',
            'date_reg' => 'Дата рег.',
            'date_term_right' => 'Дата прекращения',
            'fio' => 'ФИО',
            'citizenship' => 'Гражданство',
            'notice_ogv_oms' => 'Извещения ОГВ/ОМС',
            'notice_prosecutor' => 'Уведомления в прокуратуру',
            'sent_claims_ogv' => 'Направленные ОГВ судебные иски',
            'notice_interior_portal' => 'Извещения на вн. портале Росреестра',
        ];
    }
}
