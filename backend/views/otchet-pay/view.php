<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OtchetPay */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ошибка в платежах', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchet-pay-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'number',
            'payer_name',
            'sum',
            'payer_id',
            'payer_date',
            'note',
            'date_load',
            'status',
            'username',
        ],
    ]) ?>

</div>
