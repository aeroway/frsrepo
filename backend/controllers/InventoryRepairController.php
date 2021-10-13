<?php

namespace backend\controllers;

use Yii;
use backend\models\InventoryRepair;
use backend\models\InventoryRepairSearch;
use backend\models\InventoryRepairLog;
use backend\models\InventoryRepairLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

/**
 * InventoryRepairController implements the CRUD actions for InventoryRepair model.
 */
class InventoryRepairController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['create', 'update', 'view', 'delete', 'index', 'send-email-mo', 'log'],
                'rules' => [
                    [
                        'allow' => true,
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
     * Lists all InventoryRepair models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InventoryRepairSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InventoryRepair model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionLog($id)
    {
        $searchModel = new InventoryRepairLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('log', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new InventoryRepair model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->checkAccess();

        $model = new InventoryRepair();
        $modelLog = new InventoryRepairLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelLog->area = $model->area;
            $modelLog->name = $model->name;
            $modelLog->invnum = $model->invnum;
            $modelLog->inventory_moo = $model->inventory_moo;
            $modelLog->inventory_status = $model->inventory_status;
            $modelLog->note = $model->note;
            $modelLog->email = $model->email;
            $modelLog->username = $model->username;
            $modelLog->inventory_repair_id = $model->id;
            $modelLog->save();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InventoryRepair model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->checkAccess();

        $model = $this->findModel($id);
        $modelLog = new InventoryRepairLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelLog->area = $model->area;
            $modelLog->name = $model->name;
            $modelLog->invnum = $model->invnum;
            $modelLog->inventory_moo = $model->inventory_moo;
            $modelLog->inventory_status = $model->inventory_status;
            $modelLog->note = $model->note;
            $modelLog->email = $model->email;
            $modelLog->date_edit = $model->date_edit;
            $modelLog->username = $model->username;
            $modelLog->inventory_repair_id = $model->id;
            $modelLog->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InventoryRepair model.
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

    public function actionSendEmailMo($id)
    {
        $this->checkAccess();

        $model = $this->findModel($id);
        $model->sendEmailMo();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InventoryRepair model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InventoryRepair the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InventoryRepair::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function checkAccess()
    {
        if(!in_array("ИТО", Yii::$app->user->identity->groups)) {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
    }
}
