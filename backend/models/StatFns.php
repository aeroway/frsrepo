<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stat_fns".
 *
 * @property string|null $name
 * @property int|null $vse
 * @property int|null $vrabote
 * @property int|null $snyat_s_uch
 * @property int|null $vneseno
 * @property int|null $zareg
 * @property int|null $ne_podlezh
 * @property int|null $ne_otrab
 */
class StatFns extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stat_fns';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vse', 'vrabote', 'snyat_s_uch', 'vneseno', 'zareg', 'ne_podlezh', 'ne_otrab'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'vse' => 'Vse',
            'vrabote' => 'Vrabote',
            'snyat_s_uch' => 'Snyat S Uch',
            'vneseno' => 'Vneseno',
            'zareg' => 'Zareg',
            'ne_podlezh' => 'Ne Podlezh',
            'ne_otrab' => 'Ne Otrab',
        ];
    }
}
