<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\InventoryPartsorderSearch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InventoryPartsorderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на запчасти';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = "Управление заявками";
?>
<div class="inventory-partsorder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
	$button =
	[
		'class' => 'yii\grid\ActionColumn',
		'buttons'=>
		[
			'act'=>function ($url, $model)
			{
				$options = [
					'title' => Yii::t('yii', 'Акт'),
					'aria-label' => Yii::t('yii', 'Акт'),
				];
				$customurl=Yii::$app->getUrlManager()->createUrl(['inventory-order/act','id'=>$model['id']]);
					return Html::a('<span class="glyphicon glyphicon-calendar"></span>', $customurl, $options);
			},
			'close'=>function ($url, $model)
			{
				$options = [
					'title' => Yii::t('yii', 'Закрыть'),
					'aria-label' => Yii::t('yii', 'Закрыть'),
				];
				$customurl=Yii::$app->getUrlManager()->createUrl(['inventory-order/close','id'=>$model['id']]);
					return Html::a('<span class="glyphicon glyphicon-ok"></span>', $customurl, $options);
			},

		],
		'template'=>'{act} {close} {delete}',
	];
?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions' => function($model)
		{
			if($model->status_id_invor == 1) return ['class'=>'success'];
            if($model->status_id_invor == 5) return ['class'=>'warning'];
		},
        'export' => false,
        'pjax' => true,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model, $key, $index, $column) 
				{
					$searchModel = new InventoryPartsorderSearch();
                    $searchModel->id_partsorder_invor = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    return Yii::$app->controller->renderPartial('_poitems', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],

            'invnum_invor',
            'invname_invor',
            'user_invor',
            //'demanding_invor',
			[
				'attribute'=>'status_id_invor',
				'value'=>'statusOrder',
			],
            'date_invor:date',
             $button,
        ],
    ]); ?>
</div>
