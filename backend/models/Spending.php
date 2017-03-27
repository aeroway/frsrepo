<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spending".
 *
 * @property integer $id
 * @property string $type
 * @property string $expense
 *
 * @property PurchasePlan[] $purchasePlans
 */
class Spending extends \yii\db\ActiveRecord
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
        return 'spending';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'expense'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Вид расхода',
            'expense' => 'Статья расхода',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasePlans()
    {
        return $this->hasMany(PurchasePlan::className(), ['st_id' => 'id']);
    }
}
