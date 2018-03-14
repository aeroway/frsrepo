<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gzn_land_user_category".
 *
 * @property int $id
 * @property string $name
 *
 * @property GznObject[] $gznObjects
 */
class GznLandUserCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gzn_land_user_category';
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
        return $this->hasMany(GznObject::className(), ['land_user_category_id' => 'id']);
    }
}
