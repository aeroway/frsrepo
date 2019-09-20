<?php

namespace backend\controllers;

use Yii;
use backend\models\OraKuvdMain;
use backend\models\OraKuvdMainSearch;
use backend\models\OraKuvdMainListSearch;
use backend\models\ViewByFioSearch;
use backend\models\ViewByFio;
use backend\models\ViewByOtdelSearch;
use backend\models\ViewByOtdel;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use backend\models\AreaOtchet;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * OraKuvdMainController implements the CRUD actions for OraKuvdMain model.
 */
class OraKuvdMainController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::classname(),
                'only'=>['view', 'index', 'list', 'otdels', 'details', 'details-otdel'],
                'rules'=>[
                    [
                        'allow' => false,
                        'roles' => ['@']
                    ],
                ]
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
     * Lists all OraKuvdMain models.
     * @return mixed
     */
/*
    public function actionIndex()
    {
        $searchModel = new OraKuvdMainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
*/
    public function actionIndex(){  
        $filials = ArrayHelper::map(AreaOtchet::find()->orderBy('name')->all(),'fl','name');
        $searchModel = new ViewByOtdelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('_otdels', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filials'   =>  $filials,
        ]);
    }
    
    public function actionList()
    {  
        //$filials = OraKuvdMain::getFilialList();
        $filials = ArrayHelper::map(AreaOtchet::find()->orderBy('name')->all(),'fl','name');
        $searchModel = new ViewByFioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $params = Yii::$app->request->queryParams;
        $out_name = AreaOtchet::find()->where(['fl'=>$params['ViewByFioSearch']['otdel']])->one()->name;

/*
        $query = OraKuvdMain::find()
        ->select(['fio'])
                ->groupBy(['fio']);

        $dataProvider = new ActiveDataProvider([
                    'query' =>  $query,
                    ]);
*/

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filials'   =>  $filials,
            'params'    =>Yii::$app->request->queryParams,
            'otdel' =>  $out_name,
        ]);
    }
    
    public function actionOtdels()
    {  
        $filials = ArrayHelper::map(AreaOtchet::find()->orderBy('name')->all(),'fl','name');
        $searchModel = new ViewByOtdelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('_otdels', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filials'   =>  $filials,
        ]);
    }

    public function actionDetails($t = null, $fio = null, $fl = null)
    {
        if ($t != null) {
            if ($fl != NULL) {
                $otdel_name = AreaOtchet::find()->where(['fl' => $fl])->one()->name;
            } else {
                $otdel_name = $fio;
            }

            if ($t == 1) {
                $query = ViewByFio::getDopDocAll($fio);
                $title = 'Не рассмотрены дополнительные документы';

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => false,
                ]);
            }

            if ($t == 2) {
                $query = ViewByFio::getDoublePriost($fio);
                $title = 'Приостановка после рассмотрения доп. документов';

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => false,
                ]);
            }

            if ($t == 3) {
                $query = ViewByFio::getProsrochkaUp2($fio);
                $title = 'Будет просрочено через 2 дня';

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => false,
                ]);
            }

            if ($t == 4) {
                $query = ViewByFio::getNoUvedoml($fio);
                $title = 'Не сформированы уведомления';

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => false,
                ]);
            }

            if ($t == 5) {
                $query = ViewByFio::getProsrochenoRows($fio);
                $title = 'Просрочено';

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => false,
                ]);
            }

            if ($t == 6) {
                $query = ViewByFio::getAllPr($fio);
                $title = 'Приостановки';

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => false,
                ]);
            }

            if ($t == 7) {
                $query = ViewByFio::getAllOtkaz($fio);
                $title = 'Отказы';

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => false,
                ]);
            }

            // if ($t == 5) {
            //     $dataProvider = new ActiveDataProvider([
            //         'query' =>  ViewByFio::getOtkazByOtdel($fl),
            //     ]);
            // }

            return $this->render('_details', [
                //'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'fio' => $fio,
                'title' => $title,
                'otdel_name' => $otdel_name,
                'fl' => $fl,
            ]);    
        }
    }

    public function actionDetailsOtdel($t=null,$fio=null,$fl=null)
    {  
        if ($t != null ){
            if ($fl != NULL){
                $otdel = AreaOtchet::find()->where(['fl'=>$fl])->one()->name;
            }
            
            if ($t==1){
                $dataProvider = new ActiveDataProvider([
                    'query' =>  ViewByFio::getDopDocAllByOtdel($fl),
                    ]);    
            }
            if ($t==2){
                $dataProvider = new ActiveDataProvider([
                    'query' =>  ViewByFio::getDoublePriostByOtdel($fl),
                    ]);    
            }
            if ($t==3){
                $dataProvider = new ActiveDataProvider([
                    'query' =>  ViewByFio::getProsrochkaUp2ByOtdel($fl),
                    ]);    
            }
            if ($t==4){
                $dataProvider = new ActiveDataProvider([
                    'query' =>  ViewByFio::getNoUvedomlByOtdel($fl),
                    ]);    
            }
            if ($t==5){
                $dataProvider = new ActiveDataProvider([
                    'query' =>  ViewByFio::getOtkazByOtdel($fl),
                    ]);    
            }
            
        }

/*
        $filials = OraKuvdMain::getFilialList();
        $searchModel = new OraKuvdMainListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = OraKuvdMain::find()
        ->select(['fio'])
                ->groupBy(['fio']);
        
        $dataProvider = new ActiveDataProvider([
                    'query' =>  $query,
                    ]);
*/

        return $this->render('_details_otdel', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'otdel'   =>  $otdel,
        ]);
    }

    /**
     * Displays a single OraKuvdMain model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

}
