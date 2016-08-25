<?php

namespace backend\controllers;

use Yii;
use backend\models\InventoryPartsLigament;
use backend\models\InventoryParts;
use backend\models\InventoryPartsSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ConflictHttpException;
use yii\filters\AccessControl;

/**
 * InventoryPartsController implements the CRUD actions for InventoryParts model.
 */
class InventorypartsController extends Controller
{
    public function behaviors()
    {
        return [
			'access'=>[
				'class'=>AccessControl::classname(),
				'only'=>['create','update','view','delete','index','createpl'],
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
     * Lists all InventoryParts models.
     * @return mixed
     */
    public function actionIndex()
    {
		$this->checkAccess();

        $searchModel = new InventoryPartsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InventoryParts model.
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
     * Creates a new InventoryParts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$this->checkAccess();

        $model = new InventoryParts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InventoryParts model.
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

    public function actionUpdatee($id,$page,$sort)
    {
		$this->checkAccess();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'page' => $page, 'sort' => $sort]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing InventoryParts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$this->checkAccess();

		throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InventoryParts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InventoryParts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InventoryParts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddparts($id)
    {
		$this->findModel($id);

        $model = new InventoryPartsLigament();

        if ($model->load(Yii::$app->request->post()))
		{
			$amounti = InventoryParts::find()->select('amount')->where(['id' => $id])->all();

			if(($difference = $amounti[0]["amount"] - $model->amount_ipl) < 0)
			{
				throw new ConflictHttpException('Отрицательное значение.');
			}

			Yii::$app->db4->createCommand()->update('inventory_parts', ['amount' => $difference], ['id' => $id])->execute();

			$model->save();

			return $this->redirect(['index', NULL]);
		}
		else {
            return $this->renderAjax('createpl', [
                'model' => $model,
            ]);
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
