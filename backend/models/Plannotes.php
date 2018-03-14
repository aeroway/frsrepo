<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plannotes".
 *
 * @property int $id
 * @property string $text
 * @property int $status
 * @property string $action
 * @property int $pstages_id
 *
 * @property Planstages $pstages
 */
class Plannotes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plannotes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'action'], 'string'],
            [['status', 'pstages_id'], 'integer'],
            [['pstages_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planstages::className(), 'targetAttribute' => ['pstages_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Комментарий',
            'status' => 'Статус',
            'action' => 'Действие',
            'pstages_id' => 'Этапы',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPstages()
    {
        return $this->hasOne(Planstages::className(), ['id' => 'pstages_id']);
    }
}
