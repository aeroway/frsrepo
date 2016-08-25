<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AbSystems */

$this->title = 'Редактировать Систему: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Блокировка', 'url' => ['abemployee/index']];
$this->params['breadcrumbs'][] = ['label' => 'Системы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="ab-systems-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
