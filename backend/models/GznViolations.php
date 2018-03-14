<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gzn_violations".
 *
 * @property int $id
 * @property int $gzn_obj_id
 * @property string $decision_punishment
 * @property string $date_due
 * @property double $violation_area
 * @property double $amount_fine
 * @property double $amount_fine_collected
 * @property string $payment_doc
 * @property string $decision_cancellation
 * @property string $decision_appeal
 * @property string $date_performance
 * @property string $date_outgoing
 * @property string $violation_decision_end
 * @property string $violation_protocol
 * @property int $adm_punishment_id
 * @property int $types_punishment_id
 *
 * @property GznInjunction[] $gznInjunctions
 * @property GznObject $gznObj
 * @property GznAdmPunishment $admPunishment
 * @property GznTypesPunishment $typesPunishment
 */
class GznViolations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gzn_violations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_due', 'violation_decision_end', 'decision_cancellation', 'decision_appeal', 'decision_punishment', 'violation_protocol', 'date_outgoing', 'date_performance', ], 'date', 'format' => 'Y-m-d'],
            [['gzn_obj_id', 'adm_punishment_id', 'types_punishment_id'], 'integer'],
            [['payment_doc'], 'string'],
            [['date_due', 'date_performance', 'date_outgoing', 'violation_protocol', 'decision_punishment', 'decision_appeal', 'decision_cancellation', 'violation_decision_end'], 'safe'],
            [['violation_area', 'amount_fine', 'amount_fine_collected'], 'double'],
            [['gzn_obj_id'], 'exist', 'skipOnError' => true, 'targetClass' => GznObject::className(), 'targetAttribute' => ['gzn_obj_id' => 'id']],
            [['adm_punishment_id'], 'exist', 'skipOnError' => true, 'targetClass' => GznAdmPunishment::className(), 'targetAttribute' => ['adm_punishment_id' => 'id']],
            [['types_punishment_id'], 'exist', 'skipOnError' => true, 'targetClass' => GznTypesPunishment::className(), 'targetAttribute' => ['types_punishment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gzn_obj_id' => 'Объект проверки',
            'decision_punishment' => 'Постановление по делу об административном правонарушении',
            'date_due' => 'Срок оплаты',
            'amount_fine' => 'Размер штрафа',
            'violation_area' => 'S наруш. (кв.м.)',
            'amount_fine_collected' => 'Сумма взысканного штрафа',
            'payment_doc' => '№ платёжного поручения',
            'decision_cancellation' => 'Отмена постановления',
            'decision_appeal' => 'Обжалование постановления',
            'date_performance' => 'ФССП дата исполнения',
            'date_outgoing' => 'ФССП № и дата исх.',
            'violation_decision_end' => 'Постановление о прекращении',
            'violation_protocol' => 'Протокол об административном нарушении',
            'adm_punishment_id' => 'Административное наказание',
            'types_punishment_id' => 'Вид административного наказания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznObject()
    {
        return $this->gznObj->landUserCategory->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznInjunctions()
    {
        return $this->hasMany(GznInjunction::className(), ['gzn_violations_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznObj()
    {
        return $this->hasOne(GznObject::className(), ['id' => 'gzn_obj_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmPunishment()
    {
        return $this->hasOne(GznAdmPunishment::className(), ['id' => 'adm_punishment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypesPunishment()
    {
        return $this->hasOne(GznTypesPunishment::className(), ['id' => 'types_punishment_id']);
    }
}
