<?php

namespace backend\models;

use Yii;

use backend\models\Stazh;
use backend\models\Inmove;
use backend\models\Education;
use backend\models\LnkChin;
use backend\models\KvalifUp;

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

    public function getDoljnostName()
    {
        return $this->dolnjName->name;
    }

    public function getOtdelsName()
    {
        return $this->otdelText->text;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fam' => 'Фамилия',
            'name' => 'Имя',
            'otch' => 'Отчество',
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

    public function getBthday()
    {
        $localVarOut = '';

        $rows = Bthday::find()
            ->select('fio, dl, otd, dr')
            ->orderBy('dr ASC')
            ->createCommand()->queryAll();

        $localVarOut .= '<table class="table table-bordered table-striped" style="width: 100%">';
        $localVarOut .= '
            <thead>
                <tr>
                    <td>п/п</td>
                    <td><b>ФИО</b></td>
                    <td><b>Должность</b></td>
                    <td><b>Отдел</b></td>
                    <td><b>ДР</b></td>
                </tr>
            </thead>';

        $localVarOut .= '<tbody>';

        $i = 1;

        foreach($rows as $key => $val)
        {
            $localVarOut .= '<tr>';
            $localVarOut .= '<td>' . $i++ . '</td>';
            $localVarOut .= '<td>' . $val["fio"] . '</td>';
            $localVarOut .= '<td>' . $val["dl"] . '</td>';
            $localVarOut .= '<td>' . $val["otd"] . '</td>';
            $localVarOut .= '<td>' . $val["dr"] . '</td>';
            $localVarOut .= '</tr>';
        }

        $localVarOut .= '</tbody>';
        $localVarOut .= '</table>';

        return $localVarOut;
    }

    public function employeePositionDepartment($id)
    {
        return Employee::find()
            ->select(['emp.*', 'dl.name dolj', 'ot.text otdel'])
            ->alias('emp')
            ->where(['emp.id' => $id])
            ->innerJoin('doljn dl', 'dl.id = emp.idm_doljn')
            ->innerJoin('otdel ot', 'ot.id = emp.idm_otdel')
            ->asArray()
            ->one();
    }

    private function sumDateIntervals(\DateInterval $a, \DateInterval $b)
    {
      $base = new \DateTimeImmutable();

      return $base->add($a)->add($b)->diff($base);
    }

    private function modifyDateIntervals(\DateInterval $a, \DateInterval $b)
    {
      $base = new \DateTimeImmutable();

      return $base->add($b); //$base->modify($inmoveDiffDate->days); //->modify('+'.$b->days.' days')
    }

    public function stazh($id)
    {
        $inmoveDateStart = NULL;
        $inmoveDateEnd = NULL;
        $inmoveCountElements = NULL;
        $inmoveDiffDate =  0;
        $modelStazh = new Stazh();
        $modelInmove = new Inmove();

        $stazhGs = NULL;
        $stazhFull = NULL;
        $stazhGsDiffDate1;
        $stazhGsDiffDate2;
        $stazhGsDiffDateResult = NULL;
        $stazhDiffDate1;
        $stazhDiffDate2;
        $stazhDiffDateResult;
        $stazh = [];

        foreach ($modelStazh->stazhGs($id) as $stazh) {
            $stazhGsDiffDate1 = $this->diffDate($stazh["date_start"], $stazh["date_end"]);

            if (!empty($stazhGsDiffDate2)) {
                $stazhGsDiffDateResult = $this->sumDateIntervals($stazhGsDiffDate1, $stazhGsDiffDate2);
                $stazhGsDiffDateResult->invert = 0;
            }

            $stazhGsDiffDate2 = $stazhGsDiffDate1;
        }

        foreach ($modelStazh->stazh($id) as $stazh) {
            $stazhDiffDate1 = $this->diffDate($stazh["date_start"], $stazh["date_end"]);

            if (!empty($stazhDiffDate2)) {
                $stazhDiffDateResult = $this->sumDateIntervals($stazhDiffDate1, $stazhDiffDate2);
                $stazhDiffDateResult->invert = 0;
                $stazhDiffDate2 = $stazhDiffDateResult;

            } else {
                $stazhDiffDate2 = $stazhDiffDate1;
            }
        }

        $inmove = $modelInmove->inmoveEmployee($id);
        $inmoveCountElements = count($inmove);

        foreach ($inmove as $key => $inmv) {

            if ($key === 0) {
                $inmoveDateStart = $inmv["date_start"];
            }

            if ($key === $inmoveCountElements-1) {
                $inmoveDateEnd = date('Y-m-d', strtotime("+1 days"));
                $inmoveDiffDate = $this->diffDate($inmoveDateStart, $inmoveDateEnd);
            }
        }

        if (empty($stazhGsDiffDateResult)) {
            $stazhGs = $inmoveDiffDate;
        } else {
            $stazhGs = $this->sumDateIntervals($stazhGsDiffDateResult, $inmoveDiffDate);
        }

        if (empty($stazhDiffDateResult)) {
            if (empty($stazhDiffDate1)) {
                $stazhFull = $inmoveDiffDate;
            } else {
                $stazhFull = $this->sumDateIntervals($stazhDiffDate1, $inmoveDiffDate);
            }
        } else {
            $stazhFull = $this->sumDateIntervals($stazhDiffDateResult, $inmoveDiffDate);
        }

        $stazh["gs"] = $stazhGs;
        $stazh["full"] = $stazhFull;

        return $stazh;
    }

    public function attestatList($id)
    {
        $modelEducation = new Education();
        $modelLnkChin = new LnkChin();

        $staff = $this->employeePositionDepartment($id);
        $edu = $modelEducation->educationInfo($id);
        $rank = $modelLnkChin->lnkChin($id);
        $nameFile = $staff["fam"] . '_' . $staff["name"] . '_' . $staff["otch"];

        if ($staff["status"] === 2 || empty($staff)) {
            return '<h1>Нет документов на печать.</h1>';
        }

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $properties = $phpWord->getDocInfo();
        $properties->setCreator('Stepan Zakharov');
        $properties->setCompany('FRSKuban');
        $properties->setTitle('Get request');
        $properties->setDescription('The service of request from kadru');
        $properties->setCategory('kadru');
        $properties->setLastModifiedBy('PHPWord');
        $properties->setCreated(time());
        $properties->setModified(time());
        $properties->setSubject('Print to file');
        $properties->setKeywords('kadru, Экзаменационный лист');

        $sectionStyle = array(
            'orientation' => 'portrait',
            'marginTop' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(75.5),
            'marginLeft' => 1700,
            'marginRight' => 850,
            'marginBottom' => 995,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'spacing' => 0,
            'colsNum' => 1,
            'pageNumberingStart' => 1,
        );

        $sectionStyleSpacing = ['spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0, 'align' => 'both'];
        $sectionStyleSpacingL = ['spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0];
        $pAlignCenter = array('align' => 'center', 'spaceBefore' => 0, 'spaceAfter' => 0,);
        $boldTrue = array('bold' => TRUE);
        $boldFalseSize8 = array('bold' => FALSE, 'size' => 8);
        $boldFalseSize16 = array('bold' => FALSE, 'size' => 16);
        $boldFalseItalicTrueUnderlineSingle = array('bold' => FALSE, 'italic' => TRUE, 'underline' => 'single');

        $section = $phpWord->addSection($sectionStyle);
        $textrunHead = $section->createTextRun($pAlignCenter);
        $textrunHead->addText('АТТЕСТАЦИОННЫЙ ЛИСТ', $boldTrue);
        $textrunHead->addTextBreak(1);
        $textrunHead->addText('ГОСУДАРСТВЕННОГО ГРАЖДАНСКОГО СЛУЖАЩЕГО', $boldTrue);
        $textrunHead->addTextBreak(1);
        $textrunHead->addText('РОССИЙСКОЙ ФЕДЕРАЦИИ', $boldTrue);
        $textrunHead->addTextBreak(1);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('1. Фамилия, имя, отчество: ');
        $textrun->addText($staff["fam"] . ' ' . $staff["name"] . ' ' . $staff["otch"], $boldFalseItalicTrueUnderlineSingle);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('2. Год, число и месяц рождения: ');
        $textrun->addText(\Yii::$app->formatter->asDatetime($staff["data_b"], "php:d.m.Y"), $boldFalseItalicTrueUnderlineSingle);
   
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('3. Сведения о профессиональном образовании, наличии ученой степени, ученого звания: ');
  
        $textrun = $section->addTextRun($sectionStyleSpacingL);

        foreach ($edu as $education) {
            $textrun->addText(
                mb_strtolower($education["text"]) . ', ' . 
                $education["name_vuz"] . ', ' . 
                $education["year_end"] . ' год, ' . 
                mb_strtolower($education["specualnost"]) . ', ' . 
                mb_strtolower($education["kvalif"]),
                $boldFalseItalicTrueUnderlineSingle);
            $textrun = $section->addTextRun($sectionStyleSpacingL);
        }

        $textrun->addText('(когда и какую образовательную организацию окончил, специальность или направление подготовки, квалификация, ученая степень, ученое звание)', $boldFalseSize8);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('4. Замещаемая должность государственной гражданской службы на момент аттестации и дата назначения на эту должность: ');
        $textrun->addText(mb_strtolower(trim($staff["dolj"]), 'UTF-8') . ' ' . str_ireplace("ый", "ого", str_ireplace("отдел", "отдела", $this->mb_lcfirst($staff["otdel"]))), $boldFalseItalicTrueUnderlineSingle);
        $textrun->addText(', с ' . \Yii::$app->formatter->asDatetime($staff["date_nazn"], "php:d.m.Y") . ' года.', $boldFalseItalicTrueUnderlineSingle);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('5. Стаж государственной службы (в том числе стаж государственной гражданской службы): ');
        $textrun->addText($this->diffDateResults($this->stazh($id)["gs"]->y, $this->stazh($id)["gs"]->m, $this->stazh($id)["gs"]->d), $boldFalseItalicTrueUnderlineSingle);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('6. Общий трудовой стаж: ');
        $textrun->addText($this->diffDateResults($this->stazh($id)["full"]->y, $this->stazh($id)["full"]->m, $this->stazh($id)["full"]->d), $boldFalseItalicTrueUnderlineSingle);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('7. Классный чин гражданской службы: ');

        if (!empty($rank)) {
            $textrun->addText($this->mb_lcfirst($rank["text"]) . ', ' . \Yii::$app->formatter->asDatetime($rank["date_start"], "php:d.m.Y"), $boldFalseItalicTrueUnderlineSingle);
        }

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('(наименование классного чина и дата его присвоения)', $boldFalseSize8);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('8. Вопросы к государственному гражданскому служащему и краткие ответы на них: ');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('9. Замечания и предложения, высказанные аттестационной комиссией: ');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('10. Краткая оценка выполнения федеральным государственным служащим рекомендаций предыдущей аттестации ');
        $textrun->addText('________________________________________________________');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('(выполнены, выполнены частично, не выполнены)', $boldFalseSize8);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('11. Решение аттестационной комиссии: ___________________________________________');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('(соответствует замещаемой должности государственной гражданской службы; соответствует замещаемой должности государственной гражданской службы и рекомендуется к включению в кадровый резерв для замещения вакантной должности государственной гражданкой службы в порядке должностного роста; соответствует замещаемой должности государственной гражданской службы при условии получения дополнительного профессионального образования; не соответствует замещаемой должности государственной гражданской службы)', $boldFalseSize8);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('12. Количественный состав аттестационной комиссии _________');
        
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('На заседании присутствовало ___________ членов аттестационной комиссии');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('Количество голосов за _______, против _______');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('14. Примечания _______________________________________________________________');

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="Аттестационный_лист_' . $nameFile . '.docx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("php://output");

        exit;
    }

    public function examList($id) {
        $modelEducation = new Education();
        $modelLnkChin = new LnkChin();
        $modelKvalifUp = new KvalifUp();
        $staff = $this->employeePositionDepartment($id);
        $edu = $modelEducation->educationInfo($id);
        $rank = $modelLnkChin->lnkChin($id);
        $qualification = $modelKvalifUp->kvalifUp($id);
        $nameFile = $staff["fam"] . '_' . $staff["name"] . '_' . $staff["otch"];

        if ($staff["status"] === 2 || empty($staff)) {
            return '<h1>Нет документов на печать.</h1>';
        }

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);
        $properties = $phpWord->getDocInfo();
        $properties->setCreator('Stepan Zakharov');
        $properties->setCompany('FRSKuban');
        $properties->setTitle('Get request');
        $properties->setDescription('The service of request from kadru');
        $properties->setCategory('kadru');
        $properties->setLastModifiedBy('PHPWord');
        $properties->setCreated(time());
        $properties->setModified(time());
        $properties->setSubject('Print to file');
        $properties->setKeywords('kadru, Экзаменационный лист');

        $sectionStyle = array(
            'orientation' => 'portrait',
            'marginTop' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(75.5),
            'marginLeft' => 1700,
            'marginRight' => 850,
            'marginBottom' => 995,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
            'spacing' => 0,
            'colsNum' => 1,
            'pageNumberingStart' => 1,
        );

        $sectionStyleSpacing = ['spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0, 'align' => 'both'];
        $sectionStyleSpacingL = ['spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0];
        $pAlignCenter = array('align' => 'center', 'spaceBefore' => 0, 'spaceAfter' => 0,);
        $boldTrue = array('bold' => TRUE);
        $boldFalseSize8 = array('bold' => FALSE, 'size' => 8);
        $boldFalseSize16 = array('bold' => FALSE, 'size' => 16);
        $boldFalseItalicTrueUnderlineSingle = array('bold' => FALSE, 'italic' => TRUE, 'underline' => 'single');

        $section = $phpWord->addSection($sectionStyle);
        $textrunHead = $section->createTextRun($pAlignCenter);
        $textrunHead->addText('ЭКЗАМЕНАЦИОННЫЙ ЛИСТ', $boldTrue);
        $textrunHead->addTextBreak(1);
        $textrunHead->addText('ГОСУДАРСТВЕННОГО ГРАЖДАНСКОГО СЛУЖАЩЕГО', $boldTrue);
        $textrunHead->addTextBreak(1);
        $textrunHead->addText('РОССИЙСКОЙ ФЕДЕРАЦИИ', $boldTrue);
        $textrunHead->addTextBreak(1);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('1. Фамилия, имя, отчество: ');
        $textrun->addText($staff["fam"] . ' ' . $staff["name"] . ' ' . $staff["otch"], $boldFalseItalicTrueUnderlineSingle);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('2. Год, число и месяц рождения: ');
        $textrun->addText(\Yii::$app->formatter->asDatetime($staff["data_b"], "php:d.m.Y"), $boldFalseItalicTrueUnderlineSingle);
   
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('3. Сведения о профессиональном образовании, наличии ученой степени, ученого звания: ');
  
        $textrun = $section->addTextRun($sectionStyleSpacingL);

        foreach ($edu as $education) {
            $textrun->addText(
                mb_strtolower($education["text"]) . ', ' . 
                $education["name_vuz"] . ', ' . 
                $education["year_end"] . ' год, ' . 
                mb_strtolower($education["specualnost"]) . ', ' . 
                mb_strtolower($education["kvalif"]),
                $boldFalseItalicTrueUnderlineSingle);
            $textrun = $section->addTextRun($sectionStyleSpacingL);
        }

        $textrun->addText('(когда и какую образовательную организацию окончил, квалификация по специальности или направлению подготовки, ученая степень, ученое звание)', $boldFalseSize8);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('4. Сведения о дополнительном профессиональном образовании: ');

        $textrun = $section->addTextRun($sectionStyleSpacing);

        foreach ($qualification as $q) {
            $textrun->addText('c ' . $this->dmyDateFormat($q["data_start"]) . ' по ' . $this->dmyDateFormat($q["data_end"]) . ', ' . $q["obr_uch"] . ', ' . mb_strtolower($q["tema"]) . '; ', $boldFalseItalicTrueUnderlineSingle);
        }

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('(документ о квалификации, подтверждающие повышение или присвоение квалификации по результатам дополнительного профессионального образования (удостоверение о повышении квалификации,  диплом о профессиональной переподготовке))', $boldFalseSize8);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('5. Замещаемая должность государственной гражданской службы на день проведения квалификационного экзамена и дата назначения на эту должность: ');
        $textrun->addText(mb_strtolower(trim($staff["dolj"]), 'UTF-8') . ' ' . str_ireplace("ый", "ого", str_ireplace("отдел", "отдела", $this->mb_lcfirst($staff["otdel"]))), $boldFalseItalicTrueUnderlineSingle);
        $textrun->addText(', с ' . \Yii::$app->formatter->asDatetime($staff["date_nazn"], "php:d.m.Y") . ' года.', $boldFalseItalicTrueUnderlineSingle);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('6. Стаж государственной службы (в том числе стаж государственной гражданской службы): ');
        $textrun->addText($this->diffDateResults($this->stazh($id)["gs"]->y, $this->stazh($id)["gs"]->m, $this->stazh($id)["gs"]->d), $boldFalseItalicTrueUnderlineSingle);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('7. Общий трудовой стаж: ');
        $textrun->addText($this->diffDateResults($this->stazh($id)["full"]->y, $this->stazh($id)["full"]->m, $this->stazh($id)["full"]->d), $boldFalseItalicTrueUnderlineSingle);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('8. Классный чин гражданской службы: ');

        if (!empty($rank)) {
            $textrun->addText($this->mb_lcfirst($rank["text"]) . ', ' . \Yii::$app->formatter->asDatetime($rank["date_start"], "php:d.m.Y"), $boldFalseItalicTrueUnderlineSingle);
        }

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('(наименование классного чина и дата его присвоения)', $boldFalseSize8);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('9. Вопросы к государственному гражданскому служащему и краткие ответы на них: ');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun();
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('10. Замечания и предложения, высказанные аттестационной (конкурсной) комиссией: ');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('_____________________________________________________________________________');
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('11. Предложения, высказанные государственным гражданским служащим: ');
        $textrun->addText('_____________________________________________________________________________');
        $textrun->addText('_____________________________________________________________________________');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('12. Оценка знаний, навыков и умений (профессионального уровня) государственного гражданского служащего по результатам квалификационного экзамена: ');
        $textrun->addText('_____________________________________________________________________________');
        $textrun->addText('_____________________________________________________________________________');
        $textrun->addText('_____________________________________________________________________________');
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('(признать, что государственный гражданский служащий сдал квалификационный экзамен, и рекомендовать его для присвоения классного чина гражданской службы; признать, что государственный гражданский служащий не сдал квалификационный экзамен)', $boldFalseSize8);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('13. Количественный состав аттестационной (конкурсной) комиссии _________');
        
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('На заседании присутствовало ___________ членов аттестационной комиссии');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('Количество голосов за _______, против _______');

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('14. Примечания _______________________________________________________________');

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="Экзаменационный_лист_' . $nameFile . '.docx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("php://output");

        exit;
    }

    private function diffDate($inmoveDateStart, $inmoveDateEnd)
    {
        $date1 = new \DateTimeImmutable($inmoveDateStart);
        $date2 = new \DateTimeImmutable($inmoveDateEnd);
        $interval = $date1->diff($date2);

        return $interval;
    }

    private function mb_lcfirst($str) {
        return mb_strtolower(mb_substr($str, 0, 1)) . mb_substr($str, 1);
    }

    private function diffDateResults($years, $months, $days)
    {
        return "лет: " . $years . ", месяцев: " . $months . ", дней: " . $days;
    }

    private function dmyDateFormat($date) {
        return \Yii::$app->formatter->asDatetime($date, "php:d.m.Y");
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

    public function getDolnjName()
    {
        return $this->hasOne(Doljn::className(), ['id' => 'idm_doljn']);
    }

    public function getOtdelText()
    {
        return $this->hasOne(Otdel::className(), ['id' => 'idm_otdel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneSprs()
    {
        return $this->hasMany(PhoneSpr::className(), ['idm_empl' => 'id']);
    }
}
