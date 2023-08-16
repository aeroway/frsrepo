<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "xml_analysis".
 *
 * @property int $id
 * @property string $kn
 * @property string $address
 * @property string $filename
 * @property string $knGroup
 */
class XmlAnalysis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $knGroup;
    public static function tableName()
    {
        return 'xml_analysis';
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
            [['kn', 'filename', 'knGroup'], 'string', 'max' => 150],
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
            'knGroup' => 'КН перечисление',
        ];
    }

    public function getFilenameDate() {
        if (strpos($this->filename, 'f_frs') === false) {
            return substr($this->filename, 7, 2) . '.' . substr($this->filename, 9, 2) . '.' . substr($this->filename, 11, 4);
        } else {
            return substr($this->filename, 11, 2) . '.' . substr($this->filename, 13, 2) . '.' . substr($this->filename, 15, 4);
        }
    }
}