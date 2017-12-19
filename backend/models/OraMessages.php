<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ora_messages".
 *
 * @property integer $id
 * @property string $text_message
 * @property integer $kuvd_id
 * @property string $version
 */
class OraMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ora_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text_message', 'version'], 'string'],
            [['kuvd_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text_message' => 'Основание',
            'kuvd_id' => 'Kuvd ID',
            'version' => 'Version',
        ];
    }
}
