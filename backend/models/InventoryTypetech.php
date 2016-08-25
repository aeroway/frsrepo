<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory_typetech".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Inventory[] $inventories
 */
class InventoryTypetech extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db4;  
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventory_typetech';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventories()
    {
        return $this->hasMany(Inventory::className(), ['id_typetech' => 'id']);
    }
}
