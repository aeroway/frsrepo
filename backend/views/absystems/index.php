<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AbSystemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Системы';
$this->params['breadcrumbs'][] = ['label' => 'Блокировка', 'url' => ['abemployee/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ab-systems-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать запись', ['create'], ['class' => 'btn btn-success']) ?>
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
