<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlanviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вид обращения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planview-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
    $button =
    [
        'class' => 'yii\grid\ActionColumn',
        'buttons' =>
        [
            'create' => function ($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Создать задание'),
                    'aria-label' => Yii::t('yii', 'Создать задание'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl(['plantask/create', 'sid' => $model['id']]);

                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, $options);
            },
            'view'=>function ($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Задания'),
                    'aria-label' => Yii::t('yii', 'Задания'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl(['plantask/index', 'id' => $model['id']]);

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

                $url = Yii::$app->getUrlManager()->createUrl(['planview/update', 'id' => $model['id'], 'page' => $page, 'sort' => $sort]);

                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            }
        ],
        'template'=>'{update}',
    ];
?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return Html::a(Html::encode($data->name), Url::to(['plantask/index', 'id' => $data['id']]));
                },
                'format' => 'raw',
            ],
            'type',
            [
                'label' => 'Статусы',
                'value' => function ($data) {
                    return $data->getStatusCount($data->id);
                },
                'format' => 'html',
                'contentOptions'=>['style' => 'width: 130px;'],
            ],
            [
                'label' => 'Задания',
                'value' => function ($data) {
                    return $data->getTaskCount($data->id);
                },
                'format' => 'raw',
                //'contentOptions'=>['style' => 'width: 120px;'],
            ],

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
