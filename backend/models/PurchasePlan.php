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
 * @property integer $is_top
 * @property integer $f_row
 * @property integer $is_percent
 * @property string $year
 * @property safe $econom
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
            [['econom'], 'safe'],
            [['st_id', 'is_top', 'f_row', 'is_percent'], 'integer'],
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
            'econom' => 'Экономия',
            'name_object' => 'Название',
            'outlay' => 'Смета',
            'p_year' => 'Прошлый год',
            'c_year' => 'Текущий год',
            'special' => 'Особые закупки',
            'sum' => 'Всего',
            'year' => 'Год ПЗ',
            'is_top' => 'is top',
            'st_id' => 'st_id',
            'f_row' => 'f row',
            'is_percent' => '5%',
            'parentRows' => 'Экономия',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if ((
                    Lbo::find()->select('SUM(sum) as sum')
                               ->where(['year' => $this->year])
                               ->one()["sum"] - (

                               self::find()->select('SUM(outlay) as outlay')
                                           ->where(['year' => $this->year])
                                           ->one()["outlay"] - (

                               self::find()->select('SUM(outlay) as outlay')
                                           ->where(['id' => $this->id])
                                           ->one()["outlay"] - $this->outlay))
                ) >= 0 )
            {
                if ($this->id !== 0) {
                    if (self::UpdateAll(['is_top' => 0], ['st_id' => $this->st_id, 'f_row' => $this->f_row]))

                    return true;
                }

                return true;
            }
            else
            {
                Yii::$app->session->setFlash('false',

                    Yii::$app->params["false"] . (

                        Lbo::find()->select('SUM(sum) as sum')
                                   ->where(['year' => $this->year])
                                   ->one()["sum"] - (

                        self::find()->select('SUM(outlay) as outlay')
                                            ->where(['year' => $this->year])
                                            ->one()["outlay"] -

                        self::find()->select('SUM(outlay) as outlay')
                                            ->where(['id' => $this->id])
                                            ->one()["outlay"])));

                return false;
            }
        }

        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        //Без этой строчки потеряется связь в SchedulePlan: дочерние объекты закрепляются за вновь созданным родителем
        SchedulePlan::UpdateAll(['pp_id' => Yii::$app->db6->getLastInsertID()], ['pp_id' => Yii::$app->request->queryParams["sid"]]);

        //Историческая свзяь в PurchasePlan
        PurchasePlan::UpdateAll(['f_row' => Yii::$app->db6->getLastInsertID()], ['id' => Yii::$app->request->queryParams["sid"]]);
    }

    public function getSumSp()
    {
        $str = self::find()->select('outlay')
                           ->where(['and', ['f_row' => $this->f_row], ['is_top' => 0]])
                           ->orderBy('id DESC')
                           ->one()["outlay"];

        if (!empty($str) and $this->outlay == $str)
            return $this->outlay;

        if (!empty($str))
            return '<b>' . $this->outlay . '</b>' . '<br><sub>' . $str . '</sub>';

        return $this->outlay;
    }

    public function getParentRows()
    {
        if(empty($this->econom))
            return '';

        $out = '';
        $array = explode(',', $this->econom);

        for ($i = 0; $i <= count($array)-1; $i++)
        {
            $data = self::find()->where(['id' => $array[$i]])->one();
            $out .= $data->okpd . ' - ' . $data->name_object . '; ';
        }

        return $out;
    }

    public function getParentRowsAsArray()
    {
        $out = array();
        $array = explode(',', $this->econom);

        for ($i=0; $i <= count($array)-1; $i++)
        {
            $data = self::find()->where(['id' => $array[$i]])->one();
            $out[$array[$i]] = $data->okpd . ' - ' . $data->name_object;
        }

        return $out;
    }

    public static function getPurchasePlanSum($name, $id)
    {
        return PurchasePlan::find()
            ->select('SUM(' . $name . ') as ' . $name . '')
            ->where(['and', ['st_id' => $id], ['is_top' => '1']])
            ->one()["$name"];
    }

    public static function getPurchasePlanSumSpecial($id)
    {
        return PurchasePlan::find()
                ->select('(ISNULL(p_year, 0) + ISNULL(c_year, 0) + ISNULL(special, 0)) as [sum]')
                ->where(['id' => $id])
                ->one()["sum"];
    }

    public static function getSpendingIndexOutlay($id)
    {
        return PurchasePlan::find()->select('SUM(outlay) as outlay')->where(['st_id' => $id])->one()["outlay"];
    }

    public static function getSpendingIndexSum($id)
    {
        return PurchasePlan::find()->select('SUM(sum) as sum')->where(['st_id' => $id])->one()["sum"];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasePlans()
    {
        return $this->hasMany(SchedulePlan::className(), ['pp_id' => 'id']);
    }
}
