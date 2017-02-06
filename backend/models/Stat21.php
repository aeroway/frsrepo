<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stat_21".
 *
 * @property string $name
 * @property integer $vse
 * @property integer $work
 * @property integer $ispr
 * @property integer $ne_ispr
 * @property integer $nazn
 * @property integer $ne_nazn
 */
class Stat21 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stat_21';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['vse', 'work', 'ispr', 'ne_ispr', 'nazn', 'ne_nazn'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'vse' => 'Vse',
            'work' => 'Work',
            'ispr' => 'Ispr',
            'ne_ispr' => 'Ne Ispr',
            'nazn' => 'Nazn',
            'ne_nazn' => 'Ne Nazn',
        ];
    }
}
