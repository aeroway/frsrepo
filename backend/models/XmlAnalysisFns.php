<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "xml_analysis".
 *
 * @property string $kn
 * @property string $address
 * @property string $filename
 * @property int $id
 */
class XmlAnalysisFns extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'xml_analysis_fns';
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
            [['kn', 'address', 'filename'], 'required'],
            [['kn', 'filename'], 'string', 'max' => 150],
            [['address'], 'string', 'max' => 5000],
            [['kn', 'filename'], 'unique', 'targetAttribute' => ['kn', 'filename']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kn' => 'КН',
            'address' => 'Адрес',
            'filename' => 'Имя файла',
            'id' => 'ID',
            'filenameDate' => 'Дата',
        ];
    }

    public function getFilenameDate() {
        if (strpos($this->filename, 'VO_NEZE') !== false) {
            return substr($this->filename, 39, 2) . '.' . substr($this->filename, 37, 2) . '.' . substr($this->filename, 33, 4);
        }

        if (strpos($this->filename, 'F_FRS') === false) {
            return substr($this->filename, 7, 2) . '.' . substr($this->filename, 9, 2) . '.' . substr($this->filename, 11, 4);
        } else {
            return substr($this->filename, 11, 2) . '.' . substr($this->filename, 13, 2) . '.' . substr($this->filename, 15, 4);
        }
    }
}