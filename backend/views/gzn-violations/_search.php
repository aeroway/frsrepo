<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GznViolationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gzn-violations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'gzn_obj_id') ?>

    <?= $form->field($model, 'decision_punishment') ?>

    <?= $form->field($model, 'date_due') ?>

    <?php // echo $form->field($model, 'violation_protocol') ?>

    <?php // echo $form->field($model, 'violation_area') ?>

    <?php // echo $form->field($model, 'amount_fine') ?>

    <?php // echo $form->field($model, 'amount_fine_collected') ?>

    <?php // echo $form->field($model, 'payment_doc') ?>

    <?php // echo $form->field($model, 'decision_cancellation') ?>

    <?php // echo $form->field($model, 'decision_appeal') ?>

    <?php // echo $form->field($model, 'date_outgoing') ?>

    <?php // echo $form->field($model, 'date_performance') ?>

    <?php // echo $form->field($model, 'violation_decision_end') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
