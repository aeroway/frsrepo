<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgrRegulations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgr-regulations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_doc')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
