<?php

namespace backend\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "ora_kuvd_main".
 *
 * @property integer $id
 * @property string $otdel
 * @property string $fio
 * @property string $kuvd
 * @property string $date_receipt
 * @property string $version
 * @property integer $is_top
 * @property string $date_version
 * @property string $status
 * @property string $date_issue
 * @property integer $kuvd_id
 * @property string $date_load
 * @property string $message
 */
class OraKuvdMain extends \yii\db\ActiveRecord
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
        return 'ora_kuvd_main';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['otdel', 'fio', 'kuvd', 'version', 'status','message'], 'string'],
            [['date_receipt', 'date_version', 'date_issue', 'date_load'], 'safe'],
            [['is_top', 'kuvd_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'otdel' => 'Отдел',
            'fio' => 'Исполнитель',
            'kuvd' => 'КУВД',
            'date_receipt' => 'Дата приема',
            'version' => 'Version',
            'is_top' => 'Is Top',
            'date_version' => 'Date Version',
            'status' => 'Статус',
            'date_issue' => 'Дата окончания',
            'kuvd_id' => 'Kuvd ID',
            'date_load' => 'Дата актуальности',
            'CountRows' =>  'Кол-во приостановок',
        ];
    }
    
    public  function getFKDopDoc()
    {
        return $this->hasOne(OraDopDoc::className(), ['FK_kuvd_id' => 'kuvd_id']);
    
    }

    public static function getDopDocAll($fio)
    {
        return self::find()->joinWith(['fKDopDoc'])
                    ->where(['fio'=>$fio])
                    ->andWhere('ora_dop_doc.date_receipt > ora_kuvd_main.date_version')
                    ->andWhere("ora_kuvd_main.status = 'Приостановлено' ")
                    ->andWhere('ora_kuvd_main.is_top = 1');
    }
    
    public static function getDoublePriost($fio)
    {
        return self::find()->joinWith(['fKDopDoc'])
                    ->where(['fio'=>$fio])
                    ->andWhere('ora_dop_doc.date_receipt < ora_kuvd_main.date_version')
                    ->andWhere("ora_kuvd_main.status = 'Приостановлено' ")
                    ->andWhere('ora_kuvd_main.is_top = 1');
    }

    public static function getCountRows($fio){
        return self::find()->where(['fio'=>$fio,'status'=>'Приостановлено','is_top'=>1])->count();
    }
    
    public static function getProsrochenoRows($fio){
        return self::find()->where(['fio'=>$fio,'status'=>'В работе','is_top'=>1]);        
    }

    public static function getNoUvedoml($fio)
    {
        return self::find()->joinWith(['fKDopDoc'])
                    ->where(['fio'=> $fio])
                    ->andWhere("ora_kuvd_main.status = 'Приостановлено' ")
                    ->andWhere('ora_kuvd_main.is_top = 1');
    }

    // по районам
    public static function getDopDocAllByOtdel($fl)
    {
        return self::find()->joinWith(['fKDopDoc'])
                    ->where(['otdel'=>$fl])
                    ->andWhere('ora_dop_doc.date_receipt > ora_kuvd_main.date_version')
                    ->andWhere("ora_kuvd_main.status = 'Приостановлено' ")
                    ->andWhere('ora_kuvd_main.is_top = 1');
    }

    public static function getDoublePriostByOtdel($fl)
    {
        return self::find()->joinWith(['fKDopDoc'])
                    ->where(['otdel'=>$fl])
                    ->andWhere('ora_dop_doc.date_receipt < ora_kuvd_main.date_version')
                    ->andWhere("ora_kuvd_main.status = 'Приостановлено' ")
                    ->andWhere('ora_kuvd_main.is_top = 1');
    }

    public static function getCountRowsByOtdel($fl) {
        return self::find()->where(['otdel' => $fl, 'status' => 'Приостановлено', 'is_top' => 1])->count();
    }

    public static function getProsrochenoRowsByOtdel($fl) {
        return self::find()->where(['otdel' => $fl, 'status' => 'В работе', 'is_top' => 1]);
    }

    public function getFullFIO() {
        return ($this->fio != '') ? $this->fio : $this->performer;
    }    
}
