<?php

namespace backend\controllers;

use Yii;
use backend\models\InventoryOrder;
use backend\models\InventoryOrderSearch;
use backend\models\InventoryPartsorder;
use backend\models\InventoryPartsorderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use yii\helpers\ArrayHelper;

/**
 * InventoryPartsorderController implements the CRUD actions for InventoryPartsorder model.
 */
class InventoryPartsorderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all InventoryPartsorder models.
     * @return mixed
     */
    public function actionIndex()
    {
		$searchModel = new InventoryOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InventoryPartsorder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new InventoryPartsorder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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
     * Updates an existing Po model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsPoItem = $model->poItems;

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
     * Deletes an existing InventoryPartsorder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InventoryPartsorder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InventoryPartsorder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InventoryPartsorder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
