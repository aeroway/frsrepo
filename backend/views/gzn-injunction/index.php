<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GznInjunctionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Объект проверок', 'url' => ['gzn-object/index']];
$this->params['breadcrumbs'][] = ['label' => 'Нарушения', 'url' => ['gzn-violations/index', 'id' => !empty($_GET['pid']) ? $_GET['pid'] : '',]];
$this->title = 'Предписания';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-injunction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?php
        if(in_array("GznEdit", Yii::$app->user->identity->groups) || in_array("GznDelete", Yii::$app->user->identity->groups))
        {
            echo Html::a('Создать', ['create', 'sid' => !empty($_GET['id']) ? $_GET['id'] : '', 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',], ['class' => 'btn btn-success']);
        }
    ?>
    </p>

    <?php

    if((in_array("GznView", Yii::$app->user->identity->groups))) {
        $template = '{view}';
    } elseif(in_array("GznEdit", Yii::$app->user->identity->groups) || in_array("GznView", Yii::$app->user->identity->groups)) {
        $template = '{create} {view} {update}';
    } elseif(in_array("GznEdit", Yii::$app->user->identity->groups) || in_array("GznDelete", Yii::$app->user->identity->groups) || in_array("GznView", Yii::$app->user->identity->groups)) {
        $template = '{create} {view} {update} {delete}';
    } else {
        $template = '';
    }

    $button =
    [
        'class' => 'yii\grid\ActionColumn',
        'buttons' =>
        [
            'view' => function($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Просмотр'),
                    'aria-label' => Yii::t('yii', 'Просмотр'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl([
                        'gzn-injunction/view',
                        'id' => $model['id'],
                        'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',
                       ]);

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

                $url = Yii::$app->getUrlManager()->createUrl([
                    'gzn-injunction/update',
                    'id' => $model['id'],
                    'page' => $page,
                    'sort' => $sort,
                    'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',
                ]);

                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            },
            'delete' => function($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Удалить'),
                    'aria-label' => Yii::t('yii', 'Удалить'),
                    'data-method' => 'post',
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
                    'gzn-injunction/delete',
                    'id' => $model['id'],
                    'page' => $page,
                    'sort' => $sort,
                    'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',
                    'sid' => !empty($_GET['id']) ? $_GET['id'] : '',
                ]);

                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
            }
        ],
        'template' => $template,
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'count_term_execution',
                'format' =>  ['date', 'php:d M Y'],
            ],
            [
                'attribute' => 'not_done',
                'format' =>  ['date', 'php:d M Y'],
            ],
            'act_checking',
            [
                'attribute' => 'repeated',
                'format' =>  ['date', 'php:d M Y'],
            ],
            //'decision_judge',
            //'date_protocol',
            //'decision_judge_j',
            //'disobedience',
            //'gzn_violations_id',

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
