<?php

namespace backend\controllers;

use Yii;
use backend\models\Req;
use backend\models\Otdelreq;
use backend\models\Cel;
use backend\models\Type;
use backend\models\ReqLog;
use backend\models\ReqSearch;
use backend\models\ReqLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * ReqController implements the CRUD actions for Req model.
 */
class ReqController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::classname(),
                'only'=>['create', 'update', 'view', 'delete', 'index', 'log', 'createdatereturn', 'setcuruser'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['@']
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Req models.
     * @return mixed
     */
     
    /*
        Доступ запрещён, если user нет в группах.
        Иначе ReqSearch покажет данные по фильтру.
    */
    public function actionIndex()
    {
        $this->checkAccess();

        $searchModel = new ReqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Req model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->checkAccess();

        if(in_array("alvl1", Yii::$app->user->identity->groups))
        {
            $this->checkCurrentUser($id);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionLog($logid)
    {
        $this->checkAccess();
        if(!in_array("alvl3", Yii::$app->user->identity->groups) and !in_array("alvl4", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $searchModel = new ReqLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('log', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Req model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!in_array("alvl1", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = new Req();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Req model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $this->checkAccess();

        if(!in_array("alvl4", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $this->addLog($id,$model);
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionPrint($status)
    {
        if(!in_array("alvl3", Yii::$app->user->identity->groups) and !in_array("alvl4", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $query = Req::find()->select('id')->where(['status' => $status])->asArray()->all();

        if(($status != 5 and $status != 6 and $status != 11) or empty($query))
        {
            return '<h1>Нет документов на печать.</h1>';
        }

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $properties = $phpWord->getDocInfo();

        $properties->setCreator('Stepan Zakharov');
        $properties->setCompany('FRSKuban');
        $properties->setTitle('Get request');
        $properties->setDescription('The service of request from archive');
        $properties->setCategory('Archives');
        $properties->setLastModifiedBy('PHPWord');
        $properties->setCreated(time());
        $properties->setModified(time());
        $properties->setSubject('Print to file');
        $properties->setKeywords('req, archive');

        $sectionStyle = array
        (
            'orientation' => 'portrait',
            'marginTop' => \PhpOffice\PhpWord\Shared\Converter::pixelToTwip(80),
            'marginLeft' => 1200,
            'marginRight' => 600,
            'colsNum' => 1,
            'pageNumberingStart' => 1,
        );

        $pStyle = array('align' => 'left', 'spaceBefore' => 0, 'spaceAfter' => 0,);
        $fStyle1 = array('bold' => TRUE);
        $fStyle2 = array('bold' => FALSE);

        $section = $phpWord->addSection($sectionStyle);

        for($i = 0; $i <= count($query)-1; $i++)
        {
            $model = $this->findModel($query[$i]["id"]);

            $modelOtdel = Otdelreq::find()->select('text')->where(['id'=>$model->otdel])->one();
            $modelCel = Cel::find()->select('text')->where(['id'=>$model->cel])->one();
            $modelType = Type::find()->select('text')->where(['id'=>$model->type])->one();

            $textrun = $section->createTextRun($pStyle);
            if(!empty($model->org))
            {
                $textrun->addText('Банк', $fStyle2);
                $textrun->addTextBreak(1);
            }
            $textrun->addText('Заявка ', $fStyle1);
            $textrun->addText('№'.$model->id, $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('Срочность заявки: ', $fStyle1);
            $textrun->addText($model->fast ? 'Срочная' : 'Обычная', $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('Цель получения заявки: ', $fStyle1); 
            $textrun->addText($modelCel->text, $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('Дата: ', $fStyle1); 
            $textrun->addText(date('d.m.Y H:i:s', strtotime($model->date_in)), $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('Отдел: ', $fStyle1);
            $textrun->addText($modelOtdel->text, $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('Для кого: ', $fStyle1); 
            $textrun->addText($model->user_to, $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('Адрес объекта: ', $fStyle1); 
            $textrun->addText($model->obj_addr, $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('Архивный материал: ', $fStyle1); 
            $textrun->addText($modelType->text, $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('КН: ', $fStyle1); 
            $textrun->addText($model->kn, $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('КУВД: ', $fStyle1); 
            $textrun->addText($model->kuvd, $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('Исполнитель: ', $fStyle1); 
            $textrun->addText($model->cur_user, $fStyle2);
            $textrun->addTextBreak(1);
            $textrun->addText('Срок: ', $fStyle1); 
            $textrun->addText(date('d.m.Y', strtotime($model->srok)), $fStyle2);
            $textrun->addTextBreak(2);

            $model->user_print = Yii::$app->user->identity->username;
            $model->print_date = date("Y-m-d H:i:s");
            $model->status = 2;
            $model->save();
        }

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="word.docx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("php://output");
    }

    public function actionSetcuruser($id, $page, $sort, $status, $idReqsearch)
    {
        if(!in_array("alvl3", Yii::$app->user->identity->groups) and !in_array("alvl4", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post()))
        {
            /*if($model->getAttribute('status') > $model->getOldAttribute('status') or
                ($model->getAttribute('status') == 5 and $model->getOldAttribute('status') == 6) or
                ($model->getAttribute('status') == 6 and $model->getOldAttribute('status') == 5)
              )
            {*/
                $model->save();
                $this->addLog($id, $model);

                if(!empty($idReqsearch))
                    return $this->redirect(['index', 'page' => $page, 'sort' => $sort, 'ReqSearch[status]' => $status, 'ReqSearch[id]' => $idReqsearch]);
                return $this->redirect(['index', 'page' => $page, 'sort' => $sort, 'ReqSearch[status]' => $status]);
            //}
            //else 
            //{
                //throw new ForbiddenHttpException('Вам запрещено менять статус на значение ниже текущего.');
            //}
        } else {
            return $this->renderAjax('setcuruser', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatedatereturn($id, $page, $sort)
    {
        //$this->checkAccess();

        if(!in_array("alvl3", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $this->addLog($id,$model);

            return $this->redirect(['index', 'page' => $page, 'sort' => $sort]);

        } else {
            return $this->renderAjax('createdatereturn', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Req model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id)
    {
        // Удалять запись может назначенный "Пользователь"
        $this->checkCurrentUser($id);

        // Удалять запись может состоящий в группе, если запись со статусом "Новая"
        if($this->findModel($id)->status !== 1 or !in_array("alvl1", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Req model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Req the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Req::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function checkAccess() 
    {
        if(
            !in_array("alvl1", Yii::$app->user->identity->groups) and
            !in_array("alvl2", Yii::$app->user->identity->groups) and
            !in_array("alvl3", Yii::$app->user->identity->groups) and
            !in_array("alvl4", Yii::$app->user->identity->groups)
        )
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
        else
        {
            /* if need to search multiaccess
            $arr1 = Yii::$app->user->identity->groups;
            $arr2 = array("alvl1", "alvl2", "alvl3", "alvl4");
            $g = null;

            for($i = 0; $i<count($arr1); $i++)
                for($j = 0; $j<count($arr2); $j++)
                    if($arr1[$i] === $arr2[$j])
                    {
                        $g++;
                        //echo $i. " Элемент массива arr1 совпал с ".$j." Элементом массива arr2<br>";
                    }
            if($g>1) throw new ForbiddenHttpException('Пользователь состоит больше, чем в одной группе.');
            */
        }
    }

    private function checkCurrentUser($id)
    {
        if(Yii::$app->user->identity->username !== $this->findModel($id)->user_text AND '23UPR\\' . Yii::$app->user->identity->username !== $this->findModel($id)->user_text AND '23UPRS\\' . Yii::$app->user->identity->username !== $this->findModel($id)->user_text)
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
    }

    private function addLog($id,$model)
    {
        $modellog = new ReqLog();

        foreach($model as $key => $value)
        {
            if($key == 'id')
                $modellog->log_id = $id;

            if($key != 'id')
                $modellog->$key = $value;
        }

        foreach(Yii::$app->request->post() as $fkey) { }
        foreach($fkey as $skey => $svalue) { $modellog->$skey = $svalue; }

        $modellog->log_user = Yii::$app->user->identity->username;
        $modellog->save();
    }
}
