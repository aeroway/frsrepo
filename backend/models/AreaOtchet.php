<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property integer $id
 * @property string $kn
 * @property string $name
 * @property string $id_dpt
 * @property string $fl
 */
class AreaOtchet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kn', 'name', 'id_dpt', 'fl', 'name_2'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kn' => 'Kn',
            'name' => 'Отдел',
            'id_dpt' => 'Id Dpt',
            'fl' => 'Fl',
            'name_2' => 'name_2',
        ];
    }
}
