<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spartakiad_rating".
 *
 * @property int $id
 * @property int $department_id
 * @property int $score1
 * @property int $score2
 * @property int $score3
 * @property int $score4
 * @property int $score5
 * @property int $score6
 *
 * @property SpartakiadDepartment $department
 */
class SpartakiadRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spartakiad_rating';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db10');
    }

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['sumScore']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id'], 'required'],
            [['department_id', 'score1', 'score2', 'score3', 'score4', 'score5', 'score6'], 'default', 'value' => null],
            [['department_id', 'score1', 'score2', 'score3', 'score4', 'score5', 'score6', 'sumScore'], 'integer'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpartakiadDepartment::class, 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_id' => 'Управление',
            'score1' => 'Конкурс капитанов',
            'score2' => 'Шахматы',
            'score3' => 'Стритбол (жен)',
            'score4' => 'Минифутбол (муж)',
            'score5' => 'Эстафета',
            'score6' => 'Дартс',
            'sumScore' => 'Итог',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(SpartakiadDepartment::class, ['id' => 'department_id']);
    }
}
