<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Area".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 */
class Area extends \yii\db\ActiveRecord
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
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['name'], 'required'],
            [['name'], 'string'],
            [['status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Отдел',
            'status' => 'Status',
        ];
    }

}
