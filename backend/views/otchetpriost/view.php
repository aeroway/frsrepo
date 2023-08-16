<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use backend\models\SuspensionArticles;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetpriost */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отчёты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetpriost-view">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'area.name',
            'kuvd',
            // 'comment',
            [
                'attribute' => 'date_suspend',
                'format' =>  ['date', 'php:d M Y'],
            ],
            'urd',
            'mark.name',
            'fio_sro',
            [
                'attribute' => 'suspensionId',
                'value' => function ($model) {
                    $suspensionArticlesId = ArrayHelper::map($model->otchetpriostSuspensions, 'id', 'suspension_articles_id');
                    $articlesName = ArrayHelper::map(SuspensionArticles::find()->where(['IN', 'id', $suspensionArticlesId])->asArray()->all(), 'id', 'name');

                    return implode(',<br>', $articlesName);
                 },
                 'format' => 'raw'
            ],
            'description',
            'offer',
            'executor',
            'username',
            [
                'attribute' => 'date',
                'format' =>  ['date', 'php:d M Y'],
            ],
            // [
            //     'attribute' => 'date_update',
            //     'format' =>  ['date', 'php:M d Y'],
            //     'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
            // ],
            // 'date_load',
        ],
    ]) ?>

</div>
