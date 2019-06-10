<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Regist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'developer')->textInput() ?>

    <?= $form->field($model, 'object')->textArea(['rows' => '6']) ?>

    <?= $form->field($model, 'registered_object')->textArea(['rows' => '6']) ?>

    <?= $form->field($model, 'commission')->textArea(['rows' => '6']) ?>

    <?= $form->field($model, 'permission')->textArea(['rows' => '6']) ?>

    <?= $form->field($model, 'registrar')->textInput() ?>

    <?= $form->field($model, 'file_name')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
