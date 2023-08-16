<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sgr_regulations".
 *
 * @property int $id
 * @property string $name_doc
 */
class SgrRegulations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sgr_regulations';
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
            [['name_doc'], 'required'],
            [['name_doc'], 'string', 'max' => 700],
            [['file_doc'], 'file',
                'extensions' => 'zip',
                'maxSize' => 30720000,
                'tooBig' => 'Limit 30MB',
                'maxFiles' => 1,
            ],
        ];
    }

    public $pathSovGosRegDocRegulations = 'uploads/sov-gos-reg/doc-regulations/';

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_doc' => 'Наименование',
            'file_doc' => 'Документ',
        ];
    }

    public function getNameDoc() {
        if (empty($this->file_doc)) {
            return $this->name_doc;
        } else {
            return "<a href='" . $this->pathSovGosRegDocRegulations . $this->file_doc . "'>" . $this->name_doc . "</a>";
        }
    }
}
