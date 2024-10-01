<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Otcheterl $model */

$this->title = $model->kuvd;
$this->params['breadcrumbs'][] = ['label' => 'Журнал запросов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="otcheterl-view">

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
            'area.name',
            'kuvd',
            'application_date:date',
            'kn',
            'coordinates:html',
            'address',
            'draft_number',
            'draft_date:date',
            'outgoing_number',
            'outgoing_date:date',
            'fio_reg',
            'email_reg',
        ],
    ]) ?>

</div>
