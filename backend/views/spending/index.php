<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\SchedulePlan;
use backend\models\PurchasePlan;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SpendingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spending-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать расход', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'title' => Yii::t('yii', 'Создать ПЗ'),
                    'aria-label' => Yii::t('yii', 'Создать ПЗ'),
                ];

                $url=Yii::$app->getUrlManager()->createUrl(['purchaseplan/create', 'id' => $model['id']]);

                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, $options);
            },
            'view'=>function ($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'План график'),
                    'aria-label' => Yii::t('yii', 'План график'),
                ];

                $url=Yii::$app->getUrlManager()->createUrl(['purchaseplan/index', 'id' => $model['id']]);

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

                $url=Yii::$app->getUrlManager()->createUrl(['spending/update','id'=>$model['id'], 'page'=>$page, 'sort'=>$sort]);

                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            }
        ],
        'template'=>'{create} {view} {update}',
    ];
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'type',
            'expense',
            [
                'label' => 'Смета',
                'value' => function($data) {
                    return PurchasePlan::find()->select('SUM(outlay) as outlay')->where(['st_id' => $data["id"]])->one()["outlay"];
                }
            ],
            [
                'label' => 'Всего',
                'value' => function($data) {
                    return PurchasePlan::find()->select('SUM(sum) as sum')->where(['st_id' => $data["id"]])->one()["sum"];
                }
            ],
            [
                'label' => 'По плану',
                'value' => function($data) {
                    return SchedulePlan::find()->select('SUM(sum) as sum')->where(['IN', 'pp_id', PurchasePlan::find()->select('id')->where(['st_id' => $data["id"]])])->one()["sum"];
                }
            ],
            [
                'label' => 'Экономия',
                'value' => function($data) {
                    return SchedulePlan::find()->select('SUM(sum) as sum')->where(['IN', 'pp_id', PurchasePlan::find()->select('id')->where(['st_id' => $data["id"]])])->one()["sum"] - 
                    SchedulePlan::find()->select('SUM(sum_fact) as sum_fact')->where(['IN', 'pp_id', PurchasePlan::find()->select('id')->where(['st_id' => $data["id"]])])->one()["sum_fact"];
                },
                'contentOptions' => function ($data) {
                    $sum = (SchedulePlan::find()->select('SUM(sum) as sum')->where(['IN', 'pp_id', PurchasePlan::find()->select('id')->where(['st_id' => $data["id"]])])->one()["sum"] - 
                    SchedulePlan::find()->select('SUM(sum_fact) as sum_fact')->where(['IN', 'pp_id', PurchasePlan::find()->select('id')->where(['st_id' => $data["id"]])])->one()["sum_fact"]);

                    if($sum > 0)
                        return ['style' => 'background-color: #5cb85c;'];
                    elseif($sum < 0)
                        return ['style' => 'background-color: #d9534f;'];
                    else
                        return ['style' => ''];
                },
            ],
            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
