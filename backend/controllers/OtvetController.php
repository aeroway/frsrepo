<?php

namespace backend\controllers;

use Yii;
use backend\models\Vopros;
use backend\models\Otvet;
use backend\models\OtvetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OtvetController implements the CRUD actions for Otvet model.
 */
class OtvetController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['create', 'update', 'view', 'delete', 'index', 'log'],
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
     * Lists all Otvet models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new OtvetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $modelVopros = $this->findModelVopros($id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelVopros' => $modelVopros,
        ]);
    }

    /**
     * Displays a single Otvet model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->redirect(['vopros/index']);

        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Creates a new Otvet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Otvet();
        $modelVopros = $this->findModelVopros($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->vopros_id = $modelVopros->id;
            $model->save();

            return $this->redirect(['index', 'id' => $model->vopros_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelVopros' => $modelVopros,
        ]);
    }

    /**
     * Updates an existing Otvet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelVopros = $this->findModelVopros($model->vopros_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $modelVopros->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelVopros' => $modelVopros,
        ]);
    }

    /**
     * Deletes an existing Otvet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $modelVopros = $this->findModelVopros($model->vopros_id);
        $model->delete();

        return $this->redirect(['index', 'id' => $modelVopros->id]);
    }

    /**
     * Finds the Otvet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Otvet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Otvet::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelVopros($id)
    {
        if (($model = Vopros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
