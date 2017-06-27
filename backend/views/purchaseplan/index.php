<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\SchedulePlan;
use backend\models\Purchaseplan;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchaseplanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Главная', 'url' => ['spending/index']];
$this->title = 'Смета по ст. ' . $smeta->expense;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать смету', ['create', 'sid' => $id], ['class' => 'btn btn-success']) ?>
    </p>
<?php
    $button =
    [
        'class' => 'yii\grid\ActionColumn',
        'buttons'=>
        [
            'create' => function ($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Создать ПГ'),
                    'aria-label' => Yii::t('yii', 'Создать ПГ'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl(['scheduleplan/create', 'sid' => $model['id']]);

                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, $options);
            },
            'view' => function ($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'План график'),
                    'aria-label' => Yii::t('yii', 'План график'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl(['scheduleplan/index', 'sid' => $model['id']]);

                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
            },
            'update' => function ($url, $model, $key)
            {
                $options = [
                    'title' => Yii::t('yii', 'План закупок'),
                    'aria-label' => Yii::t('yii', 'План закупок'),
                ];

                if(empty(Yii::$app->request->queryParams["page"]))
                    $page = 1;
                else
                    $page = Yii::$app->request->queryParams["page"];

                if(empty(Yii::$app->request->queryParams["sort"]))
                    $sort = '';
                else
                    $sort = Yii::$app->request->queryParams["sort"];

                $url = Yii::$app->getUrlManager()->createUrl(['purchaseplan/update', 'sid' => $model['id'], 'page' => $page, 'sort' => $sort]);

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
                'value' => 'sumSp',
                'format' => 'html',
                'footer' => PurchasePlan::getPurchasePlanSum('outlay', Yii::$app->request->queryParams["id"]),
            ],
            [
                'attribute' => 'p_year',
                'value' => 'p_year',
                'footer' => PurchasePlan::getPurchasePlanSum('p_year', Yii::$app->request->queryParams["id"]),
            ],
            [
                'attribute' => 'c_year',
                'value' => 'c_year',
                'footer' => PurchasePlan::getPurchasePlanSum('c_year', Yii::$app->request->queryParams["id"]),
            ],
            'special',
            [
                'label' => 'Всего',
                'value' => function($data)
                {
                    return PurchasePlan::getPurchasePlanSumSpecial($data["id"]);
                },
                'footer' => 
                (
                    PurchasePlan::getPurchasePlanSum('p_year', Yii::$app->request->queryParams["id"]) +
                    PurchasePlan::getPurchasePlanSum('c_year', Yii::$app->request->queryParams["id"]) +
                    PurchasePlan::getPurchasePlanSum('special', Yii::$app->request->queryParams["id"])
                ),
            ],
            //'year',
            [
                'label' => 'По плану',
                'value' => function($data) 
                {
                    return SchedulePlan::getschedulePlanSumi('sum', $data["id"]);
                },
                'footer' => SchedulePlan::getSpendingSum('sum', Yii::$app->request->queryParams["id"]),
            ],
            [
                'label' => 'Экономия',
                'value' => function($data)
                {
                    return 
                    SchedulePlan::getschedulePlanSumi('sum', $data["id"]) -
                    SchedulePlan::getschedulePlanSumi('sum_fact', $data["id"]);
                },
                'contentOptions' => function ($data)
                {
                    $sum = 
                    (
                        SchedulePlan::getschedulePlanSumi('sum', $data["id"]) -
                        SchedulePlan::getschedulePlanSumi('sum_fact', $data["id"])
                    );

                    if($sum > 0)
                        return ['style' => 'background-color: #5cb85c;'];
                    elseif($sum < 0)
                        return ['style' => 'background-color: #d9534f;'];
                    else
                        return ['style' => ''];
                },
                'footer' => 
                (
                    SchedulePlan::getSpendingSum('sum', Yii::$app->request->queryParams["id"]) -
                    SchedulePlan::getSpendingSum('sum_fact', Yii::$app->request->queryParams["id"])
                ),
            ],
            [
                'label' => '5%',
                 'format' => 'html',
                'value' => function($data)
                {
                    if($data->is_percent)
                    {
                        $url = Yii::$app->getUrlManager()->createUrl(['purchaseplan/index', 'id' => $data['st_id'], 'hist_id' => $data['id']]);

                        return Html::a('<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>', $url);
                    }
                },
            ],

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
