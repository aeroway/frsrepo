<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otchetfiz".
 *
 * @property int $id
 * @property string $number_book
 * @property string $full_name
 * @property string $birth_date
 * @property string $name
 * @property string $kn
 * @property string $adr_txt
 * @property string $name1
 * @property string $name2
 * @property string $name3
 * @property string $fl
 * @property string $status
 * @property string $comment
 * @property string $date
 * @property string $username
 * @property int $flag
 * @property string $filename
 * @property string $date_update
 * @property string $date_load
 * @property double $cost
 */
class Otchetfiz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otchetfiz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'cost'], 'required'],
            [['number_book', 'full_name', 'name', 'kn', 'adr_txt', 'name1', 'name2', 'name3', 'fl', 'status', 'comment', 'username', 'filename'], 'string'],
            [['birth_date', 'date', 'date_update', 'date_load'], 'safe'],
            [['flag'], 'integer'],
            [['cost'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number_book' => '№ книги',
            'full_name' => 'Имя',
            'birth_date' => 'ДР',
            'name' => 'Назв.',
            'kn' => 'КН',
            'adr_txt' => 'Адрес',
            'name1' => 'Назв. #1',
            'name2' => 'Назв. #2',
            'name3' => 'Назв. #3',
            'fl' => 'Район',
            'status' => 'Статус',
            'comment' => 'Коммент.',
            'date' => 'Редакт.',
            'username' => 'Пользователь',
            'flag' => 'flag',
            'filename' => 'Имя файла',
            'date_update' => 'Обновлено',
            'date_load' => 'Загружено',
            'cost' => 'Стоимость',
        ];
    }
}
