<?php

namespace backend\controllers;

use Yii;
use backend\models\Area;
use backend\models\AreaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;


/**
 * OtchetController implements the CRUD actions for Otchet model.
 */
class DashboardController extends Controller
{
    public function behaviors()
    {
        return [
			'access'=>[
				'class'=>AccessControl::classname(),
				'only'=>['create','update','view','delete','index'],
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
     * Lists all Otchet models.
     * @return mixed
     */
    public function actionIndex()
    {
/*
        $model = new Area();
        $data = $model->find()->All();
        
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit();
        
  */      $searchModel = new AreaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Otchet model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($otdel)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

}
