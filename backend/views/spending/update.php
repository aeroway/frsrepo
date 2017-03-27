<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Spending */

$this->title = 'Редактировать расход: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Расход', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="spending-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
