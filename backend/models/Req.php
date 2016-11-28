<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "req".
 *
 * @property integer $id
 * @property string $obj_addr
 * @property string $zayavitel_num
 * @property string $zayavitel_fio
 * @property integer $obj_id
 * @property string $kuvd
 * @property integer $kuvd_id
 * @property string $user_text
 * @property integer $status
 * @property string $date_in
 * @property string $user_to
 * @property string $kn
 * @property string $coment
 * @property integer $type
 * @property integer $otdel
 * @property integer $cel
 * @property string $cur_user
 * @property string $date_end
 * @property integer $fast
 * @property string $phone
 * @property integer $vedomost_num
 * @property string $user_last
 * @property integer $vedomost_unform
 * @property string $srok
 * @property string $user_print
 * @property string $print_date
 * @property string $code_mesto
 * @property string $date_v
 * @property integer $area_id
 * @property string $org
 * @property string $inn
 * @property string $date_return
 */
class Req extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db2;  
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['otdel', 'type', 'cel', 'zayavitel_fio', 'obj_addr', 'kn', 'kuvd', 'user_text', 'user_to', 'fast'], 'required'],
            [['obj_addr', 'zayavitel_num', 'zayavitel_fio', 'kuvd', 'user_text', 'user_to', 'kn', 'coment', 'cur_user', 'phone', 'user_last', 'user_print', 'code_mesto', 'org', 'inn', 'scan_doc'], 'string'],
            [['obj_id', 'kuvd_id', 'status', 'type', 'otdel', 'cel', 'fast', 'vedomost_num', 'vedomost_unform', 'area_id'], 'integer'],
            [['date_in', 'date_end', 'srok', 'print_date', 'date_v', 'date_return'], 'safe']
        ];
    }
    public function getIconStatus()
    {
        switch ($this->status) {
            case 1:
                return '<span class="glyphicon glyphicon-bell" title="Новая"> </span>';
                break;
            case 2:
                return '<span class="glyphicon glyphicon-time" title="В обработке"> </span>';
                break;
            case 3:
                return '<span class="glyphicon glyphicon-ok" title="Выполнена"> </span>';
                break;
            case 4:
                return '<span class="glyphicon glyphicon-remove" title="Отказ"> </span>';
                break;
            case 5:
                return '<span class="glyphicon glyphicon-print" title="Подготовлен к печати - Мачуги">-М</span>';
                break;
            case 6:
                return '<span class="glyphicon glyphicon-print" title="Подготовлен к печати - Ленина">-Л</span>';
                break;
            case 7:
                return '<span class="glyphicon glyphicon-eye-close" title="Подготовлен к передачи на выдачу"> </span>';
                break;
            case 8:
                return '<span class="glyphicon glyphicon-eye-open" title="Документы переданы на выдачу"> </span>';
                break;
            case 9:
                return '<span class="glyphicon glyphicon-repeat" title="Расписка возвращена"> </span>';
                break;
            default:
                return $this->status;
        }
    }
    public function getIconType()
    {
        switch ($this->type) {
            case 1:
                return '<span class="glyphicon glyphicon-briefcase" title="Дело ПУД"> </span>';
                break;
            case 2:
                return '<span class="glyphicon glyphicon-file" title="Листы реестров ЕГРП"> </span>';
                break;
            case 3:
                return '<span class="glyphicon glyphicon-briefcase" title="Дело ПУД"> </span>+<span class="glyphicon glyphicon-file" title="Листы реестров ЕГРП"> </span>';
                break;
            case 4:
                return '<span class="glyphicon glyphicon-folder-open" title="Документ"> </span>';
                break;
            case 5:
                return '<span class="glyphicon glyphicon-floppy-disk" title="Скан образ"> </span>';
                break;
            default:
                return $this->type;
        }
    }
    public function getFindOrg()
    {
        $this->getCleanUserText();
        $this->getCleanUserPrint();
        
        if(!empty($this->org) and !empty($this->inn)) {
            $this->org = str_replace("\"", "'", "$this->org");
            return $this->zayavitel_fio . ' <span class="glyphicon glyphicon-info-sign" title="' . $this->org . ' : ' . $this->inn . '"> </span>';
        } else return $this->zayavitel_fio;
    }
    public function getCleanUserText()
    {
        $this->user_text = str_replace("23UPR\\", "", "$this->user_text");
        return $this->user_text;
    }
    public function getCleanUserPrint()
    {
        $this->user_print = str_replace("23UPR\\", "", "$this->user_print");
        return $this->user_print;
    }
    public function getFullAddress()
    {
        if(!empty($this->area_id)) {
            return $this->obj_addr . '<br>[' . $this->areasArea->name . ']';
        } else {
            return $this->obj_addr;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'УИД',
            'obj_addr' => 'Адрес объекта',
            'zayavitel_num' => 'Zayavitel Num',
            'zayavitel_fio' => 'ФИО заявителя',
            'obj_id' => 'Obj ID',
            'kuvd' => 'КУВД',
            'kuvd_id' => 'Kuvd ID',
            'user_text' => 'Сотрудник',
            'status' => 'Статус',
            'date_in' => 'Дата',
            'user_to' => 'Для кого',
            'kn' => 'Кадастровый (условный) номер',
            'coment' => 'Coment',
            'type' => 'Архивный материал',
            'otdel' => 'Отдел',
            'cel' => 'Цель',
            'cur_user' => 'Исполнитель',
            'date_end' => 'Date End',
            'fast' => 'Срочность заявки*',
            'phone' => 'Телефон',
            'vedomost_num' => 'Vedomost Num',
            'user_last' => 'User Last',
            'vedomost_unform' => 'Vedomost Unform',
            'srok' => 'Srok',
            'user_print' => 'Распечатал',
            'print_date' => 'Print Date',
            'code_mesto' => 'Code Mesto',
            'date_v' => 'Date V',
            'area_id' => 'Area ID',
            'org' => 'Org',
            'inn' => 'Inn',
            'scan_doc' => 'Название документа',
            'date_return' => 'Возврат',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypesType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type']);
    }
    public function getOtdelsOtdel()
    {
        return $this->hasOne(Otdel::className(), ['id' => 'otdel']);
    }
    public function getReqsReqSt()
    {
        return $this->hasOne(ReqSt::className(), ['id' => 'status']);
    }
    public function getAreasArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }
    public function getCelsCel()
    {
        return $this->hasOne(Cel::className(), ['id' => 'cel']);
    }

}
