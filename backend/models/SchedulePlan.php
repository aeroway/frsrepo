<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "schedule_plan".
 *
 * @property integer $id
 * @property string $name
 * @property double $sum
 * @property string $comment
 * @property integer $pm_id
 *
 * @property PurchasePlan[] $purchasePlans
 * @property PurchaseMethod $pm
 */
class SchedulePlan extends \yii\db\ActiveRecord
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
        return 'schedule_plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'comment'], 'string'],
            [['sum', 'sum_fact'], 'number'],
            [['pm_id'], 'integer'],
            [['pm_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseMethod::className(), 'targetAttribute' => ['pm_id' => 'id']],
            [['pp_id'], 'integer'],
            [['pp_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchasePlan::className(), 'targetAttribute' => ['pp_id' => 'id']],
        ];
    }

    /**3
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'sum' => 'Планируемая сумма',
            'comment' => 'Комментарий',
            'sum_fact' => 'Фактическая сумма',
            'pm_id' => 'Способ закупки',
            'pp_id' => 'План закупок',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if((
                    PurchasePlan::find()->select('outlay')->where(['id' => $this->pp_id])->one()["outlay"] - 
                    ((SchedulePlan::find()->select('SUM(sum) as sum')->where(['pp_id' => $this->pp_id])->one()["sum"]) - (SchedulePlan::find()->select('sum')->where(['id' => $this->id])->one()["sum"] - $this->sum))
                ) >= 0 )

                return true;
            else
            {
                Yii::$app->session->setFlash('false', Yii::$app->params["false"] . (((PurchasePlan::find()->select('outlay')->where(['id' => $this->pp_id])->one()["outlay"]) -
                (SchedulePlan::find()->select('SUM(sum) as sum')->where(['pp_id' => $this->pp_id])->one()["sum"])) + SchedulePlan::find()->select('sum')->where(['id' => $this->id])->one()["sum"]));

                return false;
            }
        }

        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPm()
    {
        return $this->hasOne(PurchaseMethod::className(), ['id' => 'pm_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPp()
    {
        return $this->hasOne(PurchasePlan::className(), ['id' => 'pp_id']);
    }
}
