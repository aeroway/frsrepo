<?php

namespace backend\controllers;

use backend\models\SgrRegulations;
use backend\models\SgrRegulationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * SgrRegulationsController implements the CRUD actions for SgrRegulations model.
 */
class SgrRegulationsController extends Controller
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
                    'only'=>['create','update','view','delete','index'],
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
     * Lists all SgrRegulations models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SgrRegulationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgrRegulations model.
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
     * Creates a new SgrRegulations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SgrRegulations();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $model->file_doc = UploadedFile::getInstance($model, 'file_doc');
                $model->save();

                if ($model->file_doc) {
                    $model->file_doc->saveAs($model->pathSovGosRegDocRegulations . $model->file_doc->baseName . '.' . $model->file_doc->extension);
                }

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
     * Updates an existing SgrRegulations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $fileDoc = $model->file_doc;
        $isNew = false;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {
            $model->file_doc = UploadedFile::getInstance($model, 'file_doc');

            if (empty($model->file_doc) && !empty($fileDoc)) {
                $model->file_doc = $fileDoc;
                $isNew = false;
            } else {
                $isNew = true;
            }

            if ($model->file_doc) {
                $fileDocPath = $model->pathSovGosRegDocRegulations . $fileDoc;

                if ($isNew) {
                    $fileDocNew = $model->file_doc->baseName . '.' . $model->file_doc->extension;
                    $fileDocNewPath = $model->pathSovGosRegDocRegulations . $fileDocNew;

                    if ($fileDocNew != $fileDoc && !empty($fileDoc)) {
                        if (file_exists($fileDocPath)) {
                            unlink($fileDocPath);
                        }
                    }

                    // $model->file_doc = $fileDocNewPath;
                    $model->save();
                    $model->file_doc->saveAs($fileDocNewPath);
                } else {
                    $model->save();
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SgrRegulations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->file_doc) {
            if (file_exists($model->pathSovGosRegDocRegulations . $model->file_doc)) {
                unlink($model->pathSovGosRegDocRegulations . $model->file_doc);
            }
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SgrRegulations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SgrRegulations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgrRegulations::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
