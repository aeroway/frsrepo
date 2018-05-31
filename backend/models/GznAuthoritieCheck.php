<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gzn_authoritie_check".
 *
 * @property int $id
 * @property string $name
 *
 * @property GznObject[] $gznObjects
 */
class GznAuthoritieCheck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gzn_authoritie_check';
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
        return $this->hasMany(GznObject::className(), ['authoritie_check_id' => 'id']);
    }
}
