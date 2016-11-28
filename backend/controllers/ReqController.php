<?php

namespace backend\controllers;

use Yii;
use backend\models\Req;
use backend\models\ReqLog;
use backend\models\ReqSearch;
use backend\models\ReqLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * ReqController implements the CRUD actions for Req model.
 */
class ReqController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::classname(),
                'only'=>['create','update','view','delete','index','createstatus','log','createdatereturn'],
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
     * Lists all Req models.
     * @return mixed
     */
     
    /*
        Доступ запрещён, если user нет в группах.
        Иначе ReqSearch покажет данные по фильтру.
    */
    public function actionIndex()
    {
        $this->checkAccess();
        
        $searchModel = new ReqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Req model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->checkAccess();
        if(in_array("alvl1", Yii::$app->user->identity->groups))
        {
            $this->checkCurrentUser($id);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionLog($logid)
    {
        $this->checkAccess();
        if(!in_array("alvl4", Yii::$app->user->identity->groups) and !in_array("alvl3", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $searchModel = new ReqLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('log', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Req model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!in_array("alvl1", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = new Req();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Req model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $this->checkAccess();

        if(!in_array("alvl4", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $this->addLog($id,$model);
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatestatus($id)
    {
        if(in_array("alvl1", Yii::$app->user->identity->groups) or in_array("alvl2", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = $this->findModel($id);

        if(in_array("alvl3", Yii::$app->user->identity->groups) and $model->load(Yii::$app->request->post()))
        {
            if($model->getAttribute('status') > $model->getOldAttribute('status')) {
                $model->save();
                return $this->redirect(['index', 'id' => $model->id]);
            } else {
                throw new ForbiddenHttpException('Вам запрещено менять статус на значение ниже текущего.');
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->addLog($id,$model);
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->renderAjax('createstatus', [
                'model' => $model,
            ]);
        }
    }
///....
    public function actionCreatedatereturn($id,$page,$sort)
    {
        $this->checkAccess();

        if(!in_array("alvl3", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            $this->addLog($id,$model);
            return $this->redirect(['index', 'page' => $page, 'sort' => $sort]);

        } else {
            return $this->renderAjax('createdatereturn', [
                'model' => $model,
            ]);
        }
    }
///.....
    /**
     * Deletes an existing Req model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // Удалять запись может назначенный "Пользователь"
        $this->checkCurrentUser($id);

        // Удалять запись может состоящий в группе, если запись со статусом "Новая"
        if($this->findModel($id)->status !== 1 or !in_array("alvl1", Yii::$app->user->identity->groups))
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Req model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Req the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Req::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function checkAccess() 
    {
        if(
            !in_array("alvl1", Yii::$app->user->identity->groups) and
            !in_array("alvl2", Yii::$app->user->identity->groups) and
            !in_array("alvl3", Yii::$app->user->identity->groups) and
            !in_array("alvl4", Yii::$app->user->identity->groups)
        )
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
        else
        {
            /*
            $arr1 = Yii::$app->user->identity->groups;
            $arr2 = array("alvl1", "alvl2", "alvl3", "alvl4");
            $g = null;

            for($i = 0; $i<count($arr1); $i++)
                for($j = 0; $j<count($arr2); $j++)
                    if($arr1[$i] === $arr2[$j])
                    {
                        $g++;
                        //echo $i. " Элемент массива arr1 совпал с ".$j." Элементом массива arr2<br>";
                    }
            if($g>1) throw new ForbiddenHttpException('Пользователь состоит больше, чем в одной группе.');
            */
        }
    }

    private function checkCurrentUser($id)
    {
        if('23UPR\\'.Yii::$app->user->identity->username !== $this->findModel($id)->user_text)
        {
            throw new ForbiddenHttpException('Вы не можете получить доступ к этой странице.');
        }
    }

    private function addLog($id,$model)
    {
        foreach(Yii::$app->request->post() as $fkey) { }
        foreach($fkey as $skey => $svalue) { $attrarr[$skey] = $svalue; }

        $modellog = new ReqLog();
        $modellog->attributes = [
            'obj_addr' => isset($attrarr["obj_addr"]) ? $attrarr["obj_addr"] : $model->getOldAttribute('obj_addr'),
            'zayavitel_num' => isset($attrarr["zayavitel_num"]) ? $attrarr["zayavitel_num"] : $model->getOldAttribute('zayavitel_num'),
            'zayavitel_fio' => isset($attrarr["zayavitel_fio"]) ? $attrarr["zayavitel_fio"] : $model->getOldAttribute('zayavitel_fio'),
            'obj_id' => isset($attrarr["obj_id"]) ? $attrarr["obj_id"] : $model->getOldAttribute('obj_id'),
            'kuvd' => isset($attrarr["kuvd"]) ? $attrarr["kuvd"] : $model->getOldAttribute('kuvd'),
            'kuvd_id' => isset($attrarr["kuvd_id"]) ? $attrarr["kuvd_id"] : $model->getOldAttribute('kuvd_id'),
            'user_text' => isset($attrarr["user_text"]) ? $attrarr["user_text"] : $model->getOldAttribute('user_text'),
            'status' => isset($attrarr["status"]) ? $attrarr["status"] : $model->getOldAttribute('status'),
            'date_in' => isset($attrarr["date_in"]) ? $attrarr["date_in"] : $model->getOldAttribute('date_in'),
            'user_to' => isset($attrarr["user_to"]) ? $attrarr["user_to"] : $model->getOldAttribute('user_to'),
            'kn' => isset($attrarr["kn"]) ? $attrarr["kn"] : $model->getOldAttribute('kn'),
            'coment' => isset($attrarr["coment"]) ? $attrarr["coment"] : $model->getOldAttribute('coment'),
            'type' => isset($attrarr["type"]) ? $attrarr["type"] : $model->getOldAttribute('type'),
            'otdel' => isset($attrarr["otdel"]) ? $attrarr["otdel"] : $model->getOldAttribute('otdel'),
            'cel' => isset($attrarr["cel"]) ? $attrarr["cel"] : $model->getOldAttribute('cel'),
            'cur_user' => isset($attrarr["cur_user"]) ? $attrarr["cur_user"] : $model->getOldAttribute('cur_user'),
            'date_end' => isset($attrarr["date_end"]) ? $attrarr["date_end"] : $model->getOldAttribute('date_end'),
            'fast' => isset($attrarr["fast"]) ? $attrarr["fast"] : $model->getOldAttribute('fast'),
            'phone' => isset($attrarr["phone"]) ? $attrarr["phone"] : $model->getOldAttribute('phone'),
            'vedomost_num' => isset($attrarr["vedomost_num"]) ? $attrarr["vedomost_num"] : $model->getOldAttribute('vedomost_num'),
            'user_last' => isset($attrarr["user_last"]) ? $attrarr["user_last"] : $model->getOldAttribute('user_last'),
            'vedomost_unform' => isset($attrarr["vedomost_unform"]) ? $attrarr["vedomost_unform"] : $model->getOldAttribute('vedomost_unform'),
            'srok' => isset($attrarr["srok"]) ? $attrarr["srok"] : $model->getOldAttribute('srok'),
            'user_print' => isset($attrarr["user_print"]) ? $attrarr["user_print"] : $model->getOldAttribute('user_print'),
            'print_date' => isset($attrarr["print_date"]) ? $attrarr["print_date"] : $model->getOldAttribute('print_date'),
            'code_mesto' => isset($attrarr["code_mesto"]) ? $attrarr["code_mesto"] : $model->getOldAttribute('code_mesto'),
            'date_v' => isset($attrarr["date_v"]) ? $attrarr["date_v"] : $model->getOldAttribute('date_v'),
            'area_id' => isset($attrarr["area_id"]) ? $attrarr["area_id"] : $model->getOldAttribute('area_id'),
            'org' => isset($attrarr["org"]) ? $attrarr["org"] : $model->getOldAttribute('org'),
            'inn' => isset($attrarr["inn"]) ? $attrarr["inn"] : $model->getOldAttribute('inn'),
            'date_return' => isset($attrarr["date_return"]) ? $attrarr["date_return"] : $model->getOldAttribute('date_return'),
            'log_id' => isset($id) ? $id : NULL,
            'log_user' => Yii::$app->user->identity->username,
        ];
        $modellog->insert(true);
    }
}
