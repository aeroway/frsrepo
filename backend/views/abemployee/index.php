<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\Employee;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AbEmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блокировка';
$this->params['breadcrumbs'][] = $this->title;

if (in_array("AccountBlockingAdmin", Yii::$app->user->identity->groups))
{
	$buttons = 	[
					'class' => 'yii\grid\ActionColumn',
					//'buttons'=>$statusbutton,
					'template' => '{view} {update} {delete}',
				];
} else 
{
	$buttons = 	[
					'class' => 'yii\grid\ActionColumn',
					//'buttons'=>$statusbutton,
					'template' => '{view}',
				];
}
?>

<div class="ab-employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?php
		if(in_array("AccountBlockingAdmin", Yii::$app->user->identity->groups)) 
		{
			echo Html::a('Добавить блокировку', ['create'], ['class' => 'btn btn-success']);
			echo '&nbsp';
			echo Html::a('Добавить систему', ['absystems/index'], ['class' => 'btn btn-info']);
		}
		?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions' => function($model)
		{
			if(date('Y-m-d',strtotime($model->dt2)) <= date('Y-m-d') and $model->dt2 <> NULL) return ['class'=>'danger'];
		},
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
			[
				'attribute'=>'id_employee',
				'value'=>'fullName',
				//'filter' => Html::activeDropDownList($searchModel, 'id_employee', $newdata,['class'=>'form-control','prompt' => 'Выберите Фамилию'])
			],
            //'act',
			[
				'attribute' => 'dt1',
				'format' =>  ['date', 'php:M d Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
			],
			[
				'attribute' => 'dt2',
				'format' =>  ['date', 'php:M d Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
			],
			[
				'attribute'=>'systemslist',
				'value' => function($model) 
							{
								return $model->getFullSystems($model["id"]);
							},
			],
			[
				'attribute'=>'id_status',
				'value' => function($model)
							{
								return $model->getStatus($model["id"]);
							},
			],

			$buttons,
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
