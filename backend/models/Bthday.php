<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bthday".
 *
 * @property string|null $fio
 * @property string|null $dl
 * @property string|null $otd
 * @property string|null $dr
 */
class Bthday extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bthday';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db5');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio'], 'string', 'max' => 152],
            [['dl'], 'string', 'max' => 255],
            [['otd'], 'string', 'max' => 500],
            [['dr'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fio' => 'Fio',
            'dl' => 'Dl',
            'otd' => 'Otd',
            'dr' => 'Dr',
        ];
    }
}
