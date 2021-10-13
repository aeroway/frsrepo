<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory_repair_log".
 *
 * @property int $id
 * @property string|null $area
 * @property string|null $name
 * @property string|null $invnum
 * @property string|null $inventory_moo
 * @property string|null $inventory_status
 * @property string|null $note
 * @property string|null $date_edit
 * @property string|null $email
 * @property int $inventory_repair_id
 *
 * @property InventoryRepair $inventoryRepair
 */
class InventoryRepairLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory_repair_log';
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
            [['date_edit'], 'safe'],
            [['inventory_repair_id'], 'required'],
            [['inventory_repair_id'], 'default', 'value' => null],
            [['inventory_repair_id'], 'integer'],
            [['area', 'name', 'inventory_moo', 'inventory_status', 'username'], 'string', 'max' => 150],
            [['invnum'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 2048],
            [['email'], 'string', 'max' => 100],
            [['inventory_repair_id'], 'exist', 'skipOnError' => true, 'targetClass' => InventoryRepair::className(), 'targetAttribute' => ['inventory_repair_id' => 'id']],
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
            'date_edit' => 'Редакт.',
            'email' => 'Email',
            'username' => 'Сотрудник',
            'inventory_repair_id' => 'Inventory Repair ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventoryRepair()
    {
        return $this->hasOne(InventoryRepair::className(), ['id' => 'inventory_repair_id']);
    }
}
