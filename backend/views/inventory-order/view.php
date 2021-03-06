<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InventoryPartsorder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки на запчасти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-partsorder-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php /* Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */ ?>
        <?php /* Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'id',
            'invnum_invor',
            'invname_invor',
            'ip_invor',
            'user_invor',
        ],
    ]) ?>

</div>
