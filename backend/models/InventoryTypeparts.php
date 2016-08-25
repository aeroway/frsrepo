<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory_typeparts".
 *
 * @property integer $id
 * @property string $name
 *
 * @property InventoryParts[] $inventoryParts
 */
class InventoryTypeparts extends \yii\db\ActiveRecord
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
        return 'inventory_typeparts';
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
    public function getInventoryParts()
    {
        return $this->hasMany(InventoryParts::className(), ['id_typeparts' => 'id']);
    }
}
