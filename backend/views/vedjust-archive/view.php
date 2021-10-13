<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\VedomostCheckForm */

$this->title = $model->vedomost_num;
$this->params['breadcrumbs'][] = ['label' => 'Приём дел в архив', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vedomost-check-form-view">

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
            'date_in',
            'user_in',
            'vedomost_num',
            // 'vedomost_date',
            // 'vedomost_res',
            // 'check_type',
            // 'module',
            // 'ip',
            // 'sektors_ip',
            // 'dt_fr',
        ],
    ]) ?>

</div>
