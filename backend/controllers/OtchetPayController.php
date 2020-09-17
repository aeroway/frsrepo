<?php

namespace backend\controllers;

use Yii;
use backend\models\OtchetPay;
use backend\models\OtchetPaySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use backend\models\OtchetnstatSearch;
use yii\filters\AccessControl;

/**
 * OtchetPayController implements the CRUD actions for OtchetPay model.
 */
class OtchetPayController extends Controller
{
    /**
     * @inheritdoc
     */
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
     * Lists all OtchetPay models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OtchetPaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexstat()
    {
        $searchModel = new OtchetnstatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexstat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OtchetPay model.
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
     * Creates a new OtchetPay model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');

        $model = new OtchetPay();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OtchetPay model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (
                ($model->getOldAttribute('status') == 'Исправлен') and
                ('23UPR\\'.strtoupper(Yii::$app->user->identity->username) != strtoupper($this->findModel($id)->username))
           )
        {
            throw new ForbiddenHttpException('Запрещено редактировать чужие записи.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OtchetPay model.
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
     * Finds the OtchetPay model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OtchetPay the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OtchetPay::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
