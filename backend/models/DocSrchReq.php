<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "doc_srch_req".
 *
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property int $subdivision_id
 * @property string $date_update
 * @property string|null $username
 * @property string|null $answer
 * @property string $req_num
 *
 * @property Subdivision $subdivision
 */
class DocSrchReq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc_srch_req';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db10');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'email', 'subdivision_id', 'req_num'], 'required'],
            [['email'], 'email'],
            [['subdivision_id'], 'default', 'value' => null],
            [['subdivision_id'], 'integer'],
            [['date_update'], 'safe'],
            [['full_name', 'email', 'username', 'req_num'], 'string', 'max' => 256],
            [['answer'], 'string', 'max' => 512],
            [['subdivision_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subdivision::className(), 'targetAttribute' => ['subdivision_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Имя',
            'email' => 'E-mail',
            'subdivision_id' => 'Подразделение',
            'date_update' => 'Дата корректировки',
            'username' => 'Сотрудник',
            'answer' => 'Ответ',
            'req_num' => 'Номер обращения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubdivision()
    {
        return $this->hasOne(Subdivision::className(), ['id' => 'subdivision_id']);
    }
}
