<?php

namespace backend\controllers;

use Yii;
use backend\models\Planstages;
use backend\models\PlanstagesSearch;
use backend\models\Plannotes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

/**
 * PlanstagesController implements the CRUD actions for Planstages model.
 */
class PlanstagesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['create', 'update', 'view', 'delete', 'index', 'createmodal'],
                'rules' => [
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
     * Lists all Planstages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlanstagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Planstages model.
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
     * Creates a new Planstages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Planstages();
        $modelsPlannotes = [new Plannotes];
 
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $modelsPlannotes = Model::createMultiple(Plannotes::classname());
            Model::loadMultiple($modelsPlannotes, Yii::$app->request->post());
 
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPlannotes) && $valid;
 
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPlannotes as $modelPlannotes) {
                            $modelPlannotes->pstages_id = $model->id;
                            if (! ($flag = $modelPlannotes->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index',
                            'id' => $model->ptask_id,
                            'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',
                            'page' => !empty($_GET['page']) ? $_GET['page'] : '',
                            'sort' => !empty($_GET['sort']) ? $_GET['sort'] : '',
                        ]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsPlannotes' => (empty($modelsPlannotes)) ? [new Plannotes] : $modelsPlannotes
            ]);
        }
    }

    public function actionCreatemodal($id, $sid, $pid, $page, $sort)
    {
        $model = new Plannotes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index',
                'id' => $id,
                'pid' => $pid,
                'page' => !empty($_GET['page']) ? $_GET['page'] : '',
                'sort' => !empty($_GET['sort']) ? $_GET['sort'] : '',
            ]);
        }

        return $this->renderAjax('createmodal', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Planstages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsPlannotes = $model->plannotes;
 
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $oldIDs = ArrayHelper::map($modelsPlannotes, 'id', 'id');
            $modelsPlannotes = Model::createMultiple(Plannotes::classname(), $modelsPlannotes);
            Model::loadMultiple($modelsPlannotes, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPlannotes, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPlannotes) && $valid;
 
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Plannotes::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPlannotes as $modelPlannotes) {
                            $modelPlannotes->pstages_id = $model->id;
                            if (! ($flag = $modelPlannotes->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index', 
                            'id' => $model->ptask_id,
                            'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',
                            'page' => !empty($_GET['page']) ? $_GET['page'] : '',
                            'sort' => !empty($_GET['sort']) ? $_GET['sort'] : '',
                        ]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
 
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsPlannotes' => (empty($modelsPlannotes)) ? [new Plannotes] : $modelsPlannotes
            ]);
        }
    }

    /**
     * Deletes an existing Planstages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Planstages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Planstages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Planstages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
