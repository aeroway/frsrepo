<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otchetfns".
 *
 * @property int $id
 * @property string|null $area
 * @property string|null $type_obj
 * @property string $kn
 * @property string|null $address
 * @property string|null $category
 * @property string|null $permit_use
 * @property string|null $square
 * @property string|null $date_reg
 * @property string|null $info_tax
 * @property string|null $info_gfd
 * @property int|null $flag
 * @property int|null $status2
 * @property string|null $in_process
 * @property string|null $remove_reg
 * @property string|null $identified
 * @property string|null $comment
 * @property string|null $date
 * @property string|null $username
 * @property string|null $status
 * @property string|null $filename
 * @property string|null $date_update
 * @property string|null $date_load
 */
class Otchetfns extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otchetfns';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['date_reg', 'date', 'date_update', 'date_load'], 'safe'],
            [['flag', 'status2'], 'integer'],
            [['area', 'type_obj', 'kn', 'in_process', 'identified', 'filename'], 'string', 'max' => 50],
            [['address', 'comment'], 'string', 'max' => 2048],
            [['category'], 'string', 'max' => 1000],
            [['permit_use'], 'string', 'max' => 1000],
            [['square'], 'string', 'max' => 150],
            [['info_tax', 'info_gfd'], 'string', 'max' => 3],
            [['remove_reg'], 'string', 'max' => 10],
            [['username', 'status'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area' => 'Отдел',
            'type_obj' => 'Вид объекта',
            'kn' => 'КН',
            'address' => 'Адрес',
            'category' => 'Кат. / Назн.',
            'permit_use' => 'РИ',
            'square' => 'Пл. / Прот.',
            'date_reg' => 'Пост. на учёт',
            'info_tax' => 'ФНС',
            'info_gfd' => 'ГФД',
            'flag' => 'Рассмотрен',
            'status2' => 'Статус 2',
            'in_process' => 'Взят в раб.',
            'remove_reg' => 'Снят с уч.',
            'identified' => 'Выяв. правообл.',
            'comment' => 'Примечание',
            'date' => 'Дата',
            'username' => 'Пользователь',
            'status' => 'Статус',
            'filename' => 'Имя файла',
            'date_update' => 'Обновлено',
            'date_load' => 'Загружено',
        ];
    }
}
