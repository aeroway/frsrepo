<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->title = $model->invname;
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать объект', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        /*= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'invname',
            'invnum',
            [
                'attribute' => 'idMoo.name',
                'label' => 'Материальноответственный',
            ],
            'location',
            'idTypetech.name',
            [
                'attribute' => 'date',
                'format' =>  ['date', 'php:d.m.Y'],
            ],
            'idStatus.name',
            'comment',
            [
                'attribute' => 'authority',
                'format'=>'raw',
                'value' => $model->authority ? 'Да' : '-',
            ],
            [
                'attribute' => 'waybill',
                'format'=>'raw',
                'value' => $model->waybill ? 'Да' : '-',
            ],
            //'username',
        ],
    ]) ?>

</div>
