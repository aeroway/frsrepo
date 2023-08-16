<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sgr_meeting".
 *
 * @property int $id
 * @property string $date_event
 * @property string $status
 * @property string $protocol
 * @property int $year
 * @property string $questions
 * @property string|null $questions_file
 */
class SgrMeeting extends \yii\db\ActiveRecord
{
    public $dateTimeEvent;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sgr_meeting';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db10');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dateTimeEvent', 'status', 'questions'], 'required'],
            ['date_event', 'integer'],
            ['date_event', 'default', 'value' => time()],
            ['dateTimeEvent', 'date', 'format' => 'php:d.m.Y H:i'],
            [['year'], 'default', 'value' => null],
            [['year'], 'integer'],
            [['status'], 'string', 'max' => 100],
            [['protocol'], 'file',
                'extensions' => 'zip',
                'maxSize' => 30720000,
                'tooBig' => 'Limit 30MB',
                'maxFiles' => 1,
            ],
            [['questions_file'], 'file',
                'extensions' => 'zip',
                // 'mimeTypes' => 'application/zip',
                'maxSize' => 30720000,
                'tooBig' => 'Limit 30MB',
                'maxFiles' => 1,
            ],
            [['questions'], 'string', 'max' => 2000],
        ];
    }

    public $pathSovGosRegDocMeeting = 'uploads/sov-gos-reg/doc-meeting/';

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_event' => 'Дата проведения',
            'status' => 'Статус',
            'protocol' => 'Протокол',
            'year' => 'Год',
            'questions' => 'Материалы',
            'questions_file' => 'Материалы',
            'dateTimeEvent' => 'Дата проведения',
        ];
    }

    public function setDateEvent($date)
    {
        $this->date_event = empty($date) ? null : strtotime($date);
    }

    public function getDateEvent()
    {
        return empty($this->date_event) ? '' : date('d.m.Y H:i', $this->date_event);
    }

    public function getYears()
    {   return $this::find()
            ->select(['year'])
            ->distinct()
            ->asArray()
            ->orderBy(['year' => SORT_ASC])
            ->all();
    }

    public function saveFile($fileName, $fileDoc)
    {
        if ($fileName && $fileDoc) {
                $fileDocNew = $fileName->baseName . '.' . $fileName->extension;
                $fileDocNewPath = $this->pathSovGosRegDocMeeting . $fileDocNew;
                $fileDocPath = $this->pathSovGosRegDocMeeting . $fileDoc;

                if ($fileDocNew != $fileDoc && !empty($fileDoc)) {
                    if (file_exists($fileDocPath)) {
                        unlink($fileDocPath);
                    }
                }

                $fileName->saveAs($fileDocNewPath);
        } else {
            return false;
        }

        return true;
    }
}