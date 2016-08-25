<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OtchetnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchetn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'area') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'reason1') ?>

    <?= $form->field($model, 'reason2') ?>

    <?= $form->field($model, 'offer') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'condnum') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
