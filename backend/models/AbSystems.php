<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ab_systems".
 *
 * @property integer $id
 * @property string $name
 *
 * @property AbEmplSys[] $abEmplSys
 */
class AbSystems extends \yii\db\ActiveRecord
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
        return 'ab_systems';
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
            'name' => 'Система',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    //public function getAbEmplSys()
    //{
        //return $this->hasMany(AbEmplSys::className(), ['id_sys' => 'id']);
    //}
}
