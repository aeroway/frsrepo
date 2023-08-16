<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sgr_members".
 *
 * @property int $id
 * @property string $fio
 * @property string $position
 * @property string|null $photo
 */
class SgrMembers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sgr_members';
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
            [['fio', 'position'], 'required'],
            [['fio', 'contact'], 'string', 'max' => 150],
            [['photo'], 'file',
                'extensions' => 'jpg, png',
                'mimeTypes' => 'image/jpeg, image/png',
                'maxSize' => 512000,
                'tooBig' => 'Limit 500KB',
            ],
            [['position', 'status'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'position' => 'Должность',
            'photo' => 'Фото',
            'contact' => 'Контактная информация',
            'status' => 'Статус',
        ];
    }
}
