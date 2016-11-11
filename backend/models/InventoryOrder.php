<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory_order".
 *
 * @property integer $id
 * @property string $invnum_invor
 * @property string $invname_invor
 * @property string $ip_invor
 * @property string $user_invor
 *
 * @property InventoryPartsorder $idPartsorderInvor
 */
class InventoryOrder extends \yii\db\ActiveRecord
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
        return 'inventory_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invnum_invor', 'invname_invor', 'ip_invor', 'user_invor'], 'string'],
			[['invnum_invor', 'invname_invor'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invnum_invor' => 'Инвентарный номер',
            'invname_invor' => 'Тип техники',
            'ip_invor' => 'IP',
            'user_invor' => 'Пользователь',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPartsorderInvor()
    {
        return $this->hasMany(InventoryPartsorder::className(), ['id_partsorder_invor' => 'id']);
    }
}
