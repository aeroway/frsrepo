<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otdel".
 *
 * @property integer $id
 * @property string $text
 */
class Otdel extends \yii\db\ActiveRecord
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
        return 'otdel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'unique'],
            [['text'], 'string'],
            [['date_start', 'date_stop'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Отдел',
            'date_start' => 'Начало',
            'date_stop' => 'Окончание',
        ];
    }
}
