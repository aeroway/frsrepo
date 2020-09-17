<?php

namespace backend\controllers;

use Yii;
use backend\models\GznInjunction;
use backend\models\GznInjunctionSearch;
use backend\models\GznAllInjunctionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * GznInjunctionController implements the CRUD actions for GznInjunction model.
 */
class GznInjunctionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::classname(),
                'only'=>['create', 'update', 'view', 'delete', 'index', 'injunction'],
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all GznInjunction models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!in_array("GznEdit", Yii::$app->user->identity->groups) && !in_array("GznDelete", Yii::$app->user->identity->groups) && !in_array("GznView", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $searchModel = new GznInjunctionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInjunction()
    {
        if(!in_array("GznEdit", Yii::$app->user->identity->groups) && !in_array("GznDelete", Yii::$app->user->identity->groups) && !in_array("GznView", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $searchModel = new GznAllInjunctionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('injunction', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GznInjunction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(!in_array("GznEdit", Yii::$app->user->identity->groups) && !in_array("GznDelete", Yii::$app->user->identity->groups) && !in_array("GznView", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GznInjunction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!in_array("GznEdit", Yii::$app->user->identity->groups) && !in_array("GznDelete", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = new GznInjunction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GznInjunction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!in_array("GznEdit", Yii::$app->user->identity->groups) && !in_array("GznDelete", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GznInjunction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(!in_array("GznDelete", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index', 'id' => !empty($_GET['sid']) ? $_GET['sid'] : '', 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '']);
    }

    /**
     * Finds the GznInjunction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GznInjunction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GznInjunction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
