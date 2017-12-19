<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OraKuvdMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $fio;

$this->params['breadcrumbs'][]= ['label' => 'Отделы', 'url' => ['ora-kuvd-main/index']];
$this->params['breadcrumbs'][]= ['label' => $otdel_name, 'url' => ['ora-kuvd-main/list', 'ViewByFioSearch[otdel]' => $fl]];
$this->params['breadcrumbs'][] = $fio;
?>
<div class="ora-kuvd-main-index">

    <h1><?= Html::encode($this->title.':'.$title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'otdel',
            //'fio',
            [
                'label' => 'Основная запись',
               'value' => 'kuvd',
            ],
            [
                'attribute' => 'date_receipt',
                 'format' => ['date', 'php:d.m.Y'],
            ],
            [
                'label' =>  'Дата решения',
                'format' => ['date', 'php:d.m.Y'],
                'value' =>  'date_version',
            ],
            //'version',
            //'is_top',

             'status',
            [
                'attribute' => 'date_suspend',
                'label' =>  'Срок приостановки',
                'format' => ['date', 'php:d.m.Y'],
            ],
            // 'kuvd_id',
            //'date_load',
            [  
                'label' =>  'Доп. документы',
                'value'=>'fKDopDoc.kuvd',
            ],

            [
                'attribute' => 'fKDopDoc.date_receipt',
                'format' => ['date', 'php:d.m.Y'],
            ],
            [
                'label' =>  'Основания',
                'attribute' => 'message',
            ]

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
