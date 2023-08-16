<?php

namespace backend\models;
use yii\helpers\ArrayHelper;
use backend\models\OraKuvdMain;
use Yii;

/**
 * This is the model class for table "ora_kuvd_main".
 *
 * @property string $name
 * @property string $fl
 
 */
class ViewByOtdel extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db;  
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_by_otdel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'fl'], 'string'],
            [['vsego', 'pr', 'otkaz', 'doublepr', 'noUvedoml', 'prSdopom', 'prosrPR'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Отдел',
            'fl' => 'Исполнитель',
            'vsego' => 'Всего',
            'pr' => 'Приостановлено',
            'otkaz' => 'Отказы',
            'doublepr' => 'Повторная приостановка',
            'noUvedoml' => 'Нет уведомлений',
            'prSdopom' => 'Не рассмотрены допы',
            'prosrPR' => 'Приостановка просрочена',
            
        ];
    }

    public function getPrProcent()
    {
        if ($this->vsego > 0) {
            return round(($this->pr / $this->vsego) * 100);
        } else return '0'; 
    }
    
    public function getNoUvedomlProcent()
    {
        if ($this->vsego > 0) {
            return round(($this->noUvedoml / $this->pr) * 100);
        } else return '0'; 
    }
}
