<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InventoryPartsorder */

$this->title = 'Создать заявку на запчасти';
$this->params['breadcrumbs'][] = ['label' => 'Заявки на запчасти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-partsorder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPoItem' => $modelsPoItem,
    ]) ?>

</div>
