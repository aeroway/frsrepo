<?php

namespace backend\controllers;

use Yii;
use backend\models\Otchetfiz;
use backend\models\OtchetfizSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

/**
 * OtchetfizController implements the CRUD actions for Otchetfiz model.
 */
class OtchetfizController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access'=> [
                'class' => AccessControl::classname(),
                'only' => ['create', 'update', 'view', 'delete', 'index'],
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Otchetfiz models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OtchetfizSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 300;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Otchetfiz model.
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

    /**
     * Creates a new Otchetfiz model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');

        $model = new Otchetfiz();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Otchetfiz model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ( ($model->getOldAttribute('status') == 'Исправлен') and ('23UPR\\'.strtoupper(Yii::$app->user->identity->username) != strtoupper($this->findModel($id)->username)) ) {
            throw new ForbiddenHttpException('Запрещено редактировать чужие записи.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Otchetfiz model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Otchetfiz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Otchetfiz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Otchetfiz::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBulk()
    {
        $action = Yii::$app->request->post('action');
        $selection = (array)Yii::$app->request->post('selection');

        foreach($selection as $id)
        {
            Yii::$app->db->createCommand()->update(Yii::$app->session->getFlash('table'), ['username' => $action, 'status' => 'назначено', 'flag' => 2,], "id = $id")->execute();
        }

        return $this->redirect(['index', 'table'=> Yii::$app->session->getFlash('table')]);

    }
}
