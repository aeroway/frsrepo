<?php

namespace backend\controllers;

use Yii;
use backend\models\InventoryOrder;
use backend\models\InventoryOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use backend\models\InventoryPartsorder;
use backend\models\InventoryPartsorderSearch;
use backend\models\Model;
use yii\helpers\ArrayHelper;
use backend\models\Inventory;
use backend\models\InventoryParts;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * InventoryOrderController implements the CRUD actions for InventoryOrder model.
 */
class InventoryOrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::classname(),
                'only'=>['create','update','view','delete','index','indexlist'],
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
        ];
    }

    /**
     * Lists all InventoryOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->checkAccess();

        $searchModel = new InventoryOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexlist()
    {
        $this->checkAccess2();

        $searchModel = new InventoryOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAct($id)
    {
        $this->checkAccess2();

        $searchModel = new InventoryOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = $this->findModel($id);
        $model->attributes = [
            'status_id_invor' => 5,
            'date_invor' => date("Y-m-d H:i:s"),
        ];
        $model->save();

        return $this->render('indexlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionClose($id)
    {
        $this->checkAccess2();

        $searchModel = new InventoryOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = $this->findModel($id);
        $model->attributes = [
            'status_id_invor' => 3,
            'date_invor' => date("Y-m-d H:i:s"),
        ];
        $model->save();

        return $this->render('indexlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single InventoryOrder model.
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

    /**
     * Creates a new InventoryOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->checkAccess();

        $model = new InventoryOrder();
        $modelsPoItem = [new InventoryPartsorder];

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $modelsPoItem = Model::createMultiple(InventoryPartsorder::classname());
            Model::loadMultiple($modelsPoItem, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPoItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPoItem as $modelPoItem) {
                            $modelPoItem->id_partsorder_invor = $model->id;
                            if (! ($flag = $modelPoItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsPoItem' => (empty($modelsPoItem)) ? [new InventoryPartsorder] : $modelsPoItem
            ]);
        }
    }

    /**
     * Updates an existing InventoryOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->checkAccess2();

        $model = $this->findModel($id);
        $modelsPoItem = $model->idPartsorderInvor;

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $oldIDs = ArrayHelper::map($modelsPoItem, 'id', 'id');
            $modelsPoItem = Model::createMultiple(InventoryPartsorder::classname(), $modelsPoItem);
            Model::loadMultiple($modelsPoItem, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPoItem, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPoItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            InventoryPartsorder::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPoItem as $modelPoItem) {
                            $modelPoItem->id_partsorder_invor = $model->id;
                            if (! ($flag = $modelPoItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsPoItem' => (empty($modelsPoItem)) ? [new InventoryPartsorder] : $modelsPoItem
            ]);
        }
    }

    /**
     * Deletes an existing InventoryOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->checkAccess2();

        // Для удаления запчастей связанных с объектом
        //InventoryPartsorder::deleteAll(['id_partsorder_invor' => $id]);
        //$this->findModel($id)->delete();

        $model = $this->findModel($id);
        $model->attributes = [
            'active_invor' => 0,
            'date_invor' => date("Y-m-d H:i:s"),
        ];
        $model->save();

        return $this->redirect(['indexlist']);
    }

    /**
     * Finds the InventoryOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InventoryOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InventoryOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLists($id)
    {
        $invs = Inventory::find()
            ->where(['invnum' => $id])
            ->all();

            foreach($invs as $inv)
            {
                echo $inv->invname;
            }
    }

    public function actionValidation()
    {
        $invpar = InventoryParts::find()
            ->where(['nameparts' => Yii::$app->request->get('namepart')])
            ->one();

        if ($invpar["amount"] == 0)
        {
            return 'Нет на складе';
        }

        if( ($invpar["amount"] - Yii::$app->request->get('count')) < 0 )
        {
            return $invpar["amount"];
        }
    
        if( (Yii::$app->request->get('count')) < 0)
        {
            return 'Запрещено';
        }
    }

    private function checkAccess()
    {
        if(
            !in_array("AdminInventory", Yii::$app->user->identity->groups) and
            !in_array("ManagerInventory", Yii::$app->user->identity->groups)
        )
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
    }

    private function checkAccess2()
    {
        if(!in_array("AdminInventory", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
    }

}
