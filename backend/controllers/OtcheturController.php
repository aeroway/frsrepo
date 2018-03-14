<?php

namespace backend\controllers;

use Yii;
use backend\models\Otchetur;
use backend\models\OtcheturSearch;
use backend\models\OtcheturstatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * OtcheturController implements the CRUD actions for Otchetur model.
 */
class OtcheturController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class' => AccessControl::classname(),
                'only' => ['create', 'update', 'view', 'delete', 'index'],
                'rules'=>[
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
     * Lists all Otchetur models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Otchetur::$name = Yii::$app->request->get('table'))
            Otchetur::$name = Yii::$app->session->getFlash('table');

        $searchModel = new OtcheturSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize = 300;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexstat()
    {
        if (!Otchetur::$name = Yii::$app->request->get('table'))
            Otchetur::$name = Yii::$app->session->getFlash('table');

        $searchModel = new OtcheturstatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexstat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Otchetur model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Otchetur::$name = Yii::$app->request->get('table'))
            Otchetur::$name = Yii::$app->session->getFlash('table');

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Otchetur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');

        $model = new Otchetur();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Otchetur model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Otchetur::$name = Yii::$app->request->get('table'))
            Otchetur::$name = Yii::$app->session->getFlash('table');

        $model = $this->findModel($id);

        if ( ($model->getOldAttribute('status') == 'Исправлен') and ('23UPR\\'.strtoupper(Yii::$app->user->identity->username) != strtoupper($this->findModel($id)->username)) ) {
            throw new ForbiddenHttpException('Запрещено редактировать чужие записи.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'table' => Otchetur::$name]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Otchetur model.
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
     * Finds the Otchetur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Otchetur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Otchetur::findOne($id)) !== null) {
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
            Yii::$app->db->createCommand()->update(Yii::$app->session->getFlash('table'), [
                'username' => $action,
                'status' => 'назначено',
                'flag' => 2,
            ], "id = $id")->execute();
        }

        return $this->redirect(['index', 'table'=> Yii::$app->session->getFlash('table')]);

    }
}
