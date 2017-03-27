<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "purchase_plan".
 *
 * @property integer $id
 * @property string $type
 * @property string $okpd
 * @property string $name_object
 * @property double $outlay
 * @property double $p_year
 * @property double $c_year
 * @property double $special
 * @property double $sum
 * @property integer $st_id
 * @property safe $year
 *
 * @property SchedulePlan $pp
 */
class PurchasePlan extends \yii\db\ActiveRecord
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
        return 'purchase_plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year'], 'required'],
            [['st_id'], 'integer'],
            [['type', 'okpd', 'name_object'], 'string'],
            [['outlay', 'p_year', 'c_year', 'special', 'sum', 'year'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'okpd' => 'ОКПД',
            'name_object' => 'Название',
            'outlay' => 'Смета',
            'p_year' => 'Прошлый год',
            'c_year' => 'Текущий год',
            'special' => 'Особые закупки',
            'sum' => 'Всего',
            'year' => 'Год ПЗ',
            'st_id' => 'st_id',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if((
                    Lbo::find()->select('SUM(sum) as sum')->where(['year' => $this->year])->one()["sum"] - 
                    (PurchasePlan::find()->select('SUM(outlay) as outlay')->where(['year' => $this->year])->one()["outlay"] - (PurchasePlan::find()->select('SUM(outlay) as outlay')->where(['id' => $this->id])->one()["outlay"] - $this->outlay))
                ) >= 0 )

                return true;
            else
            {
                Yii::$app->session->setFlash('false', Yii::$app->params["false"] . (Lbo::find()->select('SUM(sum) as sum')->where(['year' => $this->year])->one()["sum"] - (PurchasePlan::find()->select('SUM(outlay) as outlay')->where(['year' => $this->year])->one()["outlay"] - PurchasePlan::find()->select('SUM(outlay) as outlay')->where(['id' => $this->id])->one()["outlay"])));

                return false;
            }
        }

        return false;
    }

    public function sumSp()
    {
        
        return '!!!';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasePlans()
    {
        return $this->hasMany(SchedulePlan::className(), ['pp_id' => 'id']);
    }
}
