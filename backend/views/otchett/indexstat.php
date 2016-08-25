<?php

use yii\helpers\Html;
use yii\grid\GridView;

//use backend\models\Otchett;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчёт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
			$date5 = date_create(date('Y-m-d'));
			$date15 = date_create(date('Y-m-d'));
			$date30 = date_create(date('Y-m-d'));

			date_sub($date5, date_interval_create_from_date_string('5 days'));
			date_sub($date15, date_interval_create_from_date_string('15 days'));
			date_sub($date30, date_interval_create_from_date_string('30 days'));

		/*= Html::a('Create Otchet', ['create'], ['class' => 'btn btn-success']) */
		echo '<div class="bs-example-bg-classes">
				<p class="bg-active"><a href="index.php?OtchetstatSearch[date]='.date_format($date5, 'Y-m-d').'&r=otchett/indexstat&table='.\Yii::$app->request->get('table').'">В работе от 1 до 5 дней</a></p>
				<p class="bg-info"><a href="index.php?OtchetstatSearch[date]='.date_format($date15, 'Y-m-d').'&r=otchett/indexstat&table='.\Yii::$app->request->get('table').'">В работе от 5 до 15 дней</a></p>
				<p class="bg-warning"><a href="index.php?OtchetstatSearch[date]='.date_format($date30, 'Y-m-d').'&r=otchett/indexstat&table='.\Yii::$app->request->get('table').'">В работе от 15 и более дней</a></p>
			</div>';
		?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions' => function($model)
		{
			$date5  = new DateTime($model->date);
			$date5->add(new DateInterval('P5D'));
			$date15 = new DateTime($model->date);
			$date15->add(new DateInterval('P15D'));
			$date30 = new DateTime($model->date);
			$date30->add(new DateInterval('P30D'));

			if($date5->format('Y-m-d') >= date('Y-m-d') and $model->date <> NULL) return ['class'=>'active'];
			if($date15->format('Y-m-d') >= date('Y-m-d') and $model->date <> NULL) return ['class'=>'info'];

			return ['class'=>'warning'];
		},
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
			[
				'attribute' => 'kn',
				'contentOptions' => ['style'=>'width: 160px;'],
			],
            'description',
            //'status',
            'comment',
			[
				'attribute' => 'date',
				'format' =>  ['date', 'php:M d Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
			],
			[
				'attribute' => 'username',
				'contentOptions' => ['style'=>'width: 150px;'],
			],
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
			[
				'attribute' => 'date_load',
				'format' =>  ['date', 'php:M d Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
			],
			'area',

            //['class' => 'yii\grid\ActionColumn'],
			/*
			[
				'class' => 'yii\grid\ActionColumn',
				'buttons'=>
				[
					'view'=>function ($url, $model) 
					{
						$customurl=Yii::$app->getUrlManager()->createUrl(['otchett/view','id'=>$model['id'],'table'=> Otchett::$name]);

						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $customurl);
					},
					'update'=>function ($url, $model) 
					{
						$customurl=Yii::$app->getUrlManager()->createUrl(['otchett/update','id'=>$model['id'],'table'=> Otchett::$name]);

						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $customurl);
					}
				],
				'template' => '{view} {update}',
			],
			*/
        ],
    ]); ?>

</div>
