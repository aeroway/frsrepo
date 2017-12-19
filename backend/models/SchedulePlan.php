<?php

namespace backend\models;

use backend\models\PurchasePlan;

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
    public static $spendingEId;
    public static $spendingResult;
    public static $schedulePlanSum;
    public static $schedulePlanSumfact;
    
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
                    PurchasePlan::find()
                        ->select('outlay')
                        ->where(['id' => $this->pp_id])
                        ->one()["outlay"] - ((

                    SchedulePlan::find()
                        ->select('SUM(sum) as sum')
                        ->where(['pp_id' => $this->pp_id])
                        ->one()["sum"]) - (

                    SchedulePlan::find()
                        ->select('sum')
                        ->where(['id' => $this->id])
                        ->one()["sum"] - $this->sum))
                ) >= 0 )

                return true;
            else
            {
                Yii::$app->session->setFlash('false', 

                    Yii::$app->params["false"] . (((

                        PurchasePlan::find()
                            ->select('outlay')
                            ->where(['id' => $this->pp_id])
                            ->one()["outlay"]) - (

                        SchedulePlan::find()
                            ->select('SUM(sum) as sum')
                            ->where(['pp_id' => $this->pp_id])
                            ->one()["sum"])) + 
                                            
                        SchedulePlan::find()
                            ->select('sum')
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
        . ($this->date_doc ? ' от ' . Yii::$app->formatter->asDate($this->date_doc) : '')
        . ($this->date_exp_from ? ' срок действия с ' . Yii::$app->formatter->asDate($this->date_exp_from) : '')
        . ($this->date_exp_to ? ' по ' . Yii::$app->formatter->asDate($this->date_exp_to) : '')
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
        return $this->hasOne(PurchasePlan::className(), ['f_row' => 'pp_id']);
    }

    public static function spendingEconom($id)
    {
        if(SchedulePlan::$spendingEId and SchedulePlan::$spendingEId === $id)
        {
            return SchedulePlan::$spendingResult;
        }
        else
        {
            SchedulePlan::$spendingEId = $id;
            SchedulePlan::$spendingResult = 
                SchedulePlan::find()
                    ->select('SUM(sum) as sum')
                    ->where(['IN', 'pp_id', 
                        PurchasePlan::find()
                            ->select('id')
                            ->where(['st_id' => $id])])
                            ->one()["sum"] - 
                        SchedulePlan::find()
                            ->select('SUM(sum_fact) as sum_fact')
                            ->where(['IN', 'pp_id', 
                                PurchasePlan::find()
                                    ->select('id')
                                    ->where(['st_id' => $id])])
                                    ->one()["sum_fact"];
        }

        return SchedulePlan::$spendingResult;
    }

    public static function getSpendingSum($name, $id)
    {
        return SchedulePlan::find()
            ->select('SUM(' . $name . ') as ' . $name . '')
            ->where(['IN', 'pp_id', 
                PurchasePlan::find()
                    ->select('id')
                    ->where(['and', ['st_id' => $id], ['is_top' => '1']])
            ])
            ->one()["$name"];
    }

    public static function schedulePlanSum($sid)
    {
        if(!SchedulePlan::$schedulePlanSum)
            SchedulePlan::$schedulePlanSum = 
                SchedulePlan::find()
                    ->select('SUM(sum) as sum')
                    ->where(['pp_id' => $sid])
                    ->one()["sum"];

        return SchedulePlan::$schedulePlanSum;
    }

    public static function schedulePlanSumfact($sid)
    {
        if(!SchedulePlan::$schedulePlanSumfact)
            SchedulePlan::$schedulePlanSumfact = 
                SchedulePlan::find()
                    ->select('SUM(sum_fact) as sum_fact')
                    ->where(['pp_id' => $sid])
                    ->one()["sum_fact"];

        return SchedulePlan::$schedulePlanSumfact;
    }

    public static function getschedulePlanSumi($name, $id)
    {
        return SchedulePlan::find()
            ->select('SUM(' . $name . ') as ' . $name . '')
            ->where(['and', ['pp_id' => $id]])
            ->andWhere('sum_fact is not null')
            ->one()["$name"];
    }

    public static function getSpendingIndexSum($id)
    {
        return SchedulePlan::find()
            ->select('SUM(sum) as sum')
            ->where(['IN', 'pp_id', PurchasePlan::find()->select('id')->where(['st_id' => $id])])
            ->andWhere('sum_fact is not null')
            ->one()["sum"];
    }
}
