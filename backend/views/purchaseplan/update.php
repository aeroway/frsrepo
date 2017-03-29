<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchasePlan */

$this->params['breadcrumbs'][] = ['label' => 'Смета', 'url' => ['spending/index']];
$this->title = 'Редактировать план закупок: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'План закупок', 'url' => ['index', 'id' => $model->st_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="purchase-plan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $model->id,
    ]) ?>

</div>
