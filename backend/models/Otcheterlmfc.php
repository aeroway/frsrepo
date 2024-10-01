<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otcheterlmfc".
 *
 * @property int $id
 * @property int $area_id
 * @property string $ref_num
 * @property string $application_date
 * @property string $address
 * @property string $fio_mfc
 * @property string $description
 * @property string $username
 * @property string $date_create
 *
 * @property Area $area
 */
class Otcheterlmfc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otcheterlmfc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['area_id', 'ref_num', 'application_date', 'address', 'fio_mfc', 'description', 'username'], 'required'],
            [['area_id'], 'integer'],
            [['application_date', 'date_create'], 'safe'],
            [['ref_num', 'username'], 'string', 'max' => 50],
            [['address', 'description'], 'string', 'max' => 2048],
            [['fio_mfc'], 'string', 'max' => 100],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => AreaOtchet::class, 'targetAttribute' => ['area_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_id' => 'Тер. отдел',
            'ref_num' => '№ обращения',
            'application_date' => 'Дата приёма',
            'address' => 'Адрес МФЦ',
            'fio_mfc' => 'ФИО МФЦ',
            'description' => 'Описание ошибки',
            'username' => 'Пользователь',
            'date_create' => 'Дата создания',
        ];
    }

    /**
     * Gets query for [[Area]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(AreaOtchet::class, ['id' => 'area_id']);
    }
}
