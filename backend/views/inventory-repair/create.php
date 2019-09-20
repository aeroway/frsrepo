<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InventoryRepair */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Техника на ремонт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-repair-create">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
