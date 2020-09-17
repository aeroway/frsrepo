<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RstEnfProcSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Реестр исполнительных производств';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rst-enf-proc-index">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'otdel_id',
                'value' => 'otdel.text'
            ],
            'num_req',
            'agency',
            'num_enf_proc',
            'decision',
            'num_notice',
            'comment',
            'num_appeal',
            'result',
            // 'date_edit',
            [
                'attribute' => 'date_edit',
                'format' =>  ['date', 'php:d M Y'],
                'contentOptions' => ['style' => 'width: 100px; text-align: center;'],
            ],
            'username',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
