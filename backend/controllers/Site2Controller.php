<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\Egrp;
use yii\web\ForbiddenHttpException;

use backend\models\VedomostCheckForm;
use backend\models\VedomostCheckFormSearch;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class Site2Controller extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'stat','check','test','checkm','indexved'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        if(!in_array("alvl3", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
        return $this->render('index');
    }

    public function actionIndexved()
    {
        $searchModel = new VedomostCheckFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexved', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewved($id)
    {
        return $this->render('viewved', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = VedomostCheckForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
 
 public function actionTest(){
    
    $egrp = new Egrp();
    $request = Yii::$app->request;
    $id = $request->get('id',0);

    $res = $egrp->vedomost($id,Yii::$app->user->identity->username);
    print_r($res);
    $otvet = json_decode($res);
    print_r($otvet);
    echo $otvet->NMB;
    exit();
 }
 
 
public function actionCheck()
{
    if(!in_array("alvl3", Yii::$app->user->identity->groups))
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
    }

    $egrp = new Egrp();
    $id = Yii::$app->request->post('id',0);
    if ($id>0)
    {
    
    $res = $egrp->vedomost(substr($id,0,strlen($id)-1),Yii::$app->user->identity->username,$_SERVER['REMOTE_ADDR']);
    if (!is_null($res)) {
        $otvet = json_decode($res);
    }
    return $this->render('check', [
        'result' => 'Ведомость № '.$otvet->NMB,
        'otvet' => $otvet
        ]);
    }
    else {
        
        $result='';
        return $this->render('check',['result'=>$result]);
    }
}

public function actionCheckm()
{
    if(!in_array("alvl3", Yii::$app->user->identity->groups))
    {
        throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
    }

    $egrp = new Egrp();
    $num = Yii::$app->request->post('num', 0);

    if ($num > 0)
    {
        $res = $egrp->vedomostm($num, Yii::$app->user->identity->username, $_SERVER['REMOTE_ADDR']);

        if (!is_null($res)) {
            $otvet = json_decode($res);
        }

        return $this->render('checkm', [
            'result' => 'Ведомость № '.$otvet->NMB,
            'otvet' => $otvet
        ]);
    } else {
        $result = '';

        return $this->render('checkm', ['result' => $result]);
    }
}

//////////////////////////////////////

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


}
