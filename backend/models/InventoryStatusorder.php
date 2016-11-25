<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory_statusorder".
 *
 * @property integer $id
 * @property string $status_invor
 *
 * @property InventoryOrder[] $inventoryOrders
 * @property InventoryStatusorder $id0
 * @property InventoryStatusorder $inventoryStatusorder
 */
class InventoryStatusorder extends \yii\db\ActiveRecord
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
        return 'inventory_statusorder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_invor'], 'string'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => InventoryStatusorder::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_invor' => 'Status Invor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventoryOrders()
    {
        return $this->hasMany(InventoryOrder::className(), ['status_id_invor' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(InventoryStatusorder::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventoryStatusorder()
    {
        return $this->hasOne(InventoryStatusorder::className(), ['id' => 'id']);
    }
}
