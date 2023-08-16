<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OtchetfnsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchetfns-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'area') ?>

    <?= $form->field($model, 'type_obj') ?>

    <?= $form->field($model, 'kn') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'permit_use') ?>

    <?php // echo $form->field($model, 'square') ?>

    <?php // echo $form->field($model, 'date_reg') ?>

    <?php // echo $form->field($model, 'info_tax') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <?php // echo $form->field($model, 'in_process') ?>

    <?php // echo $form->field($model, 'remove_reg') ?>

    <?php // echo $form->field($model, 'identified') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'filename') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <?php // echo $form->field($model, 'date_load') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
