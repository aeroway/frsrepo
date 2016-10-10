<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\Otchett;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchet */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отчёт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id, 'table'=> Otchett::$name], ['class' => 'btn btn-primary']) ?>
        <?php
		/*= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'kn',
            'description',
            'status',
            'comment',
			[
				'attribute' => 'date',
				'format' =>  ['date', 'php:d.m.Y'],
			],
            'username',
			'id_dpt',
			'id_egrp',
			[
				'attribute' => 'date_update',
				'format' =>  ['date', 'php:d M Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
			],
			'area',
			[
				'attribute' => 'date_load',
				'format' =>  ['date', 'php:d M Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
			],
			'protocol',
        ],
    ]) ?>

</div>
