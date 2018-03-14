<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gzn_adm_punishment".
 *
 * @property int $id
 * @property string $name
 *
 * @property GznViolations[] $gznViolations
 */
class GznAdmPunishment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gzn_adm_punishment';
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
    public function getGznViolations()
    {
        return $this->hasMany(GznViolations::className(), ['adm_punishment_id' => 'id']);
    }
}
