<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "keys_1".
 *
 * @property string $text
 * @property integer $id
 */
class Keys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keys_1';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbtest');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text' => 'Text',
            'id' => 'ID',
        ];
    }
}
