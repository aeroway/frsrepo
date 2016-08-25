<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventoryPartsLigamentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Установленные запчасти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-parts-ligament-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* Html::a('Create Inventory Parts Ligament', ['create'], ['class' => 'btn btn-success']) */?>
		<?= Html::a('Перейти к запчастям', Yii::$app->getUrlManager()->createUrl(['inventoryparts/index']), ['class' => 'btn btn-info']) ?>
		<?= Html::a('Перейти к объектам', Yii::$app->getUrlManager()->createUrl(['inventory/index']), ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
			'typepartsName',
			[
				'attribute' => 'id_inventory_parts',
				'value' => 'idInventoryParts.nameparts',
			],
			'amount_ipl',
			[
				'attribute' => 'invnumInventory.invname',
				'label' => 'Объект',
			],
			'invnum_inventory',
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update}',
			],
        ],
    ]); ?>
<?php
	$this->registerJs('
		var gridview_id = ""; // specific gridview
		var columns = [2]; // index column that will grouping, start 1
		var column_data = [];
			column_start = [];
			rowspan = [];
 
		for (var i = 0; i < columns.length; i++)
		{
			column = columns[i];
			column_data[column] = "";
			column_start[column] = null;
			rowspan[column] = 1;
		}

		var row = 1;
		$(gridview_id+" table > tbody  > tr").each(function()
		{
			var col = 1;
			$(this).find("td").each(function()
			{
				for (var i = 0; i < columns.length; i++) 
				{
					if(col==columns[i])
					{
						if(column_data[columns[i]] == $(this).html()) {
							$(this).remove();
							rowspan[columns[i]]++;
							$(column_start[columns[i]]).attr("rowspan",rowspan[columns[i]]);
						} else {
							column_data[columns[i]] = $(this).html();
							rowspan[columns[i]] = 1;
							column_start[columns[i]] = $(this);
						}
					}
				}
				col++;
			})
			row++;
		});
	');
?>
</div>
