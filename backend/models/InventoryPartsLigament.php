<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory_parts_ligament".
 *
 * @property integer $id
 * @property string $invnum_inventory
 * @property integer $id_inventory_parts
 * @property integer $amount
 *
 * @property Inventory $invnumInventory
 * @property InventoryParts $idInventoryParts
 */
class InventoryPartsLigament extends \yii\db\ActiveRecord
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
        return 'inventory_parts_ligament';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invnum_inventory', 'id_inventory_parts', 'amount_ipl'], 'required'],
            [['invnum_inventory'], 'string'],
            [['id_inventory_parts', 'amount_ipl'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invnum_inventory' => 'Инв. объекта',
            'id_inventory_parts' => 'Запчасть',
            'amount_ipl' => 'Шт.',
            'typepartsName' => 'Тип запчасти'
        ];
    }

    public function getTypepartsName()
    {
        return $this->idInventoryParts->typepartsName;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvnumInventory()
    {
        return $this->hasOne(Inventory::className(), ['invnum' => 'invnum_inventory']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInventoryParts()
    {
        return $this->hasOne(InventoryParts::className(), ['id' => 'id_inventory_parts']);
    }
}
