<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventoryPartsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запчасти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-parts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить запчать', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Перейти к объектам', Yii::$app->getUrlManager()->createUrl(['inventory/index']), ['class' => 'btn btn-info']) ?>
		<?= Html::a('Установленные запчасти', Yii::$app->getUrlManager()->createUrl(['inventorypl/index']), ['class' => 'btn btn-info']) ?>
    </p>

<?php
Modal::begin([
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ],
    'header' => '<h3>Установить</h3>',
]);
ActiveForm::begin();
echo '<div id="inventory-parts-setup"></div>';
//echo '<div id="inventory-parts-update"></div>';
ActiveForm::end();
Modal::end();

Modal::begin([
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ],
    'header' => '<h3>Редактировать</h3>',
]);

Modal::end();
?>
<?php Pjax::begin(); ?>	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
			'nameparts',
			[
				'attribute' => 'id_typeparts',
				'value' => 'idTypeparts.name',
				//'filterRowOptions'=>['class'=>'kartik-sheet-style'],
			],
            'amount',
            'location',
			'comment_parts',

            [
				'class' => 'yii\grid\ActionColumn',
				'contentOptions'=>['style'=>'text-align: center;width: 80px;'],
				'buttons'=>
				[
					'addparts'=>function ($url, $model, $key)
					{
						$options = [
							'title' => Yii::t('yii', 'Setup'),
							'aria-label' => Yii::t('yii', 'Setup'),
							'data-toggle' => Yii::t('yii', 'modal'),
							'data-target' => Yii::t('yii', '#w0'),
						];
						$url=Yii::$app->getUrlManager()->createUrl(['inventoryparts/addparts','id'=>$model['id']]);

						return Html::a('<span class="glyphicon glyphicon-wrench"></span>', $url, $options);

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

						$url=Yii::$app->getUrlManager()->createUrl(['inventoryparts/updatee','id'=>$model['id'], 'page'=>$page, 'sort'=>$sort]);

						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);

					},

				],
				'template' => '{view} {update} {addparts}',
			],
        ],
    ]);
	?>
<?php Pjax::end(); ?>
</div>
