<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property string $fam
 * @property string $name
 * @property string $otch
 * @property string $pasp_s
 * @property string $pasp_n
 * @property string $pasp_date_v
 * @property string $pasp_kem_v
 * @property string $adres_f
 * @property string $adres_reg
 * @property string $date_priem
 * @property integer $gsdp_y
 * @property integer $gsdp_m
 * @property integer $gsdp_d
 * @property integer $otsdp_y
 * @property integer $otsdp_m
 * @property integer $otsdp_d
 * @property integer $ver
 * @property integer $is_top
 * @property string $date_nazn
 * @property integer $idm_otdel
 * @property integer $idm_doljn
 * @property string $oklad
 * @property string $nadbavka
 * @property string $osnovanie
 * @property string $date_in
 * @property integer $brak
 * @property string $suprug
 * @property string $phone
 * @property string $prikazi
 * @property integer $status
 * @property string $data_b
 * @property integer $tgs_y
 * @property integer $tgs_m
 * @property integer $tgs_d
 * @property string $date_stazh
 * @property integer $voen_uch
 * @property string $voen_kom
 * @property string $inn
 * @property string $snils
 * @property integer $voen_zvanie
 * @property integer $stat
 * @property integer $gos_reg
 * @property integer $gos_inspect
 * @property string $status_to
 * @property string $foto
 * @property integer $tos_y
 * @property integer $tos_m
 * @property integer $tos_d
 * @property integer $pol
 * @property integer $doplata_ur_percent
 * @property string $doplata_ur_prikaz
 * @property string $doplata_ur_data
 * @property string $nadbavka_stazh
 * @property string $nadbavka_stazh_raschet
 * @property string $login_upr
 * @property string $login_just
 * @property integer $check_is_login
 * @property string $skud_card_num
 * @property string $date_uvolnen
 *
 * @property Attestat[] $attestats
 * @property HospitalList[] $hospitalLists
 * @property KadRezerv[] $kadRezervs
 * @property PhoneSpr[] $phoneSprs
 */
class Employee extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db5;  
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fam', 'name', 'otch', 'pasp_s', 'pasp_n', 'pasp_kem_v', 'adres_f', 'adres_reg', 'oklad', 'nadbavka', 'osnovanie', 'suprug', 'phone', 'prikazi', 'voen_kom', 'inn', 'snils', 'foto', 'doplata_ur_prikaz', 'login_upr', 'login_just', 'skud_card_num'], 'string'],
            [['pasp_date_v', 'date_priem', 'date_nazn', 'date_in', 'data_b', 'date_stazh', 'status_to', 'doplata_ur_data', 'date_uvolnen'], 'safe'],
            [['gsdp_y', 'gsdp_m', 'gsdp_d', 'otsdp_y', 'otsdp_m', 'otsdp_d', 'ver', 'is_top', 'idm_otdel', 'idm_doljn', 'brak', 'status', 'tgs_y', 'tgs_m', 'tgs_d', 'voen_uch', 'voen_zvanie', 'stat', 'gos_reg', 'gos_inspect', 'tos_y', 'tos_m', 'tos_d', 'pol', 'doplata_ur_percent', 'check_is_login'], 'integer'],
            [['nadbavka_stazh', 'nadbavka_stazh_raschet'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fam' => 'Fam',
            'name' => 'Name',
            'otch' => 'Otch',
            'pasp_s' => 'Pasp S',
            'pasp_n' => 'Pasp N',
            'pasp_date_v' => 'Pasp Date V',
            'pasp_kem_v' => 'Pasp Kem V',
            'adres_f' => 'Adres F',
            'adres_reg' => 'Adres Reg',
            'date_priem' => 'Date Priem',
            'gsdp_y' => 'Gsdp Y',
            'gsdp_m' => 'Gsdp M',
            'gsdp_d' => 'Gsdp D',
            'otsdp_y' => 'Otsdp Y',
            'otsdp_m' => 'Otsdp M',
            'otsdp_d' => 'Otsdp D',
            'ver' => 'Ver',
            'is_top' => 'Is Top',
            'date_nazn' => 'Date Nazn',
            'idm_otdel' => 'Idm Otdel',
            'idm_doljn' => 'Idm Doljn',
            'oklad' => 'Oklad',
            'nadbavka' => 'Nadbavka',
            'osnovanie' => 'Osnovanie',
            'date_in' => 'Date In',
            'brak' => 'Brak',
            'suprug' => 'Suprug',
            'phone' => 'Phone',
            'prikazi' => 'Prikazi',
            'status' => 'Status',
            'data_b' => 'Data B',
            'tgs_y' => 'Tgs Y',
            'tgs_m' => 'Tgs M',
            'tgs_d' => 'Tgs D',
            'date_stazh' => 'Date Stazh',
            'voen_uch' => 'Voen Uch',
            'voen_kom' => 'Voen Kom',
            'inn' => 'Inn',
            'snils' => 'Snils',
            'voen_zvanie' => 'Voen Zvanie',
            'stat' => 'Stat',
            'gos_reg' => 'Gos Reg',
            'gos_inspect' => 'Gos Inspect',
            'status_to' => 'Status To',
            'foto' => 'Foto',
            'tos_y' => 'Tos Y',
            'tos_m' => 'Tos M',
            'tos_d' => 'Tos D',
            'pol' => 'Pol',
            'doplata_ur_percent' => 'Doplata Ur Percent',
            'doplata_ur_prikaz' => 'Doplata Ur Prikaz',
            'doplata_ur_data' => 'Doplata Ur Data',
            'nadbavka_stazh' => 'Nadbavka Stazh',
            'nadbavka_stazh_raschet' => 'Nadbavka Stazh Raschet',
            'login_upr' => 'Login Upr',
            'login_just' => 'Login Just',
            'check_is_login' => 'Check Is Login',
            'skud_card_num' => 'Skud Card Num',
            'date_uvolnen' => 'Date Uvolnen',
        ];
    }

    public function getFullName()
    {
        if(!empty($this->fam) and !empty($this->name) and !empty($this->otch)) {
            return $this->fam . ' ' . $this->name . ' ' . $this->otch;
        } else{
            return 'Неполные данные по ФИО';
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttestats()
    {
        return $this->hasMany(Attestat::className(), ['idm_empl' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospitalLists()
    {
        return $this->hasMany(HospitalList::className(), ['idm_empl' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKadRezervs()
    {
        return $this->hasMany(KadRezerv::className(), ['idm_empl' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneSprs()
    {
        return $this->hasMany(PhoneSpr::className(), ['idm_empl' => 'id']);
    }
}
