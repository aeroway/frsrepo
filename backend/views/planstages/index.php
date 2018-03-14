<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlanstagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['planview/index']];
$this->params['breadcrumbs'][] = ['label' => 'Задания', 'url' => ['plantask/index', 'id' => !empty($_GET['pid']) ? $_GET['pid'] : '',]];
$this->title = 'Этапы: ' . substr($searchModel->ptask->pview->name, 0, 98) . ' - ' . $searchModel->ptask->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planstages-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить этап', ['create', 'sid' => !empty($_GET['id']) ? $_GET['id'] : '', 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $button =
    [
        'class' => 'yii\grid\ActionColumn',
        'buttons' =>
        [
            'view' => function ($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Просмотр'),
                    'aria-label' => Yii::t('yii', 'Просмотр'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl([
                        'planstages/view',
                        'id' => $model['id'],
                        'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',
                       ]);

                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
            },
            'update' => function ($url, $model, $key)
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

                $url = Yii::$app->getUrlManager()->createUrl([
                        'planstages/update',
                        'id' => $model['id'],
                        'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',
                        'page' => $page,
                        'sort' => $sort
                       ]);

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
            [
                'attribute' => 'name',
                'value' => function ($data) {
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

                    return Html::a(Html::encode($data->name),
                        Url::to([
                            'planstages/update',
                            'id' => $data['id'],
                            'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',
                            'page' => $page,
                            'sort' => $sort
                        ])
                    );
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'textNote',
                'label' => 'Замечания',
                'format' => 'html',
                'value' => 'textNote',
            ],
            [
                'attribute' => 'plannotesAction',
                'label' => 'Действие',
                'format' => 'html',
                'value' => 'plannotesAction',
                'contentOptions'=>['style' => 'width: 90px;'],
            ],
            //'executor',
            //'ptask_id',

            //['class' => 'yii\grid\ActionColumn'],
            //$button,
        ],
    ]); ?>
</div>
