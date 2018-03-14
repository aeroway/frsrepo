<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otchetur".
 *
 * @property int $id
 * @property string $number_book
 * @property string $full_name
 * @property string $inn
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
class Otchetur extends \yii\db\ActiveRecord
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
            [['status', 'cost'], 'required'],
            [['number_book', 'full_name', 'inn', 'name', 'kn', 'adr_txt', 'name1', 'name2', 'name3', 'fl', 'status', 'comment', 'username', 'filename'], 'string'],
            [['date', 'date_update', 'date_load'], 'safe'],
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
            'inn' => 'ИНН',
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

    public function otchetList($table)
    {
        $rows = (new \yii\db\Query())
            ->select('name_list')
            ->from('otchet_list')
            ->where(['table_list' => $table])
            ->all();

        foreach($rows[0] as $nameList) {}
        
        return $nameList;
    }
}
