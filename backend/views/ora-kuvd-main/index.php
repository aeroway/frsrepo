<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OraKuvdMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ora Kuvd Mains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ora-kuvd-main-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ora Kuvd Main', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'otdel',
            'fio',
            'kuvd',
            'date_receipt',
            // 'version',
            // 'is_top',
            // 'date_version',
            // 'status',
            // 'date_issue',
            // 'kuvd_id',
            // 'date_load',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
