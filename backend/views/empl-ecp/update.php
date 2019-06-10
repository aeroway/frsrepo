<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EmplEcp */

$this->title = 'Редактировать: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ЭЦП', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="empl-ecp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
