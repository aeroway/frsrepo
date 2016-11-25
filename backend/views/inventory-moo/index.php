<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InventoryMooSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Материально ответственное лицо';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-moo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить МО', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Перейти к объектам', Yii::$app->getUrlManager()->createUrl(['inventory/index']), ['class' => 'btn btn-info']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
