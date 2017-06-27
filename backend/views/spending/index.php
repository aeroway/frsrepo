<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\SchedulePlan;
use backend\models\PurchasePlan;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SpendingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Смета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spending-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать вид расходов', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Способ закупки', Yii::$app->getUrlManager()->createUrl(['purchasemethod/index']), ['class' => 'btn btn-info']) ?>
        <?= Html::a('Лимит БО', Yii::$app->getUrlManager()->createUrl(['lbo/index']), ['class' => 'btn btn-info']) ?>
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

                $url=Yii::$app->getUrlManager()->createUrl(['purchaseplan/create', 'sid' => $model['id']]);

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
                    return PurchasePlan::getSpendingIndexOutlay($data["id"]);
                }
            ],
            [
                'label' => 'Всего',
                'value' => function($data) {
                    return PurchasePlan::getSpendingIndexSum($data["id"]);
                }
            ],
            [
                'label' => 'По плану',
                'value' => function($data) {
                    return SchedulePlan::getSpendingIndexSum($data["id"]);
                }
            ],
            [
                'label' => 'Экономия',
                'value' => function($data) {
                    return SchedulePlan::spendingEconom($data["id"]);
                },
                'contentOptions' => function ($data) {
                    $sum = SchedulePlan::spendingEconom($data["id"]);

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
