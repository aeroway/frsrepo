<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OraKuvdMain */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ora Kuvd Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ora-kuvd-main-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'otdel',
            'fio',
            'kuvd',
            'date_receipt',
            'version',
            'is_top',
            'date_version',
            'status',
            'date_issue',
            'kuvd_id',
            'date_load',
        ],
    ]) ?>

</div>
