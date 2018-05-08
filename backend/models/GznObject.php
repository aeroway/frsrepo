<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gzn_object".
 *
 * @property int $id
 * @property int $gzn_type_check_id
 * @property string $authoritie_check
 * @property string $kn
 * @property int $land_num
 * @property double $land_area
 * @property string $kn_cost
 * @property string $order_check
 * @property string $act_check
 * @property string $date_enforcement
 * @property string $date_check
 * @property string $land_category
 * @property string $requisites_land_user
 * @property string $address_land_plot
 * @property string $type_func_use
 * @property string $description_violation
 * @property string $full_name_inspector
 * @property int $land_category_id
 * @property int $land_user_category_id
 * @property int $area_id
 * @property int $success
 * @property int $checklist
 *
 * @property GznTypeCheck $gznTypeCheck
 * @property GznLandCategory $landCategory
 * @property GznLandUserCategory $landUserCategory
 * @property AreaOtchet $areaOtchet
 * @property GznViolations[] $gznViolations
 */
class GznObject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gzn_object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gzn_type_check_id', 'authoritie_check', 'kn', 'land_num', 'land_area', 'kn_cost', 'order_check', 'act_check', 'address_land_plot', 'type_func_use', 'full_name_inspector', 'land_category_id', 'land_user_category_id'], 'required'],
            [['gzn_type_check_id', 'land_num', 'land_category_id', 'land_user_category_id', 'area_id', 'success', 'checklist'], 'integer'],
            [['authoritie_check', 'kn', 'kn_cost', 'order_check', 'act_check', 'land_category', 'requisites_land_user', 'address_land_plot', 'type_func_use', 'full_name_inspector'], 'string'],
            [['land_area'], 'double'],
            [['date_enforcement', 'date_check', 'description_violation'], 'safe'],
            [['gzn_type_check_id'], 'exist', 'skipOnError' => true, 'targetClass' => GznTypeCheck::className(), 'targetAttribute' => ['gzn_type_check_id' => 'id']],
            [['land_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => GznLandCategory::className(), 'targetAttribute' => ['land_category_id' => 'id']],
            [['land_user_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => GznLandUserCategory::className(), 'targetAttribute' => ['land_user_category_id' => 'id']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => AreaOtchet::className(), 'targetAttribute' => ['area_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gzn_type_check_id' => 'Тип мероприятия',
            'area_id' => 'Район',
            'authoritie_check' => 'Орган проводивший мероприятия',
            'kn' => 'Кадастровый номер',
            'land_num' => 'Количество земельных участков',
            'success' => 'Результативность',
            'checklist' => 'Проверка внесена в ЕРП',
            'land_area' => 'S всего (кв.м.)',
            'kn_cost' => 'Кадастровая стоимость (тыс. руб.)',
            'order_check' => 'На основании',
            'act_check' => 'Наименование проверяемого лица',
            'date_enforcement' => 'Акт (проверки/обследования)',
            'date_check' => 'Год проверки',
            'land_category' => 'Распоряжение',
            'requisites_land_user' => 'Реквизиты и телефон землепользователя',
            'address_land_plot' => 'Адрес земельного участка',
            'type_func_use' => 'Вид функционального использования',
            'description_violation' => 'Акт без нарушения',
            'full_name_inspector' => 'ФИО инспектора',
            'land_category_id' => 'Категория земель',
            'land_user_category_id' => 'Категория землепользователя',
        ];
    }

    public function getIconStatus()
    {
        switch ($this->success) {
            case 1:
                return '<span class="glyphicon glyphicon-ok" title="Результативный"> </span>';
                break;
            default:
                return '<span class="glyphicon glyphicon-remove" title="Нерезультативный"> </span>';
        }
    }

    public function getIconСhecklist()
    {
        switch ($this->checklist) {
            case 1:
                return '<span class="glyphicon glyphicon-ok" title="Проверка внесена в ЕРП"> </span>';
                break;
            default:
                return '<span class="glyphicon glyphicon-remove" title="Проверка не внесена в ЕРП"> </span>';
        }
    }

    // Срок исполнения предписания
    public function getDatePerformancePrescription()
    {
        /*
            Не подсвечивать, если заполнены даты:
            1. Акт проверки исполнения предписания - act_checking
            2. Протокол по ст. 19.5 ч.25 КоАП РФ - repeated
            3. Протокол по ст. 19.5 ч.26 КоАП РФ - decision_judge
        */

        $sqlDatePrescription = '
            SELECT not_done, act_checking, repeated, decision_judge
            FROM [gzn_injunction] inj
            INNER JOIN [gzn_violations] vi ON vi.id = inj.[gzn_violations_id]
            INNER JOIN [gzn_object] ob ON ob.id = vi.[gzn_obj_id]
            WHERE ob. id = ' . $this->id;

        $allDatePrescription = \Yii::$app->db->createCommand($sqlDatePrescription)->queryAll();

        foreach($allDatePrescription as $datePrescription) {
            if($datePrescription["act_checking"] > 0 || $datePrescription["repeated"] > 0 || $datePrescription["decision_judge"] > 0)
                return;

            if(date('Y-m-d', strtotime($datePrescription["not_done"])) <= date('Y-m-d', strtotime("+7 days")))
                return ['class' => 'success'];
        }
    }

    //Дата выдачи предписания
    public function getDateIssuePrescription()
    {
        $localVarOut = '';

        $sqlDatePrescription = '
            SELECT count_term_execution
            FROM [gzn_injunction] inj
            INNER JOIN [gzn_violations] vi ON vi.id = inj.[gzn_violations_id]
            INNER JOIN [gzn_object] ob ON ob.id = vi.[gzn_obj_id]
            WHERE ob. id = ' . $this->id;

        $allDatePrescription = \Yii::$app->db->createCommand($sqlDatePrescription)->queryAll();

        foreach($allDatePrescription as $datePrescription) {
            $localVarOut .= Yii::$app->formatter->asDate($datePrescription["count_term_execution"], 'php:d M Y') . '<br>';
        }

        return $localVarOut;
    }

    // returns the statistic of conducted surveys
    private function getAmountConductedSurveys($name)
    {
        $resultStr = '';
        $localVarOut = '';
        $localVarOut .= "<h4>$name</h4>";
        $localVarOut .= '<table class="table table-bordered table-striped">';

        $amountDateCheck =
          GznObject::find()
            ->select('date_check')
            ->groupBy('date_check')
            ->createCommand()
            ->queryAll();

        $localVarOut .= '<thead><tr><td>Отдел</td>';

        foreach($amountDateCheck as $amount) {
            $localVarOut .= "<td><b>$amount[date_check]</b></td>";
        }

        $localVarOut .= '</tr></thead>';

        $resultStr .= 'select distinct(a.name),';
        for($i = 0; $i < count($amountDateCheck); $i++)
        {
            if($i == 0)
                $resultStr .= "(select count(id) from gzn_object where area_id = go.area_id and gzn_type_check_id = 3 and date_check = '" . $amountDateCheck[$i]['date_check'] . "') as y" . $amountDateCheck[$i]['date_check'];
            else
                $resultStr .= ",(select count(id) from gzn_object where area_id = go.area_id and gzn_type_check_id = 3 and date_check = '" . $amountDateCheck[$i]['date_check'] . "') as y" . $amountDateCheck[$i]['date_check'];
        }
        $resultStr .= ' from gzn_object go left join area a on a.id = go.area_id';

        $resultF = \Yii::$app->db->createCommand($resultStr)->queryAll();

        $localVarOut .= '<tbody>';

        foreach($resultF as $resFv)
        {
            $localVarOut .= '<tr>';
            foreach($resFv as $resSv)
            {
                $localVarOut .= '<td>' . $resSv . '</td>';
            }
            $localVarOut .= '</tr>';
        }
        $localVarOut .= '</tbody>';
        $localVarOut .= '</table>';

        return ($localVarOut);
    }

    // show on a webpage the amount of the fine collected
    public function getAmountFineCollected($id, $name)
    {
        $resultStr = '';
        $localVarOut = '';
        $localVarOut .= "<h4>$name</h4>";
        $localVarOut .= '<table class="table table-bordered table-striped">';

        $amountDateCheck =
          GznObject::find()
            ->select('date_check')
            ->groupBy('date_check')
            ->createCommand()
            ->queryAll();

        $localVarOut .= '<thead><tr><td>Отдел</td>';

        foreach($amountDateCheck as $amount) {
            $localVarOut .= "<td><b>$amount[date_check]</b></td>";
        }

        $localVarOut .= '</tr></thead>';

        $resultStr .= 'select distinct(a.name),';
        for($i = 0; $i < count($amountDateCheck); $i++)
        {
            if($i > 0) $resultStr .= ', ';
            $resultStr .= "(
              SELECT CASE WHEN SUM(amount_fine_collected) IS NULL THEN 0 ELSE SUM(amount_fine_collected) END
              FROM [gzn_violations] vi, [gzn_object] ob, [area] a
              WHERE [adm_punishment_id] = " . $id . "
                AND vi.gzn_obj_id = ob.id
                AND amount_fine_collected IS NOT NULL
                AND go.area_id = ob.area_id
                AND a.id = ob.area_id and ob.date_check = '" . $amountDateCheck[$i]['date_check'] . "'
            ) as y" . $amountDateCheck[$i]['date_check'];
        }
        $resultStr .= ' FROM gzn_object go RIGHT JOIN area a ON a.id = go.area_id';

        $resultF = \Yii::$app->db->createCommand($resultStr)->queryAll();

        $localVarOut .= '<tbody>';

        foreach($resultF as $resFv)
        {
            $localVarOut .= '<tr>';
            foreach($resFv as $resSv)
            {
                $localVarOut .= '<td>' . (is_numeric($resSv) ? number_format($resSv, 2, '.', '') : $resSv) . '</td>';
            }
            $localVarOut .= '</tr>';
        }
        $localVarOut .= '</tbody>';
        $localVarOut .= '</table>';

        return ($localVarOut);
    }

    // save to the word file the amount of the fine collected
    public function getAmountFineCollectedPrint($id, $name)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $tableStyle = array('borderSize' => 1);
        $widthCellOne = 3000;
        $widthCellOther = 1500;
        $cellStyle = array('borderSize' => 1);
        $center = $phpWord->addParagraphStyle('p2Style', ['align' => 'center']);

        $sectionStyle = array
        (
            'orientation' => 'portrait',
            'marginTop' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(80),
            'marginLeft' => 1200,
            'marginRight' => 600,
            'colsNum' => 1,
            'pageNumberingStart' => 1,
        );

        $section = $phpWord->addSection($sectionStyle);
        $textrun = $section->addTextRun();
        $textrun->addText('Сумма взысканного штрафа ' . $name);

        $table = $section->addTable($tableStyle);
        $table->addRow();
        $table->addCell($widthCellOne, $cellStyle)->addText('Отдел', ['bold' => true]);

        $sql = '';

        $amountDateCheck =
          GznObject::find()
            ->select('date_check')
            ->groupBy('date_check')
            ->createCommand()
            ->queryAll();

        foreach($amountDateCheck as $amount) {
            $table->addCell($widthCellOther, $cellStyle)->addText($amount["date_check"], ['bold' => true], $center);
        }

        $sql .= 'select distinct(a.name),';
        for($i = 0; $i < count($amountDateCheck); $i++)
        {
            if($i > 0) $sql .= ', ';
            $sql .= "(
              SELECT CASE WHEN SUM(amount_fine_collected) IS NULL THEN 0 ELSE SUM(amount_fine_collected) END
              FROM [gzn_violations] vi, [gzn_object] ob, [area] a
              WHERE [adm_punishment_id] = " . $id . "
                AND vi.gzn_obj_id = ob.id
                AND amount_fine_collected IS NOT NULL
                AND go.area_id = ob.area_id
                AND a.id = ob.area_id and ob.date_check = '" . $amountDateCheck[$i]['date_check'] . "'
            ) as y" . $amountDateCheck[$i]['date_check'];
        }
        $sql .= ' FROM gzn_object go RIGHT JOIN area a ON a.id = go.area_id';

        $resultF = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach($resultF as $resFv)
        {
            $table->addRow();
            foreach($resFv as $resSv)
            {
                if(is_numeric($resSv)) {
                    $table->addCell($widthCellOther, $cellStyle)->addText(number_format($resSv, 2, '.', ''), ['bold' => false], $center);
                } else {
                    $table->addCell($widthCellOther, $cellStyle)->addText($resSv);
                }
            }
        }

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="word.docx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("php://output");

        exit;
    }

    public function getGznViolationsCount()
    {
        $localVarOut = '';

        //$localVarOut .= self::getAmountFineCollected(1, 'Сумма взысканного штрафа по ст. 7.1 КоАП РФ');
        //$localVarOut .= self::getAmountFineCollected(3, 'Сумма взысканного штрафа по ст. 8.8 ч. 1 КоАП РФ');
        $localVarOut .= self::getAmountConductedSurveys('Проведено административных обследований');

        return $localVarOut;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznTypeCheckName()
    {
        return $this->gznTypeCheck->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreaOtchetName()
    {
        return empty($this->areaOtchet->name) ? '' : str_replace(' отдел', '', $this->areaOtchet->name);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznTypeCheck()
    {
        return $this->hasOne(GznTypeCheck::className(), ['id' => 'gzn_type_check_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLandCategory()
    {
        return $this->hasOne(GznLandCategory::className(), ['id' => 'land_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLandUserCategory()
    {
        return $this->hasOne(GznLandUserCategory::className(), ['id' => 'land_user_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznViolations()
    {
        return $this->hasMany(GznViolations::className(), ['gzn_obj_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreaOtchet()
    {
        return $this->hasOne(AreaOtchet::className(), ['id' => 'area_id']);
    }
}
