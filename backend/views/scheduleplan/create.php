<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SchedulePlan */

$this->params['breadcrumbs'][] = ['label' => 'Смета', 'url' => ['spending/index']];
$this->params['breadcrumbs'][] = ['label' => 'План закупок', 'url' => ['index', 'id' => $model->pp_id]];
$this->title = 'Создать план график';
$this->params['breadcrumbs'][] = ['label' => 'План график', 'url' => ['index', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
