<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "purchase_method".
 *
 * @property integer $id
 * @property string $name
 *
 * @property PurchaseMethod $id0
 * @property PurchaseMethod $purchaseMethod
 * @property SchedulePlan[] $schedulePlans
 */
class PurchaseMethod extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db6;  
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseMethod::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedulePlans()
    {
        return $this->hasMany(SchedulePlan::className(), ['pm_id' => 'id']);
    }
}
