<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AbEmployee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Блокировка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ab-employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?php if(in_array("AccountBlockingAdmin", Yii::$app->user->identity->groups)) { ?>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
		<?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_employee',
			[
				'attribute'=>'fullName',
				'label'=>'Сотрудник',
			],
            'act',
			[
				'attribute' => 'dt1',
				'format' =>  ['date', 'php:d M Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
			],
			[
				'attribute' => 'dt2',
				'format' =>  ['date', 'php:d M Y'],
				'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
			],
        ],
    ]) ?>

</div>
