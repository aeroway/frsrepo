<?php

namespace backend\controllers;

use Yii;
use backend\models\Stazh;
use backend\models\Education;
use backend\models\Inmove;
use backend\models\Employee;
use backend\models\LnkChin;
use backend\models\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['create', 'update', 'view', 'delete', 'index', 'exam-list'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->checkAccess();
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->checkAccess();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->checkAccess();
        $model = new Employee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->checkAccess();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->checkAccess();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionExamList($id)
    {
        $this->checkAccess();
        $inmoveDateStart = NULL;
        $inmoveDateEnd = NULL;
        $inmoveCountElements = NULL;
        $inmoveDiffDate =  0;
        $stazhGs = ["years" => 0, "months" => 0, "days" => 0];
        $stazhFull   = ["years" => 0, "months" => 0, "days" => 0];
        $modelStazh = new Stazh();
        $modelInmove = new Inmove();
        $modelEmployee = new Employee();
        $modelEducation = new Education();
        $modelLnkChin = new LnkChin();

        foreach ($modelStazh->stazhGs($id) as $stazh) {
            $stazhGsDiffDate = $this->diffDate($stazh["date_start"], $stazh["date_end"]);
            $stazhGs["years"] += $stazhGsDiffDate->y;
            $stazhGs["months"] += $stazhGsDiffDate->m;
            $stazhGs["days"] += $stazhGsDiffDate->d;
        }

        foreach ($modelStazh->stazh($id) as $stazh) {
            $stazhDiffDate = $this->diffDate($stazh["date_start"], $stazh["date_end"]);
            $stazhFull["years"] += $stazhDiffDate->y;
            $stazhFull["months"] += $stazhDiffDate->m;
            $stazhFull["days"] += $stazhDiffDate->d;
        }

        $inmove = $modelInmove->inmoveEmployee($id);
        $inmoveCountElements = count($inmove);

        foreach ($inmove as $key => $inmv) {

            if ($key === 0) {
                $inmoveDateStart = $inmv["date_start"];
            }

            if ($key === $inmoveCountElements-1) {
                if (empty($inmv["date_end"])) {
                    $inmoveDateEnd = date('Y-m-d H:i:s');
                } else {
                    $inmoveDateEnd = $inmv["date_end"];
                }

                $inmoveDiffDate = $this->diffDate($inmoveDateStart, $inmoveDateEnd);
            }
        }

        $staff = $modelEmployee->employeePositionDepartment($id);
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
        $textrun->addText($this->diffDateResults($stazhGs["years"] + $inmoveDiffDate->y, $stazhGs["months"] + $inmoveDiffDate->m, $stazhGs["days"] + $inmoveDiffDate->d), $boldFalseItalicTrueUnderlineSingle);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('6. Общий трудовой стаж: ');
        $textrun->addText($this->diffDateResults($stazhFull["years"] + $inmoveDiffDate->y, $stazhFull["months"] + $inmoveDiffDate->m, $stazhFull["days"] + $inmoveDiffDate->d), $boldFalseItalicTrueUnderlineSingle);

        $textrun = $section->addTextRun($sectionStyleSpacing);
        $textrun->addText('7. Классный чин гражданской службы: ');
        $textrun->addText($this->mb_lcfirst($rank["text"]) . ', ' . \Yii::$app->formatter->asDatetime($rank["date_start"], "php:d.m.Y"), $boldFalseItalicTrueUnderlineSingle);

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
        header('Content-Disposition: attachment; filename="Экзаменационный_лист_' . $nameFile . '.docx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("php://output");

        exit;
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function diffDate($inmoveDateStart, $inmoveDateEnd)
    {
        $date1 = new \DateTime($inmoveDateStart);
        $date2 = new \DateTime($inmoveDateEnd);
        $interval = $date1->diff($date2);

        return $interval;
    }

    private function diffDateResults($years, $months, $days)
    {
        for ($months; $months > 12; $months-12) {
            $years = $years + 1;
            $months = $months - 12;
        }

        return "лет: " . $years . ". месяцев: " . $months . ". дней: " . $days;
    }

    private function checkAccess()
    {
        if(!in_array("Кадры", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
    }

    private function mb_lcfirst($str) {
        return mb_strtolower(mb_substr($str, 0, 1)) . mb_substr($str, 1);
    }
}