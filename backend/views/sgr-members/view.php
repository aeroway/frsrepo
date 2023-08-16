<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SgrMembers */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Состав совета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sgr-members-view">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'fio',
            'position',
            // 'contact',
            'status',
            // 'photo',
            // [
            //     'attribute' => 'photo',
            //     'format' => 'html',
            //     'value' => function ($model) {
            //         return Html::img('@web/uploads/sov-gos-reg/' . $model->photo, ['width' => '100px']);
            //     },
            //     // 'contentOptions'=>['style'=>'width: 100px;'],
            // ],
        ],
    ]) ?>

</div>
