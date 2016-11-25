<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InventoryMoo */

$this->title = 'Добавить МО';
$this->params['breadcrumbs'][] = ['label' => 'Inventory Moos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-moo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
