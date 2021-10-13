<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InventoryRepairSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Техника на ремонт', 'url' => ['index']];
$this->title = 'История изменений';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-repair-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'area',
            'name',
            'invnum',
            'inventory_moo',
            'inventory_status',
            [
                'attribute' => 'date_edit',
                'format' =>  ['date', 'php:d M Y'],
            ],
            'note',
            'username',
        ],
    ]); ?>

</div>