<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "empl_ecp_status".
 *
 * @property integer $id
 * @property string $text
 */
class EmplEcpStatus extends \yii\db\ActiveRecord
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
        return 'empl_ecp_status';
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
