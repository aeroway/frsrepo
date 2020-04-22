<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dogovor".
 *
 * @property int $id
 * @property string|null $pr_name_f
 * @property string|null $pr_name_s
 * @property string|null $pr_name_l
 * @property string|null $pr_date_b
 * @property string|null $pr_mesto_b
 * @property string|null $pr_pol
 * @property string|null $pr_pasp_s
 * @property string|null $pr_pasp_n
 * @property string|null $pr_vudan
 * @property string|null $pr_vudan_data
 * @property string|null $pr_adres_reg
 * @property string|null $pr_kod_podrazd
 * @property string|null $pok_name_f
 * @property string|null $pok_name_s
 * @property string|null $pok_name_l
 * @property string|null $pok_date_b
 * @property string|null $pok_mesto_b
 * @property string|null $pok_pol
 * @property string|null $pok_pasp_s
 * @property string|null $pok_pasp_n
 * @property string|null $pok_vudan
 * @property string|null $pok_vudan_data
 * @property string|null $pok_adres_reg
 * @property string|null $pok_kod_podrazd
 * @property string|null $obj_type
 * @property string|null $obj_kn
 * @property string|null $obj_adres
 * @property string|null $obj_square
 * @property string|null $obj_square_l
 * @property string|null $obj_cnt_room
 * @property string|null $obj_floor
 * @property string|null $obj_pod
 * @property string|null $dop_info
 * @property string|null $cena
 * @property string|null $doc_osn
 * @property string|null $date_doc_osn
 * @property string|null $zapis_v_egrp
 * @property string|null $date_zapis_v_egrp
 * @property string|null $svid
 * @property string|null $date_svid
 * @property string|null $_from
 * @property string|null $date_in
 * @property string|null $istochnik
 * @property string|null $ip
 * @property string|null $time_start
 * @property string|null $time_end
 * @property int|null $status
 * @property int|null $type_d
 * @property string|null $floors_dom
 * @property string|null $pod_oni
 * @property string|null $invn_oni
 * @property string|null $liter_oni
 * @property string|null $zem_oni
 * @property string|null $nazn_oni
 * @property string|null $square_oni_zu
 * @property string|null $square_oni_dom
 * @property string|null $kn_oni_dom
 * @property string|null $doc_osn_oni_dom
 * @property string|null $date_doc_osn_oni_dom
 * @property string|null $pravo_polz_zu
 * @property string|null $num_nej_pom
 * @property string|null $inv_ocenka
 */
class VupiskiDogovor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dogovor';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db1');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_in', 'time_start', 'time_end'], 'safe'],
            [['status', 'type_d'], 'integer'],
            [['pr_name_f', 'pr_name_s', 'pr_name_l', 'pr_vudan', 'pok_name_f', 'pok_name_s', 'pok_name_l', 'pok_vudan', 'dop_info', 'doc_osn', 'zapis_v_egrp', 'svid'], 'string', 'max' => 150],
            [['pr_date_b', 'pr_pol', 'pr_vudan_data', 'pok_date_b', 'pok_pol', 'pok_vudan_data', 'date_doc_osn', 'date_zapis_v_egrp', 'date_svid', 'date_doc_osn_oni_dom'], 'string', 'max' => 10],
            [['pr_mesto_b', 'pr_adres_reg', 'pok_mesto_b', 'pok_adres_reg'], 'string', 'max' => 250],
            [['pr_pasp_s', 'pr_pasp_n', 'pr_kod_podrazd', 'pok_pasp_s', 'pok_pasp_n', 'pok_kod_podrazd', 'obj_type', 'obj_kn', '_from', 'istochnik', 'kn_oni_dom', 'pravo_polz_zu', 'num_nej_pom', 'inv_ocenka'], 'string', 'max' => 50],
            [['obj_adres', 'obj_square', 'obj_square_l', 'obj_cnt_room', 'obj_floor', 'obj_pod'], 'string', 'max' => 4096],
            [['cena'], 'string', 'max' => 30],
            [['ip', 'invn_oni', 'liter_oni', 'square_oni_zu', 'square_oni_dom'], 'string', 'max' => 20],
            [['floors_dom', 'pod_oni'], 'string', 'max' => 3],
            [['zem_oni', 'nazn_oni', 'doc_osn_oni_dom'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pr_name_f' => 'Фамилия',
            'pr_name_s' => 'Имя',
            'pr_name_l' => 'Отчество',
            'pr_date_b' => 'Дата рождения',
            'pr_mesto_b' => 'Место рождения',
            'pr_pol' => 'Пол',
            'pr_pasp_s' => 'Серия (4 цифры)',
            'pr_pasp_n' => 'Номер (6 цифр)',
            'pr_vudan' => 'Кем выдан',
            'pr_vudan_data' => 'Дата выдачи',
            'pr_adres_reg' => 'Адрес регистрации',
            'pr_kod_podrazd' => 'Код подразделения',
            'pok_name_f' => 'Фамилия',
            'pok_name_s' => 'Имя',
            'pok_name_l' => 'Отчество',
            'pok_date_b' => 'Дата рождения',
            'pok_mesto_b' => 'Место рождения',
            'pok_pol' => 'Пол',
            'pok_pasp_s' => 'Серия (4 цифры)',
            'pok_pasp_n' => 'Номер (6 цифр)',
            'pok_vudan' => 'Кем выдан',
            'pok_vudan_data' => 'Дата выдачи',
            'pok_adres_reg' => 'Адрес регистрации',
            'pok_kod_podrazd' => 'Код подразделения',
            'obj_type' => 'Obj Type',
            'obj_kn' => 'Кадастровый/условный номер/инвентарный номер',
            'obj_adres' => 'Адрес объекта',
            'obj_square' => 'Площадь общая',
            'obj_square_l' => 'Жилая',
            'obj_cnt_room' => 'Количество комнат',
            'obj_floor' => 'Этаж',
            'obj_pod' => 'Подъезд/корпус',
            'dop_info' => 'Dop Info',
            'cena' => 'Цена (цифрами)',
            'doc_osn' => 'На основании чего принадлежит продавцу (договор купли-продажи, решение)',
            'date_doc_osn' => 'Дата',
            'zapis_v_egrp' => 'что подтверждается записью в ЕГРП №',
            'date_zapis_v_egrp' => 'от',
            'svid' => 'свидетельство о государственной регистрации №',
            'date_svid' => 'от',
            '_from' => 'From',
            'date_in' => 'Дата создания',
            'istochnik' => 'Источник',
            'ip' => 'IP',
            'time_start' => 'Time Start',
            'time_end' => 'Time End',
            'status' => 'Status',
            'type_d' => 'Договор',
            'floors_dom' => 'Этажей в доме',
            'pod_oni' => 'Подъезд/корпус',
            'invn_oni' => 'Инвентарный номер',
            'liter_oni' => 'Литер',
            'zem_oni' => 'Земельный участок расположен на землях',
            'nazn_oni' => 'Целевое назначение земельного участка',
            'square_oni_zu' => 'Площадь общая ЗУ',
            'square_oni_dom' => 'Площадь общая ОКС',
            'kn_oni_dom' => 'Кадастровый или условный номер',
            'doc_osn_oni_dom' => 'На основании чего принадлежит продавцу (договор купли-продажи, решение)',
            'date_doc_osn_oni_dom' => 'Дата',
            'pravo_polz_zu' => 'Pravo Polz Zu',
            'num_nej_pom' => 'Num Nej Pom',
            'inv_ocenka' => 'Inv Ocenka',
        ];
    }
}
