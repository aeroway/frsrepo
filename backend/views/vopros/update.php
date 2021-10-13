<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Vopros */

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Раздел тестов', 'url' => ['vopros/index']];

if (!empty($model->otdel_id)) {
    $this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['vopros/index', 'id' => $model->otdel_id]];
}

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="vopros-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
