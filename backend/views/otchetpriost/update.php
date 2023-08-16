<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetpriost */

$this->title = 'Редактировать Отчёт: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отчёты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="otchetpriost-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
