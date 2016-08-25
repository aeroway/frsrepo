<?php

namespace backend\controllers;

use Yii;
use backend\models\InventoryPartsLigament;
use backend\models\InventoryPartsLigamentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * InventoryplController implements the CRUD actions for InventoryPartsLigament model.
 */
class InventoryplController extends Controller
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
     * Lists all InventoryPartsLigament models.
     * @return mixed
     */
    public function actionIndex()
    {
		$this->checkAccess();

        $searchModel = new InventoryPartsLigamentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InventoryPartsLigament model.
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
     * Creates a new InventoryPartsLigament model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		throw new NotFoundHttpException('Запрещено.');
		
        $model = new InventoryPartsLigament();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InventoryPartsLigament model.
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
     * Deletes an existing InventoryPartsLigament model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		throw new NotFoundHttpException('Запрещено.');

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InventoryPartsLigament model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InventoryPartsLigament the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InventoryPartsLigament::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
