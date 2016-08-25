<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InventoryParts */

$this->title = 'Добавить запчасть к объекту';
$this->params['breadcrumbs'][] = ['label' => 'Запчасти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-parts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formpl', [
        'model' => $model,
    ]) ?>

</div>
