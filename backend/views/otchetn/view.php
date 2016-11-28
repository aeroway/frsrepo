<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetn */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отчёты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetn-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
            /*
            Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'area',
            'status',
            [
                'label' => 'Причины',
                'attribute' => 'reason1',
            ],
            [
                'label' => 'Кол-во объектов недвижимости с разбивкой по причинам',
                'attribute' => 'reason2',
            ],
            [
                'label' => 'Предложения по выходу из ситуации (по каждому блоку причин)',
                'attribute' => 'offer',
            ],
            'comment',
            'condnum',
            [
                'attribute' => 'dateon',
                'format' =>  ['date', 'php:M d Y'],
            ],
            'usernameon',
            'id_dpt',
            'id_egrp',
            [
                'attribute' => 'date_update',
                'format' =>  ['date', 'php:M d Y'],
                'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
            ],
            'area',
            'date_load',

        ],
    ]) ?>

</div>
