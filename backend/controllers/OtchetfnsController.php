<?php

namespace backend\controllers;

use Yii;
use backend\models\Otchetfns;
use backend\models\OtchetfnsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * OtchetfnsController implements the CRUD actions for Otchetfns model.
 */
class OtchetfnsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::classname(),
                'only'=>['create', 'update', 'view', 'delete', 'index', 'reset', 'stat-fns', 'select-status2', 'count-status2'],
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Otchetfns models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OtchetfnsSearch();
        $params = Yii::$app->request->queryParams;

        if (count($params) <= 1) {
            $params = Yii::$app->session['OtchetfnsSearch'];

            if(isset(Yii::$app->session['OtchetfnsSearch'])) {
                $_GET = Yii::$app->session['OtchetfnsSearch'];
            }
        } else {
            Yii::$app->session['OtchetfnsSearch'] = $params;
        }

        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Otchetfns model.
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
     * Creates a new Otchetfns model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');

        $model = new Otchetfns();

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
     * Updates an existing Otchetfns model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Otchetfns model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    // reset session
    public function actionReset()
    {
        Yii::$app->session['OtchetfnsSearch'] = NULL;

        return $this->redirect(['index']);
    }

    public function actionStatFns()
    {
        $fns =
        (new \yii\db\Query())
            ->from('stat_fns')
            ->orderBy(["ne_otrab" => SORT_DESC])
            ->all();

        return $this->render('stat-fns', ['fns' => $fns]);
    }

    public function actionSelectStatus2()
    {
        return
        (new \yii\db\Query())
            ->select('kn')
            ->from('otchetfns')
            ->where(['status2' => NULL])
            ->one()['kn'];
    }

    public function actionCountStatus2()
    {
        return
        (new \yii\db\Query())
            ->select('count(*) ct')
            ->from('otchetfns')
            ->where(['status2' => NULL])
            ->one()['ct'];
    }

    /**
     * Finds the Otchetfns model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Otchetfns the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Otchetfns::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
