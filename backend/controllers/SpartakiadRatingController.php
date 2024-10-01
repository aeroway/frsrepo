<?php

namespace backend\controllers;

use backend\models\SpartakiadRating;
use backend\models\SpartakiadRatingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\helpers\Json;

/**
 * SpartakiadRatingController implements the CRUD actions for SpartakiadRating model.
 */
class SpartakiadRatingController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all SpartakiadRating models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SpartakiadRatingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a muliple SpartakiadRating model.
     * @return string
     */
    public function actionIndexPart()
    {
        $searchModel = new SpartakiadRatingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index-part', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SpartakiadRating model.
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
     * Creates a new SpartakiadRating model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SpartakiadRating();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SpartakiadRating model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SpartakiadRating model.
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

    public function actionRating()
    {
        if (Yii::$app->request->post('hasEditable')) {
            $spartakiadRatingId = Yii::$app->request->post('editableKey');
            $modelSpartakiadRating = SpartakiadRating::findOne($spartakiadRatingId);
            $posted = current($_POST['SpartakiadRating']);
            $post = ['SpartakiadRating' => $posted];

            if ($modelSpartakiadRating->load($post)) {
                $modelSpartakiadRating->save();
                $out = Json::encode(['output' => '<script>window.location.reload(1)</script>', 'message' => '']);
            }

            return $out;
        }
    }

    /**
     * Finds the SpartakiadRating model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SpartakiadRating the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SpartakiadRating::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
