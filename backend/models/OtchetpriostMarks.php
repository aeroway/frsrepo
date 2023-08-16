<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otchetpriost_marks".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Otchetpriost[] $otchetpriosts
 */
class OtchetpriostMarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otchetpriost_marks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Особые отметки',
        ];
    }

    /**
     * Gets query for [[Otchetpriosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOtchetpriosts()
    {
        return $this->hasMany(Otchetpriost::className(), ['mark_id' => 'id']);
    }
}
