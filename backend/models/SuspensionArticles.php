<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "suspension_articles".
 *
 * @property int $id
 * @property string|null $name
 */
class SuspensionArticles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suspension_articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Причина приостановки',
        ];
    }

    /**
     * Gets query for [[OtchetpriostSuspensions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOtchetpriostSuspensions()
    {
        return $this->hasMany(OtchetpriostSuspension::className(), ['suspension_articles_id' => 'id']);
    }
}
