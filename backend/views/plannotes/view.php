<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Plannotes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Замечания', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plannotes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* echo Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'text',
            //'status',
            'action',
            //'pstages_id',
        ],
    ]) ?>

</div>
