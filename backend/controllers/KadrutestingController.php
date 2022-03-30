<?php

namespace backend\controllers;

use Yii;
use backend\models\Otdel;
use backend\models\Vopros;
use backend\models\Res;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * KadrutestingController implements the CRUD actions for Kadrutesting model.
 */
class KadrutestingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['create', 'update', 'view', 'delete', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
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
     * Lists all Kadrutesting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Vopros();
        $modelRes = new Res();

        if ($modelRes->load(Yii::$app->request->post())) {
            if ($modelRes->checkHourLimit() === false) {
                Yii::$app->session->setFlash('success', "Количество правильных ответов: " . (empty($modelRes->testingResult()->pr) ? 0 : $modelRes->testingResult()->pr));
            } else {
                if (!empty($modelRes->id_otvet)) {
                    $modelRes->fio = empty(Yii::$app->user->identity->fio) ? Yii::$app->user->identity->username : Yii::$app->user->identity->fio;
                    $modelRes->date_in = date("Y-m-d H:i:s.000");
                    $modelRes->ip = Yii::$app->request->userIP;
                    $modelRes->save();
                }

                $questionRes = $model->questionRes($modelRes->otdel_id);

                if (!empty($questionRes)) {
                    $answers = $model->answers($questionRes->id);

                    return $this->render('answers', [
                        'questionRes' => $questionRes,
                        'answers' => $answers,
                        'modelRes' => $modelRes,
                    ]);
                } else {
                    Yii::$app->session->setFlash('success', "Количество правильных ответов: " . (empty($modelRes->testingResult()->pr) ? 0 : $modelRes->testingResult()->pr));
                }
            }
        } elseif (($model->load(Yii::$app->request->post()) || !empty($model->otdel_id))) {
            if ($modelRes->checkHourLimit() === false) {
                Yii::$app->session->setFlash('success', "Количество правильных ответов: " . (empty($modelRes->testingResult()->pr) ? 0 : $modelRes->testingResult()->pr));
            } else {
                $questionRes = $model->questionRes($model->otdel_id);

                if (!empty($questionRes)) {
                    $answers = $model->answers($questionRes->id);

                    return $this->render('answers', [
                        'questionRes' => $questionRes,
                        'answers' => $answers,
                        'modelRes' => $modelRes,
                    ]);
                } else {
                    Yii::$app->session->setFlash('success', "Количество правильных ответов: " . (empty($modelRes->testingResult()->pr) ? 0 : $modelRes->testingResult()->pr));
                }
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Vopros model.
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
     * Creates a new Vopros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vopros();

        if (Yii::$app->request->get('id') > 0) {
            $modelOtdel = $this->findModelOtdel(Yii::$app->request->get('id'));
        }

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($modelOtdel->id)) {
                $model->otdel_id = $modelOtdel->id;
            } elseif (is_int($model->otdel_id)) {
                $modelOtdel = $this->findModelOtdel($model->otdel_id);
            } else {
                $modelOtdel = new Otdel;
                $modelOtdel->text = $model->otdel_id;
            }

            $modelOtdel->date_start = $model->date_start;
            $modelOtdel->date_stop = $model->date_stop;
            $modelOtdel->save();

            if (!is_int($model->otdel_id)) {
                $model->otdel_id = $modelOtdel->id;
            }

            if ($model->save()) {
                return $this->redirect(['otvet/create', 'id' => $model->id]);
            }

            return $this->redirect(['vopros/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Vopros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        if (Yii::$app->request->get('id') > 0) {
            $id = Yii::$app->request->get('id');
            $model = $this->findModel($id);
        }
        
        if (Yii::$app->request->get('otdel_id') > 0) {
            $id = Yii::$app->request->get('otdel_id');
            $model = $this->findModelOtdel($id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->request->get('otdel_id') > 0) {
                return $this->redirect(['index']);
            }

            return $this->redirect(['index', 'id' => $model->otdel_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vopros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $modelOtdel = $this->findModelOtdel($model->otdel_id);
        $model->delete();

        return $this->redirect(['index', 'id' => $modelOtdel->id]);
    }

    /**
     * Finds the Vopros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vopros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vopros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelOtdel($id)
    {
        if (($model = Otdel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
