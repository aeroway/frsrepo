<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gzn_injunction".
 *
 * @property integer $id
 * @property integer $count_term_execution
 * @property string $act_checking
 * @property string $not_done
 * @property string $repeated
 * @property string $decision_judge
 * @property string $date_protocol
 * @property string $decision_judge_j
 * @property string $disobedience
 * @property integer $gzn_violations_id
 *
 * @property GznViolations $gznViolations
 */
class GznInjunction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gzn_injunction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gzn_violations_id'], 'integer'],
            [['act_checking', 'decision_judge_j', 'disobedience'], 'string'],
            [['date_protocol', 'count_term_execution', 'not_done', 'repeated', 'decision_judge'], 'safe'],
            [['gzn_violations_id'], 'exist', 'skipOnError' => true, 'targetClass' => GznViolations::className(), 'targetAttribute' => ['gzn_violations_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'count_term_execution' => 'Дата выдачи предписания',
            'not_done' => 'Срок исполнения предписания',
            'act_checking' => 'Акт проверки исполнения предписания',
            'repeated' => 'Протокол по ст. 19.5 ч.25 КоАП РФ',
            'decision_judge' => 'Протокол по ст. 19.5 ч.26 КоАП РФ',
            'date_protocol' => 'Дата решения суда',
            'decision_judge_j' => 'Вид административного наказания',
            'disobedience' => 'Взыскание',
            'gzn_violations_id' => 'Нарушение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznViolations()
    {
        return $this->hasOne(GznViolations::className(), ['id' => 'gzn_violations_id']);
    }
}
