<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GznViolations */

$this->params['breadcrumbs'][] = ['label' => 'Объект проверок', 'url' => ['gzn-object/index']];
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Нарушения', 'url' => ['index', 'id' => $model->gzn_obj_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-violations-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
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
                'value' => Yii::$app->formatter->asDecimal($model->amount_fine, 2),
            ],
            [
                'attribute' => 'amount_fine_collected',
                'value' => Yii::$app->formatter->asDecimal($model->amount_fine_collected, 2),
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
            'place_proceeding',
            [
                'attribute' => 'violation_protocol',
                'format' =>  ['date', 'php:d M Y'],
            ],
            [
                'attribute' => 'violation_area',
                'value' => Yii::$app->formatter->asDecimal($model->violation_area, 1),
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
    ]) ?>

</div>
