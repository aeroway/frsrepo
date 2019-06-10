<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RegistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '214-ФЗ и объекты действующие';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'developer',
            'object',
            'registered_object',
            'commission',
            'permission',
            'registrar',
            'file_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
