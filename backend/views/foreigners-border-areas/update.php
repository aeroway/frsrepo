<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ForeignersBorderAreas $model */

$this->title = 'Иностранцы приграничные территории: ' . $model->kn;
$this->params['breadcrumbs'][] = ['label' => 'Иностранцы приграничные территории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="foreigners-border-areas-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
