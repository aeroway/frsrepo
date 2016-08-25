<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetn */

$this->title = 'Обновить Отчёт: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отчёты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="otchetn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
