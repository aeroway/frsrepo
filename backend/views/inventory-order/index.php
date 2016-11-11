<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\InventoryPartsorderSearch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InventoryPartsorderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на запчасти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-partsorder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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

            //'id',
            'invnum_invor',
            'invname_invor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
