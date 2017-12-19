<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OraDopDoc */

$this->title = 'Update Ora Dop Doc: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ora Dop Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ora-dop-doc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
