<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VedomostCheckForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vedomost-check-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_in')->textInput() ?>

    <?= $form->field($model, 'user_in')->textInput() ?>

    <?= $form->field($model, 'vedomost_num')->textInput() ?>

    <?= $form->field($model, 'vedomost_date')->textInput() ?>

    <?= $form->field($model, 'vedomost_res')->textInput() ?>

    <?= $form->field($model, 'check_type')->textInput() ?>

    <?= $form->field($model, 'module')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
