<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\InventorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать объект', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Перейти к запчастям', Yii::$app->getUrlManager()->createUrl(['inventoryparts/index']), ['class' => 'btn btn-info']) ?>
		<?= Html::a('Установленные запчасти', Yii::$app->getUrlManager()->createUrl(['inventorypl/index']), ['class' => 'btn btn-info']) ?>
		<?= Html::a('МО', Yii::$app->getUrlManager()->createUrl(['inventory-moo/index']), ['class' => 'btn btn-info']) ?>
    </p>

<?php

if(in_array("AdminInventory", Yii::$app->user->identity->groups))
{
	$button =
	[
		'class' => 'yii\grid\ActionColumn',
		'buttons'=>
		[
			'log'=>function ($url, $model)
			{
				$options = [
					'title' => Yii::t('yii', 'История'),
					'aria-label' => Yii::t('yii', 'История'),
				];
				$customurl=Yii::$app->getUrlManager()->createUrl(['inventory/log','invnum'=>$model['invnum']]);
					return Html::a('<span class="glyphicon glyphicon-calendar"></span>', $customurl, $options);
			},
			'update'=>function ($url, $model, $key)
			{
				$options = [
					'title' => Yii::t('yii', 'Редактировать'),
					'aria-label' => Yii::t('yii', 'Редактировать'),
					'data-toggle' => Yii::t('yii', 'modal'),
					'data-target' => Yii::t('yii', '#w0'),
				];

				if(empty(Yii::$app->request->queryParams["page"])) {
					$page = 1;
				} else {
					$page = Yii::$app->request->queryParams["page"];
				}
				if(empty(Yii::$app->request->queryParams["sort"])) {
					$sort = '';
				} else {
					$sort = Yii::$app->request->queryParams["sort"];
				}

				$url=Yii::$app->getUrlManager()->createUrl(['inventory/updatee','id'=>$model['id'], 'page'=>$page, 'sort'=>$sort]);

				return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
			}
		],
		'template'=>'{view} {update} {log}',
	];
} else {
	$button =
	[
		'class' => 'yii\grid\ActionColumn',
		'buttons'=>
		[
			'update'=>function ($url, $model, $key)
			{
				$options = [
					'title' => Yii::t('yii', 'Редактировать'),
					'aria-label' => Yii::t('yii', 'Редактировать'),
					'data-toggle' => Yii::t('yii', 'modal'),
					'data-target' => Yii::t('yii', '#w0'),
				];

				if(empty(Yii::$app->request->queryParams["page"])) {
					$page = 1;
				} else {
					$page = Yii::$app->request->queryParams["page"];
				}
				if(empty(Yii::$app->request->queryParams["sort"])) {
					$sort = '';
				} else {
					$sort = Yii::$app->request->queryParams["sort"];
				}

				$url=Yii::$app->getUrlManager()->createUrl(['inventory/updatee','id'=>$model['id'], 'page'=>$page, 'sort'=>$sort]);

				return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
			}
		],
		'template'=>'{view} {update}',
	];	
}

Modal::begin([
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ],
    'header' => '<h3>Редактировать</h3>',
]);
ActiveForm::begin();
echo '<div id="inventory-parts-setup"></div>';
ActiveForm::end();
Modal::end();

?>
<?php Pjax::begin(); ?>	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'invname',
            'invnum',
            //'id_moo',
			[
				'attribute' => 'id_moo',
				'value' => 'idMoo.name',
				'label' => 'Ответственный',
			],
            'location',
            // 'id_typetech',
			[
				'attribute'=>'id_status',
				'value'=>'idStatus.name',
			],
			[
				'attribute'=>'id_typetech',
				'value'=>'idTypetech.name',
			],
			//'date:date',
			[
				'attribute' => 'date',
				'format' =>  ['date', 'php:M d Y'],
				'contentOptions' => ['style'=>'width: 100px; text-align: center;'],

				//'value' => function($searchModel) {
				//	$date = new DateTime($searchModel->date);
				//	return $date->format('M d Y');
				//}

			],
            // 'id_status',
            'comment',
			[
				'attribute'=>'authority',
				'contentOptions' =>function ($model, $key, $index, $column){
					return ['class' => 'name'];
				},
				'content'=>function($data){
					return $data["authority"] ? 'Да' : '-';
				}
			],
			[
				'attribute'=>'waybill',
				'contentOptions' =>function ($model, $key, $index, $column){
					return ['class' => 'name'];
				},
				'content'=>function($data){
					return $data["waybill"] ? 'Да' : '-';
				}
			],
            'username',

            $button,

        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
