<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gzn_type_check".
 *
 * @property integer $id
 * @property string $name
 *
 * @property GznObject[] $gznObjects
 */
class GznTypeCheck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gzn_type_check';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznObjects()
    {
        return $this->hasMany(GznObject::className(), ['gzn_type_check_id' => 'id']);
    }
}
