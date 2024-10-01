<?php

namespace backend\controllers;

use Yii;
use backend\models\GenTeamMembers;
use backend\models\GenTeamMembersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * GenTeamMembersController implements the CRUD actions for GenTeamMembers model.
 */
class GenTeamMembersController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access'=>[
                    'class'=>AccessControl::classname(),
                    'only'=>['create', 'update', 'view', 'delete', 'index', 'create-team', 'activation', 'deactivation'],
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
            ]
        );
    }

    /**
     * Lists all GenTeamMembers models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GenTeamMembersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination->pageSize = 50;
        $model = new GenTeamMembers();

        if ($model->load($this->request->post())) {
            $model->statusGenTeamBarcode();

            return $this->refresh();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single GenTeamMembers model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GenTeamMembers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new GenTeamMembers();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GenTeamMembers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GenTeamMembers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCreateTeam()
    {
        $model = new GenTeamMembers();
        $model->createTeam();

        return $this->redirect(['index']);
    }

    public function actionActivation($id)
    {
        $model = new GenTeamMembers();
        $model->activation($id);

        return $this->redirect(['index']);
    }

    public function actionDeactivation($id)
    {
        $model = new GenTeamMembers();
        $model->deactivation($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the GenTeamMembers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return GenTeamMembers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GenTeamMembers::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
