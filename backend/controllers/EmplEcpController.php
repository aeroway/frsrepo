<?php

namespace backend\controllers;

use Yii;
use backend\models\EmplEcp;
use backend\models\EmplEcpLog;
use backend\models\EmplEcpSearch;
use backend\models\EmplEcpLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * EmplEcpController implements the CRUD actions for EmplEcp model.
 */
class EmplEcpController extends Controller
{
    public function behaviors()
    {
        return [
			'access'=>[
				'class'=>AccessControl::classname(),
				'only'=>['create', 'update', 'view', 'delete', 'index', 'log', 'stat'],
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
     * Lists all EmplEcp models.
     * @return mixed
     */
    public function actionIndex()
    {
		$this->checkAccess();

        $searchModel = new EmplEcpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EmplEcp model.
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

    public function actionStat()
    {
        return $this->render('stat');
    }

    public function actionLog($ecpid)
    {
        $this->checkAccess();

        $searchModel = new EmplEcpLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('log', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new EmplEcp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(!in_array("EcpAdmin", Yii::$app->user->identity->groups))
		{
			throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
		}

        $model = new EmplEcp();

        if ($model->load(Yii::$app->request->post())) {
            $model->username = Yii::$app->user->identity->username;
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EmplEcp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		$this->checkAccess();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->username = Yii::$app->user->identity->username;
            $model->save();

            $modellog = new EmplEcpLog();
            $modellog->idm_empl = $model->idm_empl;
            $modellog->ecp_start = $model->ecp_start;
            $modellog->ecp_stop = $model->ecp_stop;
            $modellog->ecp_org_id = $model->ecp_org_id;
            $modellog->status = $model->status;
            $modellog->nositel_num = $model->nositel_num;
            $modellog->nositel_type = $model->nositel_type;
            $modellog->date_in = $model->date_in;
            $modellog->req_date = $model->req_date;
            $modellog->user_in = $model->user_in;
            $modellog->invent_num = $model->invent_num;
            $modellog->comment_ecp = $model->comment_ecp;
            $modellog->ecpmodify_date = $model->ecpmodify_date;
            $modellog->empl_ecp_id = $model->id;
            $modellog->username = Yii::$app->user->identity->username;
            $modellog->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EmplEcp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(!in_array("EcpAdmin", Yii::$app->user->identity->groups))
		{
			throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
		}

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EmplEcp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmplEcp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmplEcp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	private function checkAccess()
	{
		if(
			!in_array("EcpUser", Yii::$app->user->identity->groups) and
			!in_array("EcpAdmin", Yii::$app->user->identity->groups)
		)
		{
			throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
		}
		else
		{
			$arr1 = Yii::$app->user->identity->groups;
			$arr2 = array("EcpUser", "EcpAdmin");
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

	public function actionDoit()
	{
		$model = new EmplEcp();
		$id = Yii::$app->request->get('id');
		if ($id)
		{
			// Найти всех сотрудников в отделе
			$result = $model->getAllEmployee($id);
			return $result;
        }
		return 0;
	}

    public function actionSendEmail()
    {
        $model = new EmplEcp();
        $model->sendEmail();
    }
}