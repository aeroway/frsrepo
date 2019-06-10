<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "doljn".
 *
 * @property integer $id
 * @property string $name
 * @property string $oklad
 * @property integer $act
 * @property integer $grp
 * @property integer $nadbavka
 * @property string $kod
 * @property integer $kat
 */
class Doljn extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db5;  
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doljn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'oklad', 'kod'], 'string'],
            [['act', 'grp', 'nadbavka', 'kat'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'oklad' => 'Oklad',
            'act' => 'Act',
            'grp' => 'Grp',
            'nadbavka' => 'Nadbavka',
            'kod' => 'Kod',
            'kat' => 'Kat',
        ];
    }
}
