<?php

namespace backend\models;
use yii\helpers\ArrayHelper;
use backend\models\OraKuvdMain;
use Yii;

/**
 * This is the model class for table "ora_kuvd_main".
 *
 * @property string $otdel
 * @property string $fio

 */
class ViewByFio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_by_otdel2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['otdel', 'fio'], 'string'],
            [['vsego', 'pr', 'otkaz', 'doublepr', 'noUvedoml', 'prSdopom', 'prosrPR'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'otdel' => 'Отдел',
            'fio' => 'Исполнитель',
            'vsego' =>  'Всего',
            'pr'    => 'Приостановлено',
            'otkaz' => 'Отказы',
            'doublepr'  => 'Повторная приостановка',
            'noUvedoml' => 'Нет уведомлений',
            'prSdopom'  => 'Не рассмотрены допы',
            'prosrPR'   => 'Приостановка просрочена',
            
        ];
    }
    

    public function getPrProcent() {
        if ($this->vsego > 0) {
            return round(($this->pr/$this->vsego)*100);
        } else return '0';
    }

    public function getNoUvedomlProcent() {
        if ($this->vsego > 0) {
            return round(($this->noUvedoml/$this->pr)*100);
        } else return '0'; 
    }

    public function getOtkazProcent() {
        if ($this->vsego > 0) {
            return round(($this->otkaz/$this->vsego)*100);
        } else return '0'; 
    }

    public static function getDopDocAll($fio)
    {
        return OraKuvdMain::find()->joinWith(['fKDopDoc'])
                    ->where(['fio'=>$fio])
                    ->andWhere('ora_dop_doc.date_receipt > ora_kuvd_main.date_version')
                    ->andWhere("ora_kuvd_main.status = 'Приостановлено' ")
                    ->andWhere('ora_kuvd_main.is_top = 1');
    }

    public static function getDoublePriost($fio)
    {
        return OraKuvdMain::find()->joinWith(['fKDopDoc'])
                    ->where(['fio'=>$fio])
                    ->andWhere('ora_dop_doc.date_receipt < ora_kuvd_main.date_version')
                    ->andWhere("ora_kuvd_main.status = 'Приостановлено' ")
                    ->andWhere('ora_kuvd_main.is_top = 1');
    }

    public static function getAllPr($fio) {
        return OraKuvdMain::find()->where(['fio'=>$fio,'status'=>'Приостановлено','is_top'=>1]);
    }
    
    public static function getAllOtkaz($fio){
        return OraKuvdMain::find()->where(['fio'=>$fio,'status'=>'отказ в регистрации','is_top'=>1]);        
    }
    
    public static function getProsrochenoRows($fio){
        
        $sql = "SELECT a.kuvd,a.date_receipt,a.date_version,a.date_suspend,a.kuvd_id,
                SUBSTRING(d.Addresses,1, LEN(d.Addresses) - 1) message
                FROM
                (
                SELECT DISTINCT *
                FROM ora_kuvd_main
                where 
                is_top =1
                and status = 'Приостановлено'
                and date_suspend < getdate()
                and fio = '".$fio."'
                and kuvd_id not in (
                select km.kuvd_id from ora_kuvd_main km
                cross apply ora_messages om where om.kuvd_id = km.kuvd_id 
                and om.text_message = 'Приостановка - п.37 ч.1 ст. 26'
                and
                km.is_top =1
                and km.status = 'Приостановлено'
                and km.date_suspend < getdate()
                and km.fio = '".$fio."'
                group by km.kuvd_id
                )
                
                ) a
                CROSS APPLY
                (
                SELECT text_message + ', ' 
                FROM ora_messages as B
                WHERE B.kuvd_id = a.kuvd_id
                and B.text_message like 'Приостановка%'
                --and B.text_message not like 'Приостановка - п.37 ч.1 ст. 26'
                FOR XML PATH('')

                ) D (Addresses)";

        return OraKuvdMain::findBySql($sql);
    }

    public static function getProsrochkaUp2($fio)
    {
        return OraKuvdMain::find()
                    ->joinWith(['fKDopDoc'])
                    ->where(['fio'=>$fio])
                    ->andWhere("ora_kuvd_main.status = 'Приостановлено' ")
                    ->andWhere('(ora_kuvd_main.date_end - getdate()) <= 50')
                    ->andWhere('ora_kuvd_main.is_top = 1');
    }

    public static function getNoUvedoml($fio,$fl=null)
    {
        return OraKuvdMain::find()
                    ->where('ora_kuvd_main.fio = \'\' ')
                    ->andWhere('ora_kuvd_main.performer = \''.$fio.'\'')
                    ->andWhere("ora_kuvd_main.status = 'Приостановлено' ")
                    ->andWhere("ora_kuvd_main.otdel = '".$fl."'")
                    //->andWhere('ora_dop_doc.date_receipt > ora_kuvd_main.date_version')
                    ->andWhere('ora_kuvd_main.is_top = 1');
    }
}
