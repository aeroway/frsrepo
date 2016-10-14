<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otchett".
 *
 * @property integer $id
 * @property string $kn
 * @property string $description
 * @property string $status
 * @property string $comment
 * @property string $date
 * @property string $username
 * @property string $area
 * @property string $flag
 * @property string $id_dpt
 * @property string $filename
 * @property string $id_egrp
 * @property string $date_update
 * @property string $date_load
 */
class Otchett extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

	public static $name;

    public static function tableName()
    {
		return self::$name;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'status', 'comment', 'date', 'username'], 'required'],
			[['id_dpt', 'id_egrp'], 'integer'],
            [['kn', 'description', 'status', 'comment', 'username', 'area', 'flag', 'filename', 'protocol'], 'string'],
            [['date', 'date_update', 'date_load'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kn' => 'КН/УН',
            'description' => 'Описание',
            'status' => 'Состояние',
            'comment' => 'Наимен. ошибки',
            'date' => 'Дата',
            'username' => 'Пользователь',
			'area' => 'Район',
			'flag' => 'Метка',
			'id_dpt' => 'iddpt',
			'filename' => 'Файл',
			'id_egrp' => 'id',
			'date_update' => 'Обновление',
			'date_load' => 'Загружено',
			'protocol' => 'Протокол',
        ];
    }
}
