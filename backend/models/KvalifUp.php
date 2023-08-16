<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kvalif_up".
 *
 * @property int $id
 * @property string|null $data_start
 * @property string|null $data_end
 * @property int|null $vid_id
 * @property string|null $obr_uch
 * @property string|null $dok_type
 * @property string|null $dok_ser
 * @property string|null $dok_num
 * @property string|null $osnovanie
 * @property int|null $prikaz_id
 * @property int|null $empl_idm
 * @property int|null $del
 * @property string|null $tema
 */
class KvalifUp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kvalif_up';
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
            [['data_start', 'data_end'], 'safe'],
            [['vid_id', 'prikaz_id', 'empl_idm', 'del'], 'integer'],
            [['obr_uch'], 'string', 'max' => 250],
            [['dok_type', 'osnovanie'], 'string', 'max' => 50],
            [['dok_ser'], 'string', 'max' => 5],
            [['dok_num'], 'string', 'max' => 20],
            [['tema'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_start' => 'Data Start',
            'data_end' => 'Data End',
            'vid_id' => 'Vid ID',
            'obr_uch' => 'Obr Uch',
            'dok_type' => 'Dok Type',
            'dok_ser' => 'Dok Ser',
            'dok_num' => 'Dok Num',
            'osnovanie' => 'Osnovanie',
            'prikaz_id' => 'Prikaz ID',
            'empl_idm' => 'Empl Idm',
            'del' => 'Del',
            'tema' => 'Tema',
        ];
    }

    public function kvalifUp($id)
    {
        return $this::find()
            ->select(["data_start", "data_end", "obr_uch", "tema"])
            ->where(['and', ['empl_idm' => $id], ['del' => 0]])
            ->orderBy(['data_start' => SORT_ASC])
            ->asArray()
            ->all();
    }
}
