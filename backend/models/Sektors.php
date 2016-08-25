<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sektors".
 *
 * @property integer $id
 * @property string $name
 * @property integer $ip
 */
class Sektors extends \yii\db\ActiveRecord
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
        return 'sektors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['ip'], 'integer']
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
            'ip' => 'Ip',
        ];
    }
}
