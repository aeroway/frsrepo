<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory_parts".
 *
 * @property integer $id
 * @property string $nameparts
 * @property integer $id_typeparts
 * @property integer $amount
 * @property string $location
 *
 * @property InventoryTypeparts $idTypeparts
 * @property InventoryPartsLigament[] $inventoryPartsLigaments
 */
class InventoryParts extends \yii\db\ActiveRecord
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
        return 'inventory_parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameparts', 'id_typeparts', 'amount', 'location'], 'required'],
            [['nameparts', 'location', 'comment_parts'], 'string'],
            [['id_typeparts', 'amount'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nameparts' => 'Название',
            'id_typeparts' => 'Тип запчасти',
            'amount' => 'Количество',
            'location' => 'Локация',
            'comment_parts' => 'Коммент',
        ];
    }

    public function getTypepartsName()
    {
        return $this->idTypeparts->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTypeparts()
    {
        return $this->hasOne(InventoryTypeparts::className(), ['id' => 'id_typeparts']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventoryPartsLigaments()
    {
        return $this->hasMany(InventoryPartsLigament::className(), ['id_inventory_parts' => 'id']);
    }
}
