<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отделы';
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
            'kn',
            'id',
            'name',
            'CountErrors',
//            'status',
//            'comment',
			//'flag',
			//'id_dpt',
			//'id_egrp',
			
			[
				'label'=>'внутр. id',
                //'attribute' => $model->id,
                'value' => 'id',  
				//'format' =>  ['date', 'php:M d Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
			],
			
			//'filename',

            //['class' => 'yii\grid\ActionColumn'],
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {link}',
                'buttons' => [
                'update' => function ($url,$model) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-screenshot"></span>', 
                    $url);
                },
                'link' => function ($url,$model,$key) {
                    return Html::a('Действие '.$model->id, $url);
                },
            ],
			],
        ],
    ]); ?>

</div>
