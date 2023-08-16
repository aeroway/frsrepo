<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otchetpriost".
 *
 * @property int $id
 * @property string|null $description
 * @property string|null $offer
 * @property string|null $comment
 * @property string|null $fio_sro
 * @property string|null $kuvd
 * @property string|null $date
 * @property string|null $username
 * @property string|null $status
 * @property int|null $flag
 * @property string|null $filename
 * @property string|null $date_update
 * @property string|null $date_load
 * @property string|null $executor
 * @property int|null $area_id
 * @property string|null $urd
 * @property string|null $date_suspend
 * @property int|null $mark_id
 *
 * @property Area $area
 * @property OtchetpriostMarks $mark
 * @property OtchetpriostSuspension[] $otchetpriostSuspensions
 */
class Otchetpriost extends \yii\db\ActiveRecord
{
    public $suspensionId;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otchetpriost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['area_id', 'kuvd', 'description', 'offer', 'executor', 'date_suspend', 'urd', 'suspensionId'], 'required'],
            [['fio_sro'], 'required', 'when' => function($model) {
                return ($model->mark_id == 4 && empty($model->fio_sro));
            }, 'whenClient' => "function (attribute, value) {
                if ($('#otchetpriost-mark_id').val() == 4 && $('#otchetpriost-fio_sro').val().length == 0) {
                    $('.field-otchetpriost-fio_sro').addClass('has-error').find('.help-block-error').text( 'Необходимо заполнить поле «ФИО инж/СРО/тел»');
                    return true;
                } else { 
                    $('.field-otchetpriost-fio_sro').removeClass('has-error').find('.help-block-error').text('');
                    return false;
                }
            }", 'message' => 'Необходимо заполнить поле «ФИО инж/СРО/тел»'],

            [['date', 'date_update', 'date_load', 'suspensionId', 'date_suspend'], 'safe'],
            [['flag', 'area_id', 'mark_id'], 'integer'],
            [['description', 'offer', 'username', 'executor'], 'string', 'max' => 100],
            [['comment', 'fio_sro'], 'string', 'max' => 2048],
            [['kuvd'], 'string', 'max' => 60],
            [['status'], 'string', 'max' => 25],
            [['filename'], 'string', 'max' => 50],
            [['urd'], 'string', 'max' => 5],
            [['mark_id'], 'exist', 'skipOnError' => true, 'targetClass' => OtchetpriostMarks::className(), 'targetAttribute' => ['mark_id' => 'id']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => AreaOtchet::className(), 'targetAttribute' => ['area_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Краткое описание',
            'offer' => 'Предпринятые меры',
            'comment' => 'Комментарий',
            'fio_sro' => 'ФИО инж/СРО/тел',
            'kuvd' => '№ обращения',
            'date' => 'Дата',
            'date_suspend' => 'Приостановка',
            'urd' => 'УРД',
            'username' => 'Пользователь',
            'status' => 'Статус',
            'flag' => 'Метка',
            'filename' => 'Файл',
            'date_update' => 'Обновление',
            'date_load' => 'Загружено',
            'executor' => 'Регистратор',
            'suspensionId' => 'Статья приостановки',
            'suspensionAsString' => 'Статья приостановки',
            'area_id' => 'Тер. отдел',
            'mark_id' => 'Особые отметки',
        ];
    }

    /**
     * Gets query for [[Area]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(AreaOtchet::className(), ['id' => 'area_id']);
    }

    /**
     * Gets query for [[Mark]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMark()
    {
        return $this->hasOne(OtchetpriostMarks::className(), ['id' => 'mark_id']);
    }

    /**
     * Gets query for [[OtchetpriostSuspensions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOtchetpriostSuspensions()
    {
        return $this->hasMany(OtchetpriostSuspension::className(), ['otchetpriost_id' => 'id']);
    }

    public function getSuspensionArticles()
    {
        return $this->hasMany(SuspensionArticles::className(), ['id' => 'suspension_articles_id'])->via('otchetpriostSuspensions');
    }

    public function getSuspensionAsString()
    {
        $suspensionArticles = \yii\helpers\ArrayHelper::map($this->suspensionArticles, 'id', 'name');

        return implode(", \n\r", $suspensionArticles);
    }

    public function afterFind()
    {
        $this->suspensionId = $this->suspensionArticles;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $suspensionArticles = \yii\helpers\ArrayHelper::map($this->suspensionArticles, 'id', 'id');

        foreach ($this->suspensionId as $id) {
            if (!in_array($id, $suspensionArticles)) {
                $model = new OtchetpriostSuspension();
                $model->otchetpriost_id = $this->id;
                $model->suspension_articles_id = $id;
                $model->save();
            }

            if (isset($suspensionArticles[$id])) {
                unset($suspensionArticles[$id]);
            }
        }

        OtchetpriostSuspension::deleteAll(['otchetpriost_id' => $this->id, 'suspension_articles_id' => $suspensionArticles]);
    }
}