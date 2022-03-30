<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stazh".
 *
 * @property int $id
 * @property int|null $idm_empl
 * @property string|null $date_start
 * @property string|null $date_end
 * @property int|null $sol
 * @property int|null $som
 * @property int|null $sod
 * @property int|null $sgl
 * @property int|null $sgm
 * @property int|null $sgd
 * @property float|null $koef
 * @property string|null $name_org
 * @property string|null $name_dol
 * @property int|null $del
 * @property string|null $date_in
 * @property string|null $user_in
 * @property int|null $gs
 * @property int|null $recalc
 */
class Stazh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stazh';
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
            [['idm_empl', 'sol', 'som', 'sod', 'sgl', 'sgm', 'sgd', 'del', 'gs', 'recalc'], 'integer'],
            [['date_start', 'date_end', 'date_in'], 'safe'],
            [['koef'], 'number'],
            [['name_org', 'name_dol'], 'string', 'max' => 200],
            [['user_in'], 'string', 'max' => 100],
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
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'sol' => 'Sol',
            'som' => 'Som',
            'sod' => 'Sod',
            'sgl' => 'Sgl',
            'sgm' => 'Sgm',
            'sgd' => 'Sgd',
            'koef' => 'Koef',
            'name_org' => 'Name Org',
            'name_dol' => 'Name Dol',
            'del' => 'Del',
            'date_in' => 'Date In',
            'user_in' => 'User In',
            'gs' => 'Gs',
            'recalc' => 'Recalc',
        ];
    }

    public function stazhGs($id) {
        return $this::find()
            ->where(['and', ['idm_empl' => $id], ['del' => 0], ['gs' => 1]])
            ->orderBy(['date_start' => SORT_ASC])
            ->asArray()
            ->all();
    }

    public function stazh($id) {
        return $this::find()
            ->where(['and', ['idm_empl' => $id], ['del' => 0]])
            ->orderBy(['date_start' => SORT_ASC])
            ->asArray()
            ->all();
    }
}
