<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OraDopDoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ora-dop-doc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_load')->textInput() ?>

    <?= $form->field($model, 'kuvd')->textInput() ?>

    <?= $form->field($model, 'FK_kuvd_id')->textInput() ?>

    <?= $form->field($model, 'date_receipt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
