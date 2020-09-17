<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DocSrchReqSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-srch-req-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'subdivision_id') ?>

    <?= $form->field($model, 'date_update') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'answer') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
