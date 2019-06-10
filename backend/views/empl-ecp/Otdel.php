<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otdel".
 *
 * @property integer $id
 * @property string $text
 * @property integer $ind
 *
 * @property Rm#mol[] $rm#mols
 */
class Otdel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otdel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['ind'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'ind' => 'Ind',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	/* Сгенерил какую-то хзшную связь с хзшной таблицей
    public function getRm#mols()
    {
        return $this->hasMany(Rm#mol::className(), ['idm_otdel' => 'id']);
    }
	*/
}