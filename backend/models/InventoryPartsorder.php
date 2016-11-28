<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory_partsorder".
 *
 * @property integer $id
 * @property string $partsname_invpo
 * @property integer $count_invpo
 * @property integer $id_partsorder_invor
 *
 * @property InventoryOrder[] $inventoryOrders
 */
class InventoryPartsorder extends \yii\db\ActiveRecord
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
        return 'inventory_partsorder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partsname_invpo', 'count_invpo'], 'required'],
            [['partsname_invpo'], 'string'],
            [['count_invpo', 'id_partsorder_invor'], 'integer'],
            [['id_partsorder_invor'], 'exist', 'skipOnError' => true, 'targetClass' => InventoryOrder::className(), 'targetAttribute' => ['id_partsorder_invor' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partsname_invpo' => 'Наименование',
            'count_invpo' => 'Количество',
            'id_partsorder_invor' => 'Id Partsorder Invor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventoryOrders()
    {
        return $this->hasOne(InventoryOrder::className(), ['id' => 'id_partsorder_invor']);
    }
}
