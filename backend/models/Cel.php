<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cel".
 *
 * @property integer $id
 * @property string $text
 */
class Cel extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db2;  
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
        ];
    }
}
