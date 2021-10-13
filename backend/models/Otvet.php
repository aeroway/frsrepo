<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otvet".
 *
 * @property int $id
 * @property string|null $text
 * @property int|null $vopros_id
 * @property int|null $pr
 */
class Otvet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otvet';
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
            [['pr', 'text', 'vopros_id'], 'required'],
            [['vopros_id', 'pr'], 'integer'],
            [['text'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Ответ',
            'vopros_id' => 'Vopros ID',
            'pr' => 'Правильный',
        ];
    }
}
