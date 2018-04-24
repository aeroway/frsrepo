<?php

namespace backend\controllers;

use Yii;
use backend\models\GznObject;
use backend\models\GznObjectSearch;
use backend\models\GznViolations;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * GznObjectController implements the CRUD actions for GznObject model.
 */
class GznObjectController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['create', 'update', 'view', 'delete', 'index', 'stat', 'reset', 'index2'],
                'rules'=> [
                    [
                        'allow' => true,
                        'roles' => ['@']
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
     * Lists all GznObject models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!in_array("GznEdit", Yii::$app->user->identity->groups) && !in_array("GznDelete", Yii::$app->user->identity->groups) && !in_array("GznView", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $searchModel = new GznObjectSearch();

        $params = Yii::$app->request->queryParams;

        if (count($params) <= 1) {
            $params = Yii::$app->session['GznObjectSearch'];
            if(isset(Yii::$app->session['GznObjectSearch']['page']))
                $_GET['page'] = Yii::$app->session['GznObjectSearch']['page'];
        } else {
            Yii::$app->session['GznObjectSearch'] = $params;
        }

        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GznObject model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!in_array("GznEdit", Yii::$app->user->identity->groups) && !in_array("GznDelete", Yii::$app->user->identity->groups) && !in_array("GznView", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        if(!in_array("GznEdit", Yii::$app->user->identity->groups) && !in_array("GznDelete", Yii::$app->user->identity->groups) && !in_array("GznView", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionStat()
    {
        return $this->render('stat');
    }

    /**
     * Creates a new GznObject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        if(!in_array("GznEdit", Yii::$app->user->identity->groups) && !in_array("GznDelete", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = new GznObject();
        $modelsGznViolations = [new GznViolations];
 
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $modelsGznViolations = Model::createMultiple(GznViolations::classname());
            Model::loadMultiple($modelsGznViolations, Yii::$app->request->post());
 
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsGznViolations) && $valid;
 
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsGznViolations as $modelGznViolations) {
                            $modelGznViolations->gzn_obj_id = $model->id;
                            if (! ($flag = $modelGznViolations->save(false))) {
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
                'modelsGznViolations' => (empty($modelsGznViolations)) ? [new GznViolations] : $modelsGznViolations
            ]);
        }
    }

    /**
     * Updates an existing GznObject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!in_array("GznEdit", Yii::$app->user->identity->groups) && !in_array("GznDelete", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = $this->findModel($id);
        $modelsGznViolations = $model->gznViolations;
 
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $oldIDs = ArrayHelper::map($modelsGznViolations, 'id', 'id');
            $modelsGznViolations = Model::createMultiple(GznViolations::classname(), $modelsGznViolations);
            Model::loadMultiple($modelsGznViolations, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsGznViolations, 'id', 'id')));
 
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsGznViolations) && $valid;
 
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            GznViolations::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsGznViolations as $modelGznViolations) {
                            $modelGznViolations->gzn_obj_id = $model->id;
                            if (! ($flag = $modelGznViolations->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id]);
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
 
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsGznViolations' => (empty($modelsGznViolations)) ? [new GznViolations] : $modelsGznViolations
            ]);
        }
    }

    /**
     * Deletes an existing GznObject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!in_array("GznDelete", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GznObject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GznObject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GznObject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionSelectpunishment()
	{
		$model = new GznObject();
		$id = Yii::$app->request->get('id');
        $name = Yii::$app->request->get('name');

		if ($id)
		{
			// Найти всех сотрудников в отделе
			$result = $model->getAmountFineCollected($id, $name);
			return $result;
        }

		return 0;
	}

    // reset session
    public function actionReset()
    {
        Yii::$app->session['GznObjectSearch'] = '';
        return $this->redirect(['index']);
    }
}
