<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VedomostCheckFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ведомости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vedomost-check-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php  //= Html::a('Create Vedomost Check Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'date_in',
                'label' => 'Возврат',
                'format' =>  ['date', 'php:d.m.Y'],
                'contentOptions' => ['style'=>'width: 90px;'],
            ],
            'user_in',
            'vedomost_num',
            //'vedomost_date',
            [
                'attribute' => 'IconStatus',
                'label' => 'Статус',
                'format' => 'html',
                'value' => 'IconStatus',
                'contentOptions'=>['style'=>'text-align: center; width: 65px;'],
            ],
            // 'check_type',
            // 'module',
            //'sektors_ip',
            [
                'attribute' => 'sektorsSektor.name',
                'label' => 'Нахождение',
            ]

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
