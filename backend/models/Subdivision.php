<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subdivision".
 *
 * @property int $id
 * @property string $name
 *
 * @property DocSrchReq[] $docSrchReqs
 */
class Subdivision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subdivision';
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Подразделение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocSrchReqs()
    {
        return $this->hasMany(DocSrchReq::className(), ['subdivision_id' => 'id']);
    }
}
