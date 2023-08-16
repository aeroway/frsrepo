<?php

namespace backend\controllers;

use Yii;
use backend\models\Otchetpriost;
use backend\models\OtchetpriostSearch;
use backend\models\OtchetprioststatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use backend\models\OtchetpriostSuspension;
/**
 * OtchetpriostController implements the CRUD actions for Otchetpriost model.
 */
class OtchetpriostController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::classname(),
                'only'=>['create', 'update', 'view', 'delete', 'index'],
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
     * Lists all Otchetpriost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OtchetpriostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexstat()
    {
        $searchModel = new OtchetprioststatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexstat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Otchetpriost model.
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
     * Creates a new Otchetpriost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Otchetpriost();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();

            if ($model->suspensionId) {
                foreach ($model->suspensionId as $value) {
                    $modelOtchetpriostSuspension = new OtchetpriostSuspension();
                    $modelOtchetpriostSuspension->otchetpriost_id = $model->id;
                    $modelOtchetpriostSuspension->suspension_articles_id = $value;
                    $modelOtchetpriostSuspension->save();
                }
            }

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Otchetpriost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (mb_strtoupper(Yii::$app->user->identity->username) !== mb_strtoupper($model->username)) {
            throw new ForbiddenHttpException('Запрещено редактировать чужие записи.');
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->save();

            if ($model->suspensionId) {
                foreach ($model->suspensionId as $value) {
                    $modelOtchetpriostSuspension = new OtchetpriostSuspension();
                    $modelOtchetpriostSuspension->otchetpriost_id = $model->id;
                    $modelOtchetpriostSuspension->suspension_articles_id = $value;
                    $modelOtchetpriostSuspension->save();
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Otchetpriost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (mb_strtoupper(Yii::$app->user->identity->username) !== mb_strtoupper($model->username)) {
            throw new ForbiddenHttpException('Запрещено редактировать чужие записи.');
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Otchetpriost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Otchetpriost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Otchetpriost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBulk()
    {
        $action = Yii::$app->request->post('action');
        $selection = (array)Yii::$app->request->post('selection');

        foreach($selection as $id)
        {
            Yii::$app->db->createCommand()->update('otchetpriost', [
                'username' => $action, 
                'status' => 'назначено', 
                'flag' => 2,
            ], "id = $id")
            ->execute();
        }

        return $this->redirect(['index']);
    }
}
