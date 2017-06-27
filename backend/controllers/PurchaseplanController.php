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
use backend\models\Okpd2Sprav;
use yii\db\Query;

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
        $smeta = Spending::find()->where(['id'=>$id])->one();

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
    public function actionCreate($sid, $fe = 0)
    {
        $model = new PurchasePlan();

        if ($fe > 0) {

            if ($model->load(Yii::$app->request->post())) {

                if($model->econom)
                    $model->econom = implode(",", $model->econom);

                $model->save();

                return $this->redirect(['index',
                 'id' => $model->st_id
                 ]);

            } else {

                return $this->render('update', [
                    'model' => $model,
                    'id' => $model->st_id
                ]);

            }

        } else {

            if  ((Yii::$app->request->post()) && ($model->load(Yii::$app->request->post()))) {

                if($model->econom) {
                    $model->econom = implode(",", $model->econom);
                }
                $model->save();

                return $this->redirect(['index', 'id' => $sid]);

            } else {

                return $this->render('create', [
                    'model' => $model,
                    'sid' => $sid,
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
    public function actionUpdate($sid, $page, $sort)
    {
        $model = $this->findModel($sid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'page' => $page, 'sort' => $sort, 'id' => $model->st_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'id' => $model->st_id
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

    public function actionOkpdlist($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '', 'name' => '']];

        if (!is_null($q))
        {
            $query = new Query;
            $query->select('code as id, code AS text, name')
                ->from('okpd2_sprav')
                ->where(['or', ['like', 'code', $q], ['like', 'name', $q]])
                ->limit(20);
            $command = $query->createCommand(\Yii::$app->db6);
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0)
        {
            $out['results'] = ['id' => $id, 'text' => Okpd2Sprav::find($id)->code, 'name' => Okpd2Sprav::find($id)->name];
        }

        return $out;
    }

    public function actionOkpdlistexist($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '', 'name' => '']];

        if (!is_null($q))
        {
            $query = new Query;
            $query->select('id, okpd AS text, name_object AS name')
                ->from('purchase_plan')
                ->where(['and', ['=', 'is_top', 1], ['or', ['like', 'okpd', $q], ['like', 'name_object', $q]]])
                ->limit(20);
            $command = $query->createCommand(\Yii::$app->db6);
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0)
        {
            $out['results'] = ['id' => $id, 'text' => PurchasePlan::find($id)->okpd, 'name' => PurchasePlan::find($id)->name_object];
        }

        return $out;
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
