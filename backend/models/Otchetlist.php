<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otdel".
 *
 * @property integer $id
 * @property string $text
 */
class Otchetlist extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db4;  
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otchet_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_list'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_list' => 'Название',
            'table_list' => 'Таблица',
        ];
    }
}
