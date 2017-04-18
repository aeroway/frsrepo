<?php

namespace backend\controllers;

use Yii;
use backend\models\PurchasePlan;
use backend\models\PurchaseplanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use backend\models\Spending;

/**
 * PurchaseplanController implements the CRUD actions for PurchasePlan model.
 */
class PurchaseplanController extends Controller
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
     * Lists all PurchasePlan models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new PurchaseplanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $smeta = Spending::findOne($id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
            'smeta' => $smeta,
        ]);
    }

    /**
     * Displays a single PurchasePlan model.
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
     * Creates a new PurchasePlan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id, $fe = 0)
    {
        $model = new PurchasePlan();

        if ($fe > 0)
        {
            /*
            $post = Yii::$app->request->post('PurchasePlan');
            $model->type = $post['type'];
            $model->okpd = $post['okpd'];
            $model->name_object = $post['name_object'];
            $model->outlay = $post['outlay'];
            $model->p_year = $post['p_year'];
            $model->c_year = $post['c_year'];
            $model->special = $post['special'];
            //$model->sum = $post['sum'];
            $model->st_id = $post['st_id'];
            $model->f_row = $post['f_row'];
            $model->year = $post['year'];
            */

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'id' => $model->st_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

            /*
            if ($model->save())
            {
                return $this->redirect(['index', 'id' => $model->st_id]);
            }
            */
        }
        else
        {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'id' => $id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'id' => $id,
                ]);
            }
        }
    }

    /**
     * Updates an existing PurchasePlan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $page, $sort)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'page' => $page, 'sort' => $sort, 'id' => $model->st_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PurchasePlan model.
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
     * Finds the PurchasePlan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurchasePlan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurchasePlan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
