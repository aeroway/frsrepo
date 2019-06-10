<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ecp_org".
 *
 * @property integer $id
 * @property string $text
 */
class EmplEcpOrg extends \yii\db\ActiveRecord
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
        return 'ecp_org';
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
