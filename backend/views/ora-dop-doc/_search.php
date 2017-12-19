<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OraDopDocSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ora-dop-doc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_load') ?>

    <?= $form->field($model, 'kuvd') ?>

    <?= $form->field($model, 'FK_kuvd_id') ?>

    <?= $form->field($model, 'date_receipt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
