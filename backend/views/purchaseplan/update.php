<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchasePlan */

$this->title = 'Редактировать план закупок: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'План закупок', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="purchase-plan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
