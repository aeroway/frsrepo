<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use backend\models\Employee;

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
		/*= Html::a('Create Otchet', ['create'], ['class' => 'btn btn-success']) */
		?>
    </p>

	<?=Html::beginForm(['otchet/bulk'],'post');?>
	<?php
	if(in_array("OtchetManager", Yii::$app->user->identity->groups))
	{
		echo Html::dropDownList('action','',ArrayHelper::map(Employee::find()->where(['idm_otdel' => 139])->orderBy(['fam' => SORT_ASC])->all(),'fullName','fullName'),['class'=>'form-control','style'=>'width:90%; margin-bottom:10px; margin-right:10px; float:left']);
		echo Html::submitButton('Назначить', ['class' => 'btn btn-info','style'=>'margin-bottom:10px;']);
	}
	?>
    <?= GridView::widget([
		//'tableOptions' => ['class' => 'table table-striped table-hover'],
		//'layout' => "{items}<div class='row'><div class='pull-left'> \n {summary}</div><div class='pull-right'>{pager}</div></div>",
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions' => function($model)
		{
			if($model->flag == 1) return ['class'=>'danger'];
			if($model->flag == 2) return ['class'=>'success'];
		},
        'columns' => [
			['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],

            //'id',
			[
				'attribute' => 'kn',
				'contentOptions' => ['style'=>'width: 160px;'],
			],
            'description',
            'status',
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
			'flag',
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
	<?= Html::endForm();?> 

</div>
