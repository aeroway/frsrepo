<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use backend\models\Plantask;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlantaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['planview/index']];
$this->title = 'Задания';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="plantask-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create', 'sid' => !empty($_GET['id']) ? $_GET['id'] : '',], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Статистика', ['stat', 'sid' => !empty($_GET['id']) ? $_GET['id'] : '',], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    $button =
    [
        'class' => 'yii\grid\ActionColumn',
        'buttons' =>
        [
            'create' => function($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Создать этап'),
                    'aria-label' => Yii::t('yii', 'Создать этап'),
                ];

                $url=Yii::$app->getUrlManager()->createUrl(['planstages/create', 'sid' => $model['id'], 'pid' => $model['pview_id']]);

                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, $options);
            },
            'view' => function($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Этапы'),
                    'aria-label' => Yii::t('yii', 'Этапы'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl(['planstages/index', 'id' => $model['id'], 'pid' => $model['pview_id']]);

                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
            },
            'update' => function($url, $model, $key)
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

                $url = Yii::$app->getUrlManager()->createUrl(['plantask/update', 'id' => $model['id'], 'pid' => $model['pview_id'], 'page' => $page, 'sort' => $sort]);

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
                'value' => function($data) {
                    return Html::a(Html::encode($data->name), Url::to(['planstages/index', 'id' => $data['id'], 'pid' => $data['pview_id']]));
                },
                'format' => 'raw',
            ],
            //'name',
            [
                'attribute' => 'date_task',
                'format' =>  ['date', 'php:d M Y'],
            ],
            'username',
            [
                'label' => 'Отдел',
                'value' => function($data) {
                    return $data->getEmployeeDepartment($data->username);
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Статусы',
                'value' => function($data) {
                    return $data->getStatusCount($data->id);
                },
                'format' => 'html',
                'contentOptions'=>['style' => 'width: 109px;'],
            ],
            //'pview_id',

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
