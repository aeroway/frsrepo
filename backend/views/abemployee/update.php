<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AbEmployee */

$this->title = 'Обновить блокировку: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Блокировка', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить блокировку';
?>
<div class="ab-employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
