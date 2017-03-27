<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseMethod */

$this->title = 'Создать способ закупки';
$this->params['breadcrumbs'][] = ['label' => 'Способ закупки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-method-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
