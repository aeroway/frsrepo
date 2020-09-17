<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rst_enf_proc".
 *
 * @property int $id
 * @property int|null $otdel_id
 * @property string|null $num_req
 * @property string|null $agency
 * @property string|null $num_enf_proc
 * @property string|null $decision
 * @property string|null $num_notice
 * @property string|null $num_appeal
 * @property string|null $date_edit
 * @property string|null $username
 */
class RstEnfProc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rst_enf_proc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['otdel_id'], 'integer'],
            [['date_edit'], 'safe'],
            [['num_req', 'decision', 'username'], 'string', 'max' => 50],
            [['agency', 'num_enf_proc', 'num_notice', 'num_appeal', 'result', 'comment'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'otdel_id' => 'Структурное подразделение УР',
            'num_req' => 'Номер обращения',
            'agency' => 'Орган',
            'num_enf_proc' => 'Номер ИП',
            'decision' => 'Принятое решение',
            'num_notice' => 'Номер и дата уведомления',
            'num_appeal' => 'Обращение в суд',
            'date_edit' => 'Дата ред.',
            'username' => 'Сотрудник',
            'result' => 'Результат',
            'comment' => 'Принятые меры',
        ];
    }

    public function getOtdel()
    {
        return $this->hasOne(Otdel::className(), ['id' => 'otdel_id']);
    }
}
