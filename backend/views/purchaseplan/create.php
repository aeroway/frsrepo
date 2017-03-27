<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PurchasePlan */

$this->title = 'Создать план закупок';
$this->params['breadcrumbs'][] = ['label' => 'План закупок', 'url' => ['index', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
