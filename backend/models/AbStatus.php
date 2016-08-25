<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ab_status".
 *
 * @property integer $id
 * @property string $name
 */
class AbStatus extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db3;  
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ab_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string']
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
        ];
    }
}
