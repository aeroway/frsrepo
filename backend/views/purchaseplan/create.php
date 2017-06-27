<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchasePlan */

$this->params['breadcrumbs'][] = ['label' => 'Главная', 'url' => ['spending/index']];
$this->title = 'Создать смету';
$this->params['breadcrumbs'][] = ['label' => 'Смета', 'url' => ['index', 'id' => $sid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sid' => $sid,
        'fe' => 0,
    ]) ?>

</div>
