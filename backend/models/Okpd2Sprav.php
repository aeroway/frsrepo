<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "okpd2_sprav".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $lvl
 * @property integer $parent
 */
class Okpd2Sprav extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db6;  
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'okpd2_sprav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'string'],
            [['lvl', 'parent'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'lvl' => 'Lvl',
            'parent' => 'Parent',
        ];
    }
}
