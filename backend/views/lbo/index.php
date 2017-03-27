<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LboSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лимит бюджетных организаций';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lbo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать ЛБО', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Способ закупки', Yii::$app->getUrlManager()->createUrl(['purchasemethod/index']), ['class' => 'btn btn-info']) ?>
        <?= Html::a('План закупок', Yii::$app->getUrlManager()->createUrl(['purchaseplan/index']), ['class' => 'btn btn-info']) ?>
    </p>
<?php
    $button =
    [
        'class' => 'yii\grid\ActionColumn',
        'buttons'=>
        [
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

                $url=Yii::$app->getUrlManager()->createUrl(['lbo/update','id'=>$model['id'], 'page'=>$page, 'sort'=>$sort]);

                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            }
        ],
        'template'=>'{view} {update}',
    ];
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'sum',
            'comment',
            'year',
            [
                'attribute' => 'date',
                'format' =>  ['date', 'php:d.m.Y'],
            ],

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
