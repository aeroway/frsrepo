<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OtchetpriostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otchetpriost-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'area_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'suspension_id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'offer') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'kuvd') ?>

    <?php // echo $form->field($model, 'executor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
