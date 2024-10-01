<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\GenTeamMembers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gen-team-form-barcode">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'guidBarcode')->textInput(['autofocus' => 'autofocus', 'style' => 'width: 300px;']) ?>

    <div class="form-group">
        <?php // echo Html::submitButton('Проверить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>