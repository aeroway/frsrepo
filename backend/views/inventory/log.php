<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->title = 'История изменений';
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

?>
<style>
tbody tr:nth-child(1) {
    color: green; /* Цвет текста */
    font-weight: bold;
}
</style>
<div class="inventory-log">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'invname',
            'invnum',
            'idMoo.name',
            'location',
            'idStatus.name',
            'idTypetech.name',
            [
                'attribute' => 'date',
                'format' =>  ['date', 'php:M d Y'],
                'contentOptions' => ['style'=>'width: 100px; text-align: center;'],
            ],
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

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
