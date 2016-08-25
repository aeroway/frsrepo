<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отдел ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 

    ?>
    

    <p>
        <?php
		/*= Html::a('Create Otchet', ['create'], ['class' => 'btn btn-success']) */
		?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
/*		'rowOptions' => function($model)
		{
			if($model->flag == 1) return ['class'=>'danger'];
			if($model->flag == 2) return ['class'=>'success'];

		},
        */
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
//			[
//				'attribute' => 'kn',
//				'contentOptions' => ['style'=>'width: 160px;'],
//			],
//            'kn',
            'name',
//            'status',
//            'comment',
			//'flag',
			//'id_dpt',
			//'id_egrp',
			/*
			[
				'attribute' => 'date_update',
				'format' =>  ['date', 'php:M d Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
			],
			*/
			//'filename',

            //['class' => 'yii\grid\ActionColumn'],
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update}',
			],
        ],
    ]); ?>

</div>
