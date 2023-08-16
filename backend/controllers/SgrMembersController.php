<?php

namespace backend\controllers;

use backend\models\SgrMembers;
use backend\models\SgrMembersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * SgrMembersController implements the CRUD actions for SgrMembers model.
 */
class SgrMembersController extends Controller
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
     * Lists all SgrMembers models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SgrMembersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgrMembers model.
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
     * Creates a new SgrMembers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SgrMembers();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $model->photo = UploadedFile::getInstance($model, 'photo');
                $save = $model->save();

                if ($model->photo && $model->validate()) {
                    $model->photo->saveAs('uploads/sov-gos-reg/' . $model->photo->baseName . '.' . $model->photo->extension);
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
     * Updates an existing SgrMembers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $photo = $model->photo;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            $save = $model->save();

            if ($model->photo && $model->validate()) {
                $photoPath = 'uploads/sov-gos-reg/' . $photo; 
                $photoNewPath = 'uploads/sov-gos-reg/' . $model->photo->baseName . '.' . $model->photo->extension;
                $photoName = $model->photo->baseName . '.' . $model->photo->extension;

                if ($photoName != $photo) {
                    unlink($photoPath);
                }

                $model->photo->saveAs($photoNewPath);
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SgrMembers model.
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

    /**
     * Finds the SgrMembers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SgrMembers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgrMembers::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
