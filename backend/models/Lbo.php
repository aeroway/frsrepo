<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lbo".
 *
 * @property integer $id
 * @property double $sum
 * @property string $comment
 * @property string $year
 * @property string $date
 */
class Lbo extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db6;  
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lbo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum', 'year'], 'number'],
            [['comment'], 'string'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sum' => 'Сумма',
            'comment' => 'Комментарий',
            'year' => 'Год',
            'date' => 'Дата',
        ];
    }
}
