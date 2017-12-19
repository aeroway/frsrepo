<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ora_dop_doc".
 *
 * @property integer $id
 * @property string $date_load
 * @property string $kuvd
 * @property integer $FK_kuvd_id
 * @property string $date_receipt
 */
class OraDopDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ora_dop_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_load', 'date_receipt'], 'safe'],
            [['kuvd'], 'string'],
            [['FK_kuvd_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_load' => 'Дата актуальности',
            'kuvd' => 'КУВД',
            'FK_kuvd_id' => 'Fk Kuvd ID',
            'date_receipt' => 'Дата приема ДД',
        ];
    }
}
