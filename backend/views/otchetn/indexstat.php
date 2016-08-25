<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчёты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('Создать', ['create'], ['class' => 'btn btn-success'])
		echo '<div class="bs-example-bg-classes">
				<p class="bg-active">В работе от 1 до 5 дней.</p>
				<p class="bg-info">В работе от 5 до 15 дней.</p>
				<p class="bg-warning">В работе от 15 и более дней.</p>
			</div>';
		?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions' => function($model)
		{
			$date5  = new DateTime($model->dateon);
			$date5->add(new DateInterval('P5D'));
			$date15 = new DateTime($model->dateon);
			$date15->add(new DateInterval('P15D'));
			$date30 = new DateTime($model->dateon);
			$date30->add(new DateInterval('P30D'));

			if($date5->format('Y-m-d') >= date('Y-m-d') and $model->dateon <> NULL) return ['class'=>'active'];
			if($date15->format('Y-m-d') >= date('Y-m-d') and $model->dateon <> NULL) return ['class'=>'info'];

			return ['class'=>'warning'];
		},
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'area',
			'condnum',
            'status',
            'reason1',
			[
				'attribute' => 'reason2',
				'contentOptions' => ['title'=>'Количество объектов недвижимости с разбивкой по причинам'],
			],
			[
				'attribute' => 'offer',
				'contentOptions' => ['title'=>'Предложения по выходу из ситуации (по каждому блоку причин)'],
			],
            'comment',
			[
				'attribute' => 'dateon',
				'format' =>  ['date', 'php:M d Y'],
				'contentOptions' => ['style'=>'text-align: center;'],
			],
			'usernameon',
			[
				'attribute' => 'date_load',
				'format' =>  ['date', 'php:M d Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
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

			/*
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update}',
			],
			*/
        ],
    ]); ?>

</div>
