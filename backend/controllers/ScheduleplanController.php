<?php

namespace backend\controllers;

use Yii;
use backend\models\PurchasePlan;
use backend\models\SchedulePlan;
use backend\models\SchedulePlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * ScheduleplanController implements the CRUD actions for SchedulePlan model.
 */
class ScheduleplanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SchedulePlan models.
     * @return mixed
     */
    public function actionIndex($sid)
    {
        $searchModel = new SchedulePlanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = PurchasePlan::findOne($sid);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sid' => $sid,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single SchedulePlan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelpp = PurchasePlan::find()->where(['id'=>$model->pp_id])->one();

            return $this->render('view', [
                'model' => $model,
                'modelpp' => $modelpp,
                'sid' =>  $model->pp_id,
            ]);
        
    }
    

    /**
     * Creates a new SchedulePlan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($sid)
    {
        $model = new SchedulePlan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'sid' => $sid]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'sid' => $sid,
            ]);
        }
    }

    /**
     * Updates an existing SchedulePlan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($sid, $page, $sort)
    {
        $model = $this->findModel($sid);
        $modelpp = PurchasePlan::find()->where(['id'=>$model->pp_id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index',
             'sid' => $model->pp_id, 
             'page' => $page, 
             'sort' => $sort
             ]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelpp' => $modelpp,
                'sid' =>  $model->pp_id,
            ]);
        }
    }

    /**
     * Deletes an existing SchedulePlan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SchedulePlan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SchedulePlan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SchedulePlan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
