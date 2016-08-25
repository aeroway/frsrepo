<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VedomostCheckFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vedomost-check-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_in') ?>

    <?= $form->field($model, 'user_in') ?>

    <?= $form->field($model, 'vedomost_num') ?>

    <?= $form->field($model, 'vedomost_date') ?>

    <?php // echo $form->field($model, 'vedomost_res') ?>

    <?php // echo $form->field($model, 'check_type') ?>

    <?php // echo $form->field($model, 'module') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
