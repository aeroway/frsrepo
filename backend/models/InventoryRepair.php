<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory_repair".
 *
 * @property int $id
 * @property string $area
 * @property string $name
 * @property string $invnum
 * @property string $inventory_moo
 * @property string $inventory_status
 * @property string $note
 */
class InventoryRepair extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory_repair';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db4');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['area', 'name', 'inventory_moo', 'inventory_status'], 'string', 'max' => 150],
            [['invnum'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 2048],
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
            'name' => 'Название',
            'invnum' => 'Инв. номер',
            'inventory_moo' => 'МО',
            'inventory_status' => 'Статус',
            'note' => 'Комментарий',
        ];
    }
}
