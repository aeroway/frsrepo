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
 * @property double $sum_fact
 * @property double $sum_contract
 * @property string $name_doc
 * @property string $date_doc
 * @property string $date_exp_from
 * @property string $date_exp_to
 * @property string $inn
 * @property string $name_org
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
            [['name', 'comment', 'name_doc', 'inn', 'name_org'], 'string'],
            [['sum', 'sum_fact', 'sum_contract'], 'number'],
            [['pm_id'], 'integer'],
            [['pm_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseMethod::className(), 'targetAttribute' => ['pm_id' => 'id']],
            [['pp_id'], 'integer'],
            [['pp_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchasePlan::className(), 'targetAttribute' => ['pp_id' => 'id']],
            [['date_doc', 'date_exp_from', 'date_exp_to'], 'safe'],
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
            'sum_contract' => 'Сумма по контракту',
            'name_doc' => 'Наименование документа',
            'date_doc' => 'Дата документа',
            'date_exp_from' => 'Срок действия с',
            'date_exp_to' => 'Срок действия по',
            'inn' => 'ИНН',
            'name_org' => 'Наименование юр. лица',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if ((
                    PurchasePlan::find()->select('outlay')
                                        ->where(['id' => $this->pp_id])->one()["outlay"] - ((

                    SchedulePlan::find()->select('SUM(sum) as sum')
                                        ->where(['pp_id' => $this->pp_id])->one()["sum"]) - (

                    SchedulePlan::find()->select('sum')
                                        ->where(['id' => $this->id])
                                        ->one()["sum"] - $this->sum))
                ) >= 0 )

                return true;
            else
            {
                Yii::$app->session->setFlash('false', 

                    Yii::$app->params["false"] . (((
                    
                        PurchasePlan::find()->select('outlay')
                                            ->where(['id' => $this->pp_id])
                                            ->one()["outlay"]) - (

                        SchedulePlan::find()->select('SUM(sum) as sum')
                                            ->where(['pp_id' => $this->pp_id])
                                            ->one()["sum"])) + 
                                            
                        SchedulePlan::find()->select('sum')
                                            ->where(['id' => $this->id])
                                            ->one()["sum"]));

                return false;
            }
        }

        return false;
    }

    public function getSumAllField()
    {
        return $this->name_doc
        . ' от '.date('d.m.Y', time($this->date_doc))
        . ' срок действия с ' . date('d.m.Y', time($this->date_exp_from)) 
        . ' по ' . date('d.m.Y', time($this->date_exp_to))          
        . ' ' . $this->name_org;
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
