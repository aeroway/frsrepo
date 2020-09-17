<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RstEnfProc */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Реестр исполнительных производств', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rst-enf-proc-create">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
