<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ab_empl_sys".
 *
 * @property integer $id
 * @property integer $id_empl
 * @property integer $id_status
 * @property integer $id_systems
 *
 * @property AbEmployee $idEmpl
 * @property AbStatus $idStatus
 * @property AbSystems $idSystems
 */
class AbEmplSys extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db3;  
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ab_empl_sys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_empl', 'id_status', 'id_systems'], 'required'],
            [['id_empl', 'id_status', 'id_systems'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_empl' => 'Id Empl',
            'id_status' => 'Id Status',
            'id_systems' => 'Id Systems',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEmpl()
    {
        return $this->hasOne(AbEmployee::className(), ['id' => 'id_empl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatus()
    {
        return $this->hasOne(AbStatus::className(), ['id' => 'id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSystems()
    {
        return $this->hasOne(AbSystems::className(), ['id' => 'id_systems']);
    }
}
