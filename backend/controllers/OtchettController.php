<?php

namespace backend\controllers;

use Yii;
use backend\models\Otchett;
use backend\models\OtchettSearch;
use backend\models\OtchetstatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * OtchettController implements the CRUD actions for Otchett model.
 */
class OtchettController extends Controller
{
    public function behaviors()
    {
        return [
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Otchett models.
     * @return mixed
     */
    public function actionIndex()
    {
        $arr = Yii::$app->request->get();
        Otchett::$name = $arr["table"];

        $searchModel = new OtchettSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexstat()
    {
        $arr = Yii::$app->request->get();
        Otchett::$name = $arr["table"];

        $searchModel = new OtchetstatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexstat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Otchett model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $arr = Yii::$app->request->get();
        Otchett::$name = $arr["table"];

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Otchett model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');

        $model = new Otchett();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Otchett model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $arr = Yii::$app->request->get();
        Otchett::$name = $arr["table"];

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            foreach(Yii::$app->request->post() as $fkey) { }
            foreach($fkey as $skey => $svalue) { $attrarr[$skey] = $svalue; }

            if ( ($model->getOldAttribute('status') == 'Исправлен') and ('23UPR\\'.strtoupper(Yii::$app->user->identity->username) != strtoupper($this->findModel($id)->username)) )
            {
                throw new ForbiddenHttpException('Запрещено редактировать чужие записи.');
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id, 'table'=> Otchett::$name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Otchett model.
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
     * Finds the Otchett model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Otchett the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Otchett::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBulk()
    {
        $action = Yii::$app->request->post('action');
        $selection = (array)Yii::$app->request->post('selection');

        foreach($selection as $id)
        {
            Yii::$app->db->createCommand()
            ->update(Yii::$app->session->getFlash('table'), ['username' => $action, 'status' => 'назначено', 'flag' => 2,], "id = $id")->execute();
            //->update(Yii::$app->session->getFlash('table'), ['username' => $action, 'status' => 'назначено',], "id = $id and (flag = 2 or status = 'В работе')")->execute();
        }

        return $this->redirect(['index', 'table'=> Yii::$app->session->getFlash('table')]);

    }
}
