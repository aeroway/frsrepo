<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otchetpriost_suspension".
 *
 * @property int $id
 * @property int|null $otchetpriost_id
 * @property int|null $suspension_articles_id
 *
 * @property Otchetpriost $otchetpriost
 * @property SuspensionArticles $suspensionArticles
 */
class OtchetpriostSuspension extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otchetpriost_suspension';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['otchetpriost_id', 'suspension_articles_id'], 'integer'],
            [['otchetpriost_id'], 'exist', 'skipOnError' => true, 'targetClass' => Otchetpriost::className(), 'targetAttribute' => ['otchetpriost_id' => 'id']],
            [['suspension_articles_id'], 'exist', 'skipOnError' => true, 'targetClass' => SuspensionArticles::className(), 'targetAttribute' => ['suspension_articles_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'otchetpriost_id' => 'Otchetpriost ID',
            'suspension_articles_id' => 'Suspension Articles ID',
        ];
    }

    /**
     * Gets query for [[Otchetpriost]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOtchetpriost()
    {
        return $this->hasOne(Otchetpriost::className(), ['id' => 'otchetpriost_id']);
    }

    /**
     * Gets query for [[SuspensionArticles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuspensionArticles()
    {
        return $this->hasOne(SuspensionArticles::className(), ['id' => 'suspension_articles_id']);
    }
}
