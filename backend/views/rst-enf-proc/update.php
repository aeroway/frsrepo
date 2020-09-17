<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RstEnfProc */

$this->title = 'Update Rst Enf Proc: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Реестр исполнительных производств', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->num_req, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="rst-enf-proc-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
