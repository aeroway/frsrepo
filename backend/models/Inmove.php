<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inmove".
 *
 * @property int $id
 * @property int|null $idm_empl
 * @property int|null $idm_doljn
 * @property int|null $idm_otdel
 * @property string|null $doc
 * @property string|null $doc_num
 * @property string|null $doc_date
 * @property string|null $date_in
 * @property string|null $user_in
 * @property float|null $sum
 * @property int|null $del
 * @property string|null $date_start
 * @property string|null $kotrakt_num
 * @property string|null $kotrakt_date
 * @property string|null $date_end
 * @property int|null $type
 * @property int|null $idm_empl_temp_out
 * @property int|null $history
 */
class Inmove extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inmove';
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
            [['idm_empl', 'idm_doljn', 'idm_otdel', 'del', 'type', 'idm_empl_temp_out', 'history'], 'integer'],
            [['doc_date', 'date_in', 'date_start', 'kotrakt_date', 'date_end'], 'safe'],
            [['sum'], 'number'],
            [['doc', 'doc_num', 'user_in', 'kotrakt_num'], 'string', 'max' => 50],
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
            'idm_doljn' => 'Idm Doljn',
            'idm_otdel' => 'Idm Otdel',
            'doc' => 'Doc',
            'doc_num' => 'Doc Num',
            'doc_date' => 'Doc Date',
            'date_in' => 'Date In',
            'user_in' => 'User In',
            'sum' => 'Sum',
            'del' => 'Del',
            'date_start' => 'Date Start',
            'kotrakt_num' => 'Kotrakt Num',
            'kotrakt_date' => 'Kotrakt Date',
            'date_end' => 'Date End',
            'type' => 'Type',
            'idm_empl_temp_out' => 'Idm Empl Temp Out',
            'history' => 'History',
        ];
    }

    public function inmoveEmployee($id) {
        return $this::find()
            ->where(['and', ['idm_empl' => $id], ['del' => 0]])
            ->orderBy(['date_start' => SORT_ASC])
            ->asArray()
            ->all();
    }
}
