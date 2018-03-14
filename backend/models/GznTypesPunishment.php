<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gzn_types_punishment".
 *
 * @property int $id
 * @property string $name
 */
class GznTypesPunishment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gzn_types_punishment';
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
}
