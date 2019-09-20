<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hr_events".
 *
 * @property int $id
 * @property string $event_date
 * @property string $event_type
 * @property string $event_subject
 * @property string $event_member
 * @property string $event_comment
 */
class HrEvents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hr_events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_date'], 'safe'],
            [['event_type', 'event_subject', 'event_member', 'event_comment'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_date' => 'Event Date',
            'event_type' => 'Event Type',
            'event_subject' => 'Event Subject',
            'event_member' => 'Event Member',
            'event_comment' => 'Event Comment',
        ];
    }
}
