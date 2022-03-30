<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "education".
 *
 * @property int $id
 * @property string|null $name_vuz
 * @property int|null $napr
 * @property int|null $year_end
 * @property int|null $type_educ
 * @property string|null $doc_ser
 * @property string|null $doc_num
 * @property string|null $doc
 * @property string|null $kvalif
 * @property int|null $del
 * @property int|null $idm_empl
 * @property string|null $date_in
 * @property string|null $tema
 * @property string|null $specualnost
 */
class Education extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'education';
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
            [['napr', 'year_end', 'type_educ', 'del', 'idm_empl'], 'integer'],
            [['date_in'], 'safe'],
            [['name_vuz'], 'string', 'max' => 1024],
            [['doc_ser'], 'string', 'max' => 10],
            [['doc_num'], 'string', 'max' => 20],
            [['doc'], 'string', 'max' => 100],
            [['kvalif', 'tema'], 'string', 'max' => 150],
            [['specualnost'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_vuz' => 'Name Vuz',
            'napr' => 'Napr',
            'year_end' => 'Year End',
            'type_educ' => 'Type Educ',
            'doc_ser' => 'Doc Ser',
            'doc_num' => 'Doc Num',
            'doc' => 'Doc',
            'kvalif' => 'Kvalif',
            'del' => 'Del',
            'idm_empl' => 'Idm Empl',
            'date_in' => 'Date In',
            'tema' => 'Tema',
            'specualnost' => 'Specualnost',
        ];
    }

    public function educationInfo($id)
    {
        return Education::find()
            ->select(["type_educ.text", "name_vuz", "year_end", "specualnost", "kvalif"])
            ->innerJoin('type_educ', 'type_educ.id = education.type_educ')
            ->where(['and', ['idm_empl' => $id], ['del' => 0]])
            ->asArray()
            ->all();
    }
}
