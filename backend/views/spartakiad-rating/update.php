<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SpartakiadRating $model */

$this->title = 'Редактирование: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Спартакиада 2024', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->department->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="spartakiad-rating-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
