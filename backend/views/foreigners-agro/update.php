<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ForeignersAgro $model */

$this->title = 'Иностранцы с/х: ' . $model->kn;
$this->params['breadcrumbs'][] = ['label' => 'Иностранцы с/х', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="foreigners-agro-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
