<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\VedomostCheckForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vedomost Check Forms', 'url' => ['indexved']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vedomost-check-form-view">

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
            'date_in',
            'user_in',
            'vedomost_num',
            'vedomost_date',
            'vedomost_res',
            'check_type',
            'module',
        ],
    ]) ?>

</div>
