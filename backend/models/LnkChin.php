<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lnk_chin".
 *
 * @property int $id
 * @property int|null $idm_empl
 * @property int|null $idm_type_chin
 * @property string|null $doc
 * @property string|null $doc_num
 * @property string|null $doc_date
 * @property string|null $date_in
 * @property string|null $user_in
 * @property int|null $del
 * @property string|null $date_start
 */
class LnkChin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lnk_chin';
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
            [['idm_empl', 'idm_type_chin', 'del'], 'integer'],
            [['doc_date', 'date_in', 'date_start'], 'safe'],
            [['doc'], 'string', 'max' => 150],
            [['doc_num'], 'string', 'max' => 10],
            [['user_in'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idm_empl' => 'Idm Empl',
            'idm_type_chin' => 'Idm Type Chin',
            'doc' => 'Doc',
            'doc_num' => 'Doc Num',
            'doc_date' => 'Doc Date',
            'date_in' => 'Date In',
            'user_in' => 'User In',
            'del' => 'Del',
            'date_start' => 'Date Start',
        ];
    }

    public function lnkChin($id)
    {
        return $this::find()
            ->select(["type_chin.text", "date_start"])
            ->where(['and', ['idm_empl' => $id], ['del' => 0]])
            ->innerJoin('type_chin', 'type_chin.id = lnk_chin.idm_type_chin')
            ->orderBy(['date_start' => SORT_DESC])
            ->asArray()
            ->one();
    }
}
