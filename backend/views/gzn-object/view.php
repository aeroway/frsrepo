<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\GznViolations;
use backend\models\GznInjunction;

/* @var $this yii\web\View */
/* @var $model backend\models\GznObject */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Объекты проверок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="gzn-object-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if(in_array("GznDelete", Yii::$app->user->identity->groups)) {
            echo Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <h3>Объект проверки</h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'gznTypeCheckName',
                'label' => 'Тип проверки',
            ],
            [
                'attribute' => 'gznAuthoritieCheck.name',
                'label' => 'Орган проводивший мероприятия',
            ],
            'kn',
            'land_num',
            [
                'attribute' => 'land_area',
                'value' => Yii::$app->formatter->asDecimal($model->land_area, 1),
            ],
            'kn_cost',
            'order_check',
            'act_check',
            [
                'attribute' => 'date_enforcement',
                'format' =>  ['date', 'php:d M Y'],
            ],
            'land_category',
            [
                'attribute' => 'landCategory.name',
                'label' => 'Категория земель',
            ],
            [
                'attribute' => 'landUserCategory.name',
                'label' => 'Категория землепользователя',
            ],
            'requisites_land_user',
            'address_land_plot',
            'type_func_use',
            'description_violation',
            'full_name_inspector',
            [
                'attribute' => 'areaOtchet.name',
                'label' => 'Привязан к району',
            ],
            'date_check',
        ],
    ]) ?>

    <?php
    foreach ($modelViolationId as $keyVal) {
        foreach ($keyVal as $valId) {
            if (($model2 = GznViolations::findOne($valId)) !== null) {
                echo '<br>';
                echo '<h3>Нарушение</h3>';
                echo DetailView::widget([
                    'model' => $model2,
                    'attributes' => [
                        //'id',
                        'adm_affairs',
                        'note',
                        [
                            'attribute' => 'gznObject',
                            'label' => 'Объект проверки',
                        ],
                        [
                            'attribute' => 'adm_punishment_id',
                            'value' => function($data) {
                                return $data->admPunishment->name;
                            },
                            'contentOptions'=> ['style'=>'width: 350px;'],
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'decision_punishment',
                            'format' =>  ['date', 'php:d M Y'],
                        ],
                        [
                            'attribute' => 'date_due',
                            'format' =>  ['date', 'php:d M Y'],
                        ],
                        [
                            'attribute' => 'amount_fine',
                            'value' => Yii::$app->formatter->asDecimal($model2->amount_fine, 2),
                        ],
                        [
                            'attribute' => 'amount_fine_collected',
                            'value' => Yii::$app->formatter->asDecimal($model2->amount_fine_collected, 2),
                        ],
                        'payment_doc',
                        [
                            'attribute' => 'decision_cancellation',
                            'format' =>  ['date', 'php:d M Y'],
                        ],
                        [
                            'attribute' => 'decision_appeal',
                            'format' =>  ['date', 'php:d M Y'],
                        ],
                        [
                            'attribute' => 'date_performance',
                            'format' =>  ['date', 'php:d M Y'],
                        ],
                        [
                            'attribute' => 'date_outgoing',
                            'format' =>  ['date', 'php:d M Y'],
                        ],
                        [
                            'attribute' => 'violation_decision_end',
                            'format' =>  ['date', 'php:d M Y'],
                        ],
                        [
                            'attribute' => 'place_proceeding',
                            'format' =>  ['date', 'php:d M Y'],
                        ],
                        [
                            'attribute' => 'violation_protocol',
                            'format' =>  ['date', 'php:d M Y'],
                        ],
                        [
                            'attribute' => 'violation_area',
                            'value' => Yii::$app->formatter->asDecimal($model2->violation_area, 1),
                        ],
                        [
                            'attribute' => 'types_punishment_id',
                            'value' => function($data) {
                                return !empty($data->typesPunishment->name) ? $data->typesPunishment->name : '';
                            },
                            'format' => 'raw',
                        ],
                        'date_check',
                    ],
                ]);

                $modelInjunctionId = GznInjunction::find()->select(["id"])->where(['gzn_violations_id' => $valId])->all();
                foreach ($modelInjunctionId as $keyVal) {
                    foreach ($keyVal as $valId) {
                        if (($model3 = GznInjunction::findOne($valId)) !== null) {
                            echo '<br>';
                            echo '<h3>Предписание</h3>';
                            echo DetailView::widget([
                                'model' => $model3,
                                'attributes' => [
                                    //'id',
                                    [
                                        'attribute' => 'count_term_execution',
                                        'format' =>  ['date', 'php:d M Y'],
                                    ],
                                    'act_checking',
                                    [
                                        'attribute' => 'not_done',
                                        'format' =>  ['date', 'php:d M Y'],
                                    ],
                                    [
                                        'attribute' => 'repeated',
                                        'format' =>  ['date', 'php:d M Y'],
                                    ],
                                    [
                                        'attribute' => 'decision_judge',
                                        'format' =>  ['date', 'php:d M Y'],
                                    ],
                                    [
                                        'attribute' => 'date_protocol',
                                        'format' =>  ['date', 'php:d M Y'],
                                    ],
                                    'decision_judge_j',
                                    'disobedience',
                                    //'gzn_violations_id',
                                ],
                            ]);
                        }
                    }
                }

            }
        }
    }
    ?>

    <hr>

</div>
