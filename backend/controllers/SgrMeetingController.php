<?php

namespace backend\controllers;

use Yii;
use backend\models\SgrMeeting;
use backend\models\SgrMeetingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * SgrMeetingController implements the CRUD actions for SgrMeeting model.
 */
class SgrMeetingController extends Controller
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
     * Lists all SgrMeeting models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SgrMeetingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgrMeeting model.
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
     * Creates a new SgrMeeting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SgrMeeting();
        $uniqId = uniqid();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {

                $model->questions_file = UploadedFile::getInstance($model, 'questions_file');

                if ($model->questions_file) {
                    $model->questions_file->name = $uniqId . '_' . $model->questions_file->name;
                }

                $model->protocol = UploadedFile::getInstance($model, 'protocol');

                if ($model->protocol) {
                    $model->protocol->name = $uniqId . '_' . $model->protocol->name;
                }

                $model->setDateEvent($model->dateTimeEvent);
                $model->year = Yii::$app->formatter->asDate($model->dateTimeEvent, 'php:Y');
                $model->save();

                if ($model->questions_file) {
                    $model->questions_file->saveAs($model->pathSovGosRegDocMeeting . $model->questions_file->baseName . '.' . $model->questions_file->extension);
                }

                if ($model->protocol) {
                    $model->protocol->saveAs($model->pathSovGosRegDocMeeting . $model->protocol->baseName . '.' . $model->protocol->extension);
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
     * Updates an existing SgrMeeting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $fileDoc = $model->questions_file;
        $fileProtocol = $model->protocol;
        $isNewfileDoc = false;
        $isNewfileProtocol = false;
        $uniqId = uniqid();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {
            $model->questions_file = UploadedFile::getInstance($model, 'questions_file');
            $model->protocol = UploadedFile::getInstance($model, 'protocol');

            $model->setDateEvent($model->dateTimeEvent);
            $model->year = Yii::$app->formatter->asDate($model->dateTimeEvent, 'php:Y');

            if (empty($model->questions_file) && !empty($fileDoc)) {
                $model->questions_file = $fileDoc;
                $isNewfileDoc = false;
            } else {
                $model->questions_file->name = $uniqId . '_' . $model->questions_file->name;
                $isNewfileDoc = true;
            }

            if (empty($model->protocol) && !empty($fileProtocol)) {
                $model->protocol = $fileProtocol;
                $isNewfileProtocol = false;
            } else {
                $model->protocol->name = $uniqId . '_' . $model->protocol->name;
                $isNewfileProtocol = true;
            }

            $model->save();

            if ($isNewfileDoc) {
                $model->saveFile($model->questions_file, $fileDoc);
            }

            if ($isNewfileProtocol) {
                $model->saveFile($model->protocol, $fileProtocol);
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SgrMeeting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->questions_file) {
            if (file_exists($model->pathSovGosRegDocMeeting . $model->questions_file)) {
                unlink($model->pathSovGosRegDocMeeting . $model->questions_file);
            }
        }

        if ($model->protocol) {
            if (file_exists($model->pathSovGosRegDocMeeting . $model->protocol)) {
                unlink($model->pathSovGosRegDocMeeting . $model->protocol);
            }
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SgrMeeting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SgrMeeting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgrMeeting::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
