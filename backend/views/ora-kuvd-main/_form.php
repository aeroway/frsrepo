<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OraKuvdMain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ora-kuvd-main-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'otdel')->textInput() ?>

    <?= $form->field($model, 'fio')->textInput() ?>

    <?= $form->field($model, 'kuvd')->textInput() ?>

    <?= $form->field($model, 'date_receipt')->textInput() ?>

    <?= $form->field($model, 'version')->textInput() ?>

    <?= $form->field($model, 'is_top')->textInput() ?>

    <?= $form->field($model, 'date_version')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'date_issue')->textInput() ?>

    <?= $form->field($model, 'kuvd_id')->textInput() ?>

    <?= $form->field($model, 'date_load')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
