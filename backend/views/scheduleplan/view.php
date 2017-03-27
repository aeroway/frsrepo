<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SchedulePlan */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'План график', 'url' => ['index', 'id' => $model->pp_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-plan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'sum',
            'comment',
            'pm_id',
        ],
    ]) ?>

</div>
