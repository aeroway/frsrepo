<?php

namespace backend\controllers;

use Yii;
use backend\models\AbEmployee;
use backend\models\AbEmplSys;
use backend\models\AbEmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * AbEmployeeController implements the CRUD actions for AbEmployee model.
 */
class AbemployeeController extends Controller
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
     * Lists all AbEmployee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AbEmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AbEmployee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AbEmployee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(!in_array("AccountBlockingAdmin", Yii::$app->user->identity->groups))
		{
			throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
		}

        $model = new AbEmployee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			for($i=1; count(Yii::$app->request->post()["AbEmployee"]["systemslist"]) >= $i; $i++)
			{
				Yii::$app->db3->createCommand()
				->insert('[account_blocking].[dbo].[ab_empl_sys]', [
				'id_empl' => $model->id,
				'id_systems' => Yii::$app->request->post()["AbEmployee"]["systemslist"][$i-1],
				'id_status' => Yii::$app->request->post()["AbEmployee"]["id_status"],
				])->execute();
			}

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AbEmployee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if(!in_array("AccountBlockingAdmin", Yii::$app->user->identity->groups))
		{
			throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
		}

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AbEmployee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(!in_array("AccountBlockingAdmin", Yii::$app->user->identity->groups))
		{
			throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
		}
        $model = AbEmployee::updateAll(['act' => 0],'id = '.$id);
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the AbEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AbEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AbEmployee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModel2($id)
    {
        if (($model = AbEmplSys::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionDoit()
	{
		$model = new Abemployee();
		$id = Yii::$app->request->get('id');
		if ($id)
		{
			// Найти всех сотрудников в отделе
			$result = $model->getAllEmployee($id);
			return $result;
        }
		return 0;
	}
}
