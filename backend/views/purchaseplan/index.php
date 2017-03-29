<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\SchedulePlan;
use backend\models\Purchaseplan;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchaseplanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Смета', 'url' => ['spending/index']];
$this->title = 'План закупок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать план закупок', ['create', 'id' => $id], ['class' => 'btn btn-success']) ?>
    </p>
<?php
    $button =
    [
        'class' => 'yii\grid\ActionColumn',
        'buttons'=>
        [
            'create'=>function ($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Создать ПГ'),
                    'aria-label' => Yii::t('yii', 'Создать ПГ'),
                ];

                $url=Yii::$app->getUrlManager()->createUrl(['scheduleplan/create', 'id' => $model['id']]);

                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, $options);
            },
            'view'=>function ($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'План график'),
                    'aria-label' => Yii::t('yii', 'План график'),
                ];

                $url=Yii::$app->getUrlManager()->createUrl(['scheduleplan/index', 'id' => $model['id']]);

                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
            },
            'update'=>function ($url, $model, $key)
            {
                $options = [
                    'title' => Yii::t('yii', 'Редактировать'),
                    'aria-label' => Yii::t('yii', 'Редактировать'),
                ];

                if(empty(Yii::$app->request->queryParams["page"])) {
                    $page = 1;
                } else {
                    $page = Yii::$app->request->queryParams["page"];
                }
                if(empty(Yii::$app->request->queryParams["sort"])) {
                    $sort = '';
                } else {
                    $sort = Yii::$app->request->queryParams["sort"];
                }

                $url=Yii::$app->getUrlManager()->createUrl(['purchaseplan/update','id'=>$model['id'], 'page'=>$page, 'sort'=>$sort]);

                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            }
        ],
        'template'=>'{create} {view} {update}',
    ];
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showFooter' => true,
        'footerRowOptions' => ['style' => 'font-weight: bold;'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'type',
            'okpd',
            'name_object',
            [
                'attribute' => 'outlay',
                'value' => 'outlay',
                'footer' => PurchasePlan::find()->select('SUM(outlay) as outlay')->where(['st_id' => Yii::$app->request->queryParams["id"]])->one()["outlay"],
            ],
            [
                'attribute' => 'p_year',
                'value' => 'p_year',
                'footer' => PurchasePlan::find()->select('SUM(p_year) as p_year')->where(['st_id' => Yii::$app->request->queryParams["id"]])->one()["p_year"],
            ],
            [
                'attribute' => 'c_year',
                'value' => 'c_year',
                'footer' => PurchasePlan::find()->select('SUM(c_year) as c_year')->where(['st_id' => Yii::$app->request->queryParams["id"]])->one()["c_year"],
            ],
            'special',
            [
                'label' => 'Всего',
                'value' => function($data) {
                    return PurchasePlan::find()->select('(p_year + c_year + special) as sum')->where(['id' => $data["id"]])->one()["sum"];
                },
                'footer' => (PurchasePlan::find()->select('SUM(p_year) as sum')->where(['st_id' => Yii::$app->request->queryParams["id"]])->one()["sum"] + PurchasePlan::find()->select('SUM(c_year) as sum')->where(['st_id' => Yii::$app->request->queryParams["id"]])->one()["sum"] + PurchasePlan::find()->select('SUM(special) as sum')->where(['st_id' => Yii::$app->request->queryParams["id"]])->one()["sum"]),
            ],
            //'year',
            [
                'label' => 'По плану',
                'value' => function($data) {
                    return SchedulePlan::find()->select('SUM(sum) as sum')->where(['pp_id' => $data["id"]])->one()["sum"];
                },
                'footer' => SchedulePlan::find()->select('SUM(sum) as sum')->where(['IN', 'pp_id', PurchasePlan::find()->select('id')->where(['st_id' => Yii::$app->request->queryParams["id"]])])->one()["sum"],
            ],
            [
                'label' => 'Экономия',
                'value' => function($data) {
                    return SchedulePlan::find()->select('SUM(sum) as sum')->where(['pp_id' => $data["id"]])->one()["sum"] - 
                    SchedulePlan::find()->select('SUM(sum_fact) as sum_fact')->where(['pp_id' => $data["id"]])->one()["sum_fact"];
                },
                'contentOptions' => function ($data) {
                    $sum = (SchedulePlan::find()->select('SUM(sum) as sum')->where(['pp_id' => $data["id"]])->one()["sum"] - 
                    SchedulePlan::find()->select('SUM(sum_fact) as sum_fact')->where(['pp_id' => $data["id"]])->one()["sum_fact"]);

                    if($sum > 0)
                        return ['style' => 'background-color: #5cb85c;'];
                    elseif($sum < 0)
                        return ['style' => 'background-color: #d9534f;'];
                    else
                        return ['style' => ''];
                },
                'footer' => (SchedulePlan::find()->select('SUM(sum) as sum')->where(['IN', 'pp_id', PurchasePlan::find()->select('id')->where(['st_id' => Yii::$app->request->queryParams["id"]])])->one()["sum"] - 
                    SchedulePlan::find()->select('SUM(sum_fact) as sum_fact')->where(['IN', 'pp_id', PurchasePlan::find()->select('id')->where(['st_id' => Yii::$app->request->queryParams["id"]])])->one()["sum_fact"]),
            ],

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
