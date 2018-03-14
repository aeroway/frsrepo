<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GznInjunction */

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['gzn-object/index']];
$this->params['breadcrumbs'][] = ['label' => 'Нарушения', 'url' => ['gzn-violations/index', 'id' => $model->gznViolations->gzn_obj_id]];
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Предписания', 'url' => ['index', 'id' => $model->gzn_violations_id, 'pid' => $model->gznViolations->gzn_obj_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-injunction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : ''], ['class' => 'btn btn-primary']) ?>
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
    ]) ?>

</div>
