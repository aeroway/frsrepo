<?php

namespace backend\controllers;

use Yii;
use backend\models\Otchetlist;
use backend\models\OtchetlistSearch;
use backend\models\DbConnectEgrp;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
/**
 * OtchetlistController implements the CRUD actions for Otchetlist model.
 */
class OtchetlistController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'stat', 'statx', 'update', 'view', 'stat-employee', 'stat-appoint',
                            'create', 'stat-39-range', 'stat-index', 'stat-index-ora', 'stat-index-tp', 'stat-index-otchet', 'stat-index-otchet-priost',
                            'status-reception', 'status-registration', 'number-applications', 'status-regkuvd-999', 'status-regkuvd'
                        ],
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
     * Lists all Otchetlist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OtchetlistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /* not used anymore */
    public function actionStat()
    {
        $searchModel = new OtchetlistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('stat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStatIndex($tblname)
    {
        return $this->render('stat-index', [
            'tblname' => $tblname,
        ]);
    }

    public function actionStat39Range($tblname)
    {
        return $this->render('stat-39-range', [
            'tblname' => $tblname,
        ]);
    }

    public function actionStatusRegistration()
    {
        $model = new DbConnectEgrp();
        $fromDate = Yii::$app->request->post('fromDate');
        $tillDate = Yii::$app->request->post('tillDate');

        if ($fromDate && $tillDate) {
            $model->getInstance();
            $result = $model->getStatusRegistration($fromDate, $tillDate);

            return $this->render('status-registration-index', [
                'result' => $result,
                'fromDate' => $fromDate,
                'tillDate' => $tillDate,
            ]);
        } else {
            return $this->render('status-registration-index');
        }
    }

    public function actionStatusRegkuvd()
    {
        $model = new DbConnectEgrp();
        $fromDate = Yii::$app->request->post('fromDate');
        $tillDate = Yii::$app->request->post('tillDate');

        if ($fromDate && $tillDate) {
            $model->getInstance();
            $result = $model->getStatusRegkuvd($fromDate, $tillDate);

            return $this->render('status-regkuvd-index', [
                'result' => $result,
                'fromDate' => $fromDate,
                'tillDate' => $tillDate,
            ]);
        } else {
            return $this->render('status-regkuvd-index');
        }
    }

    public function actionStatusRegkuvd999()
    {
        $model = new DbConnectEgrp();
        $fromDate = Yii::$app->request->post('fromDate');
        $tillDate = Yii::$app->request->post('tillDate');

        if ($fromDate && $tillDate) {
            $model->getInstance();
            $result = $model->getStatusRegkuvd999($fromDate, $tillDate);

            return $this->render('status-regkuvd-999-index', [
                'result' => $result,
                'fromDate' => $fromDate,
                'tillDate' => $tillDate,
            ]);
        } else {
            return $this->render('status-regkuvd-999-index');
        }
    }

    public function actionStatusReception()
    {
        $model = new DbConnectEgrp();
        $fromDate = Yii::$app->request->post('fromDate');
        $tillDate = Yii::$app->request->post('tillDate');

        if ($fromDate && $tillDate) {
            $model->getInstance();
            $result = $model->getStatusReception($fromDate, $tillDate);

            return $this->render('status-reception-index', [
                'result' => $result,
                'fromDate' => $fromDate,
                'tillDate' => $tillDate,
            ]);
        } else {
            return $this->render('status-reception-index');
        }
    }

    public function actionNumberApplications()
    {
        $model = new DbConnectEgrp();
        $fromDate = Yii::$app->request->post('fromDate');
        $tillDate = Yii::$app->request->post('tillDate');

        if ($fromDate && $tillDate) {
            $model->getInstance();
            $result = $model->getNumberApplications($fromDate, $tillDate);

            return $this->render('number-applications-index', [
                'result' => $result,
                'fromDate' => $fromDate,
                'tillDate' => $tillDate,
            ]);
        } else {
            return $this->render('number-applications-index');
        }
    }

    public function actionStatIndexOra()
    {
        $model = new DbConnectEgrp();
        if (Yii::$app->request->post('fromDate') && Yii::$app->formatter->asDate(Yii::$app->request->post('tillDate'))) {
            $model->getInstance();
            $result = $model->getStat();

            return $this->render('stat-index-ora', ['result' => $result]);
        } else {
            return $this->render('stat-index-ora');
        }
    }

    public function actionStatIndexTp()
    {
        if(!in_array("ИТО", Yii::$app->user->identity->groups) && Yii::$app->user->identity->username != 'Осипов СЛ') {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = new Otchetlist();
        $phone = Yii::$app->request->post('phone');
        $fromDate = Yii::$app->request->post('fromDate');
        $tillDate = Yii::$app->request->post('tillDate');

        if ($phone && $fromDate && $tillDate && $phone != '3017' && $phone != '3015') {
            return $this->render('stat-index-tp', [
                'result' => $model->getStatTp($phone, $fromDate, $tillDate) . $model->getStatPhone($phone, $fromDate, $tillDate),
                'phone' => $phone,
                'fromDate' => $fromDate,
                'tillDate' => $tillDate,
            ]);
        } else {
            return $this->render('stat-index-tp');
        }
    }

    public function actionStatIndexOtchet($tblname)
    {
        if(!in_array("ИТО", Yii::$app->user->identity->groups) && Yii::$app->user->identity->username != 'Осипов СЛ') {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = new Otchetlist();
        $fromDate = Yii::$app->request->post('fromDate');
        $tillDate = Yii::$app->request->post('tillDate');

        if ($tblname && $fromDate && $tillDate) {
            $model->getOtchetExcel($tblname, $fromDate, $tillDate);

            return $this->render('stat-index-otchet', [
                'tblname' => $tblname,
                'fromDate' => $fromDate,
                'tillDate' => $tillDate,
            ]);
        } else {
            return $this->render('stat-index-otchet', [
                'tblname' => $tblname,
            ]);
        }
    }

    public function actionStatIndexOtchetPriost($tblname)
    {
        if(!in_array("ИТО", Yii::$app->user->identity->groups) && Yii::$app->user->identity->username != 'Осипов СЛ') {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = new Otchetlist();
        $fromDate = Yii::$app->request->post('fromDate');
        $tillDate = Yii::$app->request->post('tillDate');

        if ($tblname && $fromDate && $tillDate) {
            $model->getOtchetPriostExcel($tblname, $fromDate, $tillDate);

            return $this->render('stat-index-otchet-priost', [
                'tblname' => $tblname,
                'fromDate' => $fromDate,
                'tillDate' => $tillDate,
            ]);
        } else {
            return $this->render('stat-index-otchet-priost', [
                'tblname' => $tblname,
            ]);
        }
    }

    /**
     * Displays a single Otchetlist model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionStatx($tblname)
    {
        return $this->render('statx', [
            'tblname' => $tblname,
        ]);
    }

    public function actionStatEmployee($tblname)
    {
        $employee =
        (new \yii\db\Query())
            ->select([new \yii\db\Expression("SUBSTRING(username, CHARINDEX('\', username)+1, 10000) AS username, count(*) ct")])
            ->from($tblname)
            ->where(["and", ["=", "status", "Исправлен"], ["=", "flag", 0]])
            ->groupBy("username")
            ->orderBy(["ct" => SORT_DESC])
            ->all();

        return $this->render('stat-employee', [
            'tblname' => $tblname,
            'employee' => $employee
        ]);
    }

    public function actionStatAppoint($tblname)
    {
        $employee =
        (new \yii\db\Query())
            ->select([new \yii\db\Expression("SUBSTRING(username, CHARINDEX('\', username)+1, 10000) AS username, count(*) ct")])
            ->from($tblname)
            ->where(['and', ['or', ['=', 'status', 'назначено'], ['=', 'flag', 1]], ['like', 'kn', '23:43:']])
            ->groupBy("username")
            ->orderBy(["username" => SORT_ASC])
            ->all();

        return $this->render('stat-employee', [
            'tblname' => $tblname,
            'employee' => $employee
        ]);
    }

    /**
     * Creates a new Otchetlist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->checkAccess();

        $model = new Otchetlist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Otchetlist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->checkAccess();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Otchetlist model.
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
     * Finds the Otchetlist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Otchetlist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Otchetlist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function checkAccess()
    {
        if(!in_array("ИТО", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
    }
}
