<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Lbo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ЛБО', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lbo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'sum',
            'comment',
            'year',
            [
                'attribute' => 'date',
                'format' =>  ['date', 'php:d.m.Y'],
            ],
        ],
    ]) ?>

</div>
