<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GznViolationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Объект проверок', 'url' => ['gzn-object/index']];
$this->title = 'Нарушения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-violations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?php
        if(in_array("GznEdit", Yii::$app->user->identity->groups) || in_array("GznDelete", Yii::$app->user->identity->groups))
        {
            echo Html::a('Создать', ['create', 'sid' => !empty($_GET['id']) ? $_GET['id'] : '',], ['class' => 'btn btn-success']);
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
            'create' => function($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Создать предписание'),
                    'aria-label' => Yii::t('yii', 'Создать предписание'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl(['gzn-injunction/create', 'sid' => $model['id'], 'pid' => $model['gzn_obj_id']]);

                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, $options);
            },
            'view' => function($url, $model)
            {
                $options = [
                    'title' => Yii::t('yii', 'Просмотр'),
                    'aria-label' => Yii::t('yii', 'Просмотр'),
                ];

                $url = Yii::$app->getUrlManager()->createUrl(['gzn-violations/view', 'id' => $model['id']]);

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

                $url = Yii::$app->getUrlManager()->createUrl(['gzn-violations/update', 'id' => $model['id'], 'page' => $page, 'sort' => $sort]);

                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            }
        ],
        'template' => $template,
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model)
        {
            if($model->amount_fine != $model->amount_fine_collected)
                if(date('Y-m-d', strtotime($model->date_due)) <= date('Y-m-d', strtotime("+4 days"))) return ['class' => 'danger'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'gzn_obj_id',
            //'violation_area',
            //'date_check',
            [
                'attribute' => 'adm_punishment_id',
                'value' => function($data) {
                    if(empty($data->admPunishment->name)) {
                        return '';
                    } else {
                        return Html::a(Html::encode($data->admPunishment->name), Url::to(['gzn-injunction/index', 'id' => $data['id'], 'pid' => $data['gzn_obj_id']]));
                    }
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Постан. об адм. правонар.',
                'attribute' => 'decision_punishment',
                'format' =>  ['date', 'php:d M Y'],
            ],
            /*
            [
                'attribute' => 'date_due',
                'format' =>  ['date', 'php:d M Y'],
            ],
            */
            // 'violation_protocol',
            [
                'attribute' => 'amount_fine',
                'value' => function($data) {
                    return Yii::$app->formatter->asDecimal($data->amount_fine, 2);
                },
            ],
            [
                'attribute' => 'amount_fine_collected',
                'value' => function($data) {
                    return Yii::$app->formatter->asDecimal($data->amount_fine_collected, 2);
                },
            ],
            // 'payment_doc',
            // 'place_proceeding',
            // 'adm_affairs',
            // 'note',
            [
                'attribute' => 'decision_cancellation',
                'format' =>  ['date', 'php:d M Y'],
            ],
            // 'decision_appeal',
            // 'date_outgoing',
            // 'date_performance',
            // 'violation_decision_end',
            [
                'label' => 'ст. 19.5 ч.25',
                'value' => function($data) {
                    $out = '';
                    foreach($data->gznInjunctions as $value) {
                        if(!empty($value["repeated"]))
                            $out .= date_create($value["repeated"])->format('d.m.Y') . '<br>';
                    }
                    return $out;
                },
                'format' => 'html',
            ],
            [
                'label' => 'ст. 19.5 ч.26',
                'value' => function($data) {
                    $out = '';
                    foreach($data->gznInjunctions as $value) {
                        if(!empty($value["decision_judge"]))
                            $out .= date_create($value["decision_judge"])->format('d.m.Y') . '<br>';
                    }
                    return $out;
                },
                'format' => 'html',
            ],
            [
                'label' => 'Решение суда',
                'value' => function($data) {
                    $out = '';
                    foreach($data->gznInjunctions as $value) {
                        if(!empty($value["date_protocol"]))
                            $out .= date_create($value["date_protocol"])->format('d.m.Y') . '<br>';
                    }
                    return $out;
                },
                'format' => 'html',
            ],
            [
                'label' => 'Остаток',
                'value' => function($data) {
                    $amountFine = 0;
                    $amountFineCollected = 0;

                    if(!empty($data->amount_fine))
                    {
                        $amountFine = $data->amount_fine;
                    }

                    if(!empty($data->amount_fine_collected))
                    {
                        $amountFineCollected = $data->amount_fine_collected;
                    }

                    return Yii::$app->formatter->asDecimal($amountFine - $amountFineCollected, 2);
                },
                'format' => 'raw',
            ],

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
