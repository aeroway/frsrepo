<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "regist".
 *
 * @property int $id
 * @property string $developer
 * @property string $object
 * @property string $registered_object
 * @property string $commission
 * @property string $permission
 * @property string $registrar
 * @property resource $file_name
 */
class Regist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['developer', 'object', 'registered_object', 'commission', 'permission', 'registrar'], 'required'],
            [['developer', 'object', 'registered_object', 'commission', 'permission', 'registrar', 'file_name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'developer' => 'Застройщик',
            'object' => 'Объект',
            'registered_object' => 'Регистрируемый объект',
            'commission' => 'Срок ввода в эксплуатацию и изменения к ним',
            'permission' => 'Информация о получение разрешения на ввод объекта в эксплуатацию',
            'registrar' => 'Регистратор (ФИО)',
            'file_name' => 'Файл',
        ];
    }
}
