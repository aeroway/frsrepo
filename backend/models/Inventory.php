<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property integer $id
 * @property string $name
 * @property string $invnum
 * @property integer $id_moo
 * @property string $location
 * @property integer $id_typetech
 * @property string $date
 * @property integer $id_status
 * @property string $comment
 * @property integer $authority
 * @property integer $waybill
 * @property string $username
 *
 * @property InventoryMoo $idMoo
 * @property InventoryStatus $idStatus
 * @property InventoryTypetech $idTypetech
 * @property InventoryPartsLigament[] $inventoryPartsLigaments
 */
class Inventory extends \yii\db\ActiveRecord
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
        return 'inventory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invname', 'invnum', 'id_moo', 'location', 'id_typetech', 'date', 'id_status', 'comment', 'authority', 'waybill'], 'required'],
            [['invname', 'invnum', 'location', 'comment', 'username'], 'string'],
            [['id_moo', 'id_typetech', 'id_status', 'authority', 'waybill'], 'integer'],
            [['date'], 'safe'],
            [['invnum'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invname' => 'Название',
            'invnum' => 'Инв. номер',
            'id_moo' => 'Материальноответственный',
            'location' => 'Локация',
            'id_typetech' => 'Тип',
            'date' => 'Дата',
            'id_status' => 'Статус',
            'comment' => 'Комментарий',
            'authority' => 'Доверенность',
            'waybill' => 'Накладная',
            'username' => 'Пользователь',
			'idMoo.name' => 'Ответственный',
			'idStatus.name' => 'Статус',
			'idTypetech.name' => 'Тип',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMoo()
    {
        return $this->hasOne(InventoryMoo::className(), ['id' => 'id_moo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatus()
    {
        return $this->hasOne(InventoryStatus::className(), ['id' => 'id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTypetech()
    {
        return $this->hasOne(InventoryTypetech::className(), ['id' => 'id_typetech']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventoryPartsLigaments()
    {
        return $this->hasMany(InventoryPartsLigament::className(), ['invnum_inventory' => 'invnum']);
    }
}
