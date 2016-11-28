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
 * @property string $demanding_invor
 * @property string $date_invor
 * @property string $status_id_invor
 * @property string $active_invor
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
            [['invnum_invor', 'invname_invor', 'ip_invor', 'user_invor', 'demanding_invor', 'date_invor'], 'string'],
            [['status_id_invor', 'active_invor'], 'integer'],
            [['invnum_invor', 'invname_invor', 'status_id_invor'], 'required'],
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
            'demanding_invor' => 'Запросивший',     //поле оказалось не нужным
            'date_invor' => 'Дата обновления',
            'status_id_invor' => 'Статус',
            'active_invor' => 'Активность',
        ];
    }

    public function getStatusOrder()
    {
        return $this->idStatusorderInvor["status_invor"];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPartsorderInvor()
    {
        return $this->hasMany(InventoryPartsorder::className(), ['id_partsorder_invor' => 'id']);
    }

    public function getIdStatusorderInvor()
    {
        return $this->hasOne(InventoryStatusorder::className(), ['id' => 'status_id_invor']);
    }
}
