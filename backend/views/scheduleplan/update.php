<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SchedulePlan */

$this->params['breadcrumbs'][] = ['label' => 'Главная', 'url' => ['spending/index']];
//$this->params['breadcrumbs'][] = ['label' => 'План закупок', 'url' => ['purchaseplan/index', 'id' => $modelpp->st_id]];
$this->title = 'Редактировать план график: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'План график', 'url' => ['index', 'sid' => $model->pp_id]];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="schedule-plan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelpp' => $modelpp,
        'sid' => $sid,
    ]) ?>

</div>
