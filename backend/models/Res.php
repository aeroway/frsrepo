<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "res".
 *
 * @property int $id
 * @property string|null $fio
 * @property string|null $date_in
 * @property int|null $id_vopros
 * @property int|null $pr
 * @property int|null $id_otvet
 * @property string|null $ip
 * @property int|null $otdel_id
 */
class Res extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'res';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db5');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_in'], 'safe'],
            [['id_vopros', 'pr', 'id_otvet', 'otdel_id'], 'integer'],
            [['fio'], 'string', 'max' => 100],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'date_in' => 'Дата',
            'id_vopros' => 'Id Vopros',
            'pr' => 'Правильные',
            'id_otvet' => 'Id Otvet',
            'ip' => 'IP',
            'otdel_id' => 'Otdel ID',
        ];
    }

    public function testingResult()
    {
        return $this::find()
            ->select('SUM(otvet.pr) AS pr')
            //->asArray()
            ->innerJoin('otvet', 'otvet.id = res.id_otvet')
            ->where(['and',
                ['=', 'otvet.pr', 1],
                ['<=', 'date_in', date("Y-m-d 23:59:59.999")],
                ['>=', 'date_in', date("Y-m-d 00:00:00.000")],
                ['fio' => empty(Yii::$app->user->identity->fio) ? Yii::$app->user->identity->username : Yii::$app->user->identity->fio]
            ])
            ->groupBy('otvet.pr')
            ->one();
    }

    public function testingResultSection($id)
    {
        return $this::find()
            ->select('CAST(res.date_in AS DATE) date_in, res.fio, SUM(otvet.pr) AS pr')
            ->innerJoin('otvet', 'otvet.id = res.id_otvet')
            ->where(['and',
                ['<>', 'otvet.pr', 0],
                ['otdel_id' => $id],
            ])
            ->groupBy('CAST(res.date_in AS DATE), res.fio, otvet.pr');
    }

    public function checkHourLimit()
    {
        $res = $this::find()
            ->select('date_in')
            ->where(['and',
                ['=', 'fio', empty(Yii::$app->user->identity->fio) ? Yii::$app->user->identity->username : Yii::$app->user->identity->fio],
                ['date_res' => date("Y-m-d")],
            ])
            ->orderBy(['id' => SORT_ASC])
            ->one();

        if (!empty($res->date_in) && date("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime($res->date_in . "+1 hour"))) {
            return false;
        }

        return true;
    }
}