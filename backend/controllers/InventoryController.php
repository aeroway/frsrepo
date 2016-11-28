<?php

namespace backend\controllers;

use Yii;
use backend\models\Inventory;
use backend\models\InventorySearch;
use backend\models\InventoryLog;
use backend\models\InventoryLogSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ConflictHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * InventoryController implements the CRUD actions for Inventory model.
 */
class InventoryController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::classname(),
                'only'=>['create','update','view','delete','index','log'],
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
     * Lists all Inventory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->checkAccess();

        $searchModel = new InventorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inventory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->checkAccess();

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionLog($invnum)
    {
        $this->checkAccess();

        $searchModel = new InventoryLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('log', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new Inventory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->checkAccess();

        $model = new Inventory();

        if ($model->load(Yii::$app->request->post()))
        {

            $rows = Inventory::find()->select('id')->where(['invnum' => $model->invnum])->limit(1)->all();

            if($rows)
            {
                throw new ConflictHttpException('Запись с таким инвентарным номером уже есть.');
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Inventory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->checkAccess();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            foreach(Yii::$app->request->post() as $fkey) { }
            foreach($fkey as $skey => $svalue) { $attrarr[$skey] = $svalue; }

            $modellog = new InventoryLog();
            $modellog->attributes = [
                'invname' => $attrarr["invname"],
                'invnum' => $attrarr["invnum"],
                'id_moo' => $attrarr["id_moo"],
                'location' => $attrarr["location"],
                'id_typetech' => $attrarr["id_typetech"],
                'date' => $attrarr["date"],
                'id_status' => $attrarr["id_status"],
                'comment' => $attrarr["comment"],
                'authority' => $attrarr["authority"],
                'waybill' => $attrarr["waybill"],
                'username' => Yii::$app->user->identity->username,
            ];
            $modellog->insert(true);

            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdatee($id,$page,$sort)
    {
        $this->checkAccess();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            foreach(Yii::$app->request->post() as $fkey) { }
            foreach($fkey as $skey => $svalue) { $attrarr[$skey] = $svalue; }

            $modellog = new InventoryLog();
            $modellog->attributes = [
                'invname' => $attrarr["invname"],
                'invnum' => $attrarr["invnum"],
                'id_moo' => $attrarr["id_moo"],
                'location' => $attrarr["location"],
                'id_typetech' => $attrarr["id_typetech"],
                'date' => $attrarr["date"],
                'id_status' => $attrarr["id_status"],
                'comment' => $attrarr["comment"],
                'authority' => $attrarr["authority"],
                'waybill' => $attrarr["waybill"],
                'username' => Yii::$app->user->identity->username,
            ];
            $modellog->insert(true);

            return $this->redirect(['index', 'page' => $page, 'sort' => $sort]);
        }
        else
        {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Inventory model.
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
     * Finds the Inventory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
/*
    protected function findModellog($id)
    {
        if (($model = InventoryLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
*/
    private function checkAccess()
    {
        if(
            !in_array("AdminInventory", Yii::$app->user->identity->groups) and
            !in_array("ManagerInventory", Yii::$app->user->identity->groups)
        )
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
        else
        {
            $arr1 = Yii::$app->user->identity->groups;
            $arr2 = array("AdminInventory", "ManagerInventory");
            $g = null;

            for($i = 0; $i<count($arr1); $i++)
                for($j = 0; $j<count($arr2); $j++)
                    if($arr1[$i] === $arr2[$j])
                    {
                        $g++;
                        //echo $i. " Элемент массива arr1 совпал с ".$j." Элементом массива arr2<br>";
                    }
            if($g>1) throw new ForbiddenHttpException('Пользователь состоит больше, чем в одной группе.');
        }
    }
}
